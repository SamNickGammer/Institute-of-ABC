<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('run:clear', function () {
    $this->info('Running clear commands...');

    Artisan::call('config:clear');
    $this->info('Config cleared!');

    Artisan::call('route:clear');
    $this->info('Route cleared!');

    Artisan::call('cache:clear');
    $this->info('Cache cleared!');

    Artisan::call('optimize:clear');
    $this->info('Optimize cleared!');

    $this->info('All clear commands executed successfully!');
})->purpose('Run config:clear, route:clear, cache:clear, and optimize:clear sequentially');
