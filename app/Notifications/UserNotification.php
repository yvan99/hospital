<?php

    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class UserNotification extends Notification {
        use Queueable;

        protected $info;

        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public function __construct($info) {
            $this->info = $info;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable) {
            return ['database'];
        }

        /**
         * Get the array representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function toArray($notifiable) {
            return [
                'header' => $this->info['header'],
                'message' => $this->info['message'],
                'action' => $this->info['action']
            ];
        }
    }
