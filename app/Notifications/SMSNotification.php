<?php
    namespace App\Notifications;

    use App\Http\Controllers\SmsController;
    use Patienceman\Notifier\NotifyHandler;
    use Patienceman\Notifier\Traits\NotifyPayload;

    class SMSNotification extends NotifyHandler {
        use NotifyPayload;

        /**
         * Send email notification
         */
        public function handle() {
            $callSms = new SmsController;
            $callSms->sendSms($this->phone, $this->message);
        }
    }
