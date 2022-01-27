<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $phone = Str::startsWith($notifiable->phone_number, '0')
            ? '88'.$notifiable->phone_number
            : Str::replaceFirst('+', '', $notifiable->phone_number);

//        dd(Http::get('http://sms.bdwebs.com/smsapi?api_key='.config('services.bdwebs.api_key').'&type=text&contacts=8801783110247&senderid='.config('services.bdwebs.senderid').'&msg="Your OTP for BSBazarBD is: 123465."')->body());
//        dd(Http::get('http://sms.bdwebs.com/miscapi/'.config('services.bdwebs.api_key').'/getDLR/getAll')->body());

        // Send notification to the $notifiable instance...
        $context = array_merge([
            'type' => 'text',
            'contacts' => $phone,
            'label' => 'transactional',
            'api_key' => config('services.bdwebs.api_key'),
            'senderid' => config('services.bdwebs.senderid'),
        ], $notification->toArray($notifiable));
        // Log::info('sending sms:', $context);
        Http::post('http://sms.bdwebs.com/smsapi', $context);
    }
}
