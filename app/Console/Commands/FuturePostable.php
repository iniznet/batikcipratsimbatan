<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterMail;
use App\Models\Blog\Page;
use App\Models\Blog\Post;
use App\Models\Management\Subscriber;
use App\Models\Shop\Product;
use Illuminate\Console\Command;

class FuturePostable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:future-postable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('published_at', '<=', now())
            ->where('status', 'future')
            ->get();

        Page::where('published_at', '<=', now())
            ->where('status', 'future')
            ->update(['status' => 'published']);

        Product::where('published_at', '<=', now())
            ->where('status', 'future')
            ->update(['status' => 'published']);

        $subscribers = Subscriber::all();
        $posts->each(function ($post) use ($subscribers) {
            $post->update(['status' => 'published']);

            // Send newsletter mail
            foreach ($subscribers as $subscriber) {
                SendNewsletterMail::dispatch($post, $subscriber);
            }
        });
    }
}
