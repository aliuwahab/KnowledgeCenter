<?php

namespace App\Listeners;

use App\Events\ArticleViewed;
use App\Models\View;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ArticleViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleViewed  $event
     * @return void
     */
    public function handle(ArticleViewed $event)
    {
        $view = new View();
        $view->article_id = $event->articleId;
        $view->ip_address = $event->viewerIpAddress;
        
        $view->save();
    }
}
