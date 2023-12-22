<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FireBaseHelper
{
    // send message to a topic
    public static function SendMessageByTopic($topic, $title, $body, $data) {
        try {
            $messaging = FireBaseHelper::InitCloudMessaging();
            $androidConfig = FireBaseHelper::GetAndroidConfig($title, $body);
            $apnsConfig = FireBaseHelper::GetApnsConfig($title, $body);
            $message = CloudMessage::withTarget('topic', $topic)
                ->withNotification(Notification::create($title, $body))
                ->withAndroidConfig($androidConfig)
                ->withApnsConfig($apnsConfig)
                ->withData(['extend' => $data]);
            $messaging->send($message);
            return "";

        } catch (\Exception $e) {
            Log::error("Send notification message to a topic error: ".$e->__toString());
            return "Send notification message to a topic error: ".$e->getMessage();
        }
    }

     // send message to mutile topics
     public static function SendMessageByTopics($topics, $title, $body, $data) {
        try {
            $conditions = "";
            foreach ($topics as $topic) {
                $condition = sprintf("'%s/' in topics ||", $topic);
                $conditions = $conditions.$condition;
            }
            $conditions = rtrim($conditions, "|| ");
            $messaging = FireBaseHelper::InitCloudMessaging();
            $androidConfig = FireBaseHelper::GetAndroidConfig($title, $body);
            $apnsConfig = FireBaseHelper::GetApnsConfig($title, $body);
            $message = CloudMessage::withTarget('condition', $conditions)
                ->withAndroidConfig($androidConfig)
                ->withApnsConfig($apnsConfig)
                ->withData(['extend' => $data]);
            $messaging->send($message);
            return "";

        } catch (\Exception $e) {
            Log::error("Send notification message to mutile topics error: ".$e->__toString());
            return "Send notification message to mutile topics error: ".$e->getMessage();
        }
    }

     // send message to a device
     public static function SendMessageByDevice($device, $title, $body, $data) {
        try {
            $messaging = FireBaseHelper::InitCloudMessaging();
            $androidConfig = FireBaseHelper::GetAndroidConfig($title, $body);
            $apnsConfig = FireBaseHelper::GetApnsConfig($title, $body);
            $message = CloudMessage::withTarget('token', $device)
                ->withNotification(Notification::create($title, $body))
                ->withAndroidConfig($androidConfig)
                ->withApnsConfig($apnsConfig)
                ->withData(['extend' => $data]);
            $messaging->send($message);
            return "";

        } catch (\Exception $e) {
            Log::error("Send notification message to a device error: ".$device.$e->__toString());
            return "Send notification message to a device error: ".$device.$e->getMessage();
        }
    }

     // send message to a device
     public static function SendMessageByDevices($devices = [], $title, $body, $data) {
        try {
            $messaging = FireBaseHelper::InitCloudMessaging();
            $androidConfig = FireBaseHelper::GetAndroidConfig($title, $body);
            $apnsConfig = FireBaseHelper::GetApnsConfig($title, $body);
            $message = CloudMessage::new()
                ->withNotification(Notification::create($title, $body))
                ->withAndroidConfig($androidConfig)
                ->withApnsConfig($apnsConfig)
                ->withData(['extend' => $data]);
            $messaging->sendMulticast($message, $devices);
            return "";

        } catch (\Exception $e) {
            Log::error("Send notification message to mutile devices error: ".$e->__toString());
            return "Send notification message to mutile devices error: ".$e->getMessage();
        }
    }
    private static function InitCloudMessaging() {
        $url = config('firebase.projects.app.database.url');
        $credentials = config('firebase.projects.app.credentials.file');
        $factory = (new Factory)
        ->withServiceAccount($credentials);
        // ->withDatabaseUri($url);
        $messaging = $factory->createMessaging();
        return $messaging;
    }


    private static function GetAndroidConfig($title, $body) {
        return AndroidConfig::fromArray([
            "ttl" => '3600s',
            'priority' => 'high',
            'notification' => [
                'title' => $title,
                'body' => $body,
                'icon' => 'notification_qcdc',
                'color' => '#37a4ed',
                'sound' => 'default',
                'visibility' => 'PUBLIC',
                'notification_priority' => 'PRIORITY_MAX'
            ],
        ]);
    }

    private static function GetApnsConfig($title, $body) {
        return ApnsConfig::fromArray([
            'headers' => [
                'apns-priority' => '10',
            ],
            'payload' => [
                'aps' => [
                    'alert' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'badge' => 42,
                    'sound' => 'default',
                ],
            ],
        ]);
    }
}
