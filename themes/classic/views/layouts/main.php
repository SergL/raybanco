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

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-1.8.2.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/fancybox2/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox2/jquery.fancybox.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/fancybox2/helpers/jquery.fancybox-thumbs.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox2/helpers/jquery.fancybox-thumbs.css" />

    <?php echo Yii::app()->config['counters']; ?>

    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>
    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?49"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fancybox.js"></script>

    <script type="text/javascript" src="//vk.com/js/api/openapi.js?62"></script>
    <script type="text/javascript">
        VK.init({apiId: 3155479, onlyWidgets: true});
    </script>
</head>

<body>
<div id="login-box-background" style="display: none; height: 100%; width: 100%; position: fixed; z-index: 9999999;"></div>
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
                    <li style="margin: 14px 13px 0 3px;"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/facebook_icon.png" alt="facebook"/></a></li>
                    <li style="margin: 14px 13px 0 0;"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/twitter_icon.png" alt="twitter"/></a></li>
                    <li style="margin: 12px 0 0;"><a target="_blank" href="http://vk.com/rayban_co"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/vk_icon.png" alt="vk" /></a></li>
                </ul>
            </div>
            <div class="header_top_r">
                <div class="header_top_r_l">

                    <?php if(Yii::app()->user->isGuest): ?>
                    <a onclick="$('#login-box').toggle(); $('#login-box-background').toggle();; return false;" href="<?php echo Yii::app()->createUrl('site/login'); ?>">Вход</a> /
                    <a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Регистрация</a>
                    <?php else: ?>
                    <a style="text-align: center;" href="<?php echo Yii::app()->createUrl('user/update'); ?>"><?php echo Yii::app()->user->mname; ?></a> /
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
                <img class="im" style="position: absolute;float: left;<?php if($i!=0) echo 'display:none;'; ?>" src="<?php echo $image->getImageUrl('large'); ?>" alt="logo background" />
                <?php endforeach; ?>
                <div class="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo2.png" alt="logo" /></div>
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


    <div id="login-box" style="display: none; z-index: 99999999;" class="login-box">
        <!--<div style="position:absolute; right: 0; margin-right: 10px; cursor: pointer;" onclick="$('#login-box').toggle();">x</div>-->

        <div class="form">
        <?php
            $login=new LoginForm;
            $form=$this->beginWidget('CActiveForm', array(
                'action'=>array('site/login', 'return_url'=>Yii::app()->request->pathInfo),
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

            <div class="row">
                <a href="<?php echo Yii::app()->createUrl('user/lostpass'); ?>">Восстановить пароль</a>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Войти'); ?>
            </div>

        <?php $this->endWidget(); ?>
        </div><!-- form -->

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#login-box-background').click(function(){
                $('#login-box').hide();
                $(this).hide();
            })
        })
    </script>


    <?php echo $content; ?>

    <div class="footer">
        <div class="getmail"><strong>АКЦИИ И СКИДКИ</strong>
            <input  id="email-send-val" type="text" placeholder="Введите пожалуйста Ваш email" />
            <button type="submit" id="email-send">ПОЛУЧАТЬ</button>
        </div>
        <div class="social_icons" style="width: 116px;">
            <a target="_blank" href="http://vk.com/rayban_co"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc1.png" alt="Соц. Кнопка 1" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc2.png" alt="Соц. Кнопка 2" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc3.png" alt="Соц. Кнопка 3" /></a>
            <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/soc4.png" alt="Соц. Кнопка 4" /></a>
        </div>
        <b class="clearb"></b>
        <div class="footer_l">
            <div class="footer_l_l">
                <div class="footer_head">Ray Ban Co</div>             
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>2)); ?>">О нас</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('site/contact'); ?>">Контакты</a></p>
            </div>
            <div class="footer_l_r">
                <div class="footer_head">Шоу-Рум</div>
                <p>Понедельник: выходной</p>
                <p>Вт-Пт: с 12:00 до 20:00</p>
                <p>Сб-Вс: с 13:00 до 20:00</p>
            </div>
        </div>
        <div class="footer_c">
            <div class="footer_head">Наши партнеры</div>
            <p><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/slogo.png" alt="Джевельмаг" /></a></p>
            
        </div>
        <div class="footer_r">
            <div class="footer_head">Помощь</div>
            <div class="footer_r_l">
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>7)); ?>">Скидочная карта</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>15)); ?>">Полезная инфромация</a></p>
            </div>
            <div class="footer_r_r">
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>9)); ?>">Как сделать заказ ?</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>1)); ?>">Оплата и доставка</a></p>
                <p><a href="<?php echo Yii::app()->createUrl('article/view', array('id'=>11)); ?>">Обмен и возврат товара</a></p>
            </div>
        </div>
        <div class="footer_nav">
            <!--<ul>
                <?php /*foreach(MenuItem::model()->findAll('parent_id=1') as $menuItem): */?>
                <li><a href="<?php /*echo $menuItem->url; */?>"><?php /*echo $menuItem->name; */?></a></li>
                <?php /*endforeach; */?>
            </ul>-->
            <div class="footer_nav_text">
                <p>Интернет-магазин Ray Ban Co. 2012</p>
                <p>Все права защищены</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            maxWidth	: 800,
            maxHeight	: 600,
            fitToView	: false,
            width		: '70%',
            height		: '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    });
</script>
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
    }, function(){})

    $('#logobox').mouseenter();
</script>

</body>
</html>