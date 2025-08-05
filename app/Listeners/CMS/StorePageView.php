<?php

namespace App\Listeners\CMS;

use App\Events\CMS\PageViewed;
use App\Models\CMS\PageView;
use Illuminate\Contracts\Queue\ShouldQueue;

class StorePageView implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PageViewed $event): void
    {
        $pageView = [
            'page_id'   => $event->page->id,
            // TODO: Process additional data (IP, Referrer, etc.)
        ];

        PageView::create($pageView);
    }
}
