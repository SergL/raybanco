<?php if(false):?>
<?php
$gallery=Gallery::model()->findByPk(6);
?>
<div class="dynamic_head">
    <ul class="thumbnails">
        <?php foreach($gallery->images as $image): ?>
        <li>
            <a href="<?php echo $image->getImageUrl('large'); ?>" class="thumbnail fancybox-thumb" rel="fancybox-thumb">
                <img src="<?php echo $image->getImageUrl('small'); ?>" alt="">
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<script type="text/javascript">
    jQuery2(document).ready(function() {
        jQuery2(".fancybox-thumb").fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            helpers	: {
                title	: {
                    type: 'outside'
                },
                thumbs	: {
                    width	: 100,
                    height	: 100
                }
            }
        });
    });
</script>
<?php endif;?>

<?php
$gallery=Gallery::model()->findByPk(6);
?>
<?php $this->beginWidget('PrettyPhoto', array(
    'gallery'=>true
)); ?>
<div class="dynamic_head">
<ul class="thumbnails">
<?php foreach($gallery->images as $image): ?>
    <li>
        <a href="<?php echo $image->getImageUrl('large'); ?>" class="thumbnail">
            <img src="<?php echo $image->getImageUrl('small'); ?>" alt="">
        </a>
    </li>
<?php endforeach; ?>
</ul></div>
<?php $this->endWidget(); ?>
