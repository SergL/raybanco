<div class="dynamic_head">Мой кабинет</div>
<div class="blog_l_themes">
    <ul>
        <li><a href="<?php echo Yii::app()->createUrl('user/update')?>">Редактировать</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('order/book?show_user_menu=true')?>">Корзина</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('user/subscription')?>">Подписка на новости</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Выход</a></li>
    </ul>
</div>