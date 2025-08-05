<?php

namespace App\Traits\Admin\Email;

use App\Mail\CRM\Form\FormSubmittedInternal;
use App\Models\CRM\Form;
use App\Models\CRM\FormSubmission;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait PreviewsMailables
{
    /**
     * @var array
     * e.g. [
     *  'crm-email-example' => [
     *      'mailable' => 'getCrmEmailExample',
     *      'module' => 'CRM',
     *      'name' => 'CRM Email Example',
     *  ],
     * ]
     */
    private array $mailable_map = [
    ];

    protected function getMailableMap(): array
    {
        $map = $this->mailable_map;

        // Add any CRM forms -- NOTE: must have actual submissions for now
        Form::has('formSubmissions')->each(function (Form $form) use (&$map) {
            $map["crm-form-submitted-internal-{$form->id}"] = [
                'mailable' => 'getFormSubmittedInternal',
                'mailableParams' => ['form_id' => $form->id],
                'module' => 'CRM',
                'name' => "Form Submitted Internal: {$form->name}",
            ];
        });

        return $map;
    }

    protected function getMailablePreviewUrls(): Collection
    {
        return collect($this->getMailableMap())->mapWithKeys(function (array $mailable, string $id) {
            return [
                $id => [
                    'module' => $mailable['module'],
                    'name' => $mailable['name'],
                    'url' => route('admin.email.preview.show', $id)
                ]
            ];
        })->groupBy('module', preserveKeys: true);
    }

    protected function getMailable(string $mailable_id): ?Mailable
    {
        $mailable_map = $this->getMailableMap();
        $mailable = Arr::get($mailable_map, $mailable_id . '.mailable');
        $params = Arr::get($mailable_map, $mailable_id . '.mailableParams', []);

        if (!$mailable) {
            return null;
        }

        return $this->$mailable($params);
    }

    protected function getFormSubmittedInternal(array $params): Mailable
    {
        return new FormSubmittedInternal(
            FormSubmission::where('form_id', Arr::get($params, 'form_id'))->firstOrFail()
        );
    }
}
