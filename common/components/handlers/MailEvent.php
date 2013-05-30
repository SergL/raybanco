<?php
class MailEvent {

    public function newUser($event) {
        if(!($event->sender instanceof User))
            return;

        $user=$event->sender;
        $config=Yii::app()->config;
        $swift=Yii::app()->swiftMailer;
        $transport=$swift->mailTransport();
        $mailer=$swift->mailer($transport);


        if(!($event->sender instanceof User))
            return;

        $user=$event->sender;

        $swift=Yii::app()->swiftMailer;
        $transport=$swift->mailTransport();
        $mailer=$swift->mailer($transport);

        $url=Yii::app()->createAbsoluteUrl('user/confirmation', array('id'=>$user->id, 'key'=>md5($user->username.$user->id)));


        $body='
С радостью сообщаем, что ваш запрос на регистрацию на сайте “Jewel Mag” принят.<br>
   Теперь вы можете совершать покупки на нашем сайте <br><br>
   С наилучшими пожеланиями,<br>
   Обращайтесь. Будем рады каждому вашему звонку';

        $subject='Регистрации в интернет магазине «Ray Ban Co»';

        $message = $swift->newMessage($subject)
            ->setFrom(isset($_SERVER['HTTP_HOST'])?'noreply@'.$_SERVER['HTTP_HOST']:'sms@'.$_SERVER['SERVER_NAME'])
            ->setTo($user->email)
            ->setBody($body, 'text/html');

        $mailer->send($message);
    }

    public function newOrder($event) {
        if(!($event->sender instanceof Order))
            return;

        $order=$event->sender;
        $config=Yii::app()->config;
        $swift=Yii::app()->swiftMailer;
        $transport=$swift->mailTransport();
        $mailer=$swift->mailer($transport);

        if($config['mailing_new_order_to_user']) {

            $body=Yii::app()->twig->render($config['mailing_new_order_pattern'], array(
                'order'=>$order
            ));

            $subject=Yii::app()->twig->render($config['mailing_new_order_subject'], array(
                'order'=>$order,
            ));

            $message = $swift->newMessage($subject)
                ->setFrom(isset($_SERVER['HTTP_HOST'])?'noreply@'.$_SERVER['HTTP_HOST']:'sms@'.$_SERVER['SERVER_NAME'])
                ->setTo($order->email)
                ->setBody($body, 'text/html');

            $mailer->send($message);
        }

        if($config['mailing_new_order_to_admin']) {

            $body="№ заказа: $order->id<br>";
            $body.="Имя: $order->name<br>";
            $body.="Телефон: $order->phone<br>";
            $body.="Ел.почта: $order->email<br>";
            $body.="Адрес: $order->address<br>";
            $body.=$order->comment;

            $message = $swift->newMessage($config['company'].' - пришел заказ')
                ->setFrom(isset($_SERVER['HTTP_HOST'])?'noreply@'.$_SERVER['HTTP_HOST']:'sms@'.$_SERVER['SERVER_NAME'])
                ->setTo($config['admin_email'])
                ->setBody($body, 'text/html');

            $mailer->send($message);
        }
    }
}