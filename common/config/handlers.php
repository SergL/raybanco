<?php
return array(
    'onOrder'=>array(
        array('MailEvent', 'newOrder'),
        array('SmsEvent', 'newOrder'),
    ),
    'onRegister'=>array(
        array('MailEvent', 'newUser'),
    ),
);