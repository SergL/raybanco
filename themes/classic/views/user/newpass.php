<div class="korzina">

    <div class="korzina_head">
        <span>Пароль успешно востановлен</span>
    </div>

    <div class="korzina_menu">
        <ul>
            <li><a href="<?php echo Yii::app()->createUrl('site/login'); ?>">Авторизация</a></li>
            <li class="active"><a href="#">Восстановить пароль</a></li>
        </ul>
    </div>
    <b class="clearb"></b>
    <div class="menu-content">

        <div class="dynamic_content">
            Ваш логин: <?php echo $model->username; ?><br>
            Используйте пароль <?php echo $password; ?> для входа в систему.
        </div>

    </div>

</div>