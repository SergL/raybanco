<?php
$count_news=News::model()->count(array(
    'condition'=>'MONTH(publish_date)='.date('n').' AND YEAR(publish_date)='.date('Y'),
));

$news_mtis_month=News::model()->findAll(array(
            'condition'=>'MONTH(publish_date)='.date('n').' AND YEAR(publish_date)='.date('Y'),
            'limit'=>5
));
?>
    <!--<div class="blog_l_themes_head">Рубрики</div>
    <div class="blog_l_themes">
        <ul>
            <li><a href="#">Серьги</a></li>
            <li><a href="#">Кольца</a></li>
            <li><a href="#">Браслеты</a></li>
            <li><a href="#">Колье и подвески</a></li>
        </ul>
    </div>-->
    <div class="blog_l_archive_head">
    Архив
    </div>
    <form id="formsearch" action="" method="get">
    <div class="blog_l_archive">
        <?php echo CHtml::dropDownList('News[month]', @$_GET['News']['month'], array(
            1=>'январь',
            2=>'февраль',
            3=>'март',
            4=>'апрель',
            5=>'май',
            6=>'июнь',
            7=>'июль',
            8=>'август',
            9=>'сентябрь',
            10=>'октябрь',
            11=>'ноябрь',
            12=>'декабрь',
        ), array('style'=>'width:90px;', 'onchange'=>'$("#formsearch").submit();'))?>
        <?php echo CHtml::dropDownList('News[year]', isset($_GET['News']['year'])?$_GET['News']['year']:date('Y'), array(
            '2012'=>2012,
            '2013'=>2013,
            '2014'=>2014,
        ), array('style'=>'width:60px;', 'onchange'=>'$("#formsearch").submit();'))?>
    </div>
    </form>

    <div class="blog_l_list_head">

    <?php echo Yii::app()->dateFormatter->format('LLLL y', time()); ?> (<?php echo $count_news; ?>)

    </div>
    <div class="blog_l_list">
        <?php foreach($news_mtis_month as $news_th): ?>
        <div class="blog_l_list_item">
            <div class="blog_l_list_item_date">
                <?php echo Yii::app()->dateFormatter->format('d.M.y', $news_th->publish_date); ?>
            </div>
            <div class="blog_l_list_item_head">
                <a href="<?php echo $news_th->url; ?>"><?php echo $news_th->title?></a>
            </div>
            <div class="blog_l_list_item_text">
                <?php echo $news_th->annotation; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <div class="blog_l_tags_head">
    Теги
    </div>
    <div class="blog_l_tags">
        <?php foreach(Tag::model()->findTagWeights() as $name=>$weight): ?>
        <a href="<?php echo Yii::app()->createUrl('news/archive', CMap::mergeArray($_GET, array('News[tags]'=>$name))); ?>" style="font-size:<?php echo intval($weight*1.5); ?>px;"><?php echo $name; ?></a>
        <?php endforeach; ?>
    </div>
