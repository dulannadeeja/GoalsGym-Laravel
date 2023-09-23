<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use function Laravel\Prompts\select;

class ClassBookingRemind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:class-booking-remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind all members that have not booked upcoming classes to do so';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $membersWithoutUpcomingBookings = User::whereHas('role', function ($query) {
            $query->where('name', 'member');
        })->whereDoesntHave('bookings', function ($query) {
            $query->where('started_at', '>', now());
        })->get(['name', 'email']);

        // log the users that will be notified to the console
        $this->table(['Name', 'Email'], $membersWithoutUpcomingBookings->toArray());

        Notification::send($membersWithoutUpcomingBookings, new \App\Notifications\ClassBookingReminder());
    }
}
