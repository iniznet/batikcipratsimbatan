<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Blog\Post;
use App\Models\Management\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Post $post;
    public Subscriber $subscriber;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, Subscriber $subscriber)
    {
        $this->post = $post;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send newsletter mail
        Mail::to($this->subscriber->email)
            ->send(new NewsletterMail($this->post, $this->subscriber));
    }
}
