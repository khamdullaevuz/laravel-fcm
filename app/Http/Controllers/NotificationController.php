<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationController extends Controller
{
    public function show()
    {
        return view('notification.show');
    }

    public function send(Request $request)
    {
        $params = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'click_action' => 'nullable'
        ]);


        $tokens = User::query()->whereNotNull('fcm_token')->select(['fcm_token'])->get()->pluck('fcm_token')->toArray();
        $data = [
            'title' => $params['title'],
            'body' => $params['body'],
            'click_action' => $params['click_action'] ?? null
        ];

        $message = CloudMessage::new()
            ->withData($data);

        $messaging = app('firebase.messaging');
        $messaging->sendMulticast($message, $tokens);

        return redirect()->route('notification.show');
    }
}
