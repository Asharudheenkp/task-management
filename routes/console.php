<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:mark-task-as-expired')->hourly();