<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('send:reminders', function () {
    $tasks = Task::where('due_date', '<=', now()->addHours(1))
                 ->where('completed', false)
                 ->get();

    foreach ($tasks as $task) {
        Mail::to('joshuamumbere71@gmail.com')->send(new TaskReminderMail($task));
    }
})->describe('Send task reminders for due tasks.');

Schedule::command('send:reminders')->everyMinute();
