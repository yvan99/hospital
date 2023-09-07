<?php
    namespace App\Notifications;

    use Patienceman\Notifier\NotifyHandler;
    use Patienceman\Notifier\Traits\NotifyPayload;

    class DatabaseNotification extends NotifyHandler {
        use NotifyPayload;

        /**
         * Send email notification
         */
        public function handle() {
            $this->foreachUser(function($user) {
                $this->alertUser($user);
                $this->dbNotification($user, $this);
            });
        }

        /**
         * Get the array to database representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function toDatabase($notifiable) {
            return [
                'header' => $this->subject,
                'message' => $this->message,
                'action' => $this->action,
                'status' => $this->status ?? "normal"
            ];
        }

        /**
         * Set default special user message
         *
         * @param  User  $user
         * @return void
         */
        public function alertUser($user) {
            if(isset($this->status) && $this->status == "special") {
                $user->special_message = [
                    "type" => $this->status,
                    "message" => $this->message,
                    "subject" => $this->subject,
                    'action' => $this->action,
                ];

                $user->save();
            }
        }
    }
