<?php
class Mz {

    public static function price($price, $params=false) {
        return Yii::app()->priceFormatter->format($price, $params=false);
    }

    public static function tprice($template, $price, $params=false) {
        return Yii::app()->priceFormatter->templateFormat($template, $price, $params=false);
    }
}