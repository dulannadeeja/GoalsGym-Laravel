<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncrementDateOfClasses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date-of-classes {--days=1}';

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
        $days = $this->option('days');

        $scheduledClasses = ScheduledClass::all();

        $scheduledClasses->each(function ($scheduledClass) use ($days) {
            $scheduledClass->started_at = $scheduledClass->started_at->addDays($days);
            $scheduledClass->save();
        });
    }
}
