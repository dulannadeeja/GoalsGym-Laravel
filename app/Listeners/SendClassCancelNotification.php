<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use App\Jobs\ProcessClassCanceledNotification;
use App\Models\ScheduledClass;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendClassCancelNotification
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
    public function handle(ClassCanceled $event): void
    {
        $scheduledClass = $event->scheduledClass;
        $allBookedUsers = $scheduledClass->bookedUsers;
//        $allBookedUsers->each(function ($bookedUser) use ($scheduledClass) {
//            $mailData = [
//                'userName'=>$bookedUser->name,
//                'date'=> $scheduledClass->started_at->format('Y-m-d'),
//                'time'=> $scheduledClass->started_at->format('H:i'),
//                'canceledBy'=> auth()->user()->name,
//            ];
////            Mail::to($bookedUser->email)->send(new \App\Mail\ClassCanceled($mailData);
//        });
        $mailData = [
            'className' => $scheduledClass->classType->name,
            'date' => $scheduledClass->started_at->format('Y-m-d'),
            'time' => $scheduledClass->started_at->format('H:i'),
            'canceledBy' => auth()->user()->name,
        ];
        ProcessClassCanceledNotification::dispatch($mailData, $allBookedUsers);

//        Notification::send($allBookedUsers, new \App\Notifications\ClassCanceled($mailData));
    }
}
