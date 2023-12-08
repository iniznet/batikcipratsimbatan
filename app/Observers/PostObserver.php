<?php

namespace App\Observers;

use App\Jobs\SendNewsletterMail;
use App\Models\Blog\Post;
use App\Models\Management\Subscriber;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        if ($post->status !== 'publish') {
            return;
        }

        $subscribers = Subscriber::all();

        // Send newsletter mail
        foreach ($subscribers as $subscriber) {
            SendNewsletterMail::dispatch($post, $subscriber);
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
