<?php

namespace App\Http\Resources\Web\CMS;

use App\Http\Resources\BaseResource;
use App\Interfaces\CMS\TemplateFieldInterface;

class ContentResource extends BaseResource
{
    public $preserveKeys = true;

    public function toArray($request)
    {
        $data = $this->data;
        if (in_array($this->template_field_type, TemplateFieldInterface::JSON_TYPES)) {
            $data = collect(json_decode($data, true));

            if ($this->template_field_type === TemplateFieldInterface::TYPE_COMPONENT) {
                $data = $data->keyBy('template_field_slug');
            } else if ($this->template_field_type === TemplateFieldInterface::TYPE_REPEATER) {
                $data = $data->map(function($item) {
                    return collect($item)->keyBy('template_field_slug');
                });
            }
        }

        return [
            'data'              => $data,
            'template_field'    => TemplateFieldResource::make($this->whenLoaded('templateField')),
        ];
    }
}
