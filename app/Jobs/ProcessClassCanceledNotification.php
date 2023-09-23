<?php

namespace App\Jobs;

use App\Mail\ClassCanceled;
use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessClassCanceledNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $mailData,public $allBookedUsers)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ProcessClassCanceledNotification');
        Notification::send($this->allBookedUsers, new \App\Notifications\ClassCanceled($this->mailData));
    }
}
