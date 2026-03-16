<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class MarkTaskAsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-task-as-expired';

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
        $now = now();
        $tasksIds = Task::where('due_date', '<',   $now)->whereNotIn('status', ['completed', 'expired'])->pluck('id');
        Task::whereIn('id', $tasksIds)->update(['status' => 'expired']);
    }
}
