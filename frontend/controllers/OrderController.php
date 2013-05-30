<?php
class OrderController extends Controller {

    public $layout='//layouts/column2';

    public function actions()
   	{
   		return array(
   			'LiqPay'=>array(
   				'class'=>'CLiqPayAction',
   			),
   		);
   	}

    public function actionCoupon() {
        if(!empty($_POST['coupon'])) {
            if(strpos(Yii::app()->config['coupons'], trim($_POST['coupon'])) !==false) {
                Yii::app()->user->setState('coupon', $_POST['coupon']);
            }
        }
        if(!empty($_POST['Order']['delivery'])){
            Yii::app()->user->setState('delivery', $_POST['Order']['delivery']);
        }
        $this->redirect(Yii::app()->request->urlReferrer?Yii::app()->request->urlReferrer:array('site/index'));
    }

    public function actionBook() {
        if(Yii::app()->cart->isEmpty) {
            $this->redirect(array('order/clear'));
        }
        $order=new Order;

        $user=null;
        if(Yii::app()->user->isGuest==false) {
            $user=User::model()->findByPk(Yii::app()->user->id);
            if($user)
                $order->attributes=$user->attributes;
        }

        $this->performAjaxValidation($order);

        $order->discount=0;
        if($user) {
            //$order->discount+=4;
        }

        if(Yii::app()->user->hasState('coupon')) {
            $order->discount+=Yii::app()->config['coupons_val'];
        }

        if(isset($_POST['Order'])) {

            $order->attributes=$_POST['Order'];
            if($order->delivery)
                $order->delivery_price=$order->delivery->priceTo(Yii::app()->cart->cost);
            $order->user_id=Yii::app()->user->id;
            $order->referer=Yii::app()->user->getState('referer');
            $order->ip=Yii::app()->request->userHostAddress;

            if(strstr($order->referer, 'google')!==false)
                preg_match('#.*?[\?\&]q=(.+?)&.*#', $order->referer, $match);
            elseif(strstr($order->referer, 'yandex')!==false)
                preg_match('#.*?[\?\&]text=(.+?)&.*#', $order->referer, $match);

            if(isset($match) && array_key_exists(1, $match))
                $order->search_terms = urldecode($match[1]);

            $order->discount=0;
            if($user) {
                //$order->discount+=4;
            }

            $has_old_price=false;
            foreach(Yii::app()->cart->products as $product) {
                $has_old_price=$product->other_price>0 || $has_old_price;
            }

            if(Yii::app()->user->hasState('coupon') && $has_old_price==false) {
                $order->discount+=Yii::app()->config['coupons_val'];
            }

            $order->ocost=Yii::app()->cart->getCost();

            if($order->save()) {
                foreach(Yii::app()->cart->products as $product) {
                    $order->addProduct($product);
                }
                Yii::app()->cart->clear();
                //$this->onOrder(new CEvent($order));

                $this->sendMail($order);


                $this->redirect(array('success', 'key'=>$order->encodeKey));
            }
        }

        $this->breadcrumbs=array(
            'Оформление заказа'
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Оформление заказа';

        $this->render('book', array(
            'cart'=>Yii::app()->cart,
            'order'=>$order,
        ));
    }

    public function actionIndex() {
        if(Yii::app()->cart->isEmpty) {
            $this->redirect(array('order/clear'));
        }
        $order=new Order;

        $user=null;
        if(Yii::app()->user->isGuest==false) {
            $user=User::model()->findByPk(Yii::app()->user->id);
            if($user)
                $order->attributes=$user->attributes;
        }

//        обновление информации по товарам в корзине
        if(isset($_POST['Product'])) {
            $products=Yii::app()->cart->products;
            foreach($products as $i=>$product) {
                if(isset($_POST['Product'][$i]['quantity'])) {
                    Yii::app()->cart->update($product, $_POST['Product'][$i]['quantity']);
                } else {
                    Yii::app()->cart->remove($product->id);
                }
            }
        }
//        end


        $this->performAjaxValidation($order);

        $order->discount=0;
        if($user) {
            //$order->discount+=4;
        }

        if(!empty($_POST['coupon']) && strpos(Yii::app()->config['coupons'], trim($_POST['coupon'])) !==false) {
            $order->discount+=Yii::app()->config['coupons_val'];
        } else {
            $_POST['coupon'] = '';
        }

        Yii::app()->cart->setDiscountPrice($order->discount);

        $order->attributes=$_POST['Order'];

        if(isset($_POST['Order']) && $_POST['Order']['submit'] == 'Подтвердить заказ') {

            $order->attributes=$_POST['Order'];
            Yii::app()->user->setState('delivery', $order->delivery_id);
            if($order->delivery)
                $order->delivery_price=$order->delivery->priceTo(Yii::app()->cart->cost);
            $order->user_id=Yii::app()->user->id;
            $order->referer=Yii::app()->user->getState('referer');
            $order->ip=Yii::app()->request->userHostAddress;

            if(strstr($order->referer, 'google')!==false)
                preg_match('#.*?[\?\&]q=(.+?)&.*#', $order->referer, $match);
            elseif(strstr($order->referer, 'yandex')!==false)
                preg_match('#.*?[\?\&]text=(.+?)&.*#', $order->referer, $match);

            if(isset($match) && array_key_exists(1, $match))
                $order->search_terms = urldecode($match[1]);

            /*$order->discount=0;
            if($user) {
                $order->discount+=4;
            }

            if(Yii::app()->user->hasState('coupon')) {
                $order->discount+=Yii::app()->config['coupons_val'];
            }*/

            $order->ocost=Yii::app()->cart->getCost(false);

            if($order->save()) {
                if($_POST['coupon']){
                    $config = Config::model()->findByPk(1);
                    $config->coupons = str_replace($_POST['coupon']."\r\n", '', $config->coupons);
                    $config->update(array('coupons'));
                }
                foreach(Yii::app()->cart->products as $product) {
                    $order->addProduct($product);
                }
                Yii::app()->cart->clear();
                //$this->onOrder(new CEvent($order));
                Yii::app()->user->setState('coupon', NULL);
                $this->sendMail($order);

                $this->redirect(array('success', 'key'=>$order->encodeKey));
            }
        }

        $this->breadcrumbs=array(
            'Оформление заказа'
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Оформление заказа';

        $this->render('index', array(
            'cart'=>Yii::app()->cart,
            'order'=>$order,
        ));
    }

     public function actionSuccess($key=null) {
         $this->breadcrumbs=array(
             'Ваш заказ оформлен'
         );
         $this->metaTitle=Yii::app()->config['shop_name'].' - Ваш заказ оформлен';

         $this->render('success', array(
             'key'=>$key,
         ));
     }

    public function actionClear() {
        $this->breadcrumbs=array(
            'Корзина пуста'
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Корзина пуста';

        $this->render('clear');
    }

    public function actionPay($key) {
        $order=$this->loadModelByKey($key);

        if(isset($_POST['Order']['payment_id'])) {
            $order->payment_id=$_POST['Order']['payment_id'];
            $order->save(false);
        }

        $this->breadcrumbs=array(
            'Оплата заказа №'.$order->id
        );
        $this->metaTitle=Yii::app()->config['shop_name'].' - Оплата заказа №'.$order->id;

        $this->render('pay', array(
            'order'=>$order,
        ));
    }

    public function actionReceipt($key) {
        $this->layout=false;
        $order=$this->loadModelByKey($key);

        $this->metaTitle=Yii::app()->config['shop_name'].' - Квитанция оплаты заказа №'.$order->id;

        $data=CArray::overwrite(array(
            'recipient'=>'',
            'inn'=>'',
            'account'=>'',
            'bank'=>'',
            'bik'=>'',
            'correspondent_account'=>'',
            'banknote'=>'',
            'pense'=>'',
            'name'=>'',
            'address'=>'',
            'order_id'=>$order->id,
            'cost_banknote'=>Yii::app()->priceFormatter->templateFormat('{banknote}', $order->getCost(), $order->payment->currency_id),
            'cost_pense'=>Yii::app()->priceFormatter->templateFormat('{pense}', $order->getCost(), $order->payment->currency_id),
        ),$order->payment->getHandlerParams(),isset($_POST['Receipt'])?$_POST['Receipt']:array());

        $this->render('receipt', $data);
    }

    public function actionUpdate() {
        if(isset($_POST['Product'])) {
            $products=Yii::app()->cart->products;
            foreach($products as $i=>$product) {
                if(isset($_POST['Product'][$i]['quantity'])) {
                    Yii::app()->cart->update($product, $_POST['Product'][$i]['quantity']);
                } else {
                    Yii::app()->cart->remove($product->id);
                }
            }
        } else {
            Yii::app()->cart->clear();
        }
        if(isset($_GET['return_url'])){
            $this->redirect($_GET['return_url']);
        }
        else
            $this->redirect(array('order/index'));
    }

    public function actionRemove($id) {
        Yii::app()->cart->remove($id);
        //Yii::app()->user->setState('coupon', NULL);
        if(isset($_GET['return_url']))
            $this->redirect($_GET['return_url']);
        else
            $this->redirect(array('order/index'));
    }

    public function actionPut($id, $quantity=null) {
        $quantity=max((int)$quantity, 1);
		$product=Product::model()->findByPk((int)$id);
		if($product===null)
			throw new CHttpException(404,'The requested page does not exist.');

        Yii::app()->cart->put($product, $quantity);
        $this->renderPartial('_view');
    }

    public function actionSetProductQuantity($product_id, $quantity) {
        $product=Product::model()->findByPk($product_id);
        if($product===null)
      			throw new CHttpException(404,'The requested page does not exist.');
        Yii::app()->cart->update($product, $quantity);
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('order/index'));
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /*public function onOrder(CEvent $event) {
        $this->raiseEvent('onOrder', $event);
    }*/

    public function loadModelByKey($key) {
        $order=Order::model()->findByEncodeKey($key);
        if($order==null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $order;
    }

    private function sendMail($order){
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
