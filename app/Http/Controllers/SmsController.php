<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class SmsController extends Controller
{
    
    public function sendSms($receiver, $message)
    {
        $data = array(
            "sender"     => env("INTOUCH_SENDER"),
            "recipients" => $receiver,
            "message"    => $message,
        );

        $url = env("INTOUCH_API");
        $username = env("INTOUCH_USERNAME");
        $password = env("INTOUCH_PASSWORD");
        
        $client = new Client();
        
        try {
            $response = $client->post($url, [
                'auth' => [$username, $password],
                'form_params' => $data,
                'verify' => false // Only use this if you want to disable SSL verification
            ]);
            
            $httpResponse = $response->getStatusCode();
            $result = $response->getBody()->getContents();
            
            if ($httpResponse != 200) {
                return $httpResponse . ' SMS system error, SMS not sent';
            } else {
                error_log($result);
                return $result;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
