<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo CHtml::encode($this->metaTitle); ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->metaDescription); ?>">
    <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords); ?>">

    <meta http-equiv="Content-Language" content="ru">

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pager.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.fancybox.css" />
    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fancybox.js"></script>

    <script type="text/javascript">
      VK.init({apiId: 2700759, onlyWidgets: true});
    </script>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="header_top_bg">
    <div class="site_center">
        <div class="header_top">
            <div class="header_top_l">
                <ul>
                    <li><a href="<?php echo Yii::app()->createUrl('site/index'); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/home_icon.png" /></a></li>
                    <li style="margin: 14px 13px 0 3px;"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/facebook_icon.png" /></a></li>
                    <li style="margin: 14px 13px 0 0;"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/twitter_icon.png" /></a></li>
                    <li style="margin: 12px 0 0;"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/vk_icon.png" /></a></li>
                </ul>
            </div>
            <div class="header_top_r">
                <div class="header_top_r_l">

                    <?php if(Yii::app()->user->isGuest): ?>
                    <a onclick="$('#login-box').toggle(); return false;" href="<?php echo Yii::app()->createUrl('site/login'); ?>">Вход</a> /
                    <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Регистрация</a>
                    <?php else: ?>
                    <a href="<?php echo Yii::app()->createUrl('user/update'); ?>"><?php echo Yii::app()->user->name; ?></a> /
                    <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">выход</a>
                    <?php endif; ?>

                </div>
                <div class="header_top_r_r">
                    <form id="search-form" action="<?php echo Yii::app()->createUrl('search/result'); ?>" method="get">
                    <input type="text" name="query" value="<?php echo @$_GET['query']; ?>" placeholder="Поиск" />
                    <a href="#" onclick="$('#search-form').submit();"></a>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="site_center">
    <div class="header">
        <div class="header_l">
            <a id="logobox" href="<?php echo Yii::app()->createUrl('site/index'); ?>" title="Ray-Ban-Ba">

                <?php foreach(Gallery::model()->findByPk(1)->images as $i=>$image): ?>
                <img class="im" style="position: absolute;float: left;<?php if($i!=0) echo 'display:none;'; ?>" src="<?php echo $image->getImageUrl('large'); ?>" />
                <?php endforeach; ?>
                <div class="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo2.png" /></div>
            </a>
        </div>
        <div class="header_r">
            <div class="phone">
                <ul>
                    <?php echo Yii::app()->config['contact_phone']; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="header_nav">
        <ul>
            <?php foreach(MenuItem::model()->findAll('parent_id=1') as $menuItem): ?>
            <li><a href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->name; ?></a></li>
            <?php endforeach; ?>
            <div class="border_eraser"></div>
        </ul>
        <div id="cart-box"><?php $this->renderPartial('/order/_view'); ?></div>
    </div>

    <div id="login-box" style="display: none;" class="login-box">


    <div class="form">
    <?php
        $login=new LoginForm;
        $form=$this->beginWidget('CActiveForm', array(
            'action'=>array('site/login'),
        ));
    ?>

    	<div class="row">
    		<?php echo $form->labelEx($login,'username'); ?>
    		<?php echo $form->textField($login,'username'); ?>
    		<?php echo $form->error($login,'username'); ?>
    	</div>

    	<div class="row">
    		<?php echo $form->labelEx($login,'password'); ?>
    		<?php echo $form->passwordField($login,'password'); ?>
    		<?php echo $form->error($login,'password'); ?>
    	</div>

    	<div class="row rememberMe">
    		<?php echo $form->checkBox($login,'rememberMe'); ?>
    		<?php echo $form->label($login,'rememberMe'); ?>
    		<?php echo $form->error($login,'rememberMe'); ?>
    	</div>

    	<div class="row buttons">
    		<?php echo CHtml::submitButton('Войти'); ?>
    	</div>

    <?php $this->endWidget(); ?>
    </div><!-- form -->



    </div>


    <?php echo $content; ?>

    <div class="footer">
        <div class="getmail">
            <strong>АКЦИИ И СКИДКИ</strong>
            <input  id="email-send-val" type="text" placeholder="Введите пожалуйста Ваш email" />
            <button type="submit" id="email-send">ПОЛУЧАТЬ</button>
        </div>
        <div class="social_icons">
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc1.png" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc2.png" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc3.png" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc4.png" /></a>
        </div>
        <b class="clearb"></b>
        <div class="footer_l">
            <div class="footer_l_l">
                <div class="footer_head">Ray Ban Co</div>
                <p><a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Онлайн магазин</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>10)); ?>">Наш Шоу-рум</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('site/contact'); ?>">Контакты</a></p>
            </div>
            <div class="footer_l_r">
                <div class="footer_head">Рабочий график:</div>
                <p>Понедельник: выходной</p>
                <p>Вт-Пт: с 8:00 до 21:00</p>
                <p>Сб-Вс: с 10:00 до 19:00</p>
            </div>
        </div>
        <div class="footer_c">
            <div class="footer_head">Наши партнеры</div>
            <p align="center"><a href="http://jawelmag.com.ua"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/slogo.png" /></a></p>
            
        </div>
        <div class="footer_r">
            <div class="footer_head">Помощь</div>
            <div class="footer_r_l">
                <p><b><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>6)); ?>">Оптовым клиентам</a></b></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>7)); ?>">Скидочная карта</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>8)); ?>">Акции и скидки</a></p>
            </div>
            <div class="footer_r_r">
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>9)); ?>">Как сделать заказ?</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>1)); ?>">Оплата и доставка</a></p>
            </div>
        </div>
        <div class="footer_nav">
            <ul>
                <?php foreach(MenuItem::model()->findAll('parent_id=1') as $menuItem): ?>
                <li><a href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="footer_nav_text">
                <p>Интернет-магазин Ray Ban Co. 2012</p>
                <p>Все права защищены</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(function (){
   		$('.more-info-link').fancybox({
   			transitionIn:'elastic',
   			transitionOut:'elastic',
   			hideOnContentClick: true,
            maxWidth:600
        });
   	})

    $('#call-me').click(function(){
		var phone=prompt('Введите номер телефона, на который Вам перезвонить');
        if(phone==null) return;
        $.post('<?php echo Yii::app()->createUrl('site/phone'); ?>', {phone:phone});
    });

    $('#email-send').click(function(){

		var email=$('#email-send-val').val();
        if(email==null) return;
        $.post('<?php echo Yii::app()->createUrl('site/email'); ?>', {email:email}, function(){
            alert('Вы успешно подписались на рассылку.');
        });
    });

    $('#logobox').hover(function(){
        var l=$('#logobox img.im').length-1;
        var i=Math.floor(Math.random()*l);

        var newlogo=$('#logobox img.im:hidden:eq('+i+')');
        $('#logobox img.im:visible').hide();
        newlogo.show();
    }, function(){});
</script>
</body>
</html>