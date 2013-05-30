<?php
class MzSlider extends CWidget {

    public $template='{navigation}{content}{arrows}';
    
    public $width;
    public $height;
    public $htmlOptions=array();

    public $options=array();
    public $itemView;
    public $viewData;
    public $itemCssClass='';

    public $cssFile;

    public $items;
    public $slideExpression;

    public function run() {
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$id=$this->htmlOptions['id']=$this->getId();

        echo CHtml::openTag('div', $this->htmlOptions);

        $data['{content}']=$this->renderContent();
        $data['{navigation}']=$this->renderNavigation();
        $data['{arrows}']=$this->renderArrows();

        echo strtr($this->template, $data);

        echo CHtml::closeTag('div');

        //$this->registerScripts();
    }

    public function renderContent() {
        $itemWidth=$this->width.'px';
        $itemHeight=$this->height.'px';
        $totalWidth=count($this->items)*$this->width;

        $content=CHtml::openTag('div', array('style'=>"width:$itemWidth;height:$itemHeight;overflow:hidden"));

        $content.=CHtml::openTag('ul', array('style'=>"width:{$totalWidth}px;height:{$this->height}px;position: relative;padding-left: 0px;"))."\n";
        if($this->slideExpression) {
            foreach($this->items as $item)
                $content.=CHtml::tag('li', array('class'=>$this->itemCssClass), $this->evaluateExpression($this->slideExpression, array('data'=>$item)));
        } else {
            $owner=$this->getOwner();
			$render=$owner instanceof CController ? 'renderPartial' : 'render';
            foreach($this->items as $i=>$item) {
                $data=$this->viewData;
				$data['index']=$i;
				$data['data']=$item;
				$data['widget']=$this;
                $content.=CHtml::openTag('li', array('class'=>$this->itemCssClass, 'style'=>'float:left;'));
                $content.=$owner->$render($this->itemView,$data, true);
                $content.=CHtml::closeTag('li');
            }
        }
        $content.=CHtml::closeTag('ul');
        $content.=CHtml::closeTag('div');
        return $content;
    }

    public function renderNavigation() {
        $navigation='';
        foreach($this->items as $i=>$item) {
            $navigation.='<a href="#">'.($i+1).'</a>';
        }
        return $navigation;
    }

    public function renderArrows() {

    }

    private function registerScripts() {
        $id=$this->htmlOptions['id'];
        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'mzSlider';
        $baseUrl=Yii::app()->assetManager->publish($dir);

        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl."/js/jquery.mzSlider.min.js");
		if($this->cssFile===null)
			$cs->registerCssFile($baseUrl.'/css/mzSlider.css');
		else if($this->cssFile!==false)
			$cs->registerCssFile($this->cssFile);

        $options=CJavaScript::encode($this->options);
        $cs->registerScript(__CLASS__.'#'.$id, "$('#$id').mzSlider($options);");
    }
}