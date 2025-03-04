<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\BookCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;

class SendBookCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $book)
    {
    }

    public function handle(): void
    {
        $users = User::chunk(4, function ($users) {
            foreach ($users as $user) {
                // Rate Limiting
                $executed = RateLimiter::attempt(
                    'send-book-notification:' . $user->id,
                    $perMinute = 5,
                    function () use ($user) {
                        Notification::send($user, new BookCreatedNotification($this->book));
                        Log::info("Book sent to user: {$user->email}");
                    }
                );

                if (!$executed) {
                    Log::warning("Rate limit exceeded for user: {$user->email}");
                     $this->release(60); 
                }
            }
            Log::info("Book sent to chunk of users");
        });
        Log::info("Book sent all");
    }
}
