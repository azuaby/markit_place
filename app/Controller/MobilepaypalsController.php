<?php
	App::uses('AppController', 'Controller');
	
	class MobilePaypalsController  extends AppController{
		public $names =  'Paypals';
		public $uses = array('User','Item','Cart');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly');
		public $helpers = array('Form','Html');
		
		
		function paycart(){
		
			global $loguser;
			global $user_level;
			$userid = $loguser[0]['User']['id'];
			$listingid = $this->request->data['listing_id'];
			$quantity = $this->request->data['quantity'];
			$size_opt = $this->request->data['size_opt'];
			$shipping_method_id = $this->request->data['shipping_method_id'];
			$_SESSION['shpngid'] = $shipping_method_id;
			//echo $size_opt;die;
			if(!empty($listingid)){
				$itemExist = $this->Cart->find('count',array('conditions'=>array('item_id'=>$listingid,'user_id'=>$userid,'payment_status'=>'progress')));
				
				if ($itemExist == 0) {
				$this->request->data['Cart']['item_id'] = $listingid;
				$this->request->data['Cart']['user_id'] = $userid;
				$this->request->data['Cart']['quantity'] = $quantity;
				$this->request->data['Cart']['size_options'] = $size_opt;
				$this->request->data['Cart']['created_at'] = date("Y-m-d H:i:s");
				$this->Cart->save($this->request->data);
				}
				$this->redirect('/mobile/cart');
			}else{
				$this->Session->setFlash('Sorry, your Item id is not valid please try again.');
				$this->redirect('/mobile/');
			}
		}
		function pay(){
			global $loguser;
			global $setngs;
			global $user_level;
			$userid = $loguser[0]['User']['id'];
			$this->layout='mobilelayout';
			$this->loadModel('Tempaddresses');
			$this->loadModel('User');
			$this->loadModel('Giftcard');
			$this->loadModel('Commission');
			
			$giftcarduseradded = $this->Giftcard->find('all',array('conditions'=>array('Giftcard.user_id'=>$userid,'Giftcard.status'=>'Pending'),'order'=>'Giftcard.id DESC'));
			
			if (!isset($_SESSION['shpngid'])) {
				$usershipping = $this->User->findByid($userid);
				$usershippingid = $usershipping['User']['defaultshipping'];
				$cntry_code = $this->Tempaddresses->findByshippingid($usershippingid);
				$cntry_codes = $cntry_code['Tempaddresses']['countrycode'];
				$_SESSION['shpngid'] = $cntry_codes;
			}
			$this->loadModel('Country');
			// echo "<pre>";print_r($this->request->data);die;
			$this->set('title_for_layout','Cart Items');
			// echo "<pre>";
			$itm_datas = array();
			$total_itms = $this->Cart->totitms($userid);
			// print_R($total_itms);die;
			
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress')));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
					$size[$crt['Cart']['item_id']] = $crt['Cart']['size_options'];
				}
				$this->set('quantity',$quantity);
				$this->set('size',$size);
			
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
				//echo "<pre>";print_r($itm_datas);die;
			}	
			
			$cntry_datas = $this->Country->find('all');
			
			foreach($itm_datas as $itm) {
				if(isset($itm_group[$itm['Item']['shop_id']])) {
					$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
				} else {
					$itm_group[$itm['Item']['shop_id']] = 1;
				}
			}
			
			
			if (empty($itm_datas)) {
				$itm_group = array();
			}
			
			$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userid)));
			
			$usershippingdefaults = $this->User->findById($userid);
			$usershippingdefault = $usershippingdefaults['User']['defaultshipping'];
			$available_bal = $usershippingdefaults['User']['credit_total'];
			foreach ($usershipping as $ship) {
				if ($ship['Tempaddresses']['shippingid'] == $usershippingdefault){
					$_SESSION['shpngid'] = $ship['Tempaddresses']['countrycode'];
				}
			}
			
			/* Giftcard Details */
			if(!empty($giftcarduseradded)){
				$giftcarditemDetails = json_decode($setngs[0]['Sitesetting']['giftcard'],true);
				//echo "<pre>";print_r($giftcarduseradded);die;
				$this->set('giftcarditemDetails',$giftcarditemDetails);
				$this->set('giftcarduseradded',$giftcarduseradded);
				$this->set('countgiftcarduseradded',count($giftcarduseradded));
					
				//$total_itms += count($giftcarduseradded);
			}
			
			
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));			
			$this->set('commiDetails',$commiDetails);
			
			//echo "<pre>";print_r($itm_group);die;
			/* foreach($cntry_datas as $cntry){
				$cntryname[$cntry['Country']['id']] = $cntry['Country']['country'];
				$cntryid[$cntry['Country']['code']] = $cntry['Country']['id'];
			} */
			//echo $_SESSION['shpngid']."<pre>";print_r($itm_datas);die;
			$this->set('carts',$carts);
			$this->set('total_itms',$total_itms);
			$this->set('itm_datas',$itm_datas);
			$this->set('cntry_datas',$cntry_datas);
			$this->set('shipping_method_id',$_SESSION['shpngid']);
			$this->set('itm_group',$itm_group);
			$this->set('userid',$userid);
			$this->set("usershipping", $usershipping);
			$this->set("usershippingdefault", $usershippingdefault);
			$this->set('available_bal',$available_bal);
			
			//$available_bal = $this->User->findById($userid);
			//$this->set('available_bal',$available_bal['User']['credit_total']);
		}
		
	function checkout () {
			$this->autoLayout = false;
			$this->autoRender = false;
			
			global $loguser;
			global $user_level;
			global $setngs;
			global $paypalAdaptive;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Shop');
			$this->loadModel('Commission');
			$this->loadModel('Coupon');
			$this->loadModel('Giftcard');
			
			$itemIds = $_POST['item_id'];
			$shippingid = $_POST['shippingid'];
			$shipamt = $_POST['shipamt'];
			$couponId = 0;
			$userEnterCreditAmt = $_POST['userEnterCreditAmt'];
			$giftCardId = $_POST['giftCardId'];
			//echo $userEnterCreditAmt;die;
			
			if (isset($_POST['couponId'])){
				$couponId = $_POST['couponId'];
			}
			
			if(isset($couponId) && $couponId != 0){
				$getcouponvalue = $this->Coupon->findById($couponId);
				$this->set('getcouponvalue',$getcouponvalue);
			}
			
			if(isset($giftCardId)){
				$getgiftcardValue = $this->Giftcard->findById($giftCardId);
				$this->set('getgiftcardValue',$getgiftcardValue);
			}
			
			$itemIds = str_replace("'","\"",$itemIds);
			$itemIds = json_decode($itemIds,true);
			$shipamt = str_replace("'","\"",$shipamt);
			$shipamt = json_decode($shipamt,true);
			//echo "<pre>";print_r($itemIds);
			
			if (!isset($_SESSION['shpngid'])) {
				$_SESSION['shpngid'] = $shipping_method_id;
			}
			
			$userModel = $this->User->findByid($userid);
			$useremail = $userModel['User']['email'];
			
			$this->loadModel('Country');
			$itm_datas = array();
			
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress','item_id'=>$itemIds)));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					if(!empty($crt['Cart']['size_options'])){
						$sizeopts = $crt['Cart']['size_options'];
					}else{
						$sizeopts = '0';
					}
					
					
					$size_options[] = $sizeopts;
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
				}
				$sizeoption = json_encode($size_options);
				//echo "<pre>";print_r($size_options);die;
				$this->set('quantity',$quantity);
				$this->set('size_options',$size_options);
			
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
			}	
			
			$cntry_datas = $this->Country->find('all');
			
			foreach($itm_datas as $itm) {
				if(isset($itm_group[$itm['Item']['shop_id']])) {
					$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
				} else {
					$itm_group[$itm['Item']['shop_id']] = 1;
				}
			}
			
			if (empty($itm_datas)) {
				$itm_group = array();
			}else {
				$shopModel = $this->Shop->findByuser_id($itm_datas[0]['Item']['user_id']);
			}
			$adaptive = $paypalAdaptive['paymentMode'];
			
			
			//echo "<pre>";print_r($paypalAdaptive);die;
			$normal = 0;
			if ($setngs[0]['Sitesetting']['paypal_id'] == $shopModel['Shop']['paypal_id'])
			{
				$normal = 1;
			}
			//echo "<pre>";print_r($itm_datas);die;
			
			$this->loadModel('Commission');
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			
				
			
			if ($adaptive == "paypalnormal" || $normal == 1) {
				$this->set('carts',$carts);
				$this->set('itm_datas',$itm_datas);
				$this->set('cntry_datas',$cntry_datas);
				$this->set('shipping_method_id',$_SESSION['shpngid']);
				$this->set('itm_group',$itm_group);
				$this->set('userid',$userid);
				$this->set('useremail',$useremail);
				$this->set('shippingid',$shippingid);
				$this->set('shipamt',$shipamt);
				$this->set('shopModel',$shopModel);
				$this->set('setngs',$setngs);
				$this->set('userEnterCreditAmt',$userEnterCreditAmt);
				$this->set('commiDetails',$commiDetails);
				$this->render('checkout');
			} else {
				if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
					$paypalurl = "https://sandbox.paypal.com/webscr?cmd=_ap-payment&paykey=";
					$apiurl = "https://svcs.sandbox.paypal.com/AdaptivePayments/";
				}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
					$paypalurl = "https://www.paypal.com/webscr?cmd=_ap-payment&paykey=";
					$apiurl = "https://svcs.paypal.com/AdaptivePayments/";
				}
				
				$adminItem = array();
				$sellerItem = array();
				$adminCommission = 0;
				$sellerAmount = 0;
				$commissionModel = $this->Commission->find('all',array('conditions'=>array('active'=>'1')));
				
				
				
				foreach($itm_datas as $key => $item) {
					$itemPrice = $item['Item']['price'];
					$itemPrice = $itemPrice * $quantity[$item['Item']['id']];
					
					if(!empty($getcouponvalue)){
						if($getcouponvalue['Coupon']['coupontype'] == 'percent'){
							$discount = $getcouponvalue['Coupon']['discount_amount'];
							$calDiscount = $itemPrice * ($discount / 100);
							$itemPrice -= $calDiscount;
						}
						if($getcouponvalue['Coupon']['coupontype'] == 'fixed'){
							$discount = $getcouponvalue['Coupon']['discount_amount'];
							$itemPrice = $itemPrice - $discount;
						}
					
					}
					
					
					foreach($commissionModel as $commission) {
						$min_value = floatval($commission['Commission']['min_value']);
						$max_value = floatval($commission['Commission']['max_value']);
						if ($min_value <= $itemPrice && $max_value >= $itemPrice) {
							$commissionType = $commission['Commission']['type'];
							$commissionPrice = floatval($commission['Commission']['amount']);
						}
					}
					//echo "commissionType".$commissionType;die;
					if ($commissionType == '$') {
						$sellerPrice = floatval($itemPrice) - $commissionPrice;
						$adminPrice = $commissionPrice;
						$adminCommission += $adminPrice;
						$sellerAmount += $sellerPrice;
					}else {
						$adminPrice = floatval($itemPrice) / $commissionPrice;
						$sellerPrice = floatval($itemPrice) - $adminPrice;
						$adminCommission += $adminPrice;
						$sellerAmount += $sellerPrice;
					}
					$adminItem[] = array(
								"name" => $item['Item']['item_title'],
								"price" => round($adminPrice,2),
								"itemPrice" => $itemPrice,
								"itemCount" => $quantity[$item['Item']['id']],
								"identifier" => $item['Item']['id']
								);
					$sellerItem[] = array(
							"name" => $item['Item']['item_title'],
							"price" => round($sellerPrice,2),
							"itemPrice" => $itemPrice,
							"itemCount" => $quantity[$item['Item']['id']],
							"identifier" => $item['Item']['id']
							);
				}
				
				//echo $sellerAmount;
				$shiptot = 0;
				foreach ($shipamt as $ship) {
					$shiptot += $ship;
				}
				$sellerAmount += $shiptot;
				//echo $sellerAmount;
				$requestEnvelope = array(
						'errorLanguage' =>"en_US",
						"detailLevel" => "ReturnAll"
				);
				//echo "Admin : ".round($adminCommission,2). " SellerPrice : " .round($sellerAmount,2);
				//echo "<pre> Admin : ";print_r($adminItem);
				//echo "<pre> Seller : ";print_r($sellerItem);die;
				
				/* $payKey = "AP-7FH28448547844415";
				$packet = array(
						"requestEnvelope" => $requestEnvelope,
						"payKey" => $payKey
				);
				$result = $this->adaptiveCall($apiurl, $packet, "GetPaymentOptions"); 
				
				
				echo $result."<pre>";print_r($result);die; */
				$adminAmount = round($adminCommission,2);
				$sellerAmount = round($sellerAmount,2);
				$createPacket = array(
						"actionType" => "PAY",
						"currencyCode" => "USD",
						"receiverList" => array(
								"receiver" => array(
										array (
												"amount" => "$adminAmount",
												"email" => $setngs[0]['Sitesetting']['paypal_id'],
												'Primary' => 'false'
												),
										array(
												"amount" => "$sellerAmount",
												"email" => $shopModel['Shop']['paypal_id'],
												'Primary' => 'true'
												),
										),
								),
						"returnUrl" => SITE_URL.'mobile/payment-successful',
						"cancelUrl" => SITE_URL.'mobile/payment-cancelled',
						"ipnNotificationUrl" => SITE_URL.'mobile/paypal/adaptiveipnprocess/',//'http://dev.hitasoft.com/new/success.php',
						"memo" => $useremail."-_-".$shippingid."-_-".$couponId."-_-".$userEnterCreditAmt."-_-".$giftCardId."-_-".$sizeoption,
						"requestEnvelope" => $requestEnvelope
						);
				
				$result = $this->adaptiveCall($apiurl, $createPacket, "Pay");
				//echo json_encode($result)."<pre>".json_encode($createPacket);
				if ($result['responseEnvelope']['ack'] == 'Success') {
					$payKey =  $result['payKey'] ;
					$payDetails = array(
							"requestEnvelope" => $requestEnvelope,
							"payKey" => $payKey,
							"receiverOptions" => array(
									array(
											"receiver" => array("email"=>$setngs[0]['Sitesetting']['paypal_id']),
											"invoiceData" => array(
													"item" => $adminItem
													)
									),
									array(
											"receiver" => array("email"=>$shopModel['Shop']['paypal_id']),
											"invoiceData" => array(
													"item" => $sellerItem,
													"totalShipping" => $shiptot
													)
									)
											),
									
							);
					//echo "<pre>";print_r($payDetails);die;
					$result = $this->adaptiveCall($apiurl, $payDetails, "SetPaymentOptions");
					//echo "<pre>";print_r($result);
					if ($result['responseEnvelope']['ack'] == 'Success') {
						$packet = array(
								"requestEnvelope" => $requestEnvelope,
								"payKey" => $payKey
								);
						$result = $this->adaptiveCall($apiurl, $packet, "GetPaymentOptions");
						
						
						//echo "<pre>";print_r($result);die;
						if ($result['responseEnvelope']['ack'] == 'Success') {
							echo "<script> window.location = '".$paypalurl.$payKey."';</script>";
						}else{
							echo "get payment option  problem";
						}
					}else{
						echo "payment settings problem";
					}
				}else{
					echo "create packet problem";
				}
			}
		}
		
		function adaptiveCall ($apiurl, $data, $action) {
			global $paypalAdaptive;
			$data = json_encode($data);
			$header = array(
					"X-PAYPAL-SECURITY-USERID:".$paypalAdaptive['apiUserId'],
					"X-PAYPAL-SECURITY-PASSWORD:".$paypalAdaptive['apiPassword'],
					"X-PAYPAL-SECURITY-SIGNATURE:".$paypalAdaptive['apiSignature'],
					"X-PAYPAL-APPLICATION-ID:".$paypalAdaptive['apiApplicationId'],
					"X-PAYPAL-REQUEST-DATA-FORMAT:JSON",
					"X-PAYPAL-RESPONSE-DATA-FORMAT:JSON"
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiurl.$action);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			//curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			$result = curl_exec($ch);
			/* $info = curl_getinfo($ch);
			
			echo "<pre>";print_r($info);
			if ($result){
				echo $result; */
			if(!curl_errno($ch))
			{
				return json_decode($result,true);
			}else{
				echo $result;
			}
		}
		
		function adaptiveresponce(){
			
		}
		
		/* payment success */
		function payment_success(){
			global $loguser;
			global $user_level;
			$this->layout = 'mobilelayout';
			$this->loadModel('User');
			$userid = $loguser[0]['User']['id'];
			$this->set('title_for_layout','Payment Successfull');
			
			$userModel = $this->User->findByid($userid);
				
		}
		
		/* payment failure */
		
		function payment_cancel(){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','Payment Cancel');
		}
		
		public function decodePayPalIPN($raw_post) {
			if (empty($raw_post)) {
				return array();
			} // else:
			$post = array();
			$pairs = explode('&', $raw_post);
			foreach ($pairs as $pair) {
				list($key, $value) = explode('=', $pair, 2);
				$key = urldecode($key);
				$value = urldecode($value);
				// This is look for a key as simple as 'return_url' or as complex as 'somekey[x].property'
				preg_match('/(\w+)(?:\[(\d+)\])?(?:\.(\w+))?/', $key, $key_parts);
				switch (count($key_parts)) {
					case 4:
						// Original key format: somekey[x].property
						// Converting to $post[somekey][x][property]
						if (!isset($post[$key_parts[1]])) {
							$post[$key_parts[1]] = array($key_parts[2] => array($key_parts[3] => $value));
						} else if (!isset($post[$key_parts[1]][$key_parts[2]])) {
							$post[$key_parts[1]][$key_parts[2]] = array($key_parts[3] => $value);
						} else {
							$post[$key_parts[1]][$key_parts[2]][$key_parts[3]] = $value;
						}
						break;
					case 3:
						// Original key format: somekey[x]
						// Converting to $post[somkey][x]
						if (!isset($post[$key_parts[1]])) {
							$post[$key_parts[1]] = array();
						}
						$post[$key_parts[1]][$key_parts[2]] = $value;
						break;
					default:
						// No special format
						$post[$key] = $value;
						break;
				}//switch
			}//foreach
		
			return $post;
		}//decodePayPalIPN()
		
		function adaptiveipnprocess() {
			$this->autoLayout = false;
			$this->autoRender = false;
			global $setngs;
			global $loguser;
			
			$siteChanges = $setngs[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			$creditAmtByAdmin = $siteChanges['credit_amount'];
			
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Cart');
			$this->loadModel('Logcoupon');
			$this->loadModel('Item');
			$this->loadModel('User');
			$this->loadModel('Userinvitecredit');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Giftcard');
			
			$postFields = 'cmd=_notify-validate';
			
			if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
				$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
				$url = 'https://www.paypal.com/cgi-bin/webscr';
			}
			
			$raw_post = file_get_contents("php://input");
			$raw_post = $this->decodePayPalIPN($raw_post);
			
			foreach($raw_post as $key => $value)
			{
					
				if ($key == 'transaction') {
					$transactionCount = count($raw_post['transaction']);
					foreach ($raw_post['transaction'] as $map => $transaction) {
						foreach ($transaction as $tranName => $tranValue){
							$postFields .= "&transaction[".$map."].".$tranName."=".urlencode($tranValue);
							$keyarray['transaction'][$map][urldecode($tranName)] = urldecode($tranValue);
						}
						/* $postFields .= "&transaction[".$map."].is_primary_receiver=".urlencode($transaction['is_primary_receiver']);
						$postFields .= "&transaction[".$map."].id_for_sender_txn=".urlencode($transaction['id_for_sender_txn']);
						$postFields .= "&transaction[".$map."].receiver=".urlencode($transaction['receiver']);
						$postFields .= "&transaction[".$map."].amount=".urlencode($transaction['amount']);
						$postFields .= "&transaction[".$map."].status=".urlencode($transaction['status']);
						$postFields .= "&transaction[".$map."].id=".urlencode($transaction['id']);
						$postFields .= "&transaction[".$map."].status_for_sender_txn=".urlencode($transaction['status_for_sender_txn']);
						$postFields .= "&transaction[".$map."].paymentType=".urlencode($transaction['paymentType']);
						$postFields .= "&transaction[".$map."].pending_reason=".urlencode($transaction['pending_reason']); */
					}
				}else {
					$postFields .= "&$key=".urlencode($value);
					$keyarray[urldecode($key)] = urldecode($value);
				}
			}
			//transaction[0].is_primary_receiver=false&
			$ch = curl_init();
			
			curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postFields
			));
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			/* $this->request->data['Orders']['status'] = $result."-------".$postFields;
			$this->request->data['Orders']['status_date'] = time();
			$this->Orders->save($this->request->data);$result = "asdfasdf"; */
			if ($result == 'VERIFIED' && $keyarray['status'] == 'COMPLETED' ) {
				
				if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
					$paypalurl = "https://sandbox.paypal.com/webscr?cmd=_ap-payment&paykey=";
					$apiurl = "https://svcs.sandbox.paypal.com/AdaptivePayments/";
				}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
					$paypalurl = "https://www.paypal.com/webscr?cmd=_ap-payment&paykey=";
					$apiurl = "https://svcs.paypal.com/AdaptivePayments/";
				}
				$requestEnvelope = array(
						'errorLanguage' =>"en_US",
						"detailLevel" => "ReturnAll"
				);
				
				$custom = explode('-_-', $keyarray['memo']);
				$userModel = $this->User->findByemail($custom[0]);
				$userid = $userModel['User']['id'];
				$usernameforcust = $userModel['User']['first_name'];
				$payKey = $keyarray['pay_key'];
				$packet = array(
						"requestEnvelope" => $requestEnvelope,
						"payKey" => $payKey
				);
				
				while(1){
					$result = $this->adaptiveCall($apiurl, $packet, "GetPaymentOptions");
					$resultCount = count($result);
					if($resultCount > 0)
						break;
				}
				$totalCost = 0;
				foreach ($result['receiverOptions']['1']['invoiceData']['item'] as $key => $item) {
					$totalCost += $item['itemPrice'] * $item['itemCount'];
					$cartItemPrice[$key+1] = $item['itemPrice'] * $item['itemCount'];
					$cartItemUnitPrice[$key+1] = $item['itemPrice'];
					$cartItemQuantity[$key+1] = $item['itemCount'];
					$cartItemId[$key+1] = $item['identifier'];
					$cartItemName[$key+1] = $item['name'];
				}
				$totShipping = $result['receiverOptions']['1']['invoiceData']['totalShipping'];
				$cartCount = count($result['receiverOptions']['1']['invoiceData']['item']);
								
				if($custom[2]!=0){
					$coupon_id = $custom[2];
						
					$getcouponvalue = $this->Coupon->findById($coupon_id);
					//$this->set('getcouponvalue',$getcouponvalue);
					$rangeval = $getcouponvalue['Coupon']['validrange'];
					$rangevals = $rangeval - 1;
					$this->Coupon->updateAll(array('validrange' => $rangevals), array('id' => $coupon_id));
						
						
					$this->request->data['Logcoupon']['user_id'] = $userid;
					$this->request->data['Logcoupon']['coupon_id'] = $coupon_id;
					$this->request->data['Logcoupon']['cdate'] = time();
					$this->Logcoupon->save($this->request->data);
						
				}else{
					$coupon_id = 0 ;
				}
				
				
				
				if($custom[4]!=0){
					$giftCardId = $custom[4];
				
					$getiftcardvalue = $this->Giftcard->findById($giftCardId);
						
					$avilamount = $getiftcardvalue['Giftcard']['amount'] - $keyarray['discount'];
						
					$this->Giftcard->updateAll(array('Giftcard.avail_amount' => "'$avilamount'"), array('Giftcard.id' => $giftCardId));
				
				}else{
					$giftCardId = 0 ;
				}
				
				/* Credit amount reduce*/
				if($custom[3]!=0){
					$credit_amt_reduce = $userModel['User']['credit_total'];
					$credit_amt_reduce -= $keyarray['discount'];
					$this->User->updateAll(array('User.credit_total' => "'$credit_amt_reduce'"), array('User.id' => $userid));
				}
				/* Credit amount reduce*/
				
				if(!empty($custom[5])){
					$sizeopt = json_decode($custom[5],true);
				}else{
					$sizeopt = '';
				}
				
				$this->request->data['Orders']['userid'] = $userid;
				$this->request->data['Orders']['totalcost'] = $totalCost;
				$this->request->data['Orders']['orderdate'] = time();
				$this->request->data['Orders']['shippingaddress'] = $custom[1];
				/* Credit amount added to Order table*/
				if($custom[3]!=0 || $custom[4]!=0){
					$this->request->data['Orders']['discount_amount'] = $keyarray['discount'];
				}
				/* Credit amount added to Order table*/
				$this->request->data['Orders']['coupon_id'] = $custom[2];
				$this->request->data['Orders']['status'] = 'Paid';
				$this->request->data['Orders']['status_date'] = time();
				$this->Orders->save($this->request->data);
				$orderId = $this->Orders->getLastInsertID();
				for ($i=1;$i<=$cartCount;$i++) {
					$this->Order_items->create();
					$this->request->data['Order_items']['orderid'] = $orderId;
					$this->request->data['Order_items']['itemid'] = $cartItemId[$i];
					$this->request->data['Order_items']['itemname'] = $cartItemName[$i];
					$this->request->data['Order_items']['itemprice'] = $cartItemPrice[$i];
					$this->request->data['Order_items']['itemquantity'] = $cartItemQuantity[$i];
					$this->request->data['Order_items']['itemunitprice'] = $cartItemUnitPrice[$i];
					$this->request->data['Order_items']['shippingprice'] = $totShipping;
					$this->request->data['Order_items']['item_size'] = $sizeopt[$i-1];
					$this->Order_items->save($this->request->data);
						
					$cartdats = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'item_id'=>$cartItemId[$i],'payment_status'=>'progress')));
						
					$this->request->data['Cart']['id'] = $cartdats[0]['Cart']['id'];
					$this->request->data['Cart']['payment_status'] = 'success';
					$this->Cart->save($this->request->data);
						
					$itemModel = $this->Item->findByid($cartItemId[$i]);
					$quantityItem = $itemModel['Item']['quantity'];
					$user_id = $itemModel['Item']['user_id'];
					$itemname[] = $itemModel['Item']['item_title'];					
					$itemopt = $itemModel['Item']['size_options'];
					$totquantity[] = $cartItemQuantity[$i];
					$this->request->data['Item']['id'] = $cartItemId[$i];
					$this->request->data['Item']['quantity'] = $quantityItem - $cartItemQuantity[$i];
					
					if(!empty($custom[5])){
					
						$explodedcoma = explode(',',$itemopt);
						foreach($explodedcoma as $k=>$exdecoma){
							$explodedequal[] = explode('=',$exdecoma);
							if($explodedequal[$k][0]==$sizeopt[$i-1]){
								//echo "   ".$llll;
								$reduced = $explodedequal[$k][1]-1;
								$getVall = $sizeopt[$i-1]."=".$reduced;
								//echo "<pre>";print_r($sss);
									
								$final .=$getVall.',';
									
							}else{
									
								$final .=$exdecoma.',';
							}
						}
					
					
						$this->request->data['Item']['size_options'] = $final;
					}
					
					
					
					
					$this->Item->save($this->request->data);
				}
			
			
				$this->Orders->updateAll(array('merchant_id' => $user_id), array('orderid' => $orderId));
			
				$invoiceId = $this->Invoices->find('first',array('order'=>array('invoiceid'=>'desc')));//getLastInsertID()+1;
				$invoiceId = $invoiceId['Invoices']['invoiceid'] + 1;
				$this->request->data['Invoices']['invoiceno'] = 'INV'.$invoiceId.$userid;
				$this->request->data['Invoices']['invoicedate'] = time();
				$this->request->data['Invoices']['invoicestatus'] = $keyarray['status'];
				$this->request->data['Invoices']['paymentmethod'] = 'Paypal Adaptive';
				$this->Invoices->save($this->request->data);
				$invoiceId = $this->Invoices->getLastInsertID();
				$this->request->data['Invoiceorders']['invoiceid'] = $invoiceId;
				$this->request->data['Invoiceorders']['orderid'] = $orderId;
				$this->Invoiceorders->save($this->request->data);
			
				
				
				
				$user_datas = $this->User->findById($userid);
				$referrer_id = $user_datas['User']['referrer_id'];
				$referrer_ids = json_decode($referrer_id);
				$sixtythdate = strtotime($user_datas['User']['created_at']) + 5184000;
				$createddate = strtotime($user_datas['User']['created_at']);
				
				if($createddate < $sixtythdate && time() <= $sixtythdate && $referrer_ids->first=='first'){
				
					$this->request->data['Userinvitecredit']['user_id'] = $userid;
					$this->request->data['Userinvitecredit']['invited_friend'] = $referrer_ids->reffid;
					$this->request->data['Userinvitecredit']['credit_amount'] = $creditAmtByAdmin;
					$this->request->data['Userinvitecredit']['status'] = "Used";
					$this->request->data['Userinvitecredit']['cdate'] = time();
					$this->Userinvitecredit->save($this->request->data);
						
					$reff_id['reffid'] = $referrer_ids->reffid;
					$reff_id['first'] = 'Purchased';
					$json_ref_id = json_encode($reff_id);
					
					$this->User->updateAll(array('User.referrer_id' => "'$json_ref_id'"), array('User.id' => $userid));
						
					$usercredit_amt = $this->User->findById($referrer_ids->reffid);
					$total_credited_amount = $usercredit_amt['User']['credit_total'];
					//$amtt = 10;						
					$total_credited_amount = $total_credited_amount + $creditAmtByAdmin;
					
					$this->User->updateAll(array('User.credit_total' => "'$total_credited_amount'"), array('User.id' => $referrer_ids->reffid));
						
					
				}
				
				
				
				
				
				
				
				//$this->Email->to = 'saravana235@gmail.com';
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $custom[0];
				$this->Email->subject = "Order notification";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'ipnmail_cust';
				$this->set('custom',$usernameforcust);
				$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$sizeopt);
				$emailidcust = base64_encode($custom[0]);
				$orderIdcust = base64_encode($orderId);
				$this->set('access_url','');
				$this->set('access_url_n_d','');
				$this->Email->send();
			
				$userModelemail = $this->User->findById($user_id);
			
				$usershipping_addr = $this->Shippingaddresses->findByShippingid($custom[1]);
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $userModelemail['User']['email'];
				//$this->Email->to = 'saravananm@hitasoft.com';
				$this->Email->subject = "Order notification";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'ipnmail_supp';
				$this->set('custom',$userModelemail['User']['first_name']);
				$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$sizeopt);
				$this->set('usershipping_addr',$usershipping_addr);
				$emailidsell = base64_encode($userModelemail['User']['email']);
				$orderIdmer = base64_encode($orderId);
				$this->set('access_url','');
				$this->Email->send();
			
			}
		}
		
		function ipnprocess () {
			$this->autoLayout = false;
			$this->autoRender = false;
			global $setngs;
			$siteChanges = $setngs[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			$creditAmtByAdmin = $siteChanges['credit_amount'];
			
			//$siteChanges['credit_amount'];
			global $loguser;
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Cart');
			$this->loadModel('Item');
			$this->loadModel('Coupon');
			$this->loadModel('Logcoupon');
			$this->loadModel('User');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Userinvitecredit');
			$this->loadModel('Giftcard');
			$this->loadModel('Forexrates');
			$this->loadModel('Tempaddresses');
			
			$postFields = 'cmd=_notify-validate';
			//$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			//$url = 'https://www.paypal.com/cgi-bin/webscr';
			
			if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
				$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
				$url = 'https://www.paypal.com/cgi-bin/webscr';
			}
			
			
			foreach($_POST as $key => $value)
			{
				$postFields .= "&$key=".urlencode($value);
				$keyarray[urldecode($key)] = urldecode($value);
			}

			$ch = curl_init();
			
			curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postFields
			));
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			if ($result == 'VERIFIED' && $keyarray['payment_status'] == 'Completed' ) {

				if ($keyarray['custom'] != ''){
					$custom = explode('-_-', $keyarray['custom']);
				}else{
					$custom = explode('-_-', $keyarray['memo']);
				}
				$userModel = $this->User->findByemail($custom[0]);
				$userid = $userModel['User']['id'];
				
				$currencyCode = $keyarray['mc_currency'];
				$forexrateModel = $this->Forexrates->find('first',
								array('conditions'=>array('currency_code' => $currencyCode)));
				$forexRate = $forexrateModel['Forexrates']['price'];
				
				$paypalno = array();$itemIds = array();$itemUsers = array();
				for ($i=1;$i<=$keyarray['num_cart_items'];$i++) {
					if($keyarray['item_number'.$i]!=''){
						$itemIds[] = $keyarray['item_number'.$i];
						$paypalno[$keyarray['item_number'.$i]] = $i;
					}else{
						$mobi_value = explode('-_-', $keyarray['item_name'.$i]);
						$itemIds[] = $mobi_value[1];
						$paypalno[$mobi_value[1]] = $i;
					}
				}
				
				$tempShippingModel = $this->Tempaddresses->findByshippingid($custom[1]);
				
				$shippingaddressesModel = $this->Shippingaddresses->find('first',array('conditions'=>array(
						'shippingid'=>$tempShippingModel['Tempaddresses']['shippingid'], 
						'userid'=>$tempShippingModel['Tempaddresses']['userid'], 
						'nickname'=>$tempShippingModel['Tempaddresses']['nickname'], 
						'name'=>$tempShippingModel['Tempaddresses']['name'], 
						'address1'=>$tempShippingModel['Tempaddresses']['address1'], 
						'address2'=>$tempShippingModel['Tempaddresses']['address2'], 
						'city'=>$tempShippingModel['Tempaddresses']['city'], 
						'state'=>$tempShippingModel['Tempaddresses']['state'], 
						'country'=>$tempShippingModel['Tempaddresses']['country'], 
						'zipcode'=>$tempShippingModel['Tempaddresses']['zipcode'], 
						'phone'=>$tempShippingModel['Tempaddresses']['phone'])));
				if (!empty($shippingaddressesModel)){
					$shippingId = $shippingaddressesModel['Shippingaddresses']['shippingid'];
				}else{
					$this->request->data['Shippingaddresses']['userid'] = $tempShippingModel['Tempaddresses']['userid'];
					$this->request->data['Shippingaddresses']['name'] = $tempShippingModel['Tempaddresses']['name'];
					$this->request->data['Shippingaddresses']['nickname'] = $tempShippingModel['Tempaddresses']['nickname'];
					$this->request->data['Shippingaddresses']['country'] = $tempShippingModel['Tempaddresses']['country'];
					$this->request->data['Shippingaddresses']['state'] = $tempShippingModel['Tempaddresses']['state'];
					$this->request->data['Shippingaddresses']['address1'] = $tempShippingModel['Tempaddresses']['address1'];
					$this->request->data['Shippingaddresses']['address2'] = $tempShippingModel['Tempaddresses']['address2'];
					$this->request->data['Shippingaddresses']['city'] = $tempShippingModel['Tempaddresses']['city'];
					$this->request->data['Shippingaddresses']['zipcode'] = $tempShippingModel['Tempaddresses']['zipcode'];
					$this->request->data['Shippingaddresses']['phone'] = $tempShippingModel['Tempaddresses']['phone'];
					$this->request->data['Shippingaddresses']['countrycode'] = $tempShippingModel['Tempaddresses']['countrycode'];
					
					$this->Shippingaddresses->save($this->request->data);
					$shippingId =  $this->Shippingaddresses->getLastInsertID();
				}
				
				$itemgroupuserModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemIds),'order'=>array('Item.user_id DESC')));
				$prevUserId = 0;$mercount = 0;$meritemcount = 0;
				foreach ($itemgroupuserModel as $itemModel){
					if ($prevUserId != $itemModel['Item']['user_id']) {
						$prevUserId = $itemModel['Item']['user_id'];
						$itemUsers[$mercount]['userid'] = $prevUserId;
						$prevcount = $mercount;
						$mercount ++;$meritemcount = 0;
					}
					$itemUsers[$prevcount]['items'][$meritemcount]['itemid'] = $itemModel['Item']['id'];
					$meritemcount ++;
				}
				$itemuserjson = json_encode($itemUsers);
				
				$this->loadModel('Shop');
				$this->request->data['Shop']['id'] = '1';
				$this->request->data['Shop']['shop_announcement'] = $prevcount;
				$this->request->data['Shop']['shop_message'] = $itemuserjson;
				$this->Shop->save($this->request->data);
				
				if(!empty($custom[2])){
					$coupon_id = $custom[2];
					
					$getcouponvalue = $this->Coupon->findById($coupon_id);
					//$this->set('getcouponvalue',$getcouponvalue);
					$rangeval = $getcouponvalue['Coupon']['validrange'];
					$rangevals = $rangeval - 1;
					$this->Coupon->updateAll(array('validrange' => $rangevals), array('id' => $coupon_id));
					
					
					$this->request->data['Logcoupon']['user_id'] = $userid;
					$this->request->data['Logcoupon']['coupon_id'] = $coupon_id;
					$this->request->data['Logcoupon']['cdate'] = time();
					$this->Logcoupon->save($this->request->data);
					
				}else{
					$coupon_id = 0 ;
				}
				
				
				
				
				
				
				/* Credit amount reduce*/

				if($custom[3]!=0){
					$credit_amt_reduce = $userModel['User']['credit_total'];
					$usedCreditInUSD = $keyarray['discount'] / $forexRate;
					$credit_amt_reduce -= $usedCreditInUSD;
					$credit_amt_reduce = round($credit_amt_reduce, 2);
					//$credit_amt_reduce -= $keyarray['discount'];
					$this->User->updateAll(array('User.credit_total' => $credit_amt_reduce), array('User.id' => $userid));
				}
				/* Credit amount reduce*/
				
				
				if(!empty($custom[5])){
					$sizeopt = json_decode($custom[5],true);
				}else{
					$sizeopt = '';
				}
				
				
				$usernameforcust = $userModel['User']['first_name'];
				foreach ($itemUsers as $itemUser) {
					$orderComission = 0;
					$totalcost = 0;
					$totalCostshipp = 0;
					$this->Orders->create();
					$this->request->data['Orders']['userid'] = $userid;
					$this->request->data['Orders']['totalcost'] = 0;
					//$this->request->data['Orders']['merchant_id'] = $itemUser['userid'];
					$this->request->data['Orders']['orderdate'] = time();
					$this->request->data['Orders']['shippingaddress'] = $shippingId;
					$this->request->data['Orders']['coupon_id'] = $custom[2];
					$this->request->data['Orders']['currency'] = $currencyCode;
					
					/* Credit amount added to Order table*/
					if($custom[3]!=0 || $custom[4]!=0){
						$this->request->data['Orders']['discount_amount'] = $keyarray['discount'];
					}
					/* Credit amount added to Order table*/
					$this->Orders->save($this->request->data);
					$orderId = $this->Orders->getLastInsertID();
					for ($j = 0;$j < count($itemUser['items']);$j++) {
						$prossItemId = $itemUser['items'][$j]['itemid'];
						$i = $paypalno[$prossItemId];
						
						if($keyarray['item_number'.$i]!=''){
							$this->request->data['Order_items']['itemid'] = $keyarray['item_number'.$i];
							$this->request->data['Order_items']['itemname'] = $keyarray['item_name'.$i];
						}else{
							$mobi_value = explode('-_-', $keyarray['item_name'.$i]);
							$this->request->data['Order_items']['itemid'] = $mobi_value[1];
							$this->request->data['Order_items']['itemname'] = $mobi_value[0];
							$keyarray['item_name'.$i] = $mobi_value[0];
							$keyarray['item_number'.$i] = $mobi_value[1];
							$keyarray['mc_shipping'.$i] = $mobi_value[2];
							$keyarray['mc_gross_'.$i] += $mobi_value[2];
						}
						
						//if ($keyarray['mc_shipping'.$i] == '')
							//$keyarray['mc_shipping'.$i] = 0;
						$shipp = $keyarray['mc_shipping'.$i];
						$itemPrice = $keyarray['mc_gross_'.$i] - $shipp;
						$itemUSD = $itemPrice / $forexRate;
						$unitPrice = $itemPrice / $keyarray['quantity'.$i];
						$ItemTottalPricee = $keyarray['mc_gross'] - $keyarray['mc_shipping'] + $keyarray['discount'];
						//$ItemTottalPricee = $ItemTottalPricees - $keyarray['discount'];
						$cartdats = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'item_id'=>$keyarray['item_number'.$i],'payment_status'=>'progress')));
						
						if ($cartdats[0]['Cart']['size_options'] != NULL) {
							$cartSize = $cartdats[0]['Cart']['size_options'];
						}else{
							$cartSize = '0';
						}
						
						$this->Order_items->create();
						$this->request->data['Order_items']['orderid'] = $orderId;
						/* if($keyarray['item_number'.$i]!=''){
							$this->request->data['Order_items']['itemid'] = $keyarray['item_number'.$i];
							$this->request->data['Order_items']['itemname'] = $keyarray['item_name'.$i];
						}else{
							$mobi_value = explode('-_-', $keyarray['item_name'.$i]);
							$this->request->data['Order_items']['itemid'] = $mobi_value[1];
							$this->request->data['Order_items']['itemname'] = $mobi_value[0];
							$keyarray['item_name'.$i] = $mobi_value[0];
							$keyarray['item_number'.$i] =$mobi_value[1];
						} */
						$this->request->data['Order_items']['itemprice'] = $keyarray['mc_gross_'.$i] - $keyarray['mc_shipping'.$i];
						$totalcost += $keyarray['mc_gross_'.$i];
						$totalCostshipp += $keyarray['mc_shipping'.$i];
						$this->request->data['Order_items']['itemquantity'] = $keyarray['quantity'.$i];
						$this->request->data['Order_items']['itemunitprice'] = ($keyarray['mc_gross_'.$i] - $keyarray['mc_shipping'.$i]) / $keyarray['quantity'.$i];
						$this->request->data['Order_items']['shippingprice'] = $keyarray['mc_shipping'.$i];
						$this->request->data['Order_items']['item_size'] = $cartSize;
						
						
						if($custom[2]!=0){
							$coupon_id = $custom[2];					
							$getcouponvaluetwo = $this->Coupon->findById($coupon_id);							
							
							if(!empty($getcouponvaluetwo)){
								if($getcouponvaluetwo['Coupon']['coupontype'] == 'percent'){
									$discount_amountTwo = $getcouponvaluetwo['Coupon']['discount_amount'] * $forexRate;
									$discount_amountTwo = ($discount_amountTwo / 100);									
									$commiItemTotalPrice = floatval(($itemPrice) * ($discount_amountTwo));							
								}
								if($getcouponvaluetwo['Coupon']['coupontype'] == 'fixed'){
									$discount_amountTwo = $getcouponvaluetwo['Coupon']['discount_amount'] * $forexRate;									
									$commiItemTotalPrice = floatval(($itemPrice) / ($ItemTottalPricee)) * ($discount_amountTwo);							
								}
							
							}							
							//$commissionCost = floatval((($discount_amountTwo)*$commiItemTotalPrice)/$discount_amountTwo);
							$commissionCost = round($commiItemTotalPrice,0);
							$this->request->data['Order_items']['discountType'] = 'Coupon Discount';
							$this->request->data['Order_items']['discountAmount'] = $commissionCost;
							$commiItemTotalPrice = '';
						}
						
						
						if($custom[4]!=0){
							$giftCardId = $custom[4];
						
							$getiftcardvalueGC = $this->Giftcard->findById($giftCardId);
							$discount_amountGC = $getiftcardvalueGC['Giftcard']['avail_amount'] * $forexRate;
								
							//$commiItemTotalPrice = floatval(($itemPrice) / ($discount_amountGC));								
							$commiItemTotalPrice = floatval(($itemPrice) / ($ItemTottalPricee)) * ($discount_amountGC);
							
								
							//$commissionCost = floatval((($discount_amountGC)*$commiItemTotalPrice)/$discount_amountGC);
							$commissionCost = round($commiItemTotalPrice,0);
							$this->request->data['Order_items']['discountType'] = 'Giftcard Discount';
							$this->request->data['Order_items']['discountAmount'] = $commissionCost;
							$commiItemTotalPrice = '';
						}
						
						
						if($custom[3]!=0){
							$actualCredit = $custom[6];
						
							//$commiItemPrice = $itm['Item']['price'];
						
							$this->loadModel('Commission');
							$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
						
							foreach($commiDetails as $commi){
								$min_val = $commi['Commission']['min_value'] * $forexRate;
								$max_val =  $commi['Commission']['max_value'] * $forexRate;
								if($itemPrice>=$min_val && $itemPrice<=$max_val){
									if($commi['Commission']['type'] == '%'){
										$amount = (floatval($itemPrice)/100) * ($commi['Commission']['amount'] * $forexRate);
										//$amount = $quantity[$itm['Item']['id']]*$amount;
										$commiItemTotalPrice +=$amount;
									}else{
										$amount = $commi['Commission']['amount'] * $forexRate;
										$amount = $keyarray['quantity'.$i]*$amount;
										$commiItemTotalPrice +=$amount;
									}
								}
							}
						
							$commissionCost = floatval((($keyarray['discount'])*$commiItemTotalPrice)/$actualCredit);
							$commissionCost = round($commissionCost,0);
							$this->request->data['Order_items']['discountType'] = 'User Credits';
							$this->request->data['Order_items']['discountAmount'] = $commissionCost;
							$commiItemTotalPrice = '';
						}
						
						$itemComission = 0;
						$this->loadModel('Commission');
						$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
						foreach($commiDetails as $commi){
							$min_val = $commi['Commission']['min_value'];
							$max_val =  $commi['Commission']['max_value'];
							if($itemUSD>=$min_val && $itemUSD<=$max_val){
								if($commi['Commission']['type'] == '%'){
									$amount = (floatval($itemUSD)/100)*$commi['Commission']['amount'];
									//$amount = $quantity[$itm['Item']['id']]*$amount;
									$itemComission +=$amount;
								}else{
									$amount = $commi['Commission']['amount'];
									$amount = $keyarray['quantity'.$i]*$amount;
									$itemComission +=$amount;
								}
							}
						}
						$itemComission = $itemComission * $forexRate;
						$itemComission = round($itemComission, 2);
						$orderComission += $itemComission;
						
						$this->Order_items->save($this->request->data);
						
						$this->request->data['Cart']['id'] = $cartdats[0]['Cart']['id'];
						$this->request->data['Cart']['payment_status'] = 'success';
						$this->Cart->save($this->request->data);
						
						$itemModel = $this->Item->findByid($keyarray['item_number'.$i]);
						$quantityItem = $itemModel['Item']['quantity'];
						$user_id = $itemModel['Item']['user_id'];
						$itemname[] = $itemModel['Item']['item_title'];
						$itemmailids[] = $itemModel['Item']['id'];
						$custmrsizeopt[] = $cartSize;
						$sellersizeopt[] = $cartSize;
						$selleritemmailids[] = $itemModel['Item']['id'];
						$selleritemname[] = $itemModel['Item']['item_title'];
						$itemopt = '';
						$itemopt = $itemModel['Item']['size_options'];
						$totquantity[] = $keyarray['quantity'.$i];
						$sellertotquantity[] = $keyarray['quantity'.$i];
						$this->request->data['Item']['id'] = $keyarray['item_number'.$i];
						$this->request->data['Item']['quantity'] = $quantityItem - $keyarray['quantity'.$i];
						$final = '';
						if(!empty($custom[5]) && !empty($itemopt)){
							
							$explodedcoma = explode(',',$itemopt);
							foreach($explodedcoma as $k=>$exdecoma){
								if ($final != ''){
									$final .= ',';
								}
								$explodedequal = explode('=',$exdecoma);
								if($explodedequal[0] == $cartSize){
									//echo "   ".$llll;
									$reduced = $explodedequal[1] - $keyarray['quantity'.$i];
									$getVall = $cartSize."=".$reduced;
									//echo "<pre>";print_r($sss);
										
									$final .=$getVall;
										
								}else{
										
									$final .=$exdecoma;
								}
							}
						}
						
						if ($cartSize != '0'){
							$this->request->data['Item']['size_options'] = $final;
						}else{
							$this->request->data['Item']['size_options'] = '';
						}
						
						$this->Item->save($this->request->data);
						$final = '';
					}
					

					if ($totalCostshipp == 0){
						$totalCostshipp = $keyarray['mc_shipping'];
					}
					
					
					
					$this->Orders->updateAll(array('merchant_id' => $user_id, 'totalcost' => $totalcost, 
							'totalCostshipp' => $totalCostshipp, 'admin_commission' => $orderComission), 
							array('orderid' => $orderId));
					
					$invoiceId = $this->Invoices->find('first',array('order'=>array('invoiceid'=>'desc')));//getLastInsertID()+1;
					$invoiceId = $invoiceId['Invoices']['invoiceid'] + 1;
					$this->Invoices->create();
					$this->request->data['Invoices']['invoiceno'] = 'INV'.$invoiceId.$userid;
					$this->request->data['Invoices']['invoicedate'] = time();
					$this->request->data['Invoices']['invoicestatus'] = $keyarray['payment_status'];
					$this->request->data['Invoices']['paymentmethod'] = 'Paypal';
					$this->Invoices->save($this->request->data);
					$invoiceId = $this->Invoices->getLastInsertID();
					$this->Invoiceorders->create();
					$this->request->data['Invoiceorders']['invoiceid'] = $invoiceId;
					$this->request->data['Invoiceorders']['orderid'] = $orderId;
					$this->Invoiceorders->save($this->request->data);
					
					App::import('Controller', 'Users');
					$Users = new UsersController;
					$this->loadModel('Userdevice');
					$userddett = $this->Userdevice->findAllByUser_id($user_id);
					foreach ($userddett as $userd) {
						$deviceTToken = $userd['Userdevice']['deviceToken'];
						$badge = $userd['Userdevice']['badge'];
						$badge +=1;
						$this->Userdevice->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
						if(isset($deviceTToken)){
							$messages = $usernameforcust." placed a order in your shop, order id : ".$orderId;
							//$messages = $logusername." est commenté votre article : ".$commentss;
							$Users->pushnot($deviceTToken,$messages,$badge);
						}
					}
					
					$userModelemail = $this->User->findById($user_id);
					
					$usershipping_addr = $this->Shippingaddresses->findByShippingid($custom[1]);
					
					if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
						$this->Email->smtpOptions = array(
							'port' => $setngs[0]['Sitesetting']['smtp_port'],
							'timeout' => '30',
							'host' => 'ssl://smtp.gmail.com',
							'username' => $setngs[0]['Sitesetting']['noreply_email'],
							'password' => $setngs[0]['Sitesetting']['noreply_password']);
				
						$this->Email->delivery = 'smtp';
					}
					$this->Email->to = $userModelemail['User']['email'];
					//$this->Email->to = 'saravananm@hitasoft.com';
					$this->Email->subject = "Order notification";
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'ipnmail_supp';
					$this->set('custom',$userModelemail['User']['first_name']);
					$this->set('loguser',$loguser);
					$this->set('itemname',$selleritemname);
					$this->set('itemid',$selleritemmailids);
					$this->set('tot_quantity',$sellertotquantity);
					$this->set('sizeopt',$sellersizeopt);
					$this->set('usershipping_addr',$usershipping_addr);
					$emailidsell = base64_encode($userModelemail['User']['email']);
					$orderIdmer = base64_encode($orderId);
					$this->set('access_url',$_SESSION['site_url']."merupdate/".$emailidsell."~".$orderIdmer);
					$this->Email->send();
					
					$selleritemname = '';$sellertotquantity = '';$selleritemmailids='';$sellersizeopt = '';
				}
				
				$user_datas = $this->User->findById($userid);
				$referrer_id = $user_datas['User']['referrer_id'];
				
				if(!empty($referrer_id)){
				$referrer_ids = json_decode($referrer_id);
				$sixtythdate = strtotime($user_datas['User']['created_at']) + 5184000;
				$createddate = strtotime($user_datas['User']['created_at']);
				
					if($createddate < $sixtythdate && time() <= $sixtythdate && $referrer_ids->first=='first'){
					
						$this->request->data['Userinvitecredit']['user_id'] = $userid;
						$this->request->data['Userinvitecredit']['invited_friend'] = $referrer_ids->reffid;
						$this->request->data['Userinvitecredit']['credit_amount'] = $creditAmtByAdmin;
						$this->request->data['Userinvitecredit']['status'] = "Used";
						$this->request->data['Userinvitecredit']['cdate'] = time();
						$this->Userinvitecredit->save($this->request->data);
						
						$reff_id['reffid'] = $referrer_ids->reffid;
						$reff_id['first'] = 'Purchased';
						$json_ref_id = json_encode($reff_id);
						//$this->User->updateAll(array('User.referrer_id' => "'$json_ref_id'"), array('user_id' => $userid));
						//$total_credited_amount = $user_datas['User']['credit_total'];
							
						
						
							
						$this->User->updateAll(array('User.referrer_id' => "'$json_ref_id'"), array('User.id' => $userid));
							
						$usercredit_amt = $this->User->findById($referrer_ids->reffid);
						$total_credited_amount = $usercredit_amt['User']['credit_total'];
						//$amtt = 10;						
						$total_credited_amount = $total_credited_amount + $creditAmtByAdmin;
						
						$this->User->updateAll(array('User.credit_total' => "'$total_credited_amount'"), array('User.id' => $referrer_ids->reffid));
							
					
					
					}
				
				}
				
				if($custom[4]!=0){
					$giftCardId = $custom[4];
						
					$getiftcardvalue = $this->Giftcard->findById($giftCardId);
						
					$avilamount = $getiftcardvalue['Giftcard']['avail_amount'] - ($keyarray['discount'] / $forexRate);
						
					$this->Giftcard->updateAll(array('Giftcard.avail_amount' => "'$avilamount'"), array('Giftcard.id' => $giftCardId));
						
				}else{
					$giftCardId = 0 ;
				}
				
				
				//$this->Email->to = 'saravana235@gmail.com';
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $custom[0];
				$this->Email->subject = "Order notification";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'ipnmail_cust';
				$this->set('custom',$usernameforcust);
				$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('itemid',$itemmailids);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$custmrsizeopt);
				$emailidcust = base64_encode($custom[0]);
				$orderIdcust = base64_encode($orderId);
				$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
				$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust);
				$this->Email->send();
				
			}
		}
			
		function deleteshippingadd () {
			$this->layout = 'ajax';
			$this->autoRender = false;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Tempaddresses');
			$shipid = $_POST['shippingid'];
			$itmShopid = $_POST['itemshopid'];
			$item_user_id = $_POST['itemuserid'];
		
			$usershipdefault = $this->User->findByid($userid);
			$usershipdefault = $usershipdefault['User']['defaultshipping'];
			$usershippingdefault = $usershipdefault;
			if($usershipdefault == $shipid) {
				$this->User->updateAll(array('defaultshipping' =>'0'), array('User.id' => $userid));
				$usershippingdefault = 0;
			}
			$this->Tempaddresses->deleteAll(array('shippingid' => $shipid), false);
			
			$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userid)));
			
			if (count($usershipping) == 0){
				echo "1";
				return;
			}
			
			//$usershippingdefault = $this->User->findByid($userid);
			//$usershippingdefault = $usershippingdefault['User']['defaultshipping'];
			if ($usershippingdefault == 0){
				$_SESSION['shpngid'] = $usershipping[0]['Tempaddresses']['countrycode'];
				$usershippingdefault = $usershipping[0]['Tempaddresses']['shippingid'];
			}else{
				foreach ($usershipping as $ship) {
					if ($ship['Tempaddresses']['shippingid'] == $usershippingdefault){
						$_SESSION['shpngid'] = $ship['Tempaddresses']['countrycode'];
					}
				}
			}
			
			$shipSelect = "";$defaultAddr = "";$jsonShipaddr = array();
			$shipSelect .= '<select id="address-cart'.$item_user_id.'" class="select-shipping-addr" name="shipping_addr" onchange="cartshipping(\''.$item_user_id.'\',\''.$itmShopid.'\')" style="width: 210px;">';
			
			foreach ($usershipping as $usership) {
				$shipid = $usership['Tempaddresses']['shippingid'];
				$nick = $usership['Tempaddresses']['nickname'];
				if ($usershippingdefault == $shipid) {
					$shipSelect .=  '<option selected value="'.$shipid.'">'.$nick.'</option>';
					$fullname = $usership['Tempaddresses']['name'];
					$address1 = $usership['Tempaddresses']['address1'];
					$address2 = $usership['Tempaddresses']['address2'];
					$city = $usership['Tempaddresses']['city'];
					$state = $usership['Tempaddresses']['state'];
					$country = $usership['Tempaddresses']['country'];
					$zip = $usership['Tempaddresses']['zipcode'];
					$phone = $usership['Tempaddresses']['phone'];
				}else{
					$shipSelect .=  '<option value="'.$shipid.'">'.$nick.'</option>';
				}
			}
			$shipSelect .=  '</select><div class="shipchload shipchload'.$item_user_id.'"><img src="'.SITE_URL.'images/loading.gif" alt="Loading" /> </div>';
				
			$defaultAddr .= '<div class="addnam">'.$fullname.'</div>
			'.$address1.'<br />'.$city.' '.$state.' '.$zip.'<br />'.$country.'<br /><div class="addphne">'.$phone.'</div>';
			
			$jsonShipaddr[] = $shipSelect;
			$jsonShipaddr[] = $defaultAddr;
			echo json_encode($jsonShipaddr);
		}
		
		function changeshipping () {
			$shipping = $_POST['shippingid'];
			$shopId = $_POST['shopid'];
			if(isset($_POST['couponnId'])){
				$couponId = $_POST['couponnId'];
			}
			$this->loadModel('Tempaddresses');
			$this->layout = 'ajax';
			global $loguser;
			$userId = $loguser[0]['User']['id'];
		
			$this->loadModel('Country');
			$this->loadModel('Coupon');
			/* $prefix = $this->Item->tablePrefix;
			$itemsId = $this->Item->query("select id from ".$prefix."items where shop_id = ".$shopId);
			foreach ($itemsId as $item){
				$itmid[] = $item[$prefix.'items']['id'];
			}
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itmid,'payment_status'=>'progress'))); */
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
					$size[$crt['Cart']['item_id']] = $crt['Cart']['size_options'];
				}
				$this->set('quantity',$quantity);
				$this->set('size',$size);
			
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
				
			
			$cntry_datas = $this->Country->find('all');
			
			foreach($itm_datas as $itm) {
				if(isset($itm_group[$itm['Item']['shop_id']])) {
					$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
				} else {
					$itm_group[$itm['Item']['shop_id']] = 1;
				}
			}
			
			$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userId)));
			$this->set("usershipping", $usershipping);
			//$usershippingdefault = $this->User->findByid($userId);
			foreach ($usershipping as $ship) {
				if ($ship['Tempaddresses']['shippingid'] == $shipping) {
					$getcountrycode = $ship['Tempaddresses']['countrycode'];
				}
			}
			
			//echo $getcountrycode;die;
			
			
			if(isset($couponId) && $couponId != 0){
				$getcouponvalue = $this->Coupon->findById($couponId);
				$this->set('getcouponvalue',$getcouponvalue);
			}
			
			$usershippingdefault = $shipping;
			$total_itms = $this->Cart->find('count',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			$this->set('total_itms',$total_itms);
			$this->set('itm_datas',$itm_datas);
			$this->set('cntry_datas',$cntry_datas);
			$this->set('shipping_method_id',$getcountrycode);
			$this->set('itm_group',$itm_group);
			$this->set('userid',$userId);
			$this->set("usershippingdefault", $usershippingdefault);
			
			
				
			$this->loadModel('Commission');
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			$this->set('commiDetails',$commiDetails);
			
			$available_bal = $this->User->findById($userId);
			$this->set('available_bal',$available_bal['User']['credit_total']);
				
			$this->render('delete_cart_item');
			}
		}
		
		/***
		 * Remove cart Item
		 * */
		function delete_cart_item ($itemId,$userId,$shopId,$qnty=0,$couponId=NULL) {
			
			$currentship = $_POST['currentship'];
			if ($qnty == 0) {
			$cartId = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itemId)));
			$cartId = $cartId['0']['Cart']['id'];
			$delete_count = $this->Cart->delete($cartId);
			$total_itms = $this->Cart->find('count',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			}else {
				$this->Cart->updateAll(array('quantity' => $qnty), array('user_id' => $userId,'item_id' => $itemId));
				$total_itms = $this->Cart->find('count',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			}
			$this->layout = 'ajax';
			$this->loadModel('Country');
			$this->loadModel('Coupon');
			$this->loadModel('Giftcard');
			
			$giftcardCount = $this->Giftcard->find('count',array('conditions'=>array('Giftcard.user_id'=>$userId,'Giftcard.status'=>'Pending'),'order'=>'Giftcard.id DESC'));
			$total_itms += $giftcardCount;
			/* $prefix = $this->Item->tablePrefix;
			$itemsId = $this->Item->query("select id from ".$prefix."items where shop_id = ".$shopId);
			foreach ($itemsId as $item){
				$itmid[] = $item[$prefix.'items']['id'];
			}
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itmid,'payment_status'=>'progress'))); */
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
					$size[$crt['Cart']['item_id']] = $crt['Cart']['size_options'];
				}
				$this->set('quantity',$quantity);
				$this->set('size',$size);
			
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
				
			
			$cntry_datas = $this->Country->find('all');
			
			foreach($itm_datas as $itm) {
				if(isset($itm_group[$itm['Item']['shop_id']])) {
					$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
				} else {
					$itm_group[$itm['Item']['shop_id']] = 1;
				}
			}
			
			$this->loadModel('Tempaddresses');
			$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userId)));
			$this->set("usershipping", $usershipping);
			//$usershippingdefault = $this->User->findByid($userId);
			foreach ($usershipping as $ship) {
				if ($ship['Tempaddresses']['shippingid'] == $currentship) {
					$getcountrycode = $ship['Tempaddresses']['countrycode'];
				}
			}
			//$usershippingdefault = $usershippingdefault['User']['defaultshipping'];
			if(isset($couponId)){
				$getcouponvalue = $this->Coupon->findById($couponId);
				$this->set('getcouponvalue',$getcouponvalue);
			}
			$this->set('total_itms',$total_itms);
			$this->set('itm_datas',$itm_datas);
			$this->set('cntry_datas',$cntry_datas);
			$this->set('shipping_method_id',$getcountrycode);
			$this->set('itm_group',$itm_group);
			$this->set('userid',$userId);
			$this->set("usershippingdefault", $currentship);
			
				
			$this->loadModel('Commission');
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			$this->set('commiDetails',$commiDetails);
			
			
			$available_bal = $this->User->findById($userId);
			$this->set('available_bal',$available_bal['User']['credit_total']);
			}
		}
		
		
		function delete_giftcart_item () {
			$this->loadModel('Giftcard');
			$giftcartid = $_REQUEST['giftcartid'];
			$prefix = $this->Giftcard->tablePrefix;
			
			$this->Giftcard->query("delete from ".$prefix."giftcards where id=".$giftcartid." ");
				
			echo 1;
			die;
		}
		
		function entercouponvalue () {
			$shipping = $_POST['shippingid'];
			$coupon_id = $_POST['coupon_id'];
			$shopId = $_POST['shopid'];
			$this->loadModel('Tempaddresses');
			$this->loadModel('Coupon');
			$this->layout = 'ajax';
			global $loguser;
			$userId = $loguser[0]['User']['id'];
		
			$this->loadModel('Country');
			$prefix = $this->Item->tablePrefix;
			//$itemsId = $this->Item->query("select id from ".$prefix."items where shop_id = ".$shopId);
			//foreach ($itemsId as $item){
				//$itmid[] = $item[$prefix.'items']['id'];
			//}
			//$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'item_id'=>$itmid,'payment_status'=>'progress')));
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
				}
				$this->set('quantity',$quantity);
					
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
		
					
				$cntry_datas = $this->Country->find('all');
					
				foreach($itm_datas as $itm) {
					if(isset($itm_group[$itm['Item']['shop_id']])) {
						$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
					} else {
						$itm_group[$itm['Item']['shop_id']] = 1;
					}
				}
					
				$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userId)));
				$this->set("usershipping", $usershipping);
				//$usershippingdefault = $this->User->findByid($userId);
				foreach ($usershipping as $ship) {
					if ($ship['Tempaddresses']['shippingid'] == $shipping) {
						$getcountrycode = $ship['Tempaddresses']['countrycode'];
					}
				} 
				$usershippingdefault = $shipping;
				$total_itms = $this->Cart->find('count',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
				
				
				
				$getcouponvalue = $this->Coupon->findById($coupon_id);
				
				
				//echo "<pre>";print_r($getcouponvalue);
				
					
				$this->loadModel('Commission');
				$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
				$this->set('commiDetails',$commiDetails);
				
				$available_bal = $this->User->findById($userId);
				$this->set('available_bal',$available_bal['User']['credit_total']);
				
				$this->set('getcouponvalue',$getcouponvalue);
				$this->set('total_itms',$total_itms);
				$this->set('itm_datas',$itm_datas);
				$this->set('cntry_datas',$cntry_datas);
				$this->set('shipping_method_id',$getcountrycode);
				$this->set('itm_group',$itm_group);
				$this->set('userid',$userId);
				$this->set("usershippingdefault", $usershippingdefault);
				$this->render('delete_cart_item');
			}
		}
		
		
		
		
		
		
		function custupdate ($statuscust = null) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Orders');
			$getvalue = explode("~", $statuscust);
			$email = base64_decode($getvalue[0]);
			$orderid = base64_decode($getvalue[1]);
			
			$ordersdetails = $this->Orders->findByOrderid($orderid);
			$orders_status = $ordersdetails['Orders']['status'];
			if($orders_status=='Shipped' || $orders_status==''){
				$this->Orders->updateAll(array('status' => "'Delivered'",'status_date' => time()), array('orderid' => $orderid));
				$this->Session->setFlash('Item delivered status added sucessfully');
				$this->redirect('/mobile/');
			}else{
				$this->Session->setFlash('Item already delivered status added sucessfully');
				$this->redirect('/mobile/');
			}
		}
		
		function custupdatend ($statuscust = null) {
		$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Orders');
			$getvalue = explode("~", $statuscust);
			$email = base64_decode($getvalue[0]);
			$orderid = base64_decode($getvalue[1]);
			
			$ordersdetails = $this->Orders->findByOrderid($orderid);
			$orders_status_date = $ordersdetails['Orders']['status_date'];
			
			$d_and_t_diff = $this->Urlfriendly->date_diff(date('m/d/Y',$orders_status_date),time());
			
			
			if($d_and_t_diff['days'] >=5){
				$this->Orders->updateAll(array('status' => "'Not-Delivered'",'status_date' => time()), array('orderid' => $orderid));
				$this->Session->setFlash('Item Not delivered status added sucessfully');
				$this->redirect('/mobile/');
			}else{
				$this->Session->setFlash('This link will activate few more days later');
				$this->redirect('/mobile/');
					
			}
			
		}
		
		
		function merupdate ($statuscust = null) {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Orders');
			$getvalue = explode("~", $statuscust);
			$email = base64_decode($getvalue[0]);
			$orderid = base64_decode($getvalue[1]);

			
			$ordersdetails = $this->Orders->findByOrderid($orderid);
			$orders_status = $ordersdetails['Orders']['status'];
			if(empty($orders_status)){
				$this->Orders->updateAll(array('status' => "'Shipped'",'status_date' => time()), array('orderid' => $orderid));
				$this->Session->setFlash('Item shipment status added successfully ');
				$this->redirect('/mobile/');
			}
			$this->Session->setFlash('Item Already shipped status added');
			$this->redirect('/mobile/');
			
		}
			
		public function checkcouponcode ($id = NULL) {
			$this->loadModel('Coupon');	
			
			$code = $_GET['coupon_value'];
			$userId = $_GET['userid'];
			$getcouponval = $this->Coupon->findByCouponcode($code);
			//echo "<pre>";print_r($getcouponval);die;
			if(!empty($getcouponval)){
				$last_date = $getcouponval['Coupon']['validtodate'];
				$range = $getcouponval['Coupon']['validrange'];
				$coupontype = $getcouponval['Coupon']['coupontype'];
				$couponid = $getcouponval['Coupon']['id'];
				$discount_amount = $getcouponval['Coupon']['discount_amount'];
				$select_merchant = $getcouponval['Coupon']['select_merchant'];
				$today_date = time();
				$today_date = (is_string($today_date) ? strtotime($today_date) : $today_date);
				$last_date = (is_string($last_date) ? strtotime($last_date) : $last_date);
	
			//$difff = $this->Urlfriendly->date_diff($today_date,$last_date);
			if($last_date > $today_date && $range>=1){
				$merchant_ides = json_decode($getcouponval['Coupon']['merchant_ids']);
				//echo "<pre>";print_r($merchant_ides);die;
				if(in_array($userId, $merchant_ides) || ($select_merchant==0)){
					echo "validmerchant $couponid";die;
				}else{
				echo "Not valid merchant";die;
				}
				}else{
				echo "Expired";die;
				}
			}else{
			echo '0';die;
			}
						
		
		}
		
		
		
		
		public function checkoutgiftcard () {
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Giftcard');
				
			$giftcardchkid = $_POST['giftcardchkid'];
			//echo $giftcardchkid;die;
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
				
			$giftcartDetail = $this->Giftcard->findByid($giftcardchkid);
			
			//echo "<pre>";print_r($giftcartDetail);die;
			
			$amount = $giftcartDetail['Giftcard']['amount'];
			$giftcardId = $giftcartDetail['Giftcard']['id'];
			$reciptent_name = $giftcartDetail['Giftcard']['reciptent_name'];
			$useremail = $giftcartDetail['Giftcard']['reciptent_email'];
			
			$this->set('useremail',$useremail);
			$this->set('reciptent_name',$reciptent_name);
			$this->set('giftcardId',$giftcardId);
			$this->set('amount',$amount);
				
			$this->render('giftcardcheckout');
		
		
		}
		
		
		
		function giftcardipnIpn () {
			$this->autoLayout = false;
			$this->autoRender = false;
			global $setngs;
			global $loguser;
			$this->loadModel('Giftcard');
			$this->loadModel('User');
		
			$postFields = 'cmd=_notify-validate';
			//$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			//$url = 'https://www.paypal.com/cgi-bin/webscr';
			if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
				$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
				$url = 'https://www.paypal.com/cgi-bin/webscr';
			}
			foreach($_POST as $key => $value)
			{
				$postFields .= "&$key=".urlencode($value);
				$keyarray[urldecode($key)] = urldecode($value);
			}
			
			$ch = curl_init();
				
			curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postFields
			));
				
			$result = curl_exec($ch);
			curl_close($ch);
			
			if ($result == 'VERIFIED' && $keyarray['payment_status'] == 'Completed' ) {
			
				$custom = $keyarray['custom'];
				$giftdet = $this->Giftcard->findById($custom);
				$current_user_id = $giftdet['Giftcard']['user_id'];
				$userModl = $this->User->findById($current_user_id);
				$current_user_email = $userModl['User']['email'];
				
				$giftcardId = $giftdet['Giftcard']['id'];
				$gfName = $giftdet['Giftcard']['reciptent_name'];
				$gcEmail = $giftdet['Giftcard']['reciptent_email'];
				$gcmessage = $giftdet['Giftcard']['message'];
				$gcamount = $giftdet['Giftcard']['amount'];
				$gcstatus = $giftdet['Giftcard']['status'];
				$uniquecode = $this->Urlfriendly->get_uniquecode(8);
				
				$this->Giftcard->updateAll(array('Giftcard.status' =>"'Paid'",'Giftcard.giftcard_key' =>"'$uniquecode'"), array('Giftcard.id' => $custom));
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $gcEmail;
				$this->Email->subject = "Giftcard";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'giftcardemail';
				$this->set('recvuser',$gfName);
				$this->set('sentuser',$userModl['User']['username']);
				$this->set('loguser',$loguser);
				$this->set('gcmessage',$gcmessage);
				$this->set('uniquecode',$uniquecode);
				$this->set('itemname',"Giftcard");
				$this->set('tot_quantity','1');
				$this->set('access_url',$_SESSION['site_url'].'mobile/signup?referrer='.$userModl['User']['username_url']);
				$this->Email->send();
			}
			
		}
		
		
		public function checkgiftcardcode () {
			$this->loadModel('Giftcard');
			global $loguser;
			$curr_email = $loguser[0]['User']['email'];
			$code = $_GET['gfcode_value'];
		
			$getgfcardval = $this->Giftcard->findByGiftcard_key($code);
			//echo "<pre>";print_r($getcouponval);die;
			if(!empty($getgfcardval)){
				$recEmail = $getgfcardval['Giftcard']['reciptent_email'];
				$gfcardId = $getgfcardval['Giftcard']['id'];
				if($recEmail==$curr_email){
					echo "Valid $gfcardId";die;
				}else{
				echo '0';die;
				}
		
				}else{
				echo '0';die;
				}
		
		
				}
		
		
		
		function entergfcardvalue () {
			$shipping = $_POST['shippingid'];
			$giftcardId = $_POST['gfcardId'];
			$shopId = $_POST['shopid'];
			$this->loadModel('Tempaddresses');
			$this->loadModel('Giftcard');
			$this->layout = 'ajax';
			global $loguser;
			$userId = $loguser[0]['User']['id'];
	
			$this->loadModel('Country');
			$prefix = $this->Item->tablePrefix;
			/* $itemsId = $this->Item->query("select id from ".$prefix."items where shop_id = ".$shopId);
			foreach ($itemsId as $item){
			$itmid[] = $item[$prefix.'items']['id'];
			} */
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));
			if(!empty($carts)){
					foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
					}
					$this->set('quantity',$quantity);

							$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));


							$cntry_datas = $this->Country->find('all');

					foreach($itm_datas as $itm) {
					if(isset($itm_group[$itm['Item']['shop_id']])) {
						$itm_group[$itm['Item']['shop_id']] = $itm_group[$itm['Item']['shop_id']] + 1;
						} else {
						$itm_group[$itm['Item']['shop_id']] = 1;
					}
					}
						
					$usershipping = $this->Tempaddresses->find('all',array('conditions'=>array('userid'=>$userId)));
					$this->set("usershipping", $usershipping);
					//$usershippingdefault = $this->User->findByid($userId);
					foreach ($usershipping as $ship) {
					if ($ship['Tempaddresses']['shippingid'] == $shipping) {
					$getcountrycode = $ship['Tempaddresses']['countrycode'];
					}
					}
				$usershippingdefault = $shipping;
				$total_itms = $this->Cart->find('count',array('conditions'=>array('user_id'=>$userId,'payment_status'=>'progress')));



				$getgiftcardValue = $this->Giftcard->findById($giftcardId);


				//echo "<pre>";print_r($getcouponvalue);
				
					
				$this->loadModel('Commission');
				$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
				$this->set('commiDetails',$commiDetails);
				
				$available_bal = $this->User->findById($userId);
				$this->set('available_bal',$available_bal['User']['credit_total']);

				$this->set('getgiftcardValue',$getgiftcardValue);
				$this->set('total_itms',$total_itms);
				$this->set('itm_datas',$itm_datas);
				$this->set('cntry_datas',$cntry_datas);
				$this->set('shipping_method_id',$getcountrycode);
				$this->set('itm_group',$itm_group);
				$this->set('userid',$userId);
				$this->set("usershippingdefault", $usershippingdefault);
				$this->render('delete_cart_item');
				}
		}
											
		
		function ggcheckout () {
			$this->autoLayout = false;
			$this->autoRender = false;
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Item');
			$this->loadModel('Groupgiftuserdetail');
		
			$itemIds = $_POST['itemId'];
			$ggid = $_POST['ggid'];
			$UserEntrAmt = $_POST['UserEntrAmt'];
		
			$item_datas = $this->Item->findById($itemIds);
			$Groupgiftuserdetail_datas = $this->Groupgiftuserdetail->findById($ggid);
		
			//echo "<pre>";print_r($Groupgiftuserdetail_datas);
			//echo "<pre>";print_r($item_datas);die;
			$this->set('item_datas',$item_datas);
			$this->set('UserEntrAmt',$UserEntrAmt);
			$this->set('Ggdatas',$Groupgiftuserdetail_datas);
			$this->set('UserId',$userid);
			$this->set('setngs',$setngs);
			$this->render('ggcheckout');
		
		}
		
		
		function ggipn () {
			$this->autoLayout = false;
			$this->autoRender = false;
			global $setngs;
			global $loguser;
			$this->loadModel('Groupgiftpayamt');
			$this->loadModel('Groupgiftuserdetail');
			$this->loadModel('Item');
			$this->loadModel('Country');
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
		
			$postFields = 'cmd=_notify-validate';
			if($setngs[0]['Sitesetting']['payment_type'] == 'sandbox'){
				$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}elseif($setngs[0]['Sitesetting']['payment_type'] == 'paypal'){
				$url = 'https://www.paypal.com/cgi-bin/webscr';
			}
			foreach($_POST as $key => $value)
			{
				$postFields .= "&$key=".urlencode($value);
				$keyarray[urldecode($key)] = urldecode($value);
			}
		
			$ch = curl_init();
		
			curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postFields
			));
		
			$result = curl_exec($ch);
			curl_close($ch);
		
			if ($result == 'VERIFIED' && $keyarray['payment_status'] == 'Completed' ) {
		
				$ggId = $keyarray['item_number1'];
				$currentUserId = $keyarray['custom'];
				$amount = $keyarray['mc_gross'];  
				
		
				$this->request->data['Groupgiftpayamt']['ggid'] = $ggId;
				$this->request->data['Groupgiftpayamt']['paiduser_id'] = $currentUserId;
				$this->request->data['Groupgiftpayamt']['amount'] = $amount;
				$this->request->data['Groupgiftpayamt']['cdate'] = time();
				$this->Groupgiftpayamt->save($this->request->data);
		
				$ggitemDetails = $this->Groupgiftuserdetail->findById($ggId);
				$balance_amt = $ggitemDetails['Groupgiftuserdetail']['balance_amt'];
				$itemId = $ggitemDetails['Groupgiftuserdetail']['item_id'];
				$ggcreateuserId = $ggitemDetails['Groupgiftuserdetail']['user_id'];
				$name = $ggitemDetails['Groupgiftuserdetail']['name'];
				$address1 = $ggitemDetails['Groupgiftuserdetail']['address1'];
				$address2 = $ggitemDetails['Groupgiftuserdetail']['address2'];
				$state = $ggitemDetails['Groupgiftuserdetail']['state'];
				$city = $ggitemDetails['Groupgiftuserdetail']['city'];
				$zipcode = $ggitemDetails['Groupgiftuserdetail']['zipcode'];
				$telephone = $ggitemDetails['Groupgiftuserdetail']['telephone'];
				$country = $ggitemDetails['Groupgiftuserdetail']['country'];
				$itemcost = $ggitemDetails['Groupgiftuserdetail']['itemcost'];
				$shipcost = $ggitemDetails['Groupgiftuserdetail']['shipcost'];
				if($shipcost == ''){
					$shipcost = 0;
				}else{
					$shipcost = $shipcost;					
				}
				
				$countryDetails = $this->Country->findById($country);
				$countryName = $countryDetails['Country']['country'];
				
				$item_datas = $this->Item->findById($itemId);
				$userDatass = $this->User->findById($ggcreateuserId);
				///echo "<pre>";print_r($userAddress);
				//echo "<pre>";print_r($userDatass);die;
				$shopEmailId = $item_datas['User']['email'];
				$itemName[] = $item_datas['Item']['item_title'];
				$usernameforsupp = $item_datas['User']['first_name'];
				
				$usernameforcust = $userDatass['User']['first_name'];
				$CrntUserEmailId = $userDatass['User']['email'];
				
				$tot_quantity[] = 1;
				
				
				$balance_amt = $balance_amt - $amount;
		
				$this->Groupgiftuserdetail->updateAll(array('Groupgiftuserdetail.balance_amt' =>"'$balance_amt'"), array('Groupgiftuserdetail.id' => $ggId));
		
				if($balance_amt <= 0 ){
					$this->Groupgiftuserdetail->updateAll(array('Groupgiftuserdetail.status' =>"'Completed'"), array('Groupgiftuserdetail.id' => $ggId));
					
					
					
					$this->request->data['Orders']['userid'] = $ggcreateuserId;
					$this->request->data['Orders']['totalcost'] = $amount;
					$this->request->data['Orders']['orderdate'] = time();
					$this->request->data['Orders']['shippingaddress'] = '0';
					$this->request->data['Orders']['coupon_id'] = '0';
					$this->request->data['Orders']['discount_amount'] = '0';					
					$this->Orders->save($this->request->data);
					
					$orderId = $this->Orders->getLastInsertID();
					
						$this->request->data['Order_items']['orderid'] = $orderId;
						$this->request->data['Order_items']['itemid'] = $itemId;
						$this->request->data['Order_items']['itemname'] = $itemName[0];
						
						$this->request->data['Order_items']['itemprice'] = $itemcost;
						$this->request->data['Order_items']['itemquantity'] = '1';
						$this->request->data['Order_items']['itemunitprice'] = $itemcost;
						$this->request->data['Order_items']['shippingprice'] = $shipcost;
						$this->request->data['Order_items']['item_size'] = '';
						$this->Order_items->save($this->request->data);
							
							
						$itemModel = $this->Item->findByid($itemId);
						$quantityItem = $itemModel['Item']['quantity'];
						$user_id = $itemModel['Item']['user_id'];
						$this->request->data['Item']['id'] = $itemId;
						$this->request->data['Item']['quantity'] = $quantityItem - 1;
						$this->Item->save($this->request->data);
					
					$this->Orders->updateAll(array('merchant_id' => $user_id), array('orderid' => $orderId));
					
					$invoiceId = $this->Invoices->find('first',array('order'=>array('invoiceid'=>'desc')));//getLastInsertID()+1;
					$invoiceId = $invoiceId['Invoices']['invoiceid'] + 1;
					$this->request->data['Invoices']['invoiceno'] = 'INV'.$invoiceId.$ggcreateuserId;
					$this->request->data['Invoices']['invoicedate'] = time();
					$this->request->data['Invoices']['invoicestatus'] = $keyarray['payment_status'];
					$this->request->data['Invoices']['paymentmethod'] = 'Paypal';
					$this->Invoices->save($this->request->data);
					$invoiceId = $this->Invoices->getLastInsertID();
					$this->request->data['Invoiceorders']['invoiceid'] = $invoiceId;
					$this->request->data['Invoiceorders']['orderid'] = $orderId;
					$this->Invoiceorders->save($this->request->data);
					
					
					if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
						$this->Email->smtpOptions = array(
							'port' => $setngs[0]['Sitesetting']['smtp_port'],
							'timeout' => '30',
							'host' => 'ssl://smtp.gmail.com',
							'username' => $setngs[0]['Sitesetting']['noreply_email'],
							'password' => $setngs[0]['Sitesetting']['noreply_password']);
				
						$this->Email->delivery = 'smtp';
					}
					//$this->Email->to = 'saravana235@gmail.com';
					$this->Email->to = $CrntUserEmailId;
					$this->Email->subject = "Group Gift Notification";
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'ggcust';
					//$this->Email->template = 'ipnmail_cust';
					$this->set('custom',$usernameforcust);
					$this->set('loguser',$loguser);
					$this->set('itemname',$itemName);
					$this->set('tot_quantity',$tot_quantity);
					$emailidcust = base64_encode($CrntUserEmailId);
					$orderIdcust = base64_encode($orderId);
					$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
					$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust);
					$this->Email->send();
					
					
					$userDET = $this->Groupgiftpayamt->find('all',array('conditions'=>array('Groupgiftpayamt.ggid'=>$ggId)));
									 
					foreach($userDET as $userss){
						$emailss[] = $userss['User']['email'];
						$usernamess[] = $userss['User']['username'];
					}
					foreach($emailss as $keyy=>$emailss1){
						if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
							$this->Email->smtpOptions = array(
								'port' => $setngs[0]['Sitesetting']['smtp_port'],
								'timeout' => '30',
								'host' => 'ssl://smtp.gmail.com',
								'username' => $setngs[0]['Sitesetting']['noreply_email'],
								'password' => $setngs[0]['Sitesetting']['noreply_password']);
					
							$this->Email->delivery = 'smtp';
						}
						$this->Email->to = $emailss1;
						$this->Email->subject = "Group Gift Notification";
						$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
						$this->Email->sendAs = "html";
						$this->Email->template = 'ggcontribute';
						//$this->Email->template = 'ipnmail_cust';
						$this->set('custom',$usernamess[$keyy]);
						$this->set('loguser',$loguser);
						$this->set('itemname',$itemName);
						$this->set('tot_quantity',$tot_quantity);
						$emailidcust = base64_encode($CrntUserEmailId);
						$orderIdcust = base64_encode($orderId);
						$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
						$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust);
						$this->Email->send();
						
					}
					
					
					if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
						$this->Email->smtpOptions = array(
							'port' => $setngs[0]['Sitesetting']['smtp_port'],
							'timeout' => '30',
							'host' => 'ssl://smtp.gmail.com',
							'username' => $setngs[0]['Sitesetting']['noreply_email'],
							'password' => $setngs[0]['Sitesetting']['noreply_password']);
				
						$this->Email->delivery = 'smtp';
					}
					$this->Email->to = $shopEmailId;
					//$this->Email->to = 'saravananm@hitasoft.com';
					$this->Email->subject = "Order notification";
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'ggsupp';
					//$this->Email->template = 'ipnmail_supp';
					$this->set('custom',$usernameforsupp);
					$this->set('loguser',$loguser);
					$this->set('itemname',$itemName);
					$this->set('tot_quantity',$tot_quantity);
					$this->set('name',$name);
					$this->set('address1',$address1);
					$this->set('address2',$address2);
					$this->set('state',$state);
					$this->set('city',$city);
					$this->set('countryName',$countryName);
					$this->set('zipcode',$zipcode);
					$this->set('telephone',$telephone);
					$emailidsell = base64_encode($shopEmailId);
					$orderIdmer = base64_encode($orderId);
					$this->set('access_url',$_SESSION['site_url']."merupdate/".$emailidsell."~".$orderIdmer);
					$this->Email->send(); 
				
				}
			}
		
		}
		
		function cartmousehover(){	
			$this->layout = 'ajax';
			//$this->autoRender = false;
			$this->loadModel('Cart');
			$this->loadModel('Giftcard');
			$this->loadModel('Item');
			global $loguser;
			global $setngs;			
			$userid = $loguser[0]['User']['id'];
			$gifttot = 0;$itmtot = 0;$total_itms = 0;
			$giftcarduseradded = $this->Giftcard->find('all',array('conditions'=>array('Giftcard.user_id'=>$userid,'Giftcard.status'=>'Pending'),'limit'=>'2','order'=>'Giftcard.id DESC'));
			$gifttot = count($giftcarduseradded);
			//echo "<pre>"; print_r($giftcarduseradded);
			if(!empty($userid)){
				$cartModel = $this->Cart->getTopCart($userid);
				$total_itms = $this->Cart->totitms($userid);
				//echo "<pre>";print_r($total_itms);die;
				if ($total_itms > 0){
					foreach ($cartModel as $cart){
						$cartIds[] = $cart['Cart']['item_id'];
						$cartQuantity[$cart['Cart']['item_id']] = $cart['Cart']['quantity'];
					}
					$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$cartIds)));
					$key = 0;
					foreach ($itemModel as $item){
						$cartitem[$key]['image'] = $item['Photo']['0']['image_name'];
						$cartitem[$key]['quantity'] = $cartQuantity[$item['Item']['id']];
						$cartitem[$key]['title'] = $item['Item']['item_title'];
						$cartitem[$key]['price'] = $item['Item']['price'] * $cartQuantity[$item['Item']['id']];
						$cartitem[$key]['titleurl'] = $item['Item']['item_title_url'];
						$cartitem[$key]['itemid'] = $item['Item']['id'];
						$key += 1;
					}
			
					$this->set('cartModel',$cartitem);
					//$this->set('total_itms',$total_itms);
				}
			}
			
			/* Giftcard Details */
			if(!empty($giftcarduseradded)){
				$giftcarditemDetails = json_decode($setngs[0]['Sitesetting']['giftcard'],true);
				//echo "<pre>";print_r($giftcarduseradded);die;
				$this->set('giftcarditemDetails',$giftcarditemDetails);
				$this->set('giftcarduseradded',$giftcarduseradded);
				$this->set('countgiftcarduseradded',count($giftcarduseradded));
					
			
			}
			/* Giftcard Details */
			
			$itmtot = $gifttot + $total_itms;
			$this->set('total_itms',$itmtot);
		}
		
		
		 
		
		function gfcrdcheckout () {			
			$this->autoLayout = false;
			$this->autoRender = false;
			global $setngs;
			$siteChanges = $setngs[0]['Sitesetting']['site_changes'];
			$siteChanges = json_decode($siteChanges,true);
			$creditAmtByAdmin = $siteChanges['credit_amount'];			
			//$siteChanges['credit_amount'];
			//$shpngid = $_SESSION['shpngid'];
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Cart');
			$this->loadModel('Item');
			$this->loadModel('Coupon');
			$this->loadModel('Logcoupon');
			$this->loadModel('User');
			$this->loadModel('Tempaddresses');
			$this->loadModel('Userinvitecredit');
			$this->loadModel('Giftcard');
			
			
			$itemIds = $_POST['item_id'];
			$shippingid = $_POST['shippingid'];
			$shipamt = $_POST['shipamt'];
			$giftCardId = $_POST['giftCardId'];
			
			$itemIds = str_replace("'","\"",$itemIds);
			$itemIds = json_decode($itemIds,true);
			$usershipping_addr = $this->Tempaddresses->findByShippingid($shippingid);
				
			$shpngid = $usershipping_addr['Tempaddresses']['countrycode'];
			//echo "<pre>";print_r($usershipping_addr);die;
			$shipamt = str_replace("'","\"",$shipamt);
			$shipamt = json_decode($shipamt,true);	

			$userModel = $this->User->findById($userid);				
			$carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'payment_status'=>'progress','item_id'=>$itemIds)));
			
			if(!empty($carts)){
				foreach($carts as $crt){
					$itmids[] = $crt['Cart']['item_id'];
					$quantity[$crt['Cart']['item_id']] = $crt['Cart']['quantity'];
				}
				$itm_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmids)));
			}
			
			$totPric = 0;
			$totPricfull = 0;
		 foreach($itm_datas as $key => $itm){
		 		//echo "<pre>";print_r($itm);die;
		 	$price = round($itm['Item']['price'] * $_SESSION['currency_value'], 2);
			$qquantity = $quantity[$itm['Item']['id']];
			$totPric = $qquantity*$price;
			$totPric = $totPric + $shipamt[$key];
			$totPricfull += $totPric;
				
	     }
	     $totPricfull = round($totPricfull, 2);

	    // echo "<pre>";print_r($itemUsers);
		$itemgroupuserModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemIds)));
		$prevUserId = 0;$mercount = 0;$meritemcount = 0;
		foreach ($itemgroupuserModel as $itemModel){
			
			if ($prevUserId != $itemModel['Item']['user_id']) {
				$prevUserId = $itemModel['Item']['user_id'];
				$itemUsers[$mercount]['userid'] = $prevUserId;
				$prevcount = $mercount;
				$mercount ++;$meritemcount = 0;
			}
		$itemUsers[$prevcount]['items'][$meritemcount]['itemid'] = $itemModel['Item']['id'];
		$meritemcount ++;
		}
			//die;	
				
		$coupon_id = 0 ;
						
		$getiftcardvalue = $this->Giftcard->findById($giftCardId);
		$avaiilAmt = $getiftcardvalue['Giftcard']['avail_amount'] * $_SESSION['currency_value'];
		$balanceAmnt = $avaiilAmt - $totPricfull;
		$balanceAmnt = round(($balanceAmnt / $_SESSION['currency_value']), 2);
		
		$this->Giftcard->updateAll(array('Giftcard.avail_amount' => "'$balanceAmnt'"), array('Giftcard.id' => $giftCardId));
		
		//echo "<pre>";print_r($itemUsers);die;
		
		$usernameforcust = $userModel['User']['first_name'];
		foreach ($itemUsers as $keys=>$itemUser) {
			$orderComission = 0;
			$totalcost = 0;
			$this->Orders->create();
			$this->request->data['Orders']['userid'] = $userid;
			$this->request->data['Orders']['totalcost'] = 0;
			$this->request->data['Orders']['merchant_id'] = $itemUser['userid'];
			$this->request->data['Orders']['orderdate'] = time();
			$this->request->data['Orders']['shippingaddress'] = $shippingid;
			$this->request->data['Orders']['coupon_id'] = $coupon_id;
			$this->request->data['Orders']['currency'] = $_SESSION['currency_code'];
			/* Credit amount added to Order table*/
			if($giftCardId!=0){
				$this->request->data['Orders']['discount_amount'] = $totPricfull;
			}
			/* Credit amount added to Order table*/
			$this->Orders->save($this->request->data);
			
			$orderId = $this->Orders->getLastInsertID();
			for ($j = 0;$j < count($itemUser['items']);$j++) {
				
				$prossItemId = $itemUser['items'][$j]['itemid'];
				
				$itemDDets = $this->Item->findById($prossItemId);
				
				foreach($itemDDets['Shiping'] as $shpng){
					$shpngs[$shpng['country_id']] = $shpng['primary_cost'];
				}
				
				if (isset($shpngs[$shpngid])) {
					$shipping_amt[$itemDDets['Item']['id']] = round($shpngs[$shpngid] * $_SESSION['currency_value'], 2);
				}else if(isset($shpngs[0])){
					$shipping_amt[$itemDDets['Item']['id']] = round($shpngs[0] * $_SESSION['currency_value'], 2);
				}
				
				//echo "<pre>";print_r($shipping_amt);
				$i = $paypalno[$prossItemId];
				//$shipp = $keyarray['mc_shipping'.$i];
				//$itemPrice = $keyarray['mc_gross_'.$i] - $shipp;
				//$unitPrice = $itemPrice / $keyarray['quantity'.$i];
				
				$cartdats = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,'item_id'=>$prossItemId,'payment_status'=>'progress')));
				
				if ($cartdats[0]['Cart']['size_options'] != NULL) {
					$cartSize = $cartdats[0]['Cart']['size_options'];
				}else{
					$cartSize = '0';
				}
				
				$this->Order_items->create();
				$this->request->data['Order_items']['orderid'] = $orderId;
				$this->request->data['Order_items']['itemid'] = $prossItemId;
				$this->request->data['Order_items']['itemname'] = $itemDDets['Item']['item_title'];
				$itemPPrice = $quantity[$prossItemId] * ($itemDDets['Item']['price'] * $_SESSION['currency_value']);
				$itemPPrice = round($itemPPrice, 2);
				$this->request->data['Order_items']['itemprice'] = $itemPPrice;
				//$itemPPrice = $itemPPrice + $shipamt[$j];
				$totalcost = $itemPPrice + $shipping_amt[$itemDDets['Item']['id']];
				$this->request->data['Order_items']['itemquantity'] = $quantity[$prossItemId];
				$this->request->data['Order_items']['itemunitprice'] = round($itemDDets['Item']['price'] * $_SESSION['currency_value'], 2);
				$this->request->data['Order_items']['shippingprice'] = $shipping_amt[$itemDDets['Item']['id']];
				$this->request->data['Order_items']['item_size'] = $cartSize;
				
				$this->Order_items->save($this->request->data);
				
				$this->request->data['Cart']['id'] = $cartdats[0]['Cart']['id'];
				$this->request->data['Cart']['payment_status'] = 'success';
				$this->Cart->save($this->request->data);
				//echo $cartdats[0]['Cart']['id'];die;
				//$itemModel = $this->Item->findByid($keyarray['item_number'.$i]);
				$quantityItem = $itemDDets['Item']['quantity'];
				$user_id = $itemDDets['Item']['user_id'];
				$itemname[] = $itemDDets['Item']['item_title'];
				$itemmailids[] = $itemDDets['Item']['id'];
				$custmrsizeopt[] = $cartSize;
				$sellersizeopt[] = $cartSize;
				$selleritemmailids[] = $itemDDets['Item']['id'];
				$selleritemname[] = $itemDDets['Item']['item_title'];
				$itemopt = '';
				$itemopt = $itemDDets['Item']['size_options'];
				$totquantity[] = $quantity[$prossItemId];
				$sellertotquantity[] = $quantity[$prossItemId];
				$this->request->data['Item']['id'] = $prossItemId;
				$this->request->data['Item']['quantity'] = $quantityItem - $quantity[$prossItemId];
				$final = '';
				if(!empty($cartSize) && !empty($itemopt)){
					
					$explodedcoma = explode(',',$itemopt);
					foreach($explodedcoma as $k=>$exdecoma){
						if ($final != ''){
							$final .= ',';
						}
						$explodedequal = explode('=',$exdecoma);
						if($explodedequal[0] == $cartSize){
							//echo "   ".$llll;
							$reduced = $explodedequal[1] - $quantity[$prossItemId];
							$getVall = $cartSize."=".$reduced;
							//echo "<pre>";print_r($sss);
								
							$final .=$getVall;
								
						}else{
								
							$final .=$exdecoma;
						}
					}
				}
				
				if ($cartSize != '0'){
					$this->request->data['Item']['size_options'] = $final;
				}else{
					$this->request->data['Item']['size_options'] = '';
				}
				
				$this->Item->save($this->request->data);
				$final = '';
				$shpngs = '';
				
				$itemComission = 0;
				$itemUSD = round($itemPPrice / $_SESSION['currency_value'], 2);
				$this->loadModel('Commission');
				$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
				foreach($commiDetails as $commi){
					$min_val = $commi['Commission']['min_value'];
					$max_val =  $commi['Commission']['max_value'];
					if($itemUSD>=$min_val && $itemUSD<=$max_val){
						if($commi['Commission']['type'] == '%'){
							$amount = (floatval($itemUSD)/100)*$commi['Commission']['amount'];
							//$amount = $quantity[$itm['Item']['id']]*$amount;
							$itemComission +=$amount;
						}else{
							$amount = $commi['Commission']['amount'];
							$amount = $keyarray['quantity'.$i]*$amount;
							$itemComission +=$amount;
						}
					}
				}
				$itemComission = $itemComission * $_SESSION['currency_value'];
				$itemComission = round($itemComission, 2);
				$orderComission += $itemComission;
			}
			
								
			$this->Orders->updateAll(array('merchant_id' => $user_id, 'totalcost' => $totalcost, 
					'admin_commission' => $orderComission), array('orderid' => $orderId));
			
			$invoiceId = $this->Invoices->find('first',array('order'=>array('invoiceid'=>'desc')));//getLastInsertID()+1;
			$invoiceId = $invoiceId['Invoices']['invoiceid'] + 1;
			$this->Invoices->create();
			$this->request->data['Invoices']['invoiceno'] = 'INV'.$invoiceId.$userid;
			$this->request->data['Invoices']['invoicedate'] = time();
			$this->request->data['Invoices']['invoicestatus'] = 'Completed';
			$this->request->data['Invoices']['paymentmethod'] = 'Giftcard';
			$this->Invoices->save($this->request->data);
			$invoiceId = $this->Invoices->getLastInsertID();
			$this->Invoiceorders->create();
			$this->request->data['Invoiceorders']['invoiceid'] = $invoiceId;
			$this->request->data['Invoiceorders']['orderid'] = $orderId;
			$this->Invoiceorders->save($this->request->data);
			
			//echo $cartdats[0]['Cart']['id'];die;
			$userModelemail = $this->User->findById($user_id);
			
			if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
				$this->Email->smtpOptions = array(
					'port' => $setngs[0]['Sitesetting']['smtp_port'],
					'timeout' => '30',
					'host' => 'ssl://smtp.gmail.com',
					'username' => $setngs[0]['Sitesetting']['noreply_email'],
					'password' => $setngs[0]['Sitesetting']['noreply_password']);
		
				$this->Email->delivery = 'smtp';
			}
			$this->Email->to = $userModelemail['User']['email'];
			//$this->Email->to = 'saravananm@hitasoft.com';
			$this->Email->subject = "Order notification";
			$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
			$this->Email->sendAs = "html";
			$this->Email->template = 'ipnmail_supp';
			$this->set('custom',$userModelemail['User']['first_name']);
			$this->set('loguser',$loguser);
			$this->set('itemname',$selleritemname);
			$this->set('itemid',$selleritemmailids);
			$this->set('tot_quantity',$sellertotquantity);
			$this->set('sizeopt',$sellersizeopt);
			$this->set('usershipping_addr',$usershipping_addr);
			$emailidsell = base64_encode($userModelemail['User']['email']);
			$orderIdmer = base64_encode($orderId);
			$this->set('access_url',$_SESSION['site_url']."merupdate/".$emailidsell."~".$orderIdmer);
			//$this->Email->send();
			
			
		$shipping_amt = '';$selleritemname = '';$sellertotquantity = '';$selleritemmailids='';$sellersizeopt = '';
		}
		$emailaddrs = $userModel['User']['email'];
		if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
			$this->Email->smtpOptions = array(
				'port' => $setngs[0]['Sitesetting']['smtp_port'],
				'timeout' => '30',
				'host' => 'ssl://smtp.gmail.com',
				'username' => $setngs[0]['Sitesetting']['noreply_email'],
				'password' => $setngs[0]['Sitesetting']['noreply_password']);
	
			$this->Email->delivery = 'smtp';
		}
		//$this->Email->to = 'saravana235@gmail.com';
		$this->Email->to = $emailaddrs;
		$this->Email->subject = "Order notification";
		$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
		$this->Email->sendAs = "html";
		$this->Email->template = 'ipnmail_cust';
		$this->set('custom',$usernameforcust);
		$this->set('loguser',$loguser);
		$this->set('itemname',$itemname);
		$this->set('itemid',$itemmailids);
		$this->set('tot_quantity',$totquantity);
		$this->set('sizeopt',$custmrsizeopt);
		$emailidcust = base64_encode($emailaddrs);
		$orderIdcust = base64_encode($orderId);
		$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
		$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust);
		//$this->Email->send();


	}
		
	
		
}
