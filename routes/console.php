<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('fcm', function(){

    $tokens = User::query()->whereNotNull('fcm_token')->select(['fcm_token'])->get()->pluck('fcm_token')->toArray();

    $data = [
        'title' => 'test',
        'body' => 'test',
        'click_action' => 'https://google.com'
    ];

    $message = CloudMessage::new()
        ->withData($data);

    $messaging = app('firebase.messaging');
    $messaging->sendMulticast($message, $tokens);
});
