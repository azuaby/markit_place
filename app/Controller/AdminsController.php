<?php
	App::uses('AppController', 'Controller');
	
	class AdminsController extends AppController{
		public $names =  'Admins';
		public $uses = array('User');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','FileUpload','RequestHandler','ColorCompare','Ymlp','Export');
		public $helpers = array('Form','Html');
		public $layout = 'admin';
		
		function admin(){
			$this->set('title_for_layout','Dashboard');
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->loadModel('News');
			$this->loadModel('Item');
			$this->loadModel('Order');
			$this->loadModel('Shop');
			$this->loadModel('Payment');
			$this->loadModel('Cart');
			
		 	$tdy = date("Y-m-d");

		 	
		 	
			$tiswk_strt = date("Y-m-d",strtotime("this week last sunday"));
			$tiswk_end = date("Y-m-d",strtotime("this week next saturday"));
			
			$tismnth_strt = date("Y-m-d",strtotime('first day of this month'));
			$tismnth_end = date("Y-m-t",strtotime('this month'));
			
			$total_usrs = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god')));
			
			$enbleusrs = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god','user_status'=>'enable')));
			
			$disbleusrs = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god','user_status'=>'disable')));
			
			$tdyjned = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god','created_at'=>$tdy)));
			
			$week_usrs = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god','created_at >='=>$tiswk_strt,'created_at <='=>$tiswk_end)));
			
			$mnth_usrs = $this->User->find('count',array('conditions'=>array('user_level <>'=>'god','created_at >='=>$tismnth_strt,'created_at <='=>$tismnth_end)));
			
			$user_datas = $this->User->find('all',array('conditions'=>array('user_level <>'=>'god'),'limit'=>5,'order' => 'RAND()'));

			//$total_complete_payment = $this->Payment->find('count',array('conditions'=>array('payment_status'=>'Completed')));
			
			$prefix = $this->Order->tablePrefix;
			
			$disable_special_del = $this->Cart->find('count',array('conditions'=>array('Cart.shipping_status'=>'disable')));
			$this->set('disable_special_del',$disable_special_del);
			
			$disable_sellers = $this->Shop->find('count',array('conditions'=>array('Shop.seller_status'=>'0','Shop.paypal_id <>'=>'')));
			$this->set('disable_sellers',$disable_sellers);
			//echo "SELECT SUM(totalcost) as total FROM ".$prefix."orders as payment WHERE status = ' ' ;";
			
			$total_complete_payment = $this->Order->query("SELECT SUM(totalcost) as total FROM ".$prefix."orders as payment WHERE status = ' ' ;");
			
			$total_admin_commission = $this->Order->query("SELECT SUM(admin_commission) as total FROM ".$prefix."orders;");
			//echo $total_complete_payment[0][0]['total'];die;
			//echo "<pre>";print_r($total_complete_payment[0][0]['total']);die;
			
			
			//,array('limit'=>5,'order'=>array('id'=>'desc'))
			$user_datas_payment = $this->Order->find('all',array('limit'=>5,'order'=>array('orderid'=>'desc')));
			
		/* 	$user_datas_pay = $this->User->find('all',array('conditions'=>array('user_level <>'=>'god')));
			
			foreach($user_datas_pay as $userdetil){
				echo "<pre>";print_r($userdetil);
				
			}die; */
			
			//echo "<pre>";print_r($user_datas_payment);die;
			
			$todaystart = date('Y-m-d 00:00:00');
			$todayend = date('Y-m-d 24:00:00');
			$todaystartdate = strtotime($todaystart);
			$todayenddate = strtotime($todayend);
			
			$today_new_orders_count = $this->Order->find('count',array('conditions'=>array('Order.orderdate BETWEEN ? AND ?' =>array($todaystartdate,$todayenddate)),'OR'=>array('Order.status'=>'','Order.status'=>'Processing')));
			
			$today_delivered_orders_count = $this->Order->find('count',array('conditions'=>array('Order.status_date BETWEEN ? AND ?' =>array($todaystartdate,$todayenddate),'Order.status'=>'Delivered')));

			$this->set('today_new_orders_count',$today_new_orders_count);
			$this->set('today_delivered_orders_count',$today_delivered_orders_count);
			
			$total_items = $this->Item->find('count');
			
			$enbleitems = $this->Item->find('count',array('conditions'=>array('status'=>'publish')));
			
			$disbleitems = $this->Item->find('count',array('conditions'=>array('status'=>'draft')));
			
			//date('Y-m-d', strtotime('Item.created_on'));
			
			$tdyadded_items = $this->Item->find('count',array('conditions'=>array('Item.created_on'=>$tdy)));
			
			$week_items = $this->Item->find('count',array('conditions'=>array('Item.created_on >='=>$tiswk_strt,'Item.created_on <='=>$tiswk_end)));
			
			$mnth_items = $this->Item->find('count',array('conditions'=>array('Item.created_on >='=>$tismnth_strt,'Item.created_on <='=>$tismnth_end)));
			
			$newsdats = $this->News->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>2,'order'=>array('created_on'=>'desc')));
			
			$merchandize_value = $this->Item->find('all',array('conditions'=>array('status'=>'publish')));
			foreach($merchandize_value as $merchandize)
			{
				$total_merchandize_value += $merchandize['Item']['price'];
			}
			$this->set('total_merchandize_value',$total_merchandize_value);
			
			$this->set('total_usrs',$total_usrs);
			$this->set('enbleusrs',$enbleusrs);
			$this->set('disbleusrs',$disbleusrs);
			$this->set('tdyjned',$tdyjned);
			$this->set('week_usrs',$week_usrs);
			$this->set('mnth_usrs',$mnth_usrs);
			$this->set('newsdats',$newsdats);
			$this->set('user_datas',$user_datas);
			$this->set('user_datas_payment',$user_datas_payment);
			//$this->set('total_complete_payment',$total_complete_payment);
			
			$this->set('total_complete_payment',$total_complete_payment[0][0]['total']);
			$this->set('total_admin_commission',$total_admin_commission[0][0]['total']);
			$this->set('total_items',$total_items);
			$this->set('tdyadded_items',$tdyadded_items);
			$this->set('enableitems',$enbleitems);
			$this->set('disbleitems',$disbleitems);
			$this->set('week_items',$week_items);
			$this->set('mnth_items',$mnth_items);
			
			// echo "<pre>";print_r($tdyadded_items);die;
		}
		
		public function add_item() {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->set('title_for_layout','Add Item');
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];

			$this->loadModel('Color');
			$color_datas = $this->Color->find('all');
			$this->set('color_datas',$color_datas);		
			
			if (isset($this->request->data['Item'])){
				//echo $setngs[0]['Sitesetting']['paypal_id'];
				//echo "<pre>";print_r($this->request->data);die;
				$this->loadModel('Shop');
				$this->loadModel('Item');
				for($i=0;$i<1;$i++){
					if(!empty($this->request->data['image'][$i])){
						$imgName = $_SESSION['media_url'].'media/items/original/'.$this->request->data['image'][$i];
						$result = ColorCompareComponent::compare(5, $imgName);
					}
				}
			//echo "<pre>";print_r($result);die;
			
			$shpcnt = $this->Shop->find('all',array('conditions'=>array('user_id'=>$userid)));
			if(!empty($shpcnt)){
				$shop_id = $shpcnt[0]['Shop']['id'];
			}else{
				$this->request->data['Shop']['user_id'] = $userid;
				$this->request->data['Shop']['paypal_id'] = $setngs[0]['Sitesetting']['paypal_id'];
				$this->Shop->save($this->request->data);
				$shop_id = $this->Shop->getLastInsertID();
			}	
			
			$this->request->data['Item']['user_id'] = $userid;
			$this->request->data['Item']['shop_id'] = $shop_id;
			$title = $this->request->data['Item']['item_title'] = $this->request->data['Item']['item_title'];
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $this->request->data['Item']['item_description'];
			$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
			
			if(!empty($this->request->data['recipient'])){
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}else{
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}
			
			$this->request->data['Item']['videourrl'] = $this->request->data['Item']['item_video'];
			$this->request->data['Item']['price'] = $this->request->data['listing']['price'];
			$this->request->data['Item']['quantity'] = $this->request->data['listing']['quantity'];
			//$this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$sizeOption = $this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$sizeQty = 0;
			if ($sizeOption != ''){
				$sizeOption = explode(",",$sizeOption);
				foreach ($sizeOption as $size){
					$singleSize = explode("=", $size);
					$sizeQty += $singleSize[1];
				}
				$this->request->data['Item']['quantity'] = $sizeQty;
			}
			$this->request->data['Item']['category_id'] = $this->request->data['Item']['category_id'];
			$this->request->data['Item']['super_catid'] = $this->request->data['\'Item\'']['\'supersubcat\''];
			$this->request->data['Item']['sub_catid'] = $this->request->data['\'Item\'']['\'subcat\''];
			$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
			$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
			if($processing_time_id == 'custom'){
				$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
				$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
				$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
			}	

			$color_method = $this->request->data['colormethod'];
			if($color_method=="auto")
			{
				$result = json_encode($result);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '0';
			}
			else
			{
				$result = json_encode($this->request->data['itemcolor']);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '1';
			}	

			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");			
			$this->request->data['Item']['status'] = 'publish';			
			//$this->request->data['Item']['item_color'] = json_encode($result);
			
			//echo "<pre>";print_r($this->request->data['Item']);die;
			
			$this->Item->save($this->request->data);
			
			$last_id = $this->Item->getLastInsertID();
			
			$this->loadModel('Photo');
			$this->loadModel('Shiping');
			for($i=0;$i<5;$i++){
				$this->Photo->create();
				// echo $this->request->data['image'][$i];
				if(!empty($this->request->data['image'][$i])){
					$this->request->data['Photo']['item_id'] = $last_id;
					$this->request->data['Photo']['image_name'] = $this->request->data['image'][$i];
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					// echo "<pre>";print_r($this->request->data['Photo']);die;
					$this->Photo->save($this->request->data);
				}
			}	
			// die;
			if(!empty($_REQUEST['country_shipping'])){
				foreach($_REQUEST['country_shipping'] as $kys=>$shpngcntry){
					// echo "<pre>";print_r($kys);
					// echo "<pre>";print_r($shpngcntry);
					foreach($shpngcntry as $shps){
						$this->Shiping->create();
						
						$this->request->data['Shiping']['item_id'] = $last_id;
						$this->request->data['Shiping']['country_id'] = $kys;
						$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
						//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
						$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
						
						$this->Shiping->save($this->request->data);
					}	
				}
			}	
			if(!empty($_REQUEST['everywhere_shipping'])){
				$this->Shiping->create();
				
				$this->request->data['Shiping']['item_id'] = $last_id;
				$this->request->data['Shiping']['country_id'] = 0;
				$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
				//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
				$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
				
				$this->Shiping->save($this->request->data);
			}
			
			
				$this->redirect('/admin/manage/items');
			}
			
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Country');
			$this->loadModel('Recipient');
			$cat_datas = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			//$style_datas = $this->Style->find('all',array('order'=>array('style_name'=>'asc')));
			$country_datas = $this->Country->find('all',array('order'=>array('country'=>'asc')));
			$rcpnt_datas = $this->Recipient->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('recipient_name'=>'asc')));
			//$occsn_datas = $this->Occasion->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('occasion_name'=>'asc')));
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			// for localhostip address is not get correctly.  so am hard coded here 
			//$IPDetail = $this->countryCityFromIP($ip);
			//$IPDetail = $this->countryCityFromIP('117.242.24.21');
			//echo "<pre>";print_r($IPDetail);die;
			//$country =  $IPDetail['country']; //country of that IP address
			//$city =  $IPDetail['city']; //outputs the IP detail of the city
			//$cntry_code =  $IPDetail['country_code']; //outputs the IP detail of the country code
			$country =  'India';
			//$city =  'Chennai';
			$cntry_code = 'IN';
			foreach($country_datas as $cntry){
				$cntrynme[$cntry['Country']['code']] = $cntry['Country']['country'];
				$cntryid[$cntry['Country']['code']] = $cntry['Country']['id'];
			}
			// die;
			// echo "<pre>";print_R($cat_datas);die;
			
			
			$this->set('cat_datas',$cat_datas);
			//$this->set('style_datas',$style_datas);
			$this->set('country_datas',$country_datas);
			$this->set('cntry_code',$cntry_code);
			$this->set('country',$country);
			$this->set('cntrynme',$cntrynme);
			$this->set('cntryid',$cntryid);
			$this->set('rcpnt_datas',$rcpnt_datas);
		}
		
	function editItem($id){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->set('title_for_layout','Edit Item');
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Item');
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Country');
			$this->loadModel('Recipient');
			
			$this->loadModel('Color');
			$color_datas = $this->Color->find('all');
			$this->set('color_datas',$color_datas);			
			
			if (isset($this->request->data['Item'])){
				//echo "<pre>";print_r($this->request->data);//die;
				
				$itemModel = $this->Item->findByid($id);
				
				//print_r($itemModel);die;
				
				$this->request->data['Item']['id'] = $id;
				$this->loadModel('Shop');
				$this->loadModel('Item');
				for($i=0;$i<1;$i++){
					if(!empty($this->request->data['image'][$i])){
						$imgName = $_SESSION['media_url'].'media/items/original/'.$this->request->data['image'][$i];
						$result = ColorCompareComponent::compare(5, $imgName);
					}
				}
			
			$this->request->data['Item']['user_id'] = $itemModel['User']['id'];
			$this->request->data['Item']['shop_id'] = $itemModel['Shop']['id'];
			$title = $this->request->data['Item']['item_title'] = $this->request->data['Item']['item_title'];
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $this->request->data['Item']['item_description'];
			$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
			
			if(!empty($this->request->data['recipient'])){
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}else{
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}
			
			$this->request->data['Item']['videourrl'] = $this->request->data['Item']['item_video'];
			$this->request->data['Item']['price'] = $this->request->data['listing']['price'];
			$this->request->data['Item']['quantity'] = $this->request->data['listing']['quantity'];
			//$this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$sizeOption = $this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$sizeQty = 0;
			if ($sizeOption != ''){
				$sizeOption = explode(",",$sizeOption);
				foreach ($sizeOption as $size){
					$singleSize = explode("=", $size);
					$sizeQty += $singleSize[1];
				}
				$this->request->data['Item']['quantity'] = $sizeQty;
			}
			$this->request->data['Item']['category_id'] = $this->request->data['Item']['category_id'];
			$this->request->data['Item']['super_catid'] = $this->request->data['Item']['supersubcat'];
			$this->request->data['Item']['sub_catid'] = $this->request->data['Item']['subcat'];
			$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
			$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
			if($processing_time_id == 'custom'){
				$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
				$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
				$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
			}
			$color_method = $this->request->data['colormethod'];
			if($color_method=="auto")
			{
				$result = json_encode($result);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '0';
			}
			else
			{
				$result = json_encode($this->request->data['itemcolor']);
				$this->request->data['Item']['item_color'] = $result;
				$this->request->data['Item']['item_color_method'] = '1';
			}			
			
			$this->request->data['Item']['modified_on'] = date("Y-m-d H:i:s");			
			$this->request->data['Item']['status'] = 'publish';			
			//$this->request->data['Item']['item_color'] = json_encode($result);
			
			//echo "<pre>";print_r($this->request->data['Item']);die;
			
			$this->Item->save($this->request->data);
			
			$last_id = $id;
			
			$this->loadModel('Photo');
			$count = 0;
			foreach ($itemModel['Photo'] as $photo){
				if(!empty($this->request->data['image'][$count])){
					$imageName = $photo['image_name'];
					if ($imageName == $this->request->data['image'][$count]){
						$count += 1;
					}else {
						$this->request->data['Photo']['image_name'] = $this->request->data['image'][$count];
						$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
						$this->request->data['Photo']['id'] = $photo['id'];
						$this->Photo->save($this->request->data);
						$count += 1;
					}
				}elseif($this->request->data['image'][$count] == ""){
						$this->Photo->deleteAll(array('id' => $photo['id']), false);
						$count += 1;
				}
			}
			for($i=$count;$i<5;$i++){
				$this->Photo->create();
				// echo $this->request->data['image'][$i];
				if(!empty($this->request->data['image'][$i])){
					$this->request->data['Photo']['item_id'] = $last_id;
					$this->request->data['Photo']['image_name'] = $this->request->data['image'][$i];
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					// echo "<pre>";print_r($this->request->data['Photo']);die;
					$this->Photo->save($this->request->data);
				}
			}	
			
			
			$this->loadModel('Shiping');
			if(!empty($_REQUEST['country_shipping'])){
				foreach($_REQUEST['country_shipping'] as $kys=>$shpngcntry){
					// echo "<pre>";print_r($kys);
					// echo "<pre>";print_r($shpngcntry);
					foreach($shpngcntry as $shps){
						//echo "<pre>";print_r($shps);
						$shipModel = $this->Shiping->find('all',array('conditions'=>array('Shiping.country_id'=>$kys,'Shiping.item_id'=>$last_id)));
			
						$primaryCost = $shps['primary'];
						if (empty($shipModel) && $primaryCost != '') {
							$this->Shiping->create();
							$this->request->data['Shiping']['item_id'] = $last_id;
							$this->request->data['Shiping']['country_id'] = $kys;
							$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
							//$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
							$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
							$this->Shiping->save($this->request->data);
							$updatedCountryId[] = $kys;
						}elseif($shipModel[0]['Shiping']['country_id'] != 0 && $primaryCost != '') {
							if ($shps['primary'] != $shipModel[0]['Shiping']['primary_cost']){
								$this->request->data['Shiping']['id'] = $shipModel[0]['Shiping']['id'];
								$this->request->data['Shiping']['primary_cost'] = $shps['primary'];
								$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
								$this->Shiping->save($this->request->data);
							}
							$updatedCountryId[] = $kys;
						}
					}
				}
			}
				
			if(!empty($_REQUEST['everywhere_shipping'])){
				$primaryCost = $_REQUEST['everywhere_shipping'][1]['primary'];
				$shipModel = $this->Shiping->find('all',array('conditions'=>array('Shiping.country_id'=>'0','Shiping.item_id'=>$last_id)));
				//echo "<pre>";print_r($shipModel[0]);
				if(empty($shipModel) && $primaryCost != ''){
					$this->Shiping->create();
					$this->request->data['Shiping']['item_id'] = $last_id;
					$this->request->data['Shiping']['country_id'] = 0;
					$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
					//$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
					$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
						
					$this->Shiping->save($this->request->data);
					$updatedCountryId[] = 0;
				}else{
					//echo $primaryCost;die;
					$newCost = $_REQUEST['everywhere_shipping'][1]['primary'];
					$oldCost = $shipModel[0]['Shiping']['primary_cost'];
					if ($newCost != $oldCost && $primaryCost != ''){
						$this->request->data['Shiping']['id'] = $shipModel[0]['Shiping']['id'];
						$this->request->data['Shiping']['country_id'] = 0;
						$this->request->data['Shiping']['primary_cost'] = $newCost;
						$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
						$this->Shiping->save($this->request->data);
					}
					$updatedCountryId[] = 0;
				}
			}
				
			if (count($updatedCountryId) > 0){
				$shipModel = $this->Shiping->find('all',array(
						'conditions'=>array(
								'Shiping.item_id'=>$last_id,
								'NOT' => array(
										'Shiping.country_id' => $updatedCountryId
								)
						)
				));
			
				if(!empty($shipModel)){
					foreach($shipModel as $ship){
						$this->Shiping->deleteAll(array('id' => $ship['Shiping']['id']), false);
					}
				}
			}
				
			
				$this->redirect('/admin/manage/items');
			}
			
			$itemModel = $this->Item->findByid($id);
			$cat_datas = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			$superSub_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>$itemModel['Item']['category_id'],'category_sub_parent'=>0)));
			$Sub_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>$itemModel['Item']['category_id'],'category_sub_parent'=>$itemModel['Item']['super_catid'])));
			$rcpnt_datas = $this->Recipient->find('all',array('conditions'=>array('status'=>'enable'),'order'=>array('recipient_name'=>'asc')));
			
			foreach ($itemModel['Shiping'] as $ship){
				$shipingId[]  = $ship['country_id'];
				$cntryid = $ship['country_id'];
			}
			$countries = $this->Country->find('all');
			$CountryModel = $this->Country->find('all',array('conditions'=>array('id'=>$shipingId)));
			
			foreach($CountryModel as $country){
				$countryName[$country['Country']['id']] = $country['Country']['country'];
			}
			
			$this->set('item',$itemModel);
			$this->set('cat_datas',$cat_datas);
			$this->set('superSub_datas',$superSub_data);
			$this->set('Sub_datas',$Sub_data);
			$this->set('rcpnt_datas',$rcpnt_datas);
			$this->set('countryName',$countryName);
			$this->set('cntry',$countries);
			$this->set('cntryid',$cntryid);
			$this->set('itemId',$id);
		}
		
		function countryCityFromIP($ipAddr)
		{
			//function to find country and city from IP address
			//Developed by Roshan Bhattarai http://roshanbh.com.np
		
			//verify the IP address for the
			ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
			$ipDetail=array(); //initialize a blank array
		
			//get the XML result from hostip.info
				
			//echo $ip=$_SERVER['REMOTE_ADDR'];die;
				
			//http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=117.242.24.21
				
			//http://api.hostip.info/?ip=
				
			//echo "http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=".$ipAddr;
			$xml = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip=".$ipAddr);
		
			//get the city name inside the node <gml:name> and </gml:name>
				
			$extract_ip = $pieces = explode(";", $xml);
				
			//print_r($extract_ip);die;
				
				
			//preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);
		
			//assing the city name to the array
			//print_r($match);die;
				
			$ipDetail['city'] = $extract_ip['6'];
				
		
			//get the country name inside the node <countryName> and </countryName>
			//preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);
		
			//assign the country name to the $ipDetail array
			$ipDetail['country']=$extract_ip[4];
		
			//get the country name inside the node <countryName> and </countryName>
			//preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
			$ipDetail['country_code']=$extract_ip[3];
				
			//assing the country code to array
		
			//return the array containing city, country and country code
			return $ipDetail;
				
		
		}
		
		
		/* saravana pandian */
		
function delete_currency_admin ($Id = null) {
	//echo "hai"; die;
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Forexrate');
		
				$prefix = $this->Forexrate->tablePrefix;
				//echo $prefix; die;
				$this->Forexrate->query("DELETE FROM ".$prefix."forexrates WHERE id = $Id");
			//$this->Forexrate->deleteAll(array('Forexrate.id' => $Id), false);		
			
		}
		
		
	public function add_member(){
		if(!$this->isauthorized())
			$this->redirect('/');
	
		$this->set('title_for_layout','AddUser Management');
		global $setngs;
			
		if(!empty($this->request->data)){
			//echo "<pre>";print_r($this->request->data);die;
			$username =  $this->request->data['signup']['username'];
			$firstname = $this->request->data['signup']['firstname'];
			//$lastname = $this->request->data['signup']['lastname'];
			$email = $this->request->data['signup']['email'];
			$menulist = $this->request->data['signup']['menulist'];
			$password = $this->request->data['signup']['password'];
	
			$nmecounts = $this->User->find('count',array('conditions'=>array('username'=>$username)));
			$emlcounts = $this->User->find('count',array('conditions'=>array('email'=>$email)));
			// echo "<pre>";print_r($nmecounts);die;
			if($nmecounts > 0){
				$this->Session->setFlash("username already exists");
				$this->redirect($this->referer());
			}else if($emlcounts > 0){
				$this->Session->setFlash("Email already exists");
				$this->redirect($this->referer());
			}else{
				$name=$this->request->data['User']['username'] = $username;
				$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
				$this->request->data['User']['first_name'] = $firstname;
				//$this->request->data['User']['last_name'] = $lastname;
				$emailaddress = $this->request->data['User']['email'] = $this->request->data['signup']['email'];
				
				$this->request->data['User']['password'] = $this->Auth->password($password);
				if($this->request->data['usr_access']=='moderate')
				{
					$this->request->data['User']['user_level'] = 'god';
					if($this->request->data['signup']['menulist']=="")
					{
						$admin_menu_default = "Home";
						$admin_default = json_encode($admin_menu_default);
						$this->request->data['User']['admin_menus'] = $admin_default;
					}
					else
						$this->request->data['User']['admin_menus'] = $this->request->data['signup']['menulist'];
				}
				else
				$this->request->data['User']['user_level'] = $this->request->data['usr_access'];
				$this->request->data['User']['activation'] = '1';
				$this->request->data['User']['user_status'] = 'enable';
				$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
				$uniquecode = $this->Urlfriendly->get_uniquecode(8);
				$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
				$this->User->save($this->request->data);
				$userid = $this->User->getLastInsertID();
					
				$this->loadModel('Shop');
				$this->request->data['Shop']['user_id'] = $userid;
				$this->Shop->save($this->request->data);
									
				$this->Session->setFlash('Member was successfully created...');
				$this->redirect('/admin/user/management');
					
			}
			}else{
				$this->loadModel('Countries');
				$countries = $this->Countries->find('all');
 				//print_r($countries);die;
				$this->set('countries',$countries);
					
			}
	}
		
		
	public function addadminsettings(){
		if(!$this->isauthorized())
			$this->redirect('/');
		$this->loadModel('User');
	
		$this->set('title_for_layout','Settings');
		global $setngs;
		global $loguser; 
		$auserid = $loguser[0]['User']['id'];
		if(!empty($this->request->data)){
			//echo $auserid;
			//echo "<pre>";print_r($this->request->data);die;
			//$username =  $this->request->data['signup']['username'];
			$firstname = $this->request->data['signup']['firstname'];
			$lastname = $this->request->data['signup']['lastname'];
			$email = $this->request->data['signup']['email'];
			$password = $this->request->data['signup']['password'];
	
			//$nmecounts = $this->User->find('count',array('conditions'=>array('username'=>$username)));
			$emlcounts = $this->User->find('count',array('conditions'=>array('User.email'=>$email,'User.id <>'=>$auserid)));
			// echo "<pre>";print_r($nmecounts);die;
			/* if($nmecounts > 0){
				$this->Session->setFlash("Username already exists");
				$this->redirect($this->referer());
			}else  */
			if($emlcounts > 0){
				$this->Session->setFlash("Email already exists");
				$this->redirect($this->referer());
				
			}else{
				$this->request->data['User']['id'] = $auserid;
				$name=$this->request->data['User']['username'] = "Admin";
				$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($name);
				$this->request->data['User']['first_name'] = $firstname;
				$this->request->data['User']['last_name'] = $lastname;
				$emailaddress = $this->request->data['User']['email'] = $email;
				$this->request->data['User']['password'] = $this->Auth->password($password);
				//$this->request->data['User']['user_level'] = $this->request->data['usr_access'];
				$this->request->data['User']['activation'] = '1';
				$this->request->data['User']['user_status'] = 'enable';
				$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
				$uniquecode = $this->Urlfriendly->get_uniquecode(8);
				$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
				$this->User->save($this->request->data);
				//$userid = $this->User->getLastInsertID();
	
				/* $this->loadModel('Shop');
				$this->request->data['Shop']['user_id'] = $auserid;
				$this->Shop->save($this->request->data); */
				
				$this->Session->setFlash('Member was successfully created...');
				$this->redirect($this->referer());
	
			}
		}else{
			$this->loadModel('User');
			$userDett = $this->User->findById($auserid);
			//print_r($userDett);die;
			$this->set('userDett',$userDett);
				
		}
	}
		
		function create_category(){
			$this->set('title_for_layout','Category Management');
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				$this->loadModel('Category');
			if(!empty($this->request->data)){
				// $this->Category->set($this->request->data);
				//echo "<pre>";print_r($this->request->data);
				//die;
				// echo "<pre>";print_r($this->request->data['Category']['categories']);die;
				$categoryname = $this->request->data['Category']['categoryname'];
				$categortype = $this->request->data['Category']['categories'];
//				$mainsec_prnts = $this->Category->find('all',array('conditions'=>array('id'=> $categortype)));
//				var_dump($mainsec_prnts);
//			    $this->set('mainsec_prnts',$mainsec_prnts);
			    
				if(empty($this->request->data['Category']['categories'])){
					$cats_data = $this->Category->find('all',array('conditions'=>array('category_name'=>$categoryname,'category_parent' => '0')));
				}else{
					$mainCatId = $this->request->data['Category']['categories'];
					$cats_data = $this->Category->find('all',array('conditions'=>array('category_name'=>$categoryname,'category_parent' => $mainCatId)));
				}
				// echo "<pre>";print_r($cats_data);die;
				if($categoryname == ''){
					$this->Session->setFlash('Please Enter Category Name');
					$this->redirect('/admin/add/category');
				}
				if(count($cats_data) > 0){
					$this->Session->setFlash('Category name Already Exists try another.');
					$this->redirect('/admin/add/category');
				}else{
					$this->Category->create();
					$this->request->data['Category']['category_name'] = $this->request->data['Category']['categoryname'];
					$this->request->data['Category']['category_vrintype'] = $this->request->data['Category']['vrintype'];
					$this->request->data['Category']['category_sub_vrintype'] = $this->request->data['Category']['sub_vrintype'];
					$this->request->data['Category']['category_del_type'] = $this->request->data['Category']['delivery_type'];
					$this->request->data['Category']['category_urlname'] = $this->Urlfriendly->utils_makeUrlFriendly($categoryname);
					if(empty($this->request->data['Category']['categories'])){
						$this->request->data['Category']['category_parent'] = 0;
					}else{
						$this->request->data['Category']['category_parent'] = $this->request->data['Category']['categories'];
					}
					$this->request->data['Category']['created_by'] = $loguser[0]['User']['id'];
					$this->request->data['Category']['created_at'] = date('Y-m-d H:i:s');
					
					// var_dump($this->Category->save($this->request->data['Category'],array('validate'=>false,'fieldList' => array('user_id'=> $loguser[0]['User']['id']))));
					$this->Category->save($this->request->data);
					// echo "<pre>";print_r($this->data['Category']);die;
					$ids = $this->Category->getLastInsertID();
					
					if(!empty($this->request->data['Category']['categoryname_2'])){
						$this->Category->create();
						$catnme = $this->request->data['Category']['category_name'] = $this->request->data['Category']['categoryname_2'];
						$this->request->data['Category']['category_urlname'] = $this->Urlfriendly->utils_makeUrlFriendly($catnme);
						
						$this->request->data['Category']['category_parent'] = $this->request->data['Category']['categories'];
						$this->request->data['Category']['category_sub_parent'] = $ids;
						
						$this->request->data['Category']['created_by'] = $loguser[0]['User']['id'];
						$this->request->data['Category']['created_at'] = date('Y-m-d H:i:s');
						// echo "<pre>";print_r($this->data['Category']);die;
						$this->Category->save($this->request->data);
					}
				}	
				$this->Session->setFlash('Successfully added');
				$this->redirect('/admin/add/category');
			}else{
				$mainsec = $this->Category->find('all',array('conditions'=>array('category_parent'=>0)));
				$this->set('mainsec',$mainsec);
			}
		}
		
		public function invoice_management ($retvalue = null) {
			if(!($this->isauthorized()))
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
			$this->set('title_for_layout','Invoices Management');
			$srcs = '';
			
			$serval = $this->passedArgs['searchval'];
			$this->set('sval',$serval);
			$invoice_orderss = $this->Invoiceorders->find('all',array('conditions'=>array('Invoiceorders.orderid like' =>'%'.$serval.'%')));
			foreach($invoice_orderss as $invoiceorders)
			{
				$invoice_ids[] = $invoiceorders['Invoiceorders']['invoiceid'];
			}
			
			if($serval)
				$this->paginate = array('conditions'=>array('OR'=>array('Invoices.invoiceid like'=>'%'.$serval.'%','Invoices.invoiceid'=>$invoice_ids,'Invoices.invoiceno like'=>'%'.$serval.'%')),'limit'=>10,'order'=>array('invoiceid'=>'desc'));
			else
				$this->paginate =  array('limit'=>10,'order'=>array('invoiceid'=>'desc'));
				
			$userdet = $this->paginate('Invoices');
			foreach($userdet as $userdetails)
			{
				$invoice_ids[] = $userdetails['Invoices']['invoiceid'];
			}
			$invoice_orders = $this->Invoiceorders->find('all',array('conditions'=>array('Invoiceorders.invoiceid'=>$invoice_ids)));
			
			$pagecount = $this->params['paging']['Invoices']['count'];
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			$this->set('invoice_orders',$invoice_orders);
		}
		
		public function invoice_view ($invoiceId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			$this->set('title_for_layout','View Invoice');
			
			$invoiceModel = $this->Invoices->findByinvoiceid($invoiceId);
			
			$invoiceOrder = $this->Invoiceorders->findByinvoiceid($invoiceId);
			$orderId = $invoiceOrder['Invoiceorders']['orderid'];
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
			$this->set('invoiceModel',$invoiceModel);
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}
		

		public function viewCoupon ($orderId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
		
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}

		public function viewMerchant ($orderId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
		
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}

		public function viewShip ($orderId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
		
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}

		public function viewDeliver ($orderId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
		
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}

		public function viewPaid ($orderId) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			
			$orderModel = $this->Orders->findByorderid($orderId);
			$orderItemModel = $this->Order_items->findAllByorderid($orderId);
			
			$shippingid = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shippingid);
			
			$sellerId = $this->Item->find('first',array('conditions'=>array('Item.id'=>$orderItemModel[0]['Order_items']['itemid'])));
			$sellerId = $sellerId['Item']['user_id'];
			
			$userModel = $this->Users->findByid($orderModel['Orders']['userid']);
			$sellerModel = $this->Users->findByid($sellerId);
			
			$coupon_id  = $orderModel['Orders']['coupon_id'];
			
			$discount_amount  = $orderModel['Orders']['discount_amount'];
			
			$orderCurrency = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('orderCurrency',$orderCurrency);
		
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
		}


		public function user_management($retvalue=null){
			if(!($this->isauthorized()))
				$this->redirect('/');
			$this->loadModel('User');
			$this->set('title_for_layout','User Management');
			$srcs = '';
			// echo "<pre>";print_r($this->request->data);die;
			
			$retvalue = $this->passedArgs['serchkeywrd'];
			if(!empty($retvalue)){
				//echo $retvalue;die;
				//echo $this->request->data['usersrch']['srch'];die;
				$srcs = $retvalue;
				
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'enable','OR'=>array('username like'=>$srcs.'%','email like'=>'%'.$srcs.'%')),'limit'=>10,'order'=>array('id'=>'desc'));
			}else{
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'enable'),'limit'=>10,'order'=>array('id'=>'desc'));
			}
				
			$userdet = $this->paginate('User');
			$pagecount = $this->params['paging']['User']['count'];
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			
		}
		
			public function nonapproved_users($retvalue=null){
			if(!($this->isauthorized()))
				$this->redirect('/');
			$this->loadModel('User');
			$this->set('title_for_layout','User Management');
			$srcs = '';
			// echo "<pre>";print_r($this->request->data);die;
			
			$retvalue = $this->passedArgs['serchkeywrd'];
			if(!empty($retvalue)){
				//echo $retvalue;die;
				//echo $this->request->data['usersrch']['srch'];die;
				$srcs = $retvalue;
				
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'disable','OR'=>array('username like'=>$srcs.'%','email like'=>'%'.$srcs.'%')),'limit'=>10,'order'=>array('id'=>'desc'));
			}else{
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'disable'),'limit'=>10,'order'=>array('id'=>'desc'));
			}
				
			$userdet = $this->paginate('User');
			$pagecount = $this->params['paging']['User']['count'];
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			
		}		
		
		public function inactivemembers($period=30, $retvalue=''){
			if(!($this->isauthorized()))
				$this->redirect('/');
			if (isset($_POST['search'])){
				$this->autoLayout = false;
				$this->autoRender = false;
			}
			$this->loadModel('User');
			$this->set('title_for_layout','Inactive User Management');
			
			$period = $period * 24 * 60 * 60;
			$inactivePeriod = time() - $period;
			$inactivePeriod = date('Y-m-d H:i:s', $inactivePeriod);
			//echo $inactivePeriod;
			if(!empty($retvalue)){
				//echo $retvalue;die;
				//echo $this->request->data['usersrch']['srch'];die;
				$srcs = $retvalue;
				$this->paginate =  array('conditions'=>array('user_status'=>'disable','user_level <>'=>'god',
						'OR'=>array('username like'=>'%'.$srcs.'%','email like'=>'%'.$srcs.'%'),'activation'=>0,'created_at <'=>$inactivePeriod),
						'limit'=>10, 'order'=>array('id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('user_status'=>'disable','user_level <>'=>'god','activation'=>0,
						'created_at <'=>$inactivePeriod),'limit'=>10,'order'=>array('id'=>'desc'));
			}
			
			$userdet = $this->paginate('User');
			//echo "<pre>";print_R($userdet); die;
			$pagecount = $this->params['paging']['User']['count'];
			$recordscount = $this->params['count'];
			//echo "<pre>";print_R($this->params);
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('recordscount',$recordscount);
			$this->set('srcs',$srcs);
			if (isset($_POST['search'])){
				$this->set('search',$_POST['search']);
				$this->render('user_searchmgmt');
			}
		}
		
		function deleteinactivemembers($period=30, $retvalue=''){
			if(!($this->isauthorized()))
				$this->redirect('/');
			
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Shop');
			
			if (!isset($_POST['selectedusers'])){
				$period = $period * 24 * 60 * 60;
				$inactivePeriod = time() - $period;
				$inactivePeriod = date('Y-m-d H:i:s', $inactivePeriod);
				//echo $inactivePeriod;
				if(!empty($retvalue)){
					//echo $retvalue;die;
					//echo $this->request->data['usersrch']['srch'];die;
					$srcs = $retvalue;
					$condition =  array('conditions'=>array('user_level <>'=>'god',
							'username like'=>$srcs.'%','activation'=>0,'created_at <'=>$inactivePeriod));
				}else{
					$condition =  array('conditions'=>array('user_level <>'=>'god','activation'=>0,
							'created_at <'=>$inactivePeriod));
				}
				$userModel = $this->User->find('all',$condition);
				foreach ($userModel as $user){
					$userid[] = $user['User']['id'];
				}
				$this->User->deleteAll(array('User.id' => $userid), false);
				$this->Shop->deleteAll(array('Shop.user_id' => $userid), false);
				
				$this->redirect('/inactivemembers');
			}else{
				$this->User->deleteAll(array('User.id' => $_POST['selectedusers']), false);
				$this->Shop->deleteAll(array('Shop.user_id' => $_POST['selectedusers']), false);
				//print_r($_POST['selectedusers']);
			}
		}
		
		public function change_user_status ($userId,$status) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('User');
			
			$prefix = $this->User->tablePrefix;
			if ($status == 'enable') {
				$this->User->query("UPDATE ".$prefix."users SET user_status = 'disable' WHERE id = ".$userId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = '<button class="btn btn-success" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeUserStatus('.$userId.',\'disable\')">Enable</button>';
			}else {
				$this->User->query("UPDATE ".$prefix."users SET user_status = 'enable' WHERE id = ".$userId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = '<button class="btn btn-warning" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeUserStatus('.$userId.',\'enable\')">Disable</button>';
			}
			echo $result;
		}
		
		public function change_seller_status ($shopId,$status) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Shop');
			$this->loadModel('User');
			global $setngs;
			global $loguser;
			$prefix = $this->Shop->tablePrefix;
			if ($status == 1) {
				$this->Shop->query("UPDATE ".$prefix."shops SET seller_status = '0' WHERE id = ".$shopId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = '<button class="btn btn-success" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$shopId.',\'0\')">Enable</button>';
			}else {
				$this->Shop->query("UPDATE ".$prefix."shops SET seller_status = '1' WHERE id = ".$shopId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = '<button class="btn btn-warning" style="width: 60px; margin-bottom: 12px; font-size: 11px;" onclick="changeSellerStatus('.$shopId.',\'1\')">Disable</button>';
				
				$shop_user = $this->Shop->find('all',array('conditions'=>array('Shop.id'=>$shopId)));
				$user_id = $shop_user[0]['Shop']['user_id'];
				
				$email_address = $this->User->find("all",array("conditions"=>array('User.id'=>$user_id)));
				$emailaddress = $email_address[0]['User']['email'];		

				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $emailaddress;
				$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Your seller signup was approved successfully";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'sellerapproved';		
				$this->set('name', $name);
				$this->set('urlname', $urlname);
				$this->set('email', $emailaddress);
				$username = $email_address[0]['User']['first_name'];
				$this->set('username',$username);
				$this->set('sender',$sender);
				$this->set('message',$message);
				$this->set('access_url',SITE_URL."login");
				
				$this->Email->send();				
			}
			echo $result;
		}
		
		public function user_searchmgmt($retvalue=null){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->set('title_for_layout','User Management');
			$srcs = '';
			// echo "<pre>";print_r($this->request->data);die;
			if(!empty($retvalue)){
				//echo $retvalue;die;
				//echo $this->request->data['usersrch']['srch'];die;
				$srcs = $retvalue;
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}				
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'enable','OR'=>array('username like'=>$srcs.'%','email like'=>'%'.$srcs.'%')),'limit'=>10,'order'=>array('id'=>'desc'));
			}else{
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}			
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'enable'),'limit'=>10,'order'=>array('id'=>'desc'));
			}
				
			$userdet = $this->paginate('User');
			$pagecount = $this->params['paging']['User']['count'];
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			
		} 
		
		public function searchnonapprovedusers($retvalue=null){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->set('title_for_layout','User Management');
			$srcs = '';
			// echo "<pre>";print_r($this->request->data);die;
			if(!empty($retvalue)){
				//echo $retvalue;die;
				//echo $this->request->data['usersrch']['srch'];die;
				$srcs = $retvalue;
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}				
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'disable','OR'=>array('username like'=>$srcs.'%','email like'=>'%'.$srcs.'%')),'limit'=>10,'order'=>array('id'=>'desc'));
			}else{
				$admin_datas = $this->User->find('all',array('conditions'=>array('User.username'=>'Admin','User.username_url'=>'admin')));
				foreach($admin_datas as $admins_datas)
				{
					$admin_ids[] = $admins_datas['User']['id'];
				}			
				$this->paginate =  array('conditions'=>array('User.id !='=>$admin_ids,'User.user_status'=>'disable'),'limit'=>10,'order'=>array('id'=>'desc'));
			}
				
			$userdet = $this->paginate('User');
			$pagecount = $this->params['paging']['User']['count'];
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			
		} 		
		
		/*disp create and manage*/

		
		public function disp(){
		
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Dispute');
			$this->loadModel('Order');
			$this->set('title_for_layout','Dispute Management');
			
			//$disp_data = $this->Dispute->find('all',array('order'=>array('disid'=>'desc')));
			
			//$this->set('disp_data',$disp_data);
			//foreach($disp_data as $key=>$temp){
				//$disid = $temp['Dispute']['disid'];
				//$uid = $temp['Dispute']['userid'];
				//$res = $temp['Dispute']['resolvestatus'];

				$this->paginate = array('conditions'=>array('Dispute.disid <>'=>0),'limit'=>10,'order'=>array('Dispute.disid'=>'desc'));
				$disp_data = $this->paginate('Dispute');
				$pagecount = $this->params['paging']['Dispute']['count'];
				$order_data = array();
				$i = 0;
				foreach($disp_data as $disps) 
				{
					$order_data[$i]['disid'] = $disps['Dispute']['disid'];
				$orderid = $disps['Dispute']['uorderid'];
				$order_data[$i]['uname'] = $disps['Dispute']['uname'];
				$order_data[$i]['sname'] = $disps['Dispute']['sname'];
				$order_data[$i]['pbm'] = $disps['Dispute']['uorderplm'];
				$order_data[$i]['disputeid'] = $disps['Dispute']['disid'];
				$order_data[$i]['id'] = $orderid;
				$order_data[$i]['datas'] = $this->Order->find('all',array('conditions'=>array('Order.orderid'=>$orderid)));
				$i += 1;
				}
				
				//echo "<pre>";print_r($order_data);die;
				$this->set('disp_data',$disp_data);
				$this->set('pagecount',$pagecount);
				$this->set('order_data',$order_data);
				
				
		
				
			//}
			
			// echo "<pre>";print_R($baners_data);die;
		
		}

		
		
		public function viewdisp($disid){
			global $setngs;
			$disid;
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Dispute');
			$this->loadModel('User');
			$orderid;
			
			$this->loadModel('Ordercomments');
			
			//$orderModel = $this->Orders->findByorderid($orderid);
			$ordercommentsModel = $this->Ordercomments->find('all',array('conditions'=>array('orderid'=>$orid),'order'=>'id DESC'));
			$buyerid = $orderModel['Orders']['userid'];
			$merchantid = $orderModel['Orders']['merchant_id'];
			
			
			
			
			$disp = $this->Dispute->findBydisid($disid);
			$orid= $disp['Dispute']['uorderid'];
			$usie= $disp['Dispute']['userid'];
			$deid= $disp['Dispute']['disid'];
			$orderModel = $this->Orders->findByorderid($orid);
			$merchantid = $orderModel['Orders']['merchant_id'];
			$userModel = $this->User->findByid($userid);
			$merchantModel = $this->User->findByid($merchantid);
			$userEmail = $userModel['User']['email'];
			$shipppingId = $orderModel['Orders']['shippingaddress'];
			$currencyCode = $orderModel['Orders']['currency'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shipppingId);
			$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));	
				
			$buyerModel = $this->User->findByid($usie);
			$merchantModel = $this->User->findByid($merchantid);
			$sellerName = $merchantModel['User']['first_name'];
			$selleremail = $merchantModel['User']['email'];
			$buyeremail = $buyerModel['User']['email'];
			
			$sellername = $merchantModel['User']['first_name'];
			$buyername = $buyerModel['User']['first_name'];
			//echo "<pre>";print_r($itemModle);die;
			$this->loadModel('Forexrate');
			$forexrateModel = $this->Forexrate->find('first',array('conditions'=>array(
					'currency_code'=>$currencyCode)));
			$currencySymbol = $forexrateModel['Forexrate']['currency_symbol'];
			
			$this->set('orderModel', $orderModel);
			$this->set('orderitemModel',$orderitemModel);
			$this->set('userModel',$userModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('itemModle',$itemModle);
			$this->set('disp',$disp);
			$this->set('buyerModel',$buyerModel);
			$this->set('sellername',$sellername);
			$this->set('buyername',$buyername);
			
			$this->set('roundProf',$siteChanges['profile_image_view']);
			$this->loadModel('Dispcon');
			$this->set('currencySymbol',$currencySymbol);
			$this->set('currencyCode', $currencyCode);
			$this->set('disid', $disid);
			if(isset($_REQUEST['resolve'])){
			if(!empty($this->request->data)){
				$res="Resolved";
				$this->request->data['Dispute']['disid'] = $disid;
				$resu=$this->request->data['Dispute']['resolvestatus'] = $res;
				//echo "<pre>";print_r($this->request->data);die;
				$prefix = $this->Dispute->tablePrefix;
				//print_r($buyeremail);print_r($selleremail);die;
				$this->Dispute->query("UPDATE ".$prefix."disputes SET resolvestatus = 'Resolved' WHERE disid = ".$disid.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				//$this->Dispute->save($resu,array('conditions' => array('Dispute.disid' => $disid)));
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $buyeremail;
				$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – Your dispute #".$disid." has been resolved";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'resolveadmin';
				
				$this->set('setngs',$setngs);
				$emailid = base64_encode($ueruploidemail);
				//$pass = base64_encode($password);
				//$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key."~".$pass);
					
				$this->Email->send();
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $selleremail;
				$this->Email->subject = $setngs[0]['Sitesetting']['site_name']." – The dispute #".$disid." has been resolved";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'resolveselleradmin';
				
				$this->set('setngs',$setngs);
				$emailid = base64_encode($ueruploidemail);
				//$pass = base64_encode($password);
				//$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key."~".$pass);
					
				$this->Email->send();
				
				
				
				
				
				$this->redirect('/admin/user/dispute/');
			}
				
			}
			
			$msgel = $this->Dispcon->find('all',array('conditions'=>array('dispid'=>$disid),'order'=>array('dcid'=>'desc')));
			foreach ($msgel as $key => $msg){
					
				$message[$key]['user_id'] = $msg['Dispcon']['user_id'];
				$message[$key]['commented_by'] = $msg['Dispcon']['commented_by'];
				$message[$key]['date'] = $msg['Dispcon']['date'];
			
				$message[$key]['order_id'] = $msg['Dispcon']['order_id'];
				$message[$key]['message'] = $msg['Dispcon']['message'];
					
			}
			
			$pllm = $this->Dispcon->find('all',array('conditions'=>array('order_id'=>$orid),'order'=>array('dcid'=>'desc')));
			foreach ($pllm as $key => $msgas){
					
				$messagedisp[$key]['user_id'] = $msgas['Dispcon']['user_id'];
				$messagedisp[$key]['commented_by'] = $msgas['Dispcon']['commented_by'];
				$messagedisp[$key]['date'] = $msgas['Dispcon']['date'];
					
				$messagedisp[$key]['order_id'] = $msgas['Dispcon']['order_id'];
				$messagedisp[$key]['message'] = $msgas['Dispcon']['message'];
					
			}
			$this->set('messagedisp',$messagedisp);
			if (!empty($this->request->data['Dispcon'])){
					
				$ms=$this->request->data['Dispcon']['message'] = $this->request->data['Dispcon']['msg'];
				 $da=$this->request->data['Dispcon']['date']= time();
				 $nei="Admin";
				 $cre=$this->request->data['Dispcon']['commented_by']= $nei;
				$ds=$this->request->data['Dispcon']['user_id'] = $usie;
				$cs=$this->request->data['Dispcon']['order_id'] = $orid;
				$dis=$this->request->data['Dispcon']['dispid'] = $disid;
				$dms=$this->request->data['Dispcon']['msid'] = $merchantid;
					
				//echo "<pre>";print_r($this->request->data['Dispcon']);die;
				$this->Dispcon->save($this->request->data);
				$this->Session->setFlash('Reply Send To Users.');
				//$this->redirect('/admin/user/view_dispute',);
				$this->redirect(array('controller' => '/', 'action' => '/admin/user/view_dispute', $disid));
				
			}
			
		}
		

public function deletdispmsg(){
				
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->layout = 'ajax';
			$this->loadModel('Dispute');
			$this->loadModel('Dispcon');
			$id = $_REQUEST['did'];
			$prefix = $this->Dispute->tablePrefix;
		
			$convdel=$this->Dispute->query("delete from ".$prefix."disputes where disid=".$id." ");
			$pllmdel = $this->Dispute->find('all',array('conditions'=>array('disid'=>$id)));
			
			
			$condi = array('Dispcon.dispid' => $id );
			$this->loadModel("Dispcon"); // This will be required if you are not present in ProductOption Controller.
			$this->Dispcon->deleteAll($condi,false);
			
			//$this->redirect('/admin/user/dispute/');
			$this->Session->setFlash('Successfully Deleted');
			$this->redirect(array('controller' => '/', 'action' => '/admin/user/dispute/'));
		}
		
		
		
		/*public function dispstatus(){
		
		if(!$this->isauthorized())
				$this->redirect('/');
			$this->layout = 'ajax';
			$this->loadModel('Dispute');
			//$this->loadModel('Dispcon');
			
			$prefix = $this->Dispute->tablePrefix;
			if(!empty($this->request->data)){
				
			$id = $_REQUEST['uoid'];
			$status = $_REQUEST['resolvestatus'];
				//$status = $this->request->data['status']['options'];
				//$status = $this->request->data['Deal']['resolvestatus'];
				
			
			
				
						$this->Dispute->query("UPDATE ".$prefix."disputes SET resolvestatus='$status' WHERE uorderid = '$id';");
					
			
			}
		
			//$this->redirect('/admin/user/dispute/');
			//$this->Session->setFlash('Successfully Deleted');
			//$this->redirect(array('controller' => '/', 'action' => '/admin/user/dispute/'));
		}*/


		public function dispstatus(){
		
		if(!$this->isauthorized())
				$this->redirect('/');
			$this->layout = 'ajax';
			$this->loadModel('Order');
			//$this->loadModel('Dispcon');
			
			$prefix = $this->Order->tablePrefix;
			if(!empty($this->request->data)){
				
			$id = $_REQUEST['uoid'];
			//$status = $_REQUEST['resolvestatus'];
				//$status = $this->request->data['status']['options'];
				//$status = $this->request->data['Deal']['resolvestatus'];
				
			if($_REQUEST['resolvestatus'] == 'Pending'){
				$status= '';
				$this->Order->query("UPDATE ".$prefix."orders SET status='$status' WHERE orderid = '$id';");
					
			}else{
				$status = $_REQUEST['resolvestatus'];
				$this->Order->query("UPDATE ".$prefix."orders SET status='$status' WHERE orderid = '$id';");
			}
			
				
						//$this->Order->query("UPDATE ".$prefix."orders SET status='$status' WHERE orderid = '$id';");
					
			
			}
		
			//$this->redirect('/admin/user/dispute/');
			//$this->Session->setFlash('Successfully Deleted');
			//$this->redirect(array('controller' => '/', 'action' => '/admin/user/dispute/'));
		}

function getadmin(){
			$this->autoLayout = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$this->loadModel('Dispcons');
			$this->loadModel('Orders');
			$currentcont = $_POST['currentcont'];
			$order_id = $_POST['order_id'];
			$contacter = $_POST['contact'];
				
		
			$orderModel = $this->Orders->findByorderid($order_id);
			$messagedisp = $this->Dispcons->find('all',array('conditions'=>array('order_id'=>$order_id),'offset'=>$currentcont,'limit'=> '40'));
			//print_r($ordercommentsModel);die;
			if (!empty($messagedisp)){
				$latestcount = $currentcont + count($messagedisp);
				$buyerid = $orderModel['Orders']['userid'];
				$merchantid = $orderModel['Orders']['merchant_id'];
				$buyerModel = $this->User->findByid($buyerid);
				$merchantModel = $this->User->findByid($merchantid);
		
				if ($contacter == 'Seller'){
					$this->set('buyerModel',$buyerModel);
					$this->set('merchantModel',$merchantModel);
				}else{
					$this->set('buyerModel',$merchantModel);
					$this->set('merchantModel',$buyerModel);
				}
				$this->set('contacter',$contacter);
				$this->set('roundProf',$siteChanges['profile_image_view']);
			}
			$this->set('messagedisp',$messagedisp);
			$this->set('latestcount',$latestcount);
		}
		
		function getmorecommentadmin() {
			$this->autoLayout = FALSE;
			$this->autoRender = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$this->loadModel('Dispcons');
			$this->loadModel('Orders');
			$userid = $loguser[0]['User']['id'];
			$offset = $_POST['offset'];
			$order_id = $_POST['order_id'];
			$contacter = $_POST['contact'];
		
			$orderModel = $this->Orders->findByorderid($order_id);
			$messagedisp = $this->Dispcons->find('all',array('conditions'=>array('order_id'=>$order_id),'order'=>'dcid DESC','offset'=>$offset,'limit'=>'5'));
			if (!empty($messagedisp)){
				$latestcount = $currentcont + count($messagedisp);
				$buyerid = $orderModel['Orders']['userid'];
				$merchantid = $orderModel['Orders']['merchant_id'];
				$buyerModel = $this->User->findByid($buyerid);
				$merchantModel = $this->User->findByid($merchantid);
				if ($contacter == 'Seller'){
					$this->set('buyerModel',$buyerModel);
					$this->set('merchantModel',$merchantModel);
				}else{
					$this->set('buyerModel',$merchantModel);
					$this->set('merchantModel',$buyerModel);
				}
				$this->set('contacter',$contacter);
				$this->set('roundProf',$siteChanges['profile_image_view']);
			}
			$this->set('messagedisp',$messagedisp);
			$this->set('latestcount','0');
			$this->render('getadmin');
		}



public function manageproblem()
		{
			/*global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Dispplm');
			$displm = $this->Dispplm->find('all',array('order'=>array('Dispplm.id'=>'desc')));
			$this->set('displm',$displm);
			
			
			
			if(!empty($this->request->data)){
				
				$problem = $this->request->data['Dispplm'];
				foreach($problem as $key => $plm)
				{  
					$prefix = $this->Dispplm->tablePrefix;
						$this->Dispplm->query("UPDATE ".$prefix."dispplms SET problem='$plm' WHERE id = '$key';");
						//$this->redirect(array('controller' => '/', 'action' => '/admin/manage/problemlist'));
					
				}
				$this->redirect(array('controller' => '/', 'action' => '/admin/manage/problemlist'));
					
			}
			*/
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->set('title_for_layout','Manage Subjects');
			$this->loadModel('Sitequeries');
				
			$subject_data = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
					'Dispute_Problem')));
				
			//$item_datas = $this->Item->find('all');
				
			$this->set('subject_data',$subject_data);
			$this->set('pagecount',$pagecount);
			
			
			
			
		}

function delete_disp_plm_admin($id) {
			//$this->autoLayout = false;
			//$this->autoRender = false;
				
			//$this->loadModel('Dispplm');
			//$displm = $this->Dispplm->find('all',array('order'=>array('Dispplm.id'=>'desc')));
			//$this->set('displm',$displm);
				
			//$this->Dispplm->deleteAll(array('Dispplm.id' => $id), false);
			//$this->redirect(array('controller' => '/', 'action' => '/admin/manage/problemlist'));
		//echo "hi";echo $id;	
	
	global $loguser;
	if(!$this->isauthorized())
		$this->redirect('/');
	
	$this->loadModel('Sitequeries');
	$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
			'Dispute_Problem')));
	$csqueries = array();
	if (!empty($sitequeriesModel)){
		$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
		foreach ($queries as $qkey => $query){
			if ($id != $qkey){
				$csqueries[] = $query;
			}
		}
		$this->request->data['Sitequeries']['id'] = $sitequeriesModel['Sitequeries']['id'];
		$this->request->data['Sitequeries']['queries'] = json_encode($csqueries);
		$this->Sitequeries->save($this->request->data);
		$this->Session->setFlash('Deleted Successfully');
	}else{
		$this->Session->setFlash('Subject Not Found');
	}
	$this->redirect('/admin/manage/problemlist');
	
	
		}

 /*public function dispquestion($id = NULL)
		{
				
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Dispplm');
			$this->loadModel('Sitequerie');
			
			
			
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'Dispute_Problem')));
				if (!empty($sitequeriesModel)){
					$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
					if ($id == NULL){
						$queries[] = $this->request->data['Dispplm']['plm'];
					}else{
						$queries[$id] = $this->request->data['Dispplm']['plm'];
					}
					$this->request->data['Sitequeries']['id'] = $sitequeriesModel['Sitequeries']['id'];
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}else{
					$queries[] = $this->request->data['Dispplm']['plm'];
					$this->request->data['Sitequeries']['type'] = 'Dispute_Problem';
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}
				$this->Sitequeries->save($this->request->data);
			
				$this->Session->setFlash('Saved Successfully');
				$this->redirect('/admin/add/dispquestion');
			}
			
			if ($id != NULL){
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'Dispute_Problem')));
				$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
				
				$this->set('query',$queries[$id]);
			}else{
				$this->set('query','');
			}
			$this->set('id',$id);
		
			
			
			
			
			if (!empty($this->request->data['Dispplm'])){
					
				$ms=$this->request->data['Dispplm']['problem'] = $this->request->data['Dispplm']['plm'];
				$da=$this->request->data['Dispplm']['timedisp']= time();
				echo $this->request->data['Dispplm']['msg'];
				$this->Dispplm->save($this->request->data);
				
				$ty="Disputes";
				$msit=$this->request->data['Sitequerie']['queries'] = $this->request->data['Dispplm']['plm'];
				$dsite=$this->request->data['Sitequerie']['type']= $ty;
				echo $this->request->data['Dispplm']['msg'];
				$this->Sitequerie->save($this->request->data);
				
				$this->Session->setFlash('Create the problem');
				$this->redirect(array('controller' => '/', 'action' => '/admin/manage/problemlist'));
					
			}	
				
				
		}*/

		function dispquestion($id = NULL){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorized())
				$this->redirect('/');
				
			$this->set('title_for_layout','Add Subject');
			$this->loadModel('Sitequeries');
				
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'Dispute_Problem')));
				if (!empty($sitequeriesModel)){
					$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
					if ($id == NULL){
						$queries[] = $this->request->data['Dispplm']['plm'];
					}else{
						$queries[$id] = $this->request->data['Dispplm']['plm'];
					}
					$this->request->data['Sitequeries']['id'] = $sitequeriesModel['Sitequeries']['id'];
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}else{
					$queries[] = $this->request->data['Dispplm']['plm'];
					$this->request->data['Sitequeries']['type'] = 'Dispute_Problem';
					$this->request->data['Sitequeries']['queries'] = json_encode($queries);
				}
				$this->Sitequeries->save($this->request->data);
					
				$this->Session->setFlash('Dispute problem created');
				$this->redirect('/admin/manage/problemlist');
			}
			if ($id != NULL){
				$sitequeriesModel = $this->Sitequeries->find('first',array('conditions'=>array('type'=>
						'Dispute_Problem')));
				$queries = json_decode($sitequeriesModel['Sitequeries']['queries'], true);
			
				$this->set('query',$queries[$id]);
			}else{
				$this->set('query','');
			}
			$this->set('id',$id);
			
		
		}
		
		
			
		
	

		
		/* delete user and his all details */
		public function deleteusrdetls(){
			if(!$this->isauthorized())
				$this->redirect('/');
			
			$this->layout = 'ajax';
			$id = $_REQUEST['uid'];
			//echo $id;die;
			$this->loadModel('Item');
			$this->loadModel('Shop');
			$this->loadModel('Shopfav');
			$this->loadModel('Itemfav');
			$this->loadModel('Comment');
			$this->loadModel('Itemlist');
			$this->loadModel('Tempaddresses');
			$this->loadModel('Wantownit');
			
			$prefix = $this->User->tablePrefix;
			
			// $this->User->delete($id);
			//echo "delete from ".$prefix."users where id=".$id." ";die;
			$this->User->query("delete from ".$prefix."users where id=".$id." ");
			// $this->Item->query("update ".$prefix."items set status='draft' where user_id=".$id." ");
			$shp_data = $this->Shop->findByUserId($id);
			$shpid = $shp_data['Shop']['id'];
			
			$this->Item->deleteAll(array('Item.shop_id' => $shpid), false);
			$this->Shop->deleteAll(array('Shop.user_id' => $id), false);
			$this->Shopfav->deleteAll(array('Shopfav.user_id' => $id), false);
			$this->Itemfav->deleteAll(array('Itemfav.user_id' => $id), false);
			$this->Comment->deleteAll(array('Comment.user_id' => $id), false);
			$this->Itemlist->deleteAll(array('Itemlist.user_id' => $id), false);
			$this->Tempaddresses->deleteAll(array('Tempaddresses.userid' => $id), false);
			$this->Wantownit->deleteAll(array('Wantownit.userid' => $id), false);
			die;
		}	
		 
		public function editseller ($sellerId=null){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Shop');
			
			if(!empty($this->request->data)){
				//echo "$sellerId<pre>";print_r($this->request->data);die;
			
				$this->request->data['Shop']['id'] = $sellerId;
				$this->request->data['Shop']['shop_name'] = $this->request->data['brand_name'];
				$this->request->data['Shop']['shop_title'] = $this->request->data['merchant']['merchant_name'];
				$this->request->data['Shop']['seller_status'] = $this->request->data['status'];
				if($this->request->data['status'] == 2){
					$this->request->data['Shop']['seller_status'] = 1;
				}
				$this->request->data['Shop']['paypal_id'] = $this->request->data['merchant']['paypalId'];
				$this->request->data['Shop']['phone_no'] = $this->request->data['merchant']['person_phone_number'];
				$this->request->data['Shop']['shop_address'] = $this->request->data['merchant']['officeaddress'];
				$this->request->data['Shop']['shop_latitude'] = $this->request->data['merchant']['bankaccountno'];
				$this->request->data['Shop']['shop_longitude'] = $this->request->data['merchant']['mpowerid'];
				$this->Shop->save($this->request->data);
				$this->Session->setFlash('Successfully edited.');
				$this->redirect('/admin/manage/sellers');
			}else{
				$shopModel = $this->Shop->findById($sellerId);
				$this->set('shopModel',$shopModel);
				$this->set('sellerid',$sellerid);
				
				// echo "<pre>";print_r($shopModel);die;
			}
		}	
	
		
		function profile_edit($id = null){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			if(!empty($this->request->data)){
				// echo "<pre>";print_r($this->request->data);die;
				$email = $this->request->data['profile']['editemail'];
				
				$dets = $this->User->find('all',array('conditions'=>array('email'=>$email,'id Not'=>$id)));
				if(empty($dets)){
				
					$this->request->data['User']['id'] = $id;
					$this->request->data['User']['username'] = $this->request->data['profile']['edituser'];
					$this->request->data['User']['email'] = $this->request->data['profile']['editemail'];
					if($this->request->data['profile']['changepass'] == 'yes'){
						$pass = $this->request->data['profile']['editpassword'];
						$this->request->data['User']['password'] = $this->Auth->password($pass);
					}
					/* $this->request->data['User']['address'] = $this->request->data['profile']['editaddress'];
					$this->request->data['User']['county'] = $this->request->data['profile']['editcounty'];
					$this->request->data['User']['phoneno'] = $this->request->data['profile']['editphoneno'];
					$this->request->data['User']['website'] = $this->request->data['profile']['editwebsite']; */
					$this->User->save($this->request->data);
					$this->Session->setFlash('Successfully edited.');
					$this->redirect('/');
				}else{
					$this->Session->setFlash('Email id alread exist');
					$this->redirect('/profile/edit/'.$id);
				}
			}else{
				$userdata = $this->User->findById($id);
				$this->set('userdata',$userdata);
				// echo "<pre>";print_r($userdata);die;
			}
			// die;
		}
		
		
		
		public function err404 () {
			$this->loadModel('Help');
			$err_content = $this->Help->find('all');
			foreach($err_content as $error)
			$error_content = $error['Help']['err_code'];
			$this->set('error_content',$error_content);		
			if(!empty($this->request->data)) {
				$content = $this->request->data['content'];
				//echo $content; die;
				//$this->Help->updateAll(array('err_code' => "'$content'"));

				$this->request->data['Help']['id'] = '1';
				$this->request->data['Help']['err_code'] = $content;
				$this->Help->save($this->request->data);

				$this->Session->setflash("updated Successfully");
				$this->redirect('/err404');
			}
			
		}
		
		
		
		
		
		/* public function merchant_payment () {
			$this->loadModel('User');
			$this->loadModel('Orders');
			$getpayval = $this->Orders->find('all',array('conditions'=>array('status'=>'Delivered')));
			$previousval = null;
			if(!empty($getpayval)){
				foreach($getpayval as $pay){
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[] = $pay['Orders']['status'];
					$order_totalcost[] = $totcostreduceShip;
		
					$previousValue[] = $pay['Orders']['merchant_id'];
		
					if(in_array($pay['Orders']['merchant_id'], $previousValue)) {
						$tot[$pay['Orders']['merchant_id']] +=  $totcostreduceShip;
					}
				}
			}
			$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			$getitemuser = $this->paginate('User');
			$pagecount = $this->params['paging']['User']['count'];
				
			$this->set('getitemuser',$getitemuser);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('tot',$tot);
			$this->set('pagecount',$pagecount);
		
		} */
		
		public function pgsetup () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Sitesetting');
			$this->set('title_for_layout','Payment Gateway setup');
			
			if(!empty($this->request->data)){
			//echo "<pre>";print_r($this->request->data);die;
			//$this->request->data['Sitesetting']['payment_type'] = $this->request->data['PaypalGateway']['type'];
			//$this->request->data['Sitesetting']['paypal_id'] = $this->request->data['PaypalGateway']['paypal_id'];
			$type = $this->request->data['PaypalGateway']['type'];
			$paypalAdaptive['paymentMode'] = $this->request->data['PaypalGateway']['paypal_payment_mode'];
			$paypalAdaptive['apiUserId'] = $this->request->data['PaypalGateway']['paypal_api_userid'];
			$paypalAdaptive['apiPassword'] = $this->request->data['PaypalGateway']['paypal_api_password'];
			$paypalAdaptive['apiSignature'] = $this->request->data['PaypalGateway']['paypal_api_signature'];
			$paypalAdaptive['apiApplicationId'] = $this->request->data['PaypalGateway']['paypal_application_id'];
			$eid = $this->request->data['PaypalGateway']['paypal_id'];
			$paypalAdaptive = json_encode($paypalAdaptive);
			$this->Sitesetting->updateAll(array('payment_type' => "'$type'",'paypal_id' => "'$eid'",'paypaladaptive' => "'$paypalAdaptive'"), array('id' => '1'));
			
			
			}
				$paystatus = $this->Sitesetting->find('first');
				//payment_type
				//paypal_id
				//echo "<pre>";print_r($paystatus);die;
				$paypalAdaptive = json_decode($paystatus['Sitesetting']['paypaladaptive'],true);
				$this->set('paystatus',$paystatus);
				$this->set('paypalAdaptive',$paypalAdaptive);
		
		}
		
		public function merchant_payment () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			//$this->paginate =
			$serval = $this->passedArgs['searchval'];
			$this->set('sval',$serval);
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$serval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}			
			
			if($serval)
			$this->paginate = array('conditions'=>array('NOT' => array('Orders.status' => array('Shipped','Delivered')),'OR'=>array('Orders.orderid like'=>'%'.$serval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('NOT' => array('Orders.status' => array('Shipped','Delivered'))), 'limit'=>10, 'order'=>array('Orders.orderid'=>'desc'));
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			//echo "<pre>";print_r($getpayval);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];

					//$order_totalcost[] = $pay['Orders']['totalcost'];
					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip >= $min_val && $totcostreduceShip <= $max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $pay['Orders']['totalcost']/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
					 $order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
					$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('usernames',$usernames);
			$this->set('order_currency',$order_currency);
			//$this->set('tot',$tot);
			$this->set('pagecount',$pagecount);
		
		}		
		
		public function merchant_payment_deliver () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');

			$serval = $this->passedArgs['searchval'];
			$this->set('sval',$serval);
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$serval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}			
			
			if($serval)
			$this->paginate = array('conditions'=>array('Orders.status'=>'Delivered','OR'=>array('Orders.orderid like'=>'%'.$serval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('Orders.status'=>'Delivered'),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
			
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));	
			//echo "<pre>";print_r($getpayval);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$order_totalcostShipping_ognl[$orderIddd] = $pay['Orders']['totalCostshipp'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					//$order_totalcost[] = $totcostreduceShip;
					$order_totalcost[$orderIddd] = $pay['Orders']['totalcost'] - $pay['Orders']['admin_commission'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];
					
					/* foreach($commiDetails as $commi){
					$min_val = $commi['Commission']['min_value'];
					$max_val =  $commi['Commission']['max_value'];
					if($totcostreduceShip>=$min_val && $totcostreduceShip<=$max_val){
						if($commi['Commission']['type'] == '%'){
							//echo (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
							//die;
							$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
							$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							
						}else{
							$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
						}
					}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
						$order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
						$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_currency',$order_currency);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('order_totalcostShipping_ognl',$order_totalcostShipping_ognl);
			$this->set('usernames',$usernames);
			//$this->set('tot',$tot);
			$this->set('pagecount',$pagecount);
		
		}
		
		
		public function merchant_payment_ship () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			
			$serval = $this->passedArgs['searchval'];
			$this->set('sval',$serval);
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$serval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}			
			
			if($serval)			
			$this->paginate = array('conditions'=>array('Orders.status'=>'Shipped','OR'=>array('Orders.orderid like'=>'%'.$serval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('Orders.status'=>'Shipped'),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			//echo "<pre>";print_r($getpayval);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];

					//$order_totalcost[] = $pay['Orders']['totalcost'];
					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip >= $min_val && $totcostreduceShip <= $max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $pay['Orders']['totalcost']/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
					 $order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
					$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('usernames',$usernames);
			$this->set('order_currency',$order_currency);
			//$this->set('tot',$tot);
			$this->set('pagecount',$pagecount);
		
		}
		
		
		public function merchant_payment_paid () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');

			$serval = $this->passedArgs['searchval'];
			$this->set('sval',$serval);
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$serval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}			
			
			if($serval)	
			$this->paginate = array('conditions'=>array('Orders.status'=>'Paid','OR'=>array('Orders.orderid like'=>'%'.$serval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('Orders.status'=>'Paid'),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			//echo "<pre>";print_r($commiDetails);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$order_totalcostShipping_ognl[$orderIddd] = $pay['Orders']['totalCostshipp'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];
					//$order_totalcost[] = $totcostreduceShip;
					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip>=$min_val && $totcostreduceShip<=$max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $totcostreduceShip/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
					 $order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
					$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('order_currency',$order_currency);
			$this->set('order_totalcostShipping_ognl',$order_totalcostShipping_ognl);
			$this->set('usernames',$usernames);
			//$this->set('tot',$tot);
			$this->set('pagecount',$pagecount);
		
		}
		
		
		public function pay_to_merchant () {
			if(!$this->isauthorized())
				$this->redirect('/');
			
			global $setngs;
			$this->loadModel('User');
			$merchname = $_POST['merchname'];
			$price = $_POST['price'];
			
			$orderid = $_POST['orderid'];
			
			$getemail = $this->User->findByUsername_url($merchname);
			
			//echo "<pre>";print_r($getemail['Shop']['paypal_id']);die;
			
			
			$this->set('merchname',$merchname);
			$this->set('price',$price);
			$this->set('orderid',$orderid);
			$this->set('currency',$_POST['currency']);
			$this->set('setngs',$setngs);
			$this->set('mercahnt_email',$getemail['Shop']['paypal_id']);
			
		}
		
		
		public function payadminurl () {
			if(!$this->isauthorized())
				$this->redirect('/');
		
			
			$this->loadModel('Orders');
			if($_GET['st']=='Completed'){
				$orderid = $_GET['item_number'];	
				$this->Orders->updateAll(array('Orders.status' => "'Paid'"), array('Orders.orderid' => $orderid));
				$this->redirect('/admin/merchant_payment/');
			}
			
		}
		
		public function commission () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Commission');
			if(!empty($this->request->data)){
					$min_range = $this->request->data['start_range'];
					$max_range = $this->request->data['end_range'];
					$amount = $this->request->data['commission_amount'];
					if($min_range < $max_range && $amount <= 100){
					$this->request->data['Commission']['applyto'] = $this->request->data['applyto'];
					$this->request->data['Commission']['type'] = $this->request->data['commission_type'];
					//$this->request->data['Commission']['min_value'] = $this->request->data['start_range'];
					//$this->request->data['Commission']['max_value'] = $this->request->data['end_range'];
					$this->request->data['Commission']['min_value'] = $min_range;
					$this->request->data['Commission']['max_value'] = $max_range;
					$this->request->data['Commission']['amount'] = $this->request->data['commission_amount'];
					$this->request->data['Commission']['commission_details'] = $this->request->data['commissionDetails'];
					$this->request->data['Commission']['active'] = '1';
					$this->request->data['Commission']['cdate'] = time();
					$this->Commission->save($this->request->data);
					$this->Session->setFlash('Commission was successfully created...');
					$this->redirect('/admin/viewcommission/');
					}
					else {
						$this->redirect('/admin/commission/');
					}
			}
		}
		public function editcommission ($id =null) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Commission');
				
			if(!empty($this->request->data)){
					$min_range = $this->request->data['start_range'];
					$max_range = $this->request->data['end_range'];
					$amount = $this->request->data['commission_amount'];
					if($min_range < $max_range && $amount <= 100){
					$this->request->data['Commission']['id'] = $id;
					$this->request->data['Commission']['applyto'] = $this->request->data['applyto'];
					$this->request->data['Commission']['type'] = $this->request->data['commission_type'];
					//$this->request->data['Commission']['min_value'] = $this->request->data['start_range'];
					//$this->request->data['Commission']['max_value'] = $this->request->data['end_range'];
					$this->request->data['Commission']['min_value'] = $min_range;
					$this->request->data['Commission']['max_value'] = $max_range;
					$this->request->data['Commission']['amount'] = $this->request->data['commission_amount'];
					$this->request->data['Commission']['commission_details'] = $this->request->data['commissionDetails'];
					//$this->request->data['Commission']['active'] = '1';
					$this->request->data['Commission']['cdate'] = time();
					$this->Commission->save($this->request->data);
					$this->Session->setFlash('Commission was successfully created...');
					$this->redirect('/admin/viewcommission/');
					}
					else {
						$this->redirect('/admin/viewcommission/');
					}
			
			}else{
		
				$getcommivalues = $this->Commission->findById($id);
				//echo "<pre>";print_r($getcommivalues);die;
				$this->set('getcommivalues',$getcommivalues);
			}
		}
		
		public function deletecommission ($id = NULL){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			if ($id != Null) {
				$this->loadModel('Commission');
				$this->Commission->deleteAll(array('id' => $id), false);
			}
			$this->paginate = array('conditions'=>array('Commission.id <>'=>0),'limit'=>10,'order'=>array('Commission.id'=>'desc'));
			$getcommivalue = $this->paginate('Commission');
			$pagecount = $this->params['paging']['Commission']['count'];
				
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcommivalue',$getcommivalue);
			$this->set('pagecount',$pagecount);
			$this->render('view_commission');
		}
		
		public function view_commission () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Commission');
			//$getcommivalue = $this->Commission->find('all');
			//echo "<pre>";print_r($getcommivalues);die;
			
			$this->paginate = array('conditions'=>array('Commission.id <>'=>0),'limit'=>10,'order'=>array('Commission.id'=>'desc'));
			$getcommivalue = $this->paginate('Commission');
			$pagecount = $this->params['paging']['Commission']['count'];
				
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcommivalue',$getcommivalue);
			$this->set('pagecount',$pagecount);
				
		
		}
		
		public function activatecommission ($id = NULL) {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Commission');
			$actvalue = explode('@', $id);
			//echo "<pre>";print_r($actvalue);die;
			if($actvalue[0]=='act'){
				$this->Commission->updateAll(array('active' => '0'), array('id' => $actvalue[1]));
				//$this->Commission->updateAll(array('active' => '1'), array('id' => $id));
			}else{
				$this->Commission->updateAll(array('active' => '1'), array('id' => $actvalue[1]));
			}
			$this->redirect('/admin/viewcommission/');
			
		}
		
		public function delivery_charges() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Deliverycharge');
			$this->paginate = array('conditions'=>array('Deliverycharge.id <>'=>0),'limit'=>10,'order'=>array('Deliverycharge.id'=>'asc'));
			$getchargeval = $this->paginate('Deliverycharge');
			$pagecount = $this->params['paging']['Deliverycharge']['count'];
			
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getchargeval',$getchargeval);
			$this->set('pagecount',$pagecount);
		
		}
		
		public function delivery_area() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
				$this->loadModel('Area');
			$this->loadModel('Deliverycharge');
			if(!empty($this->request->data)){
				//echo $id;die;
				$zonename = $this->request->data['zone_name'];
				
				$countarea = 0;
				$del_arealist = $this->Deliverycharge->find('all');
				foreach($del_arealist as $del_area){
				if($del_area['Deliverycharge']['name'] == $zonename){
						$countarea = 1;
					}
				}
				if($countarea == 0){
				    $this->request->data['Deliverycharge']['name'] = $zonename;
				    $this->request->data['Deliverycharge']['regulr_chrge'] = $this->request->data['delcharges']['regulr_chrge'];
				    $this->request->data['Deliverycharge']['expres_chrge'] = $this->request->data['delcharges']['expres_chrge'];
				    $this->Deliverycharge->save($this->request->data);
				}

				$this->redirect('/admin/deliverycharges/');
			}
			$arealist = $this->Area->find('all');
			$this->set('arealist',$arealist);
		
		}
		
		public function edit_delcharge ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Deliverycharge');
			$this->loadModel('Area');
			if(!empty($this->request->data)){
				//echo $id;die;
				
				$countryname = $this->request->data['zone_name'];
				
				$this->request->data['Deliverycharge']['id'] = $id;

				$this->request->data['Deliverycharge']['name'] = $countryname;
				$this->request->data['Deliverycharge']['regulr_chrge'] = $this->request->data['delcharges']['regulr_chrge'];
				$this->request->data['Deliverycharge']['expres_chrge'] = $this->request->data['delcharges']['expres_chrge'];
				$this->Deliverycharge->save($this->request->data);
				$this->redirect('/admin/deliverycharges/');

			}else{
				//echo "dd".$id;die;
				$getchargeval = $this->Deliverycharge->findById($id);
				//echo "<pre>";print_r($getchargeval);die;
				$this->set('getchargeval',$getchargeval);
			}
			$arealist = $this->Area->find('all');
			$this->set('arealist',$arealist);
		
		}
		
		public function delete_delcharge(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Deliverycharge');
			$id = $_REQUEST['id'];
			$prefix = $this->Deliverycharge->tablePrefix;
			$this->Deliverycharge->query("delete from ".$prefix."delivery_charges where id=".$id." ");
			
			echo 0;
			die;
		}
		
		public function delivery_countries() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Deliverycountries');
			$this->paginate = array('conditions'=>array('Deliverycountries.id <>'=>0),'limit'=>10,'order'=>array('Deliverycountries.id'=>'asc'));
			$getcntryval = $this->paginate('Deliverycountries');
			$pagecount = $this->params['paging']['Deliverycountries']['count'];
			
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcntryval',$getcntryval);
			$this->set('pagecount',$pagecount);
		
		}
		
		public function add_del_countries() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('State');
			$this->loadModel('Area');
			$this->loadModel('Allowedcountries');
			$this->loadModel('Deliverycountries');
			if(!empty($this->request->data)){
				//echo $id;die;

				$countryid = $this->request->data['dcountry'];
				$countryModel = $this->Allowedcountries->findByid($countryid);
				$countrycode = $countryModel['Allowedcountries']['code'];
				$countryname = $countryModel['Allowedcountries']['country'];

				$allowed_del_cntrys = $this->Deliverycountries->find('all');
				$countdel_cntry = 0;
				foreach($allowed_del_cntrys as $allowed_del_cntry){ 
					if($allowed_del_cntry['Deliverycountries']['dcountry'] == $countryname && $allowed_del_cntry['Deliverycountries']['darea'] == $this->request->data['delcountry']['darea'] && $allowed_del_cntry['Deliverycountries']['dzone'] == $this->request->data['delcountry']['dzone']){
						$countdel_cntry = 1;
					}
				}
				if($countdel_cntry == 0){
				    $this->request->data['Deliverycountries']['dcountry'] = $countryname;
				    $this->request->data['Deliverycountries']['dcountrycode'] = $countrycode;
				    $this->request->data['Deliverycountries']['darea'] = $this->request->data['delcountry']['darea'];
				    $this->request->data['Deliverycountries']['dcurrency'] = $this->request->data['delcountry']['dcurrency'];
				    $this->request->data['Deliverycountries']['dzone'] = $this->request->data['delcountry']['dzone'];
				    $this->Deliverycountries->save($this->request->data);
				}

				$allowed_states = $this->State->find('all');
				$countstate = 0;
				foreach($allowed_states as $allowed_state){
					if($allowed_state['State']['state'] == $this->request->data['delcountry']['darea']){
						$countstate = 1;
					}
				}
				if($countstate == 0){
					$this->request->data['State']['country_id'] = $countryid;
					$this->request->data['State']['state'] = $this->request->data['delcountry']['darea'];
					$this->State->save($this->request->data);
				}
				
				$statename = $this->request->data['delcountry']['darea'];
				$countryModel = $this->State->find('all',array('conditions'=>array('State.state'=> $statename)));
				$statecode = $countryModel[0]['State']['id'];
				
				$allowed_areas = $this->Area->find('all');
				$countarea = 0;
				foreach($allowed_areas as $allowed_area){
					if($allowed_area['Area']['area'] == $this->request->data['delcountry']['dzone']){
						$countarea = 1;
					}
				}
				if($countarea == 0){
					$this->request->data['Area']['state_id'] = $statecode;
					$this->request->data['Area']['area'] = $this->request->data['delcountry']['dzone'];
					$this->Area->save($this->request->data);
				}
				
				$this->redirect('/admin/deliverycountries/');
			}
			$getcntry = $this->Allowedcountries->find('all');
			$this->set('getcntry',$getcntry);
		}
		
		public function edit_del_countries ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('State');
			$this->loadModel('Area');
			$this->loadModel('Allowedcountries');
			$this->loadModel('Deliverycountries');
			if(!empty($this->request->data)){
				//echo $id;die;
				$this->request->data['Deliverycountries']['id'] = $id;

				$countryid = $this->request->data['dcountry'];
				$countryModel = $this->Allowedcountries->findByid($countryid);
				$countrycode = $countryModel['Allowedcountries']['code'];
				$countryname = $countryModel['Allowedcountries']['country'];

/*				$this->request->data['Deliverycountries']['dcountry'] = $countryname;
				$this->request->data['Deliverycountries']['dcountrycode'] = $countrycode;
				$this->request->data['Deliverycountries']['darea'] = $this->request->data['delcountry']['darea'];
				$this->request->data['Deliverycountries']['dcurrency'] = $this->request->data['delcountry']['dcurrency'];
				$this->request->data['Deliverycountries']['dzone'] = $this->request->data['delcountry']['dzone'];
				$this->Deliverycountries->save($this->request->data);
				
				$this->request->data['State']['country_id'] = $countrycode;
				$this->request->data['State']['state'] = $this->request->data['delcountry']['darea'];
				$this->State->save($this->request->data);
				
				$this->request->data['Area']['state_id'] = $countrycode;
				$this->request->data['Area']['area'] = $this->request->data['delcountry']['dzone'];
				$this->Area->save($this->request->data);*/
				
				$allowed_del_cntrys = $this->Deliverycountries->find('all');
				$countdel_cntry = 0;
				foreach($allowed_del_cntrys as $allowed_del_cntry){ 
					if($allowed_del_cntry['Deliverycountries']['dcountry'] == $countryname && $allowed_del_cntry['Deliverycountries']['darea'] == $this->request->data['delcountry']['darea'] && $allowed_del_cntry['Deliverycountries']['dzone'] == $this->request->data['delcountry']['dzone']){
						$countdel_cntry = 1;
					}
				}
				if($countdel_cntry == 0){
				    $this->request->data['Deliverycountries']['dcountry'] = $countryname;
				    $this->request->data['Deliverycountries']['dcountrycode'] = $countrycode;
				    $this->request->data['Deliverycountries']['darea'] = $this->request->data['delcountry']['darea'];
				    $this->request->data['Deliverycountries']['dcurrency'] = $this->request->data['delcountry']['dcurrency'];
				    $this->request->data['Deliverycountries']['dzone'] = $this->request->data['delcountry']['dzone'];
				    $this->Deliverycountries->save($this->request->data);
				}

				$allowed_states = $this->State->find('all');
				$countstate = 0;
				foreach($allowed_states as $allowed_state){
					if($allowed_state['State']['state'] == $this->request->data['delcountry']['darea']){
						$countstate = 1;
					}
				}
				if($countstate == 0){
					$this->request->data['State']['country_id'] = $countryid;
					$this->request->data['State']['state'] = $this->request->data['delcountry']['darea'];
					$this->State->save($this->request->data);
				}
				
				$statename = $this->request->data['delcountry']['darea'];
				$countryModel = $this->State->find('all',array('conditions'=>array('State.state'=> $statename)));
				$statecode = $countryModel[0]['State']['id'];
				
				$allowed_areas = $this->Area->find('all');
				$countarea = 0;
				foreach($allowed_areas as $allowed_area){
					if($allowed_area['Area']['area'] == $this->request->data['delcountry']['dzone']){
						$countarea = 1;
					}
				}
				if($countarea == 0){
					$this->request->data['Area']['state_id'] = $statecode;
					$this->request->data['Area']['area'] = $this->request->data['delcountry']['dzone'];
					$this->Area->save($this->request->data);
				}
				
				
				$this->redirect('/admin/deliverycountries/');
			}else{
				$getcntryval = $this->Deliverycountries->findById($id);
				$this->set('getcntryval',$getcntryval);
			}
			$getcntry = $this->Allowedcountries->find('all');
			$this->set('getcntry',$getcntry);
		}

		public function allowed_countries() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Allowedcountries');
			$this->paginate = array('conditions'=>array('Allowedcountries.id <>'=>0),'limit'=>10,'order'=>array('Allowedcountries.id'=>'asc'));
			$getcntry = $this->paginate('Allowedcountries');
			$pagecount = $this->params['paging']['Allowedcountries']['count'];
			
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcntry',$getcntry);
			$this->set('pagecount',$pagecount);
		
		}
		
		public function add_countries() {
			
			if(!$this->isauthorized())
			$this->redirect('/');
			$this->loadModel('Country');
			$this->loadModel('Allowedcountries');
			if(!empty($this->request->data)){
				//echo $id;die;

				$countryid = $this->request->data['dcountry'];
				$countryModel = $this->Country->findByid($countryid);
				$countryname = $countryModel['Country']['country'];
				$countrycode = $countryModel['Country']['code'];

				$this->request->data['Allowedcountries']['country'] = $countryname;
				$this->request->data['Allowedcountries']['country_id'] = $countryid;
				$this->request->data['Allowedcountries']['code'] = $countrycode;
				
				$allowed_cntrys = $this->Allowedcountries->find('all');
				$count = 0;
				foreach($allowed_cntrys as $allowed_cntry){
					if($allowed_cntry['Allowedcountries']['country'] == $countryname){
						$count = 1;
					}
				}
				if($count == 0){
					$this->Allowedcountries->save($this->request->data);
				}
				$this->redirect('/admin/allowcountries/');
			}
			$countrylist = $this->Country->find('all');
			$this->set('countrylist',$countrylist);
		}
		
		public function edit_countries ($id = NULL) {
			
			if(!$this->isauthorized())
			$this->redirect('/');
			$this->loadModel('Country');
			$this->loadModel('Allowedcountries');
			if(!empty($this->request->data)){
				//echo $id;die;
				$this->request->data['Allowedcountries']['id'] = $id;

				$countryid = $this->request->data['dcountry'];
				$countryModel = $this->Country->findByid($countryid);
				$countryname = $countryModel['Country']['country'];
				$countrycode = $countryModel['Country']['code'];

				$this->request->data['Allowedcountries']['country'] = $countryname;
				$this->request->data['Allowedcountries']['country_id'] = $countryid;
				$this->request->data['Allowedcountries']['code'] = $countrycode;
				$this->Allowedcountries->save($this->request->data);
				$this->redirect('/admin/allowcountries/');
			}else{
				$getcntry = $this->Allowedcountries->findById($id);
				$this->set('getcntry',$getcntry);
			}
			$countrylist = $this->Country->find('all');
			$this->set('countrylist',$countrylist);
		}

		public function delete_alcntry(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Allowedcountries');
			$id = $_REQUEST['id'];
			$prefix = $this->Allowedcountries->tablePrefix;
			$this->Allowedcountries->query("delete from ".$prefix."allowed_countries where id=".$id." ");
			
			echo 0;
			die;
		}

		public function delete_delcntry(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Deliverycountries');
			$id = $_REQUEST['id'];
			$prefix = $this->Deliverycountries->tablePrefix;
			$this->Deliverycountries->query("delete from ".$prefix."deliverycountries where id=".$id." ");
			
			echo 0;
			die;
		}
		
		public function specialdelivery() {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Cart');
			$this->loadModel('User');
			$this->loadModel('Item');
			$this->paginate = array('conditions'=>array('Cart.id <>'=>0),'limit'=>10,'order'=>array('Cart.id'=>'asc'));
			$getcharge = $this->paginate('Cart');
			$users_info = array();
			$items_info = array();
			foreach($getcharge as $uid){
			    $userinfo = $this->User->findById($uid['Cart']['user_id']);
			    $iteminfo = $this->Item->findById($uid['Cart']['item_id']);
			    array_push($users_info,$userinfo['User']);
			    array_push($items_info,$iteminfo['Item']);
			}
			$pagecount = $this->params['paging']['Cart']['count'];
			
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('users_info',$users_info);
			$this->set('items_info',$items_info);
			$this->set('getcharge',$getcharge);
			$this->set('pagecount',$pagecount);
		
		}
		
		public function edit_specialdelivery ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Item');
			$this->loadModel('Cart');
			if(!empty($this->request->data)){
				//echo $id;die;
				$this->request->data['Cart']['id'] = $id;

				$this->request->data['Cart']['shipping_status'] = 'enable';
				$this->request->data['Cart']['shipping_charg'] = $this->request->data['cart']['shipping_charg'];
				$this->Cart->save($this->request->data);
				$this->redirect('/admin/specialdelivery/');

			}else{
				//echo "dd".$id;die;
				$getcharge = $this->Cart->findById($id);
				$userinfo = $this->User->findById($getcharge['Cart']['user_id']);
				$iteminfo = $this->Item->findById($getcharge['Cart']['item_id']);
				$user_name = $userinfo['User']['first_name'];
				$item_name = $iteminfo['Item']['item_title'];
				
				$this->set('getcharge',$getcharge);
				$this->set('user_name',$user_name);
				$this->set('item_name',$item_name);
			}
		
		}
		
		public function addprice($price1 = NULL , $price2 = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Price');
			if(!empty($this->request->data)){
				//echo $id;die;
				$price1 = $this->request->data['pricerange']['from'];
				$price2 = $this->request->data['pricerange']['to'];
				//echo "<pre>";print_r($this->request->data);die;
				//$this->request->data['Price']['from'] = $this->request->data['pricerange']['from'];
				//$this->request->data['Price']['to'] = $this->request->data['pricerange']['to'];
				if($price1 < $price2){
				$this->request->data['Price']['from'] = $price1;
				$this->request->data['Price']['to'] = $price2;
				$this->request->data['Price']['cdate'] = time();
				$this->Price->save($this->request->data);
				$this->redirect('/admin/manage/price/');
				}
				else{
				$this->redirect('/admin/add/price/');	
				}
			}
		
		}
		public function editprice ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Price');
			if(!empty($this->request->data)){
				//echo $id;die;
				//echo "<pre>";print_r($this->request->data);die;
				$this->request->data['Price']['id'] = $id;
				//$this->request->data['Price']['from'] = $this->request->data['pricerange']['from'];
				//$this->request->data['Price']['to'] = $this->request->data['pricerange']['to'];
				$price1 = $this->request->data['pricerange']['from'];
				$price2 = $this->request->data['pricerange']['to'];
				if($price1 < $price2){
				$this->request->data['Price']['from'] = $price1;
				$this->request->data['Price']['to'] = $price2;
				$this->request->data['Price']['cdate'] = time();
				$this->Price->save($this->request->data);
				$this->redirect('/admin/manage/price/');
				}
				else{
				$this->redirect('/admin/manage/price/');	
				}
			}else{
				//echo "dd".$id;die;
				$getpriceval = $this->Price->findById($id);
				//echo "<pre>";print_r($getpriceval);die;
				$this->set('getpriceval',$getpriceval);
			}
		
		}
		
	
		
		public function manageseller () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Shop');
			$this->loadModel('User');
			$sval = $this->passedArgs['searchval'];
			
			$user_names = $this->User->find('all',array('conditions'=>array('User.first_name like'=>'%'.$sval.'%')));
			foreach($user_names as $usernames)
			{
				$user_ids[] = $usernames['User']['id'];
			}			
			if($sval)
			$this->paginate = array('conditions'=>array('OR'=>array('Shop.shop_name like'=>'%'.$sval.'%','Shop.paypal_id like'=>'%'.$sval.'%','Shop.user_id'=>$user_ids),'Shop.seller_status'=>'1', 'Shop.paypal_id <>'=>''), 'limit'=>10, 'order'=>array('Shop.id'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('Shop.seller_status'=>'1', 'Shop.paypal_id <>'=>''), 'limit'=>10, 'order'=>array('Shop.id'=>'desc'));
			$sellerModel = $this->paginate('Shop');
			$pagecount = $this->params['paging']['Shop']['count'];
			
			//echo "<pre>";print_r($getpriceval);die;
			$this->set('sellerModel',$sellerModel);
			$this->set('pagecount',$pagecount);
		
		}
		
		
		
		public function manageprice () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Price');
			$this->paginate = array('conditions'=>array('Price.id <>'=>0),'limit'=>10,'order'=>array('Price.id'=>'asc'));
			$getpriceval = $this->paginate('Price');
			$pagecount = $this->params['paging']['Price']['count'];
			
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getpriceval',$getpriceval);
			$this->set('pagecount',$pagecount);
		
		}

		public function deleteprice(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Price');
			$id = $_REQUEST['id'];
			$prefix = $this->Price->tablePrefix;
		
			$this->Price->query("delete from ".$prefix."prices where id=".$id." ");
			
			echo 0;
			die;
		}
		
		
		public function managecurrency () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Forexrate');
		
			$this->paginate = array('limit'=>10,'order'=>array('Forexrate.id'=>'asc'));
			$getcurrencyval = $this->paginate('Forexrate');
			$pagecount = $this->params['paging']['Forexrate']['count'];
			$this->set('getcurrencyval',$getcurrencyval);
			$this->set('pagecount',$pagecount);
			//print_r($getcurrencyval); die;

			
		}
			
		public function addcurrency () {
			
			
			if(!$this->isauthorized())
				$this->redirect('/');
				$this->loadModel('Forexrate');
				
				if(!empty($this->request->data)){
				$currency_code = $this->request->data['Forexrate']['Currency Code'];
				$count = $this->Forexrate->find('count',array('conditions'=>array('currency_code' => $currency_code)));

				if($count == 0) {
				$this->request->data['Forexrate']['currency_code'] = $currency_code;
				//$this->request->data['Forexrate']['currency_name'] = $this->request->data['Forexrate']['Currency Name'];
				//$this->request->data['Forexrate']['currency_symbol'] = $this->request->data['Forexrate']['Currency Symbol'];
				$this->request->data['Forexrate']['currency_name'] = $_SESSION['currency_name'];
				$this->request->data['Forexrate']['currency_symbol'] = $_SESSION['currency_symbl'];
				$this->request->data['Forexrate']['price'] = $this->request->data['Forexrate']['Rate'];
				$this->request->data['Forexrate']['status'] = $this->request->data['Forexrate']['Status'];
				$this->Forexrate->save($this->request->data);
				$this->redirect('/admin/manage/currency/');
				}
				else{
				$this->Session->setFlash('Currency already exists');
				$this->redirect('/admin/add/currency/');
				
				}
			
			}
			//echo $hex;die;
		
		}

		public function editcurrency ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Forexrate');
			//$data = $this->Forexrate->find('all');
			///print_r($data); die;
			if(!empty($this->request->data)){
				//echo $id;die;
			   // echo "<pre>";print_r($this->request->data);die;
			
				$price = $this->request->data['forexrate'];
				//print_r($price); die;
				foreach($price as $key => $prices)
				{
					$prefix = $this->Forexrate->tablePrefix;
					//print_r( $prices); 
					echo '<br/>';
					if ($prices != 1){
						$this->Forexrate->query("UPDATE ".$prefix."forexrates SET price='$prices' WHERE currency_code = '$key' AND status = 'enable' AND price != '1';");
					}
				}
		
			}	
			$this->redirect('/admin/manage/currency/');
		
		}
		
		public function addcolors () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Color');
			if(!empty($this->request->data)){
				//echo $id;die;
				$rgbval1 = $this->request->data['rgbval1'];
				$rgbval2 = $this->request->data['rgbval2'];
				$rgbval3 = $this->request->data['rgbval3'];
				
				$rgbval = $rgbval1.','.$rgbval2.','.$rgbval3;
				
				//echo "<pre>";print_r($this->request->data);
				
				$this->request->data['Color']['color_name'] = $this->request->data['Color']['colorname'];
			
				$this->request->data['Color']['rgb'] =$rgbval;
				
				$rgb = array($rgbval);
				//echo "<pre>";print_r($rgb);die;
				$hex = $this->rgb2hex($rgb);
				$this->request->data['Color']['color_hex'] =$hex;
				
				//echo $rgbval;
				//echo $this->request->data['Color']['colorname'];die;
				
				$this->request->data['Color']['cdate'] = time();
				$this->Color->save($this->request->data);
				$this->redirect('/admin/manage/colors/');
			}
			
			//echo $hex;die;
		
		}
		public function managecolors () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Color');
			$this->paginate = array('conditions'=>array('Color.id <>'=>0),'limit'=>10,'order'=>array('Color.id'=>'asc'));
			$getcolorval = $this->paginate('Color');
			$pagecount = $this->params['paging']['Color']['count'];
				
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcolorval',$getcolorval);
			$this->set('pagecount',$pagecount);
		}
		
		public function editcolor ($id = NULL) {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Color');
			if(!empty($this->request->data)){
				//echo $id;die;
				//echo "<pre>";print_r($this->request->data);die;
				$this->request->data['Color']['id'] = $id;
				$rgbval1 = $this->request->data['rgbval1'];
				$rgbval2 = $this->request->data['rgbval2'];
				$rgbval3 = $this->request->data['rgbval3'];
				
				$rgbval = $rgbval1.','.$rgbval2.','.$rgbval3;
				
				//echo "<pre>";print_r($this->request->data);
				
				$this->request->data['Color']['color_name'] = $this->request->data['Color']['colorname'];
			
				$this->request->data['Color']['rgb'] =$rgbval;
				
				$rgb = array($rgbval);
				$hex = $this->rgb2hex($rgb);
				$this->request->data['Color']['color_hex'] =$hex;
				
				//echo $rgbval;
				//echo $this->request->data['Color']['colorname'];die;
				
				$this->request->data['Color']['cdate'] = time();
				$this->Color->save($this->request->data);
				$this->redirect('/admin/manage/colors/');
			}else{
				//echo "dd".$id;die;
				$getcolorval = $this->Color->findById($id);
				//echo "<pre>";print_r($getcolorval);die;
				$this->set('getcolorval',$getcolorval);
			}
		
		}
		public function deletecolor(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Color');
			$id = $_REQUEST['id'];
			$prefix = $this->Color->tablePrefix;
		
			$this->Color->query("delete from ".$prefix."colors where id=".$id." ");
				
			echo 0;
			die;
		}
		
		
		/* function hex2rgb($hex) {
			$hex = str_replace("#", "", $hex);
		
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgb = array($r, $g, $b);
			//return implode(",", $rgb); // returns the rgb values separated by commas
			return $rgb; // returns an array with the rgb values
		} */
		
		
		
		function rgb2hex($rgb) {
			//echo "<pre>";print_r($rgb);die;
			$rgbv = explode(',',$rgb[0]);
			//echo "<pre>";print_r($rgbv);die;
			$hex = "#";
			$hex .= str_pad(dechex($rgbv[0]), 2, "0", STR_PAD_LEFT);
			$hex .= str_pad(dechex($rgbv[1]), 2, "0", STR_PAD_LEFT);
			$hex .= str_pad(dechex($rgbv[2]), 2, "0", STR_PAD_LEFT);
			//echo $hex;die;
			return $hex; // returns the hex value including the number sign (#)
		}
		
		
		public function addcoupon () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Coupon');
			$coupon_use = $this->request->data['onetimeuse'];
			if(!empty($this->request->data)){
				//echo "<pre>";print_r($this->request->data);die;
				$code = $this->request->data['Coupon']['code'];
				$getcouponval = $this->Coupon->findByCouponcode($code);
				//echo "<pre>";print_r($getcouponval);die;
				
				
				
				if(empty($getcouponval)){
					
					$merchant_id = $this->request->data['merchant_id'];
					
					if($coupon_use=="on")
					$this->request->data['Coupon']['one_time_use'] = "yes";
					else
					$this->request->data['Coupon']['one_time_use'] = "no";
					
					$merchant_ids = json_encode($merchant_id);
					$this->request->data['Coupon']['couponcode'] = $this->request->data['Coupon']['code'];
					$this->request->data['Coupon']['coupontype'] = $this->request->data['dis_type'];
					$this->request->data['Coupon']['validrange'] = $this->request->data['Coupon']['range'];
					$this->request->data['Coupon']['totalrange'] = $this->request->data['Coupon']['range'];
					$this->request->data['Coupon']['select_merchant'] = $this->request->data['select_merchant'];
					$this->request->data['Coupon']['merchant_ids'] = $merchant_ids;
					$this->request->data['Coupon']['validfromdate'] = $this->request->data['Coupon']['fromdate'];
					$this->request->data['Coupon']['validtodate'] = $this->request->data['Coupon']['enddate'];
					$this->request->data['Coupon']['discount_amount'] = $this->request->data['Coupon']['amount'];
						
					$this->request->data['Coupon']['cdate'] = time();
					$this->Coupon->save($this->request->data);
					$this->redirect('/admin/managecoupon/');

				}else{
					$this->redirect('/admin/addcoupon/');
				}
			}else{
				$this->loadModel('Shop');
				$getmerchant_name = $this->Shop->find('all',array('conditions'=>array("not" => array ( "Shop.paypal_id" => '',"Shop.shop_name"=>NULL))));
				$this->set('getmerchant_name',$getmerchant_name);
				//echo "<pre>";print_r($getmerchant_name);die;
			}
				
			//echo $hex;die;
		
		}
		public function managecoupon () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Coupon');
			$this->paginate = array('conditions'=>array('Coupon.id <>'=>0),'limit'=>10,'order'=>array('Coupon.id'=>'desc'));
			$getcouponval = $this->paginate('Coupon');
			$pagecount = $this->params['paging']['Coupon']['count'];
		
			//echo "<pre>";print_r($getcommivalue);die;
			$this->set('getcouponval',$getcouponval);
			$this->set('pagecount',$pagecount);
		}
		
		public function generatecoupons () {
			$generatevalue = $this->Urlfriendly->get_uniquecode('8');
			echo $generatevalue;die;
		}
		
		
		
		public function deletecoupon(){
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Coupon');
			$id = $_REQUEST['id'];
			$prefix = $this->Coupon->tablePrefix;
		
			$this->Coupon->query("delete from ".$prefix."coupons where id=".$id." ");
		
			echo 0;
			die;
		}
		public function editcoupon ($id = NULL, $couponcode = NULL) {
//echo $couponcode; echo $id; die;

			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Coupon');
			if(!empty($this->request->data)){
				
				$merchant_id = $this->request->data['merchant_id'];
				$merchant_ids = json_encode($merchant_id);
				$this->request->data['Coupon']['id'] = $id;
				//$this->request->data['Coupon']['couponcode'] = $this->request->data['Coupon']['code'];
				$this->request->data['Coupon']['couponcode'] = $couponcode;
				$this->request->data['Coupon']['coupontype'] = $this->request->data['dis_type'];
				$this->request->data['Coupon']['totalrange'] = $this->request->data['Coupon']['range'];
				$this->request->data['Coupon']['validrange'] = $this->request->data['Coupon']['range'];
				$this->request->data['Coupon']['validfromdate'] = $this->request->data['Coupon']['fromdate'];
				$this->request->data['Coupon']['select_merchant'] = $this->request->data['select_merchant'];
				$this->request->data['Coupon']['merchant_ids'] = $merchant_ids;
				$this->request->data['Coupon']['validtodate'] = $this->request->data['Coupon']['enddate'];
				$this->request->data['Coupon']['discount_amount'] = $this->request->data['Coupon']['amount'];
				$this->request->data['Coupon']['cdate'] = time();
				$this->Coupon->save($this->request->data);
				$this->redirect('/admin/managecoupon/');
				
			}else{
				$getcouponval = $this->Coupon->findById($id);
				$this->set('getcouponval',$getcouponval);
				$this->loadModel('Shop');
				$getmerchant_name = $this->Shop->find('all',array('conditions'=>array("not" => array ( "Shop.paypal_id" => '',"Shop.shop_name"=>NULL))));
				$this->set('getmerchant_name',$getmerchant_name);
				//echo "<pre>";print_r($getmerchant_name);die;
			}
		
		}
		
		
		public function couponlog () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Logcoupon');
			$this->loadModel('Coupon');
			$this->loadModel('Orders');
			$this->paginate = array('conditions'=>array('Logcoupon.id <>'=>0),'limit'=>10,'order'=>array('Logcoupon.id'=>'desc'));
			$getlogcouponval = $this->paginate('Logcoupon');
			foreach($getlogcouponval as $getlogcoupon)
			{
				$coupon_ids[] = $getlogcoupon['Logcoupon']['coupon_id'];
				$user_ids[] = $getlogcoupon['Logcoupon']['user_id'];
				$cdate[] = $getlogcoupon['Logcoupon']['cdate'];
			}
			
			$order_det = $this->Orders->find('all',array('conditions'=>array('Orders.coupon_id'=>$coupon_ids,'Orders.userid'=>$user_ids,'Orders.orderdate'=>$cdate)));
			$this->set('order_det',$order_det);
			$coupon_values = $this->Coupon->find('all',array('conditions'=>array('Coupon.id'=>$coupon_ids)));
			$this->set('coupon_values',$coupon_values);
			
			$pagecount = $this->params['paging']['Logcoupon']['count'];
		
			//echo "<pre>";print_r($getlogcouponval);die;
			$this->set('getlogcouponval',$getlogcouponval);
			$this->set('pagecount',$pagecount);
		}
		
		
		
		
		public function giftcard () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Sitesetting');
			$this->set('title_for_layout','Gift card');
			
			if(!empty($this->request->data)){
				
				
				$giftcardd['title'] = trim($this->request->data['title']);
				$giftcardd['description'] = trim($this->request->data['description']);
				$giftcardd['amounts'] = trim($this->request->data['amounts']);
				$giftcardd['image'] = $this->request->data['image'];
				$giftcardd['time'] = time();
				
			$giftcarde = json_encode($giftcardd);
			$this->Sitesetting->updateAll(array('giftcard' => "'$giftcarde'"), array('id' => '1'));
			
			$this->redirect('/giftcard/');
			
			}else{
				//$giftDetails = $this->Giftcard->find('first');
				$giftDetails = $this->Sitesetting->find('first');
				
				$this->set('giftDetails',json_decode($giftDetails['Sitesetting']['giftcard'],true));
				
				
			}
				
			
			
			
			
			
			/* $this->loadModel('Giftcard');
			if(!$this->isauthorized())
				$this->redirect('/');
			if(!empty($this->request->data)){
				//echo "<pre>";print_r($this->request->data);die;
				$this->request->data['Giftcard']['id'] = $id;
				$this->request->data['Giftcard']['title'] = $this->request->data['title'];
				$this->request->data['Giftcard']['description'] = $this->request->data['description'];
				$this->request->data['Giftcard']['amount'] = $this->request->data['amounts'];
				$this->request->data['Giftcard']['expiry_days'] = $this->request->data['expiry_days'];
				$this->request->data['Giftcard']['image'] = $this->request->data['image'];
				$this->request->data['Giftcard']['cdate'] = time();
				$this->Giftcard->save($this->request->data);
				$this->redirect('/giftcard/');
			}else{
				$giftDetails = $this->Giftcard->find('first');
				//echo "<pre>";print_r($giftDetails);die;
				$this->set('giftDetails',$giftDetails);
				
			}  */
			
		}
		
		
		public function giftcardlog () {
			
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Giftcard');
			$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$giftcardlogval = $this->paginate('Giftcard');
			$pagecount = $this->params['paging']['Giftcard']['count'];
		
			//echo "<pre>";print_r($getlogcouponval);die;
			$this->set('giftcardlogval',$giftcardlogval);
			$this->set('pagecount',$pagecount);
		}
		
		
		public function searchitemkeyword () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Item');
			$this->loadModel('Category');
			$cate_datass = $this->Category->find('all');
				
			foreach($cate_datass as $catee){
				$catDet[$catee['Category']['id']] = $catee['Category']['category_name'];
			}
				
			$startdate = $_POST['startdate'];
			$enddate = $_POST['enddate'];
			$searchkywrd = $_POST['serchkeywrd'];
				
			if(!empty($startdate) && !empty($enddate) && !empty($searchkywrd)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'publish'),'order'=>array('Item.id'=>'desc'));
			}elseif(!empty($searchkywrd)){
				$this->paginate =  array('conditions'=>array('OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'publish'),'limit'=>10,'order'=>array('Item.id'=>'asc'));
			}elseif(!empty($startdate) && !empty($enddate)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'Item.status'=>'publish'),'order'=>array('Item.id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('Item.status'=>'publish'),'limit'=>10,'order'=>array('Item.id'=>'desc'));
			}
				
			//$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$itemDetss = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
		
			//echo "<pre>";print_r($itemDetss);die;
			$this->set('catDet',$catDet);
			$this->set('item_datas',$itemDetss);
			$this->set('pagecount',$pagecount);
			$this->set('searchkywrd',$searchkywrd);
		}
		
			public function searchnonapproveditems () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Item');
			$this->loadModel('Category');
			$cate_datass = $this->Category->find('all');
				
			foreach($cate_datass as $catee){
				$catDet[$catee['Category']['id']] = $catee['Category']['category_name'];
			}
				
			$startdate = $_POST['startdate'];
			$enddate = $_POST['enddate'];
			$searchkywrd = $_POST['serchkeywrd'];
				
			if(!empty($startdate) && !empty($enddate) && !empty($searchkywrd)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'draft'),'order'=>array('Item.id'=>'desc'));
			}elseif(!empty($searchkywrd)){
				$this->paginate =  array('conditions'=>array('OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'draft'),'limit'=>10,'order'=>array('Item.id'=>'asc'));
			}elseif(!empty($startdate) && !empty($enddate)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'Item.status'=>'draft'),'order'=>array('Item.id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('Item.status'=>'draft'),'limit'=>10,'order'=>array('Item.id'=>'desc'));
			}
				
			//$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$itemDetss = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
		
			//echo "<pre>";print_r($itemDetss);die;
			$this->set('catDet',$catDet);
			$this->set('item_datas',$itemDetss);
			$this->set('pagecount',$pagecount);
			$this->set('searchkywrd',$searchkywrd);
		}		

		public function searchaffiliate () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Item');
			$this->loadModel('Category');
			$cate_datass = $this->Category->find('all');
				
			foreach($cate_datass as $catee){
				$catDet[$catee['Category']['id']] = $catee['Category']['category_name'];
			}
				
			$startdate = $_POST['startdate'];
			$enddate = $_POST['enddate'];
			$searchkywrd = $_POST['serchkeywrd'];
				
			if(!empty($startdate) && !empty($enddate) && !empty($searchkywrd)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'things'),'order'=>array('Item.id'=>'desc'));
			}elseif(!empty($searchkywrd)){
				$this->paginate =  array('conditions'=>array('OR'=>array('Item.item_title like'=>'%'.$searchkywrd.'%','Item.id like'=>'%'.$searchkywrd.'%'),'Item.status'=>'things'),'limit'=>10,'order'=>array('Item.id'=>'asc'));
			}elseif(!empty($startdate) && !empty($enddate)){
				$startdate = date("Y-m-d H:i:s", strtotime($startdate));
				$enddate =  date("Y-m-d H:i:s", strtotime($enddate));
				$this->paginate =  array('conditions'=>array('Item.created_on BETWEEN ? AND ? '=>array($startdate, $enddate),'Item.status'=>'things'),'order'=>array('Item.id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('Item.status'=>'things'),'limit'=>10,'order'=>array('Item.id'=>'desc'));
			}
				
			//$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$itemDetss = $this->paginate('Item');
			$pagecount = $this->params['paging']['Item']['count'];
		
			//echo "<pre>";print_r($itemDetss);die;
			$this->set('catDet',$catDet);
			$this->set('item_datas',$itemDetss);
			$this->set('pagecount',$pagecount);
			$this->set('searchkywrd',$searchkywrd);
		}
		
		public function searchsellerkeyword (){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Shop');
			$this->loadModel('User');
			
			$searchkywrd = $_POST['serchkeywrd'];
			
			$user_names = $this->User->find('all',array('conditions'=>array('User.first_name like'=>'%'.$searchkywrd.'%')));
			foreach($user_names as $usernames)
			{
				$user_ids[] = $usernames['User']['id'];
			}
			
			if(!empty($searchkywrd)){
				$this->paginate =  array('conditions'=>array('OR'=>array('Shop.shop_name like'=>'%'.$searchkywrd.'%','Shop.paypal_id like'=>'%'.$searchkywrd.'%','Shop.user_id'=>$user_ids),'Shop.paypal_id <>'=>'', 'Shop.seller_status'=>'1'),'limit'=>10,'order'=>array('Shop.id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('Shop.paypal_id <>'=>'', 'Shop.seller_status'=>'1'),'limit'=>10,'order'=>array('Shop.id'=>'desc'));
			}
			
			//$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$shopDetss = $this->paginate('Shop');
			$pagecount = $this->params['paging']['Shop']['count'];
			
			//echo "<pre>";print_r($itemDetss);die;
			$this->set('shop_datas',$shopDetss);
			$this->set('pagecount',$pagecount);
			$this->set('searchkywrd',$searchkywrd);
		}
		
		
		function change_currency_status ($currId,$status) {
			
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Forexrate');
			
			$prefix = $this->Forexrate->tablePrefix;
			//echo $status; 	
			//echo $prefix; die;
			if ($status == 'disable') {
				$this->Forexrate->query("UPDATE ".$prefix."forexrates SET status='enable' WHERE id = ".$currId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = "<button class='btn btn-success' onclick='changeCurrencyStatus(".$currId.",\"enable\");'>Disable</button>";
			}else {
				$this->Forexrate->query("UPDATE ".$prefix."forexrates SET status='disable' WHERE id = ".$currId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = "<button class='btn btn-warning' onclick='changeCurrencyStatus(".$currId.",\"disable\");'>Enable</button>";
			}
			
			echo $result;
		
	}

		

		function currency_code($currency) {
			
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Forexrate');
//$currency = 'BRL';
			$currency_name = array('KWD' => 'Kuwaiti Dinar','SAR' => 'Saudi Riyal','AUD' => 'Australian Dollar', 'BRL' => 'Brazilian Real', 'CAD' => 'Canadian Dollar', 'CZK' => 'Czech Koruna', 'DKK' => 'Danish Krone', 'EUR' => 'Euro', 'HKD' => 'Hong Kong Dollar', 'HUF' => 'Hungarian Forint', 'ILS' => 'Israeli New Sheqel', 'JPY' => 'Japanese Yen', 'MYR' => 'Malaysian Ringgit', 'MXN' => 'Mexican Peso', 'NOK' => 'Norwegian Krone', 'NZD' => 'New Zealand Dollar', 'PHP' => 'Philippine Peso', 'PLN' => 'Polish Zloty', 'GBP' => 'Pound Sterling', 'RUB' => 'Russian Ruble', 'SGD' => 'Singapore Dollar', 'SEK' => 'Swedish Krona', 'CHF' => 'Swiss Franc', 'TWD' => 'Taiwan New Dollar', 'THB' => 'Thai Baht', 'TRY' => 'Turkish Lira', 'USD' => 'U.S. Dollar');
	
			$currency_symbol = array('KWD' => 'K.D.','SAR' => 'Riyal','AUD' => '$', 'BRL' => 'R$', 'CAD' => '$', 'CZK' => 'Kč', 'DKK' => 'kr.', 'EUR' => '€', 'HKD' => '$', 'HUF' => 'Ft', 'ILS' => '₪', 'JPY' => '¥', 'MYR' => 'RM', 'MXN' => 'Mex$', 'NOK' => 'kr', 'NZD' => '$', 'PHP' => '₱', 'PLN' => 'zł', 'GBP' => '£', 'RUB' => 'руб', 'SGD' => 'S$', 'SEK' => 'kr', 'CHF' => 'SFr.', 'TWD' => '$', 'THB' => '฿', 'TRY' => 'も', 'USD' => '$');

			$_SESSION['currency_name'] = $currency_name[''.$currency.''];

			$_SESSION['currency_symbl'] =  $currency_symbol[''.$currency.''];
		//$this->set('currency_name', $currency_name[''.$currency.'']);
		
	}


	//Author : saravana pandian Date: 27-05-2014 Reason: Default Language setting
		function mobile_settings()
		{
		if(!$this->isauthorized())
		$this->redirect('/');			
		$this->loadModel('Sitesetting');			
			$mobile_apps = $this->Sitesetting->find('first');
			$mobile_app_lang = $mobile_apps['Sitesetting']['mobile_settings'];
			$mobile_lang = json_decode($mobile_app_lang,true);
			$this->set('mobile_lang',$mobile_lang);
		if(!empty($this->request->data)){
			$language = $this->request->data['language'];
			$mobileSetting['language'] = $language;
			$mobileSetting = json_encode($mobileSetting);
			$this->request->data['Sitesetting']['id'] = 1;
			$this->request->data['Sitesetting']['mobile_settings'] = $mobileSetting;
			if($this->Sitesetting->save($this->request->data))
			{
			$this->Session->setFlash('saved successfully');
			$this->redirect('/admin/mobile/settings');
			}
			else
			$this->Session->setFlash('error');			
		}
		
		}

		public function contact() {
			
			$this->loadModel('Help');		
			
			$contacts = $this->Help->find('all');
				foreach($contacts as $contacts) {
					$contact = $contacts['Help']['contact'];
				}
			
			$this->set('contact',$contact);
			
			if(!empty($this->request->data)) {
				$address = $this->request->data['contact']['contact'];
				$this->Help->updateAll(array('contact' => "'$address'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/contact');
			}
			
		}

		public function terms_sale() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_termsofSale'];
					$sub = $sale['Help']['sub_termsofSale'];
				}
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			if(!empty($this->request->data)) {
				$main = $this->request->data['sale']['main'];
				$sub = $this->request->data['sale']['sub'];
				$this->Help->updateAll(array('main_termsofSale' => "'$main'",'sub_termsofSale' => "'$sub'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/terms_sale');
			}
			
		}

		public function terms_service() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_termsofService'];
					$sub = $sale['Help']['sub_termsofService'];
				}
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			if(!empty($this->request->data)) {
				$main = $this->request->data['service']['main'];
				$sub = $this->request->data['service']['sub'];
				$this->Help->updateAll(array('main_termsofService' => "'$main'",'sub_termsofService' => "'$sub'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/terms_service');
				
			}
			
		}

		public function privacy() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_privacy'];
					$sub = $sale['Help']['sub_privacy'];
				}
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			if(!empty($this->request->data)) {
				$main = $this->request->data['privacy']['main'];
				$sub = $this->request->data['privacy']['sub'];
				$this->Help->updateAll(array('main_privacy' => "'$main'",'sub_privacy' => "'$sub'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/privacy');
			}
			
		}

		public function terms_merchant() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_termsofMerchant'];
					$sub = $sale['Help']['sub_termsofMerchant'];
				}
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			if(!empty($this->request->data)) {
				$main = $this->request->data['merchant']['main'];
				$sub = $this->request->data['merchant']['sub'];
				
				$this->Help->updateAll(array('main_termsofMerchant' => "'$main'",'sub_termsofMerchant' => "'$sub'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/terms_merchant');
			}
			
		}

		public function copyright() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_copyright'];
					$sub = $sale['Help']['sub_copyright'];
				}
			
			$this->set('main',$main);
			$this->set('sub',$sub);
			
			if(!empty($this->request->data)) {
				$main = $this->request->data['copyright']['main'];
				$sub = $this->request->data['copyright']['sub'];
				
				$this->Help->updateAll(array('main_copyright' => "'$main'",'sub_copyright' => "'$sub'"));
				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/copyright');
				
			}
			
		}

		public function faq() {
			
			$this->loadModel('Help');		
			
			$sale = $this->Help->find('all');
				foreach($sale as $sale) {
					$main = $sale['Help']['main_faq'];
					$sub = $sale['Help']['sub_faq'];
					
				}
			
			$this->set('sub',$sub);
			$this->set('main',$main);
			if(!empty($this->request->data)) {
				$main = $this->request->data['faq']['main'];
				$sub = $this->request->data['faq']['sub'];
				
				$this->Help->updateAll(array('main_faq' => "'$main'" , 'sub_faq' => "'$sub'"));

				$this->Session->setflash("updated Successfully");
				$this->redirect('/admin/faq');
			}
			
		}
		
		function edituser($id)
		{
			$this->loadModel('User');
			$user_datas = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
			$this->set('user_datas',$user_datas);
			
			$admin_menus_list = $user_datas['User']['admin_menus'];
			$this->set('admin_menus_list',$admin_menus_list);
			
				$this->loadModel('Countries');
				$countries = $this->Countries->find('all');
 				//print_r($countries);die;
				$this->set('countries',$countries);			
			if(!empty($this->request->data))
			{
				$username =  $this->request->data['signup']['username'];
				$firstname = $this->request->data['signup']['firstname'];
				//$lastname = $this->request->data['signup']['lastname'];
				$email = $this->request->data['signup']['email'];
				$password = $this->request->data['signup']['password'];
				if($user_datas['User']['password']!=$password)
				$pass_word = $this->Auth->password($password);
				else
				$pass_word = $this->request->data['signup']['password'];
				
				if($this->request->data['usr_access']=='moderate')
				{
					$userlevel = 'god';
					if($this->request->data['signup']['menulist']=="")
					{
						$admin_menu_default = "Home";
						$admin_default = json_encode($admin_menu_default);
						$admin_menu_list = $admin_default;
					}
					else
						$admin_menu_list = $this->request->data['signup']['menulist'];
				}
				else
				$userlevel = $this->request->data['usr_access'];				
				
				$this->User->updateAll(array('User.first_name'=>"'$firstname'",'User.email'=>"'$email'",'User.password'=>"'$pass_word'",'User.user_level'=>"'$userlevel'",'User.admin_menus'=>"'$admin_menu_list'"),array('User.id'=>$id,'User.username'=>$username));
				$this->redirect('/admin/user/management/');
			}
			
		}
		
		function merchant_payment_search()
		{
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			$sval = $_POST['sval'];
			
			$sdate = strtotime($_POST['stdate']);
			$edate = strtotime($_POST['eddate']);
		
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$sval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}
			if(!empty($sdate) && !empty($edate) && !empty($sval))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('NOT' => array('Orders.status' => array('Shipped','Delivered')),'Orders.orderdate BETWEEN ? AND ?' =>array($startdate,$enddate),'OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sval))
			{
				$this->paginate = array('conditions'=>array('NOT' => array('Orders.status' => array('Shipped','Delivered')),'OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sdate) && !empty($edate))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('NOT' => array('Orders.status' => array('Shipped','Delivered')),'Orders.orderdate BETWEEN ? AND ?' =>array($startdate,$enddate)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			$getpayval = $this->paginate('Orders');
			
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];

					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip >= $min_val && $totcostreduceShip <= $max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $pay['Orders']['totalcost']/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('usernames',$usernames);
			$this->set('order_currency',$order_currency);
			$this->set('pagecount',$pagecount);		
			$this->set('sval',$sval);
		}
		
		
		public function merchant_payment_ship_search () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			$sval = $_POST['sval'];
			$sdate = strtotime($_POST['stdate']);
			$edate = strtotime($_POST['eddate']);
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$sval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}			
			if(!empty($sdate) && !empty($edate) && !empty($sval))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('Orders.status'=>'Shipped','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate),'OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sval))
			{
				$this->paginate = array('conditions'=>array('Orders.status'=>'Shipped','OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sdate) && !empty($edate))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);			
				$this->paginate = array('conditions'=>array('Orders.status'=>'Shipped','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}			
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			//echo "<pre>";print_r($getpayval);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];

					//$order_totalcost[] = $pay['Orders']['totalcost'];
					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip >= $min_val && $totcostreduceShip <= $max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $pay['Orders']['totalcost']/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
					 $order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
					$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('usernames',$usernames);
			$this->set('order_currency',$order_currency);
			$this->set('sval',$sval);
			$this->set('pagecount',$pagecount);
		
		}		
		
		public function merchant_payment_deliver_search () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			//$this->paginate =
			$sval = $_POST['sval'];
			$sdate = strtotime($_POST['stdate']);
			$edate = strtotime($_POST['eddate']);		
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$sval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}				
			if(!empty($sdate) && !empty($edate) && !empty($sval))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('Orders.status'=>'Delivered','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate),'OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sval))
			{
				$this->paginate = array('conditions'=>array('Orders.status'=>'Delivered','OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sdate) && !empty($edate))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('Orders.status'=>'Delivered','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}				
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
			
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));	
			//echo "<pre>";print_r($getpayval);die;
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$order_totalcostShipping_ognl[$orderIddd] = $pay['Orders']['totalCostshipp'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					//$order_totalcost[] = $totcostreduceShip;
					$order_totalcost[$orderIddd] = $pay['Orders']['totalcost'] - $pay['Orders']['admin_commission'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];
					
					/* foreach($commiDetails as $commi){
					$min_val = $commi['Commission']['min_value'];
					$max_val =  $commi['Commission']['max_value'];
					if($totcostreduceShip>=$min_val && $totcostreduceShip<=$max_val){
						if($commi['Commission']['type'] == '%'){
							//echo (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
							//die;
							$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
							$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							
						}else{
							$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
						}
					}
					}
					/* if($commiDetails['Commission']['type'] == 'Percentage'){
						$order_totalcost[] = $totcostreduceShip/$commiDetails['Commission']['amount'];
					}else{
						$order_totalcost[] = $totcostreduceShip-$commiDetails['Commission']['amount'];
					} */
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			
			//echo "<pre>";print_r($order_totalcost);die;
			//$this->paginate =  array('conditions'=>array('User.id'=>$ordermerchant_id),'limit'=>10,'order'=>array('User.id'=>'desc'));
			//$getitemuser = $this->paginate('User');
			//$pagecount = $this->params['paging']['User']['count'];
		
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_currency',$order_currency);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('order_totalcostShipping_ognl',$order_totalcostShipping_ognl);
			$this->set('usernames',$usernames);
			$this->set('sval',$sval);
			$this->set('pagecount',$pagecount);
		
		}	
		
		public function merchant_payment_paid_search () {
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('User');
			$this->loadModel('Orders');
			$this->loadModel('Commission');
			$this->set('title_for_layout','Orders');
			
			$sval = $_POST['sval'];
			$sdate = strtotime($_POST['stdate']);
			$edate = strtotime($_POST['eddate']);			
			$merchant_user = $this->User->find('all',array('conditions'=>array('User.username_url like'=>'%'.$sval.'%')));
			foreach($merchant_user as $merchants)
			{
				$merchant_ids[] = $merchants['User']['id'];
			}
						
			if(!empty($sdate) && !empty($edate) && !empty($sval))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('Orders.status'=>'Paid','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate),'OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sval))
			{
				$this->paginate = array('conditions'=>array('Orders.status'=>'Paid','OR'=>array('Orders.orderid like'=>'%'.$sval.'%','Orders.merchant_id'=>$merchant_ids)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}
			else if(!empty($sdate) && !empty($edate))
			{
				$startdate = date('Y-m-d 24:00:00',$sdate);
				$enddate = date('Y-m-d 24:00:00',$edate);
				$startdate = strtotime($startdate);
				$enddate = strtotime($enddate);				
				$this->paginate = array('conditions'=>array('Orders.status'=>'Paid','Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate)),'limit'=>10,'order'=>array('Orders.orderid'=>'desc'));
			}				
			$getpayval = $this->paginate('Orders');
			$pagecount = $this->params['paging']['Orders']['count'];
				
			$commiDetails = $this->Commission->find('all',array('conditions'=>array('Commission.active'=>'1')));
			if(!empty($getpayval)){
				foreach($getpayval as $key=>$pay){
					$orderIddd= $pay['Orders']['orderid'];
					$ordermerchant_id[] = $pay['Orders']['merchant_id'];
					$order_status[$orderIddd] = $pay['Orders']['status'];
					$order_totalcost_ognl[$orderIddd] = $pay['Orders']['totalcost'];
					$order_totalcostShipping_ognl[$orderIddd] = $pay['Orders']['totalCostshipp'];
					$totcostreduceShip = $pay['Orders']['totalcost'] - $pay['Orders']['totalCostshipp'];
					$order_currency[$orderIddd] = $pay['Orders']['currency'];
					//$order_totalcost[] = $totcostreduceShip;
					foreach($commiDetails as $commi){
						$min_val = $commi['Commission']['min_value'];
						$max_val =  $commi['Commission']['max_value'];
						if($totcostreduceShip>=$min_val && $totcostreduceShip<=$max_val){
							if($commi['Commission']['type'] == '%'){
								//$dis = $totcostreduceShip/$commi['Commission']['amount'];
								$dis = (floatval($totcostreduceShip)/100)*$commi['Commission']['amount'];
								$order_totalcost[$orderIddd] = $totcostreduceShip - $dis;
							}else{
								$order_totalcost[$orderIddd] = $totcostreduceShip-$commi['Commission']['amount'];
							}
						}
					}
					$usernames1 = $this->User->findById($pay['Orders']['merchant_id']);
					$usernames[$pay['Orders']['merchant_id']] = $usernames1['User']['username_url'];
				}
			}
			$this->set('getitemuser',$getpayval);
			$this->set('order_status',$order_status);
			$this->set('order_totalcost',$order_totalcost);
			$this->set('order_totalcost_ognl',$order_totalcost_ognl);
			$this->set('order_currency',$order_currency);
			$this->set('order_totalcostShipping_ognl',$order_totalcostShipping_ognl);
			$this->set('usernames',$usernames);
			$this->set('sval',$sval);
			$this->set('pagecount',$pagecount);
		
		}			
		
		public function invoice_search_management ($retvalue = null) {
			if(!($this->isauthorized()))
				$this->redirect('/');
			$this->loadModel('Invoices');
			$this->loadModel('Invoiceorders');
			$this->set('title_for_layout','Invoices Management');
			$sval = $_POST['sval'];

				$invoice_orders = $this->Invoiceorders->find('all',array('conditions'=>array('Invoiceorders.orderid like' =>'%'.$sval.'%')));
				foreach($invoice_orders as $invoiceorders)
				{
					$invoice_ids[] = $invoiceorders['Invoiceorders']['invoiceid'];
				}
				$this->paginate = array('conditions'=>array('OR'=>array('Invoices.invoiceid like'=>'%'.$sval.'%','Invoices.invoiceno like'=>'%'.$sval.'%','Invoices.invoiceid'=>$invoice_ids)),'limit'=>10,'order'=>array('invoiceid'=>'desc'));
				
				
			$userdet = $this->paginate('Invoices');
			
			$pagecount = $this->params['paging']['Invoices']['count'];
			
			$userdet = $this->paginate('Invoices');
			foreach($userdet as $userdetails)
			{
				$invoice_ids[] = $userdetails['Invoices']['invoiceid'];
			}
			$invoice_orders_list = $this->Invoiceorders->find('all',array('conditions'=>array('Invoiceorders.invoiceid'=>$invoice_ids)));			
				
			$this->set('userdet',$userdet);
			$this->set('pagecount',$pagecount);
			$this->set('srcs',$srcs);
			$this->set('invoice_orders',$invoice_orders_list);
			$this->set('sval',$sval);
		}	
		
		function upload_item() 
		{
		if(!$this->isauthorized())
		$this->redirect('/');
		global $loguser;			
		$this->loadModel('Item');
		$this->loadModel('Category');
		$this->loadModel('Shop');
		$this->loadModel('User');
		$this->loadModel('Recipient');

		if(!empty($this->request->data)){
		 
		  	$filename = WEBROOT_PATH."/".$this->data['Pages']['file']['name']; 
		 
	      		move_uploaded_file($this->data['Pages']['file']['tmp_name'],$filename);
	  
		
			$file = $this->data['Pages']['file']['name'];
		    	
			$exts = array("csv","xls");
			$allowedExts = array("csv");
			$temp = explode(".", $file);
			$extension = end($temp);
		if(in_array($extension, $exts)) {
			if(in_array($extension, $allowedExts)){
				$name = fopen($file,"r");
				while(! feof($name))
		 		{
		
		 			$data[] = fgetcsv($name,1024);
				}
				//$count = count($data);
				$arraySize=sizeof($data);
				$arraySize=$arraySize-1;
				for($i=1; $i<$arraySize; $i++)
				{
					
					$title = $data[$i][0];
					$brand = $data[$i][1];
					$category = $data[$i][2];
					$subcat = $data[$i][3];
					$subcat2 = $data[$i][4];
					$video = $data[$i][5];
					$gender = $data[$i][6];
					$relation = $data[$i][7];
					$shipping = $data[$i][8];
					$shipTo = $data[$i][9];
					$shipPrice = $data[$i][10];
					$desc = $data[$i][11];
					$quantity = $data[$i][12];
					$price = $data[$i][13];
					$size = $data[$i][14];
					$color = $data[$i][15];
					$target = $data[$i][16];
					$image1 = $data[$i][17];
					$image2 = $data[$i][18];
					$image3 = $data[$i][19];
					$image4 = $data[$i][20];
					$image5 = $data[$i][21];
			
					$userDetail = $this->User->find('all', array('conditions'=>array('User.username_url'=>$brand)));
					foreach($userDetail as $userDetails) {
						$userid = $userDetails['User']['id'];
					}		

			
					if($shipping == '1 business day') {
						$ship = '1d';
					}
					elseif($shipping == '1-2 business days') {
						$ship = '2d';
					}
					elseif($shipping == '1-3 business day') {
						$ship = '3d';
					}
					elseif($shipping == '3-5 business days') {
						$ship = '4d';
					}
					elseif($shipping == '1-2 weeks') {
						$ship = '2ww';
					}
					elseif($shipping == '2-3 weeks') {
						$ship = '3w';
					}
					elseif($shipping == '3-4 weeks') {
						$ship = '4w';
					}
					elseif($shipping == '4-6 weeks') {
						$ship = '6w';
					}
					elseif($shipping == '6-8 weeks') {
						$ship = '8w';
					}
					else {
						$ship = $shipping;
					}
			
			
					if($image1 != ''){
					$imageurl = $target .'/'. $image1;
					$image_save1 = time().$userid.'.jpg';
					$this->FileUpload->upload($imageurl,$image_save1,"item");
					}
					if($image2 != ''){
					$imageurl = $target .'/'. $image2;
					$image_save2 = time().'1'.$userid.'.jpg';
					$this->FileUpload->upload($imageurl,$image_save2,"item");
					}
					if($image3 != ''){
					$imageurl = $target .'/'. $image3;
					$image_save3 = time().'2'.$userid.'.jpg';
					$this->FileUpload->upload($imageurl,$image_save3,"item");
					}
					if($image4 != ''){
					$imageurl = $target .'/'. $image4;
					$image_save4 = time().'3'.$userid.'.jpg';
					$this->FileUpload->upload($imageurl,$image_save4,"item");
					}
					if($image5 != ''){
					$imageurl = $target .'/'. $image5;
					$image_save5 = time().'4'.$userid.'.jpg';
					$this->FileUpload->upload($imageurl,$image_save5,"item");
					}
		
				if($title != ''  && $category != '' && $subcat != '' && $desc != '' && $quantity != '' && $price != '' && $shipping != '' && $brand != '' && $shipPrice != ''  && ($image1 != '' || $image2 != '' || $image3 != '' || $image4 != '' || $image5 != '')) {
					$this->Item->create();
					
					$this->request->data['Item']['user_id'] = $userid;
					$shop = $this->Shop->find('all',array('conditions' => array('Shop.user_id' => $userid)));
					foreach($shop as $shops) {
					$shopId = $shops['Shop']['id'];
					$this->request->data['Item']['shop_id'] = $shopId;
					}
					
					$this->request->data['Item']['item_title'] = $title;
					$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			

					$categry = $this->Category->find('all', array('conditions'=>array('category_name' => $category)));
					if(count($categry) == 0) {
					$this->Category->create();
					$this->request->data['Category']['category_name'] = $category;
					$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($category);
					$this->request->data['Category']['created_by'] = $userid;
					$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
					$this->Category->save($this->request->data);
					$cat_id = $this->Category->getLastInsertID();
					$this->request->data['Item']['category_id'] = $cat_id;
					}	
					else {
					foreach($categry as $cate) {
					$cate_id = $cate['Category']['id'];
					$this->request->data['Item']['category_id'] = $cate_id;
					}
					}

					$subcategry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat)));
					$getCategry = $this->Category->find('all', array('conditions'=>array('category_name' => $category)));
					if(count($subcategry) == 0) {
					$this->Category->create();
					$this->request->data['Category']['category_name'] = $subcat;
					$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($subcat);
					foreach($getCategry as $getCate) {
					$getId = $getCate['Category']['id'];
					$this->request->data['Category']['category_parent'] = $getId;
					}
					$this->request->data['Category']['created_by'] = $userid;
					$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
					$this->Category->save($this->request->data);
					$subcat_id = $this->Category->getLastInsertID();
					$this->request->data['Item']['super_catid'] = $subcat_id;
					}	
					else {
					foreach($subcategry as $subcate) {
					$subcate_id = $subcate['Category']['id'];
					$this->request->data['Item']['super_catid'] = $subcate_id;
					}
					}

					$sub2categry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat2)));
					$getSubcategry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat)));
					if(count($sub2categry) == 0) {
					$this->Category->create();
					$this->request->data['Category']['category_name'] = $subcat2;
					$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($subcat2);
					foreach($getSubcategry as $getSub) {
					$subid = $getSub['Category']['id'];
					$this->request->data['Category']['category_sub_parent'] = $subid;
					}	
					$this->request->data['Category']['created_by'] = $userid;
					$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
					$this->Category->save($this->request->data);
					$sub2cat_id = $this->Category->getLastInsertID();
					$this->request->data['Item']['sub_catid'] = $sub2cat_id;
					}	
					else {
					foreach($sub2categry as $sub2cate) {
					$sub2cate_id = $sub2cate['Category']['id'];
					$this->request->data['Item']['sub_catid'] = $sub2cate_id;
					}
					}
			
					$recipient = $this->Recipient->find('all', array('conditions'=>array('recipient_name' => $relation)));
					foreach($recipient as $recipients) {
						$rec_id[] = $recipients['Recipient']['id'];
					}
					$this->request->data['Item']['videourrl'] = $video;
					$this->request->data['Item']['occasion'] = $gender;
					$this->request->data['Item']['recipient'] = json_encode($rec_id);
					$this->request->data['Item']['processing_time'] = $ship;
					$this->request->data['Item']['item_description'] = $desc;
					$this->request->data['Item']['price'] = $price;
					
					$this->request->data['Item']['quantity'] = $quantity;
					$this->request->data['Item']['size_options'] = $size;

					$sizeQty = 0;
					if ($size != ''){
						$sizeOption = explode(",",$size);
						foreach ($sizeOption as $size){
							$singleSize = explode("=", $size);
							$sizeQty += $singleSize[1];
						}
						$this->request->data['Item']['quantity'] = $sizeQty;
					}
			
					$this->request->data['Item']['item_color'] = json_encode($color);
					
					$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
					$this->request->data['Item']['status'] = "publish";
					$this->request->data['Item']['modified_on'] = date("Y-m-d H:i:s");
			
					if($shipTo != '') {			
					$this->loadModel('Country');		
					$countryId = $this->Country->find('all',array('conditions' => array('Country.country' => $shipTo)));
			
					foreach($countryId as $country) {
						$cntryId = $country['Country']['id'];
						$this->request->data['Item']['ship_from_country'] = $cntryId;
					}
					}
			
					else {
					$this->request->data['Item']['ship_from_country'] = 198;
					}

					$this->Item->save($this->request->data);
					$last_id = $this->Item->getLastInsertID();
			
					$this->loadModel('Shiping');
			
					if($shipTo != '') {		
					$this->Shiping->create();
					$this->request->data['Shiping']['item_id'] = $last_id;
					$this->request->data['Shiping']['country_id'] = $cntryId;
					$this->request->data['Shiping']['primary_cost'] = $shipPrice;
					$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
					$this->Shiping->save($this->request->data);	
					}
					else {
					$this->Shiping->create();
					$this->request->data['Shiping']['item_id'] = $last_id;
					$this->request->data['Shiping']['country_id'] = 198;
					$this->request->data['Shiping']['primary_cost'] = $shipPrice;
					$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
					$this->Shiping->save($this->request->data);


					$this->Shiping->create();
					$this->request->data['Shiping']['item_id'] = $last_id;
					$this->request->data['Shiping']['country_id'] = 0;
					$this->request->data['Shiping']['primary_cost'] = $shipPrice;
					$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
					$this->Shiping->save($this->request->data);	
					}
				
			
					$this->loadModel('Photo');			
			
						if($image1 != ''){
						$this->Photo->create();
							$this->request->data['Photo']['item_id'] = $last_id;
					
							$this->request->data['Photo']['image_name'] = $image_save1;
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->Photo->save($this->request->data);
						}
				
						if($image2 != ''){
						$this->Photo->create();
							$this->request->data['Photo']['item_id'] = $last_id;
					
							$this->request->data['Photo']['image_name'] = $image_save2;
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->Photo->save($this->request->data);
						}
				
						if($image3 != ''){
						$this->Photo->create();				
							$this->request->data['Photo']['item_id'] = $last_id;
					
							$this->request->data['Photo']['image_name'] = $image_save3;
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->Photo->save($this->request->data);
						}
			
						if($image4 != ''){
						$this->Photo->create();
							$this->request->data['Photo']['item_id'] = $last_id;
					
							$this->request->data['Photo']['image_name'] = $image_save4;
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->Photo->save($this->request->data);
						}

						if($image5 != ''){
						$this->Photo->create();
							$this->request->data['Photo']['item_id'] = $last_id;
					
							$this->request->data['Photo']['image_name'] = $image_save5;
							$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
							$this->Photo->save($this->request->data);
			  		
						}
		
						}
						}
						$this->Session->setFlash("Import Successfully");
						unlink($file);
					}
            else {

		include 'reader.php';
        	$excel = new Spreadsheet_Excel_Reader();
   
        	$excel->read($file);

		 $x=2;
		
            while($x<=$excel->sheets[0]['numRows']) {
              
                $title = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
		$brand = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
		$category = isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
		$subcat = isset($excel->sheets[0]['cells'][$x][4]) ? $excel->sheets[0]['cells'][$x][4] : '';
		$subcat2 = isset($excel->sheets[0]['cells'][$x][5]) ? $excel->sheets[0]['cells'][$x][5] : '';
		$video = isset($excel->sheets[0]['cells'][$x][6]) ? $excel->sheets[0]['cells'][$x][6] : '';
		$gender = isset($excel->sheets[0]['cells'][$x][7]) ? $excel->sheets[0]['cells'][$x][7] : '';
		$relation = isset($excel->sheets[0]['cells'][$x][8]) ? $excel->sheets[0]['cells'][$x][8] : '';
		$shipping = isset($excel->sheets[0]['cells'][$x][9]) ? $excel->sheets[0]['cells'][$x][9] : '';
		$shipTo = isset($excel->sheets[0]['cells'][$x][10]) ? $excel->sheets[0]['cells'][$x][10] : '';
		$shipPrice = isset($excel->sheets[0]['cells'][$x][11]) ? $excel->sheets[0]['cells'][$x][11] : '';
		$desc = isset($excel->sheets[0]['cells'][$x][12]) ? $excel->sheets[0]['cells'][$x][12] : '';
                $quantity = isset($excel->sheets[0]['cells'][$x][13]) ? $excel->sheets[0]['cells'][$x][13] : '';
                $price = isset($excel->sheets[0]['cells'][$x][14]) ? $excel->sheets[0]['cells'][$x][14] : '';
		$size = isset($excel->sheets[0]['cells'][$x][15]) ? $excel->sheets[0]['cells'][$x][15] : '';
		$color = isset($excel->sheets[0]['cells'][$x][16]) ? $excel->sheets[0]['cells'][$x][16] : '';
                $target = isset($excel->sheets[0]['cells'][$x][17]) ? $excel->sheets[0]['cells'][$x][17] : '';
		$image1 = isset($excel->sheets[0]['cells'][$x][18]) ? $excel->sheets[0]['cells'][$x][18] : '';
		$image2 = isset($excel->sheets[0]['cells'][$x][19]) ? $excel->sheets[0]['cells'][$x][19] : '';
		$image3 = isset($excel->sheets[0]['cells'][$x][20]) ? $excel->sheets[0]['cells'][$x][20] : '';
		$image4 = isset($excel->sheets[0]['cells'][$x][21]) ? $excel->sheets[0]['cells'][$x][21] : '';
		$image5 = isset($excel->sheets[0]['cells'][$x][22]) ? $excel->sheets[0]['cells'][$x][22] : '';

			$userDetail = $this->User->find('all', array('conditions'=>array('User.username_url'=>$brand)));
			foreach($userDetail as $userDetails) {
				$userid = $userDetails['User']['id'];
			}	

			
			if($shipping == '1 business day') {
				$ship = '1d';
			}
			elseif($shipping == '1-2 business days') {
				$ship = '2d';
			}
			elseif($shipping == '1-3 business day') {
				$ship = '3d';
			}
			elseif($shipping == '3-5 business days') {
				$ship = '4d';
			}
			elseif($shipping == '1-2 weeks') {
				$ship = '2ww';
			}
			elseif($shipping == '2-3 weeks') {
				$ship = '3w';
			}
			elseif($shipping == '3-4 weeks') {
				$ship = '4w';
			}
			elseif($shipping == '4-6 weeks') {
				$ship = '6w';
			}
			elseif($shipping == '6-8 weeks') {
				$ship = '8w';
			}
			else {
				$ship = $shipping;
			}
			
			
			if($image1 != ''){
			$imageurl = $target .'/'. $image1;
			$image_save1 = time().$userid.'.jpg';
			$this->FileUpload->upload($imageurl,$image_save1,"item");
			}
			if($image2 != ''){
			$imageurl = $target .'/'. $image2;
			$image_save2 = time().'1'.$userid.'.jpg';
			$this->FileUpload->upload($imageurl,$image_save2,"item");
			}
			if($image3 != ''){
			$imageurl = $target .'/'. $image3;
			$image_save3 = time().'2'.$userid.'.jpg';
			$this->FileUpload->upload($imageurl,$image_save3,"item");
			}
			if($image4 != ''){
			$imageurl = $target .'/'. $image4;
			$image_save4 = time().'3'.$userid.'.jpg';
			$this->FileUpload->upload($imageurl,$image_save4,"item");
			}
			if($image5 != ''){
			$imageurl = $target .'/'. $image5;
			$image_save5 = time().'4'.$userid.'.jpg';
			$this->FileUpload->upload($imageurl,$image_save5,"item");
			}
		if($title != '' && $category != '' && $subcat != '' && $desc != '' && $quantity != '' && $price != '' && $shipping != '' && $brand != '' && $shipPrice != ''  && ($image1 != '' || $image2 != '' || $image3 != '' || $image4 != '' || $image5 != '')) {
			$this->Item->create();
			
			$this->request->data['Item']['user_id'] = $userid;
			$shop = $this->Shop->find('all',array('conditions' => array('Shop.user_id' => $userid)));
			foreach($shop as $shops) {
			$shopId = $shops['Shop']['id'];
			$this->request->data['Item']['shop_id'] = $shopId;
			}
			
			$this->request->data['Item']['item_title'] = $title;
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			

			$categry = $this->Category->find('all', array('conditions'=>array('category_name' => $category)));
			if(count($categry) == 0) {
			$this->Category->create();
			$this->request->data['Category']['category_name'] = $category;
			$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($category);
			$this->request->data['Category']['created_by'] = $userid;
			$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
			$this->Category->save($this->request->data);
			$cat_id = $this->Category->getLastInsertID();
			$this->request->data['Item']['category_id'] = $cat_id;
			}	
			else {
			foreach($categry as $cate) {
			$cate_id = $cate['Category']['id'];
			$this->request->data['Item']['category_id'] = $cate_id;
			}
			}

			$subcategry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat)));
			$getCategry = $this->Category->find('all', array('conditions'=>array('category_name' => $category)));
			if(count($subcategry) == 0) {
			$this->Category->create();
			$this->request->data['Category']['category_name'] = $subcat;
			$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($subcat);
			foreach($getCategry as $getCate) {
			$getId = $getCate['Category']['id'];
			$this->request->data['Category']['category_parent'] = $getId;
			}
			$this->request->data['Category']['created_by'] = $userid;
			$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
			$this->Category->save($this->request->data);
			$subcat_id = $this->Category->getLastInsertID();
			$this->request->data['Item']['super_catid'] = $subcat_id;
			}	
			else {
			foreach($subcategry as $subcate) {
			$subcate_id = $subcate['Category']['id'];
			$this->request->data['Item']['super_catid'] = $subcate_id;
			}
			}

			$sub2categry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat2)));
			$getSubcategry = $this->Category->find('all', array('conditions'=>array('category_name' => $subcat)));
			if(count($sub2categry) == 0) {
			$this->Category->create();
			$this->request->data['Category']['category_name'] = $subcat2;
			$this->request->data['Category']['category_urlname'] =  $this->Urlfriendly->utils_makeUrlFriendly($subcat2);
			foreach($getSubcategry as $getSub) {
			$subid = $getSub['Category']['id'];
			$this->request->data['Category']['category_sub_parent'] = $subid;
			}	
			$this->request->data['Category']['created_by'] = $userid;
			$this->request->data['Category']['created_at'] = date("Y-m-d H:i:s");
			$this->Category->save($this->request->data);
			$sub2cat_id = $this->Category->getLastInsertID();
			$this->request->data['Item']['sub_catid'] = $sub2cat_id;
			}	
			else {
			foreach($sub2categry as $sub2cate) {
			$sub2cate_id = $sub2cate['Category']['id'];
			$this->request->data['Item']['sub_catid'] = $sub2cate_id;
			}
			}
			
			$recipient = $this->Recipient->find('all', array('conditions'=>array('recipient_name' => $relation)));
			foreach($recipient as $recipients) {
				$rec_id[] = $recipients['Recipient']['id'];
			}
			$this->request->data['Item']['videourrl'] = $video;
			$this->request->data['Item']['occasion'] = $gender;
			$this->request->data['Item']['recipient'] = json_encode($rec_id);
			$this->request->data['Item']['processing_time'] = $ship;
			$this->request->data['Item']['item_description'] = $desc;
			$this->request->data['Item']['price'] = $price;
			
			$this->request->data['Item']['quantity'] = $quantity;

			$this->request->data['Item']['size_options'] = $size;

			$sizeQty = 0;
			if ($size != ''){
				$sizeOption = explode(",",$size);
				foreach ($sizeOption as $size){
					$singleSize = explode("=", $size);
					$sizeQty += $singleSize[1];
				}
				$this->request->data['Item']['quantity'] = $sizeQty;
			}
			
			$this->request->data['Item']['item_color'] = json_encode($color);
			
			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
			$this->request->data['Item']['status'] = "publish";
			$this->request->data['Item']['modified_on'] = date("Y-m-d H:i:s");
			
			if($shipTo != '') {			
			$this->loadModel('Country');		
			$countryId = $this->Country->find('all',array('conditions' => array('Country.country' => $shipTo)));
			
			foreach($countryId as $country) {
				$cntryId = $country['Country']['id'];
				$this->request->data['Item']['ship_from_country'] = $cntryId;
			}
			}
			
			else {
			$this->request->data['Item']['ship_from_country'] = 198;
			}

			$this->Item->save($this->request->data);
			$last_id = $this->Item->getLastInsertID();
			
			$this->loadModel('Shiping');
			
			if($shipTo != '') {		
			$this->Shiping->create();
			$this->request->data['Shiping']['item_id'] = $last_id;
			$this->request->data['Shiping']['country_id'] = $cntryId;
			$this->request->data['Shiping']['primary_cost'] = $shipPrice;
			$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
			$this->Shiping->save($this->request->data);	
			}
			else {
			$this->Shiping->create();
			$this->request->data['Shiping']['item_id'] = $last_id;
			$this->request->data['Shiping']['country_id'] = 198;
			$this->request->data['Shiping']['primary_cost'] = $shipPrice;
			$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
			$this->Shiping->save($this->request->data);


			$this->Shiping->create();
			$this->request->data['Shiping']['item_id'] = $last_id;
			$this->request->data['Shiping']['country_id'] = 0;
			$this->request->data['Shiping']['primary_cost'] = $shipPrice;
			$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
			$this->Shiping->save($this->request->data);	
			}
			
			$this->loadModel('Photo');			
			
				if($image1 != ''){
				$this->Photo->create();
					$this->request->data['Photo']['item_id'] = $last_id;
					
					$this->request->data['Photo']['image_name'] = $image_save1;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					$this->Photo->save($this->request->data);
				}
				
				if($image2 != ''){
				$this->Photo->create();
					$this->request->data['Photo']['item_id'] = $last_id;
					
					$this->request->data['Photo']['image_name'] = $image_save2;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					$this->Photo->save($this->request->data);
				}
				
				if($image3 != ''){
				$this->Photo->create();				
					$this->request->data['Photo']['item_id'] = $last_id;
					
					$this->request->data['Photo']['image_name'] = $image_save3;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					$this->Photo->save($this->request->data);
				}
			
				if($image4 != ''){
				$this->Photo->create();
					$this->request->data['Photo']['item_id'] = $last_id;
					
					$this->request->data['Photo']['image_name'] = $image_save4;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					$this->Photo->save($this->request->data);
				}

				if($image5 != ''){
				$this->Photo->create();
					$this->request->data['Photo']['item_id'] = $last_id;
					
					$this->request->data['Photo']['image_name'] = $image_save5;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					$this->Photo->save($this->request->data);
	  		
				}
		
			}
		$x++;	
		}	
		
		$this->Session->setFlash("Import Successfully");
		unlink($file);
		}
		}
		else {
			$this->Session->setFlash("Please Use csv or xls File only");
			$this->redirect('/admin/item/upload');
			
		}
           	 }
			
		
		}	
			
		
		function newsletter()
		{
		 	
	 		/*$this->request->data['Subscriber'] = array('mareesharini@gmail.com','mareeschandran04@gmail.com');
		 	$result = $this->Ymlp->command('Contacts.Add', $this->request->data['Subscriber']);
		 	echo $result;
		 	
		 	//$group = $this->Ymlp->command('Groups.GetList');
		 	//echo $group;
		 	
		 	$results = $this->Ymlp->command('Newsletter.send','hi','','hello','','','','',0,'Groups.GetList()','','','66ZU4UGGZBRNQ095CZU1','6vxf','');
		 	
		 	echo $results;*/
		 	
		/*$data = array(
			'first_name' => 'Casi',
			'last_name' => 'Robot',
			'address' => '189 Chillsbury Rd',
			'city' => 'Santa Monica',
			'state' => 'CA',
			'other' => '',
			'zip' => '91471',
			'country' => 'US',
			'email' => 'mareesharini@gmail.com',
		);*/
		/*$data = array(
		'Key' => '66ZU4UGGZBRNQ095CZU1',
		'Username' => '6vxf',
		'Output' => '',
		);
		$method = 'Groups.GetList';
		$expected = 'Code 0: mareesharini@gmail.com has been added';
		$result = $this->Ymlp->command($method, $data);*/

	 	//echo $result;			
			
		}	

		function addnews()
		{
		$this->loadModel('User');
		
		
			$responce_val = $_POST['responce'];
			$this->set('responce_val',$responce_val);
			foreach($responce_val as $responces)
			{
				$responce_email[] = $responces['EMAIL'];
			} 
			$this->set('responce_email',$responce_email);		
			$user_datas = $this->User->find('all',array('conditions'=>array('User.email'=>$responce_email)));
			$this->set('user_datas',$user_datas);
			$users = $this->User->find('all',array('conditions'=>array('User.activation'=>'1')));	
			$count = count($users);
			$this->set('count',$count);
			$this->set('users',$users);
	 	
			
		}	
		function get_contacts()
		{
		
		}
		
		function addcontactslist()
		{
			$this->autoLayout = false;
			$this->loadModel('User');
		
		
			$responce_val = $_POST['responce'];
			$this->set('responce_val',$responce_val);
			foreach($responce_val as $responces)
			{
				$responce_email[] = $responces['EMAIL'];
			} 
			$this->set('responce_email',$responce_email);		
			$user_datas = $this->User->find('all',array('conditions'=>array('User.email'=>$responce_email)));
			$this->set('user_datas',$user_datas);	
			foreach($user_datas as $userdatas)
			{
				$user_ids[] = $userdatas['User']['id'];
			}	
			$users = $this->User->find('all',array('conditions'=>array('User.id !='=>$user_ids,'User.activation'=>'1')));	
			$count = count($users);
			$this->set('count',$count);
			$this->set('users',$users);				
		}
		
			public function merchant_payment_export () { 
			$this->autoLayout = false;
			$this->autoRender = false;
			if(!$this->isauthorized())
				$this->redirect('/');
				if($this->request->is('post')){
			$this->loadModel('Orders'); 
			$sdate=strtotime($this->request->data['start']);
			$edate=strtotime($this->request->data['end']);

			$order_status = $this->request->data['status'];
			if($order_status=="" || $order_status=="Pending" || $order_status=="Processing")
			{
				if(!empty($sdate) && !empty($edate))
				{
					$startdate = date('Y-m-d 24:00:00',$sdate);	
					$enddate = date('Y-m-d 24:00:00',$edate);
					$startdate = strtotime($startdate);
					$enddate = strtotime($enddate);
					$data = $this->Orders->find('all', array('conditions' => array('Orders.status' => $order_status ,'Orders.orderdate BETWEEN ? AND ?' =>array($startdate,$enddate))));
				}
				else
				$data = $this->Orders->find('all', array('conditions' => array('Orders.status' => $order_status)));
			}
			else if($order_status=="Shipped" || $order_status=="Delivered" || $order_status=="Paid")
			{
				if(!empty($sdate) && !empty($edate))
				{
					$startdate = date('Y-m-d 24:00:00',$sdate);	
					$enddate = date('Y-m-d 24:00:00',$edate);
					$startdate = strtotime($startdate);
					$enddate = strtotime($enddate);
					$data = $this->Orders->find('all', array('conditions' => array('Orders.status' => $order_status ,'Orders.status_date BETWEEN ? AND ?' =>array($startdate,$enddate))));
				}
				else
				$data = $this->Orders->find('all', array('conditions' => array('Orders.status' => $order_status)));				
			}
			 

        	$this->Export->exportCsv($data, 'orders.csv');
		}}		
		
		function list_contacts()
		{
			$this->loadModel('User');
			$responce_val = $_POST['responce'];
			$this->set('responce_val',$responce_val);
			foreach($responce_val as $responces)
			{
				$responce_email[] = $responces['EMAIL'];
			} 			
			$user_datas = $this->User->find('all',array('conditions'=>array('User.email'=>$responce_email)));
			$this->set('user_datas',$user_datas);
		}
		
		function nonapproved_sellers()
		{
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Shop');
			$this->loadModel('User');
			$sval = $this->passedArgs['searchval'];
			
			$user_names = $this->User->find('all',array('conditions'=>array('User.first_name like'=>'%'.$sval.'%')));
			foreach($user_names as $usernames)
			{
				$user_ids[] = $usernames['User']['id'];
			}			
			if($sval)
			$this->paginate = array('conditions'=>array('OR'=>array('Shop.shop_name like'=>'%'.$sval.'%','Shop.paypal_id like'=>'%'.$sval.'%','Shop.user_id'=>$user_ids),'Shop.seller_status'=>'0', 'Shop.paypal_id <>'=>''), 'limit'=>10, 'order'=>array('Shop.id'=>'desc'));
			else
			$this->paginate = array('conditions'=>array('Shop.seller_status'=>'0', 'Shop.paypal_id <>'=>''), 'limit'=>10, 'order'=>array('Shop.id'=>'desc'));
			$sellerModel = $this->paginate('Shop');
			$pagecount = $this->params['paging']['Shop']['count'];
			
			//echo "<pre>";print_r($getpriceval);die;
			$this->set('sellerModel',$sellerModel);
			$this->set('pagecount',$pagecount);
		}
		
			public function searchnonapproveseller (){
			if(!$this->isauthorized())
				$this->redirect('/');
			$this->loadModel('Shop');
			$this->loadModel('User');
			
			$searchkywrd = $_POST['serchkeywrd'];
			
			$user_names = $this->User->find('all',array('conditions'=>array('User.first_name like'=>'%'.$searchkywrd.'%')));
			foreach($user_names as $usernames)
			{
				$user_ids[] = $usernames['User']['id'];
			}
			
			if(!empty($searchkywrd)){
				$this->paginate =  array('conditions'=>array('OR'=>array('Shop.shop_name like'=>'%'.$searchkywrd.'%','Shop.paypal_id like'=>'%'.$searchkywrd.'%','Shop.user_id'=>$user_ids),'Shop.paypal_id <>'=>'', 'Shop.seller_status'=>'0'),'limit'=>10,'order'=>array('Shop.id'=>'desc'));
			}else{
				$this->paginate =  array('conditions'=>array('Shop.paypal_id <>'=>'', 'Shop.seller_status'=>'0'),'limit'=>10,'order'=>array('Shop.id'=>'desc'));
			}
			
			//$this->paginate = array('conditions'=>array('Giftcard.status'=>'Paid'),'limit'=>10,'order'=>array('Giftcard.id'=>'desc'));
			$shopDetss = $this->paginate('Shop');
			$pagecount = $this->params['paging']['Shop']['count'];
			
			//echo "<pre>";print_r($itemDetss);die;
			$this->set('shop_datas',$shopDetss);
			$this->set('pagecount',$pagecount);
			$this->set('searchkywrd',$searchkywrd);
		}		
		
}
