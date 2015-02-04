<?php
App::uses('AppController', 'Controller');
	
	class MobilesController  extends AppController{
		public $names =  'Users';
		public $uses = array('User');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','FileUpload','Captcha' => array('rotate' => true),'RequestHandler','ColorCompare');
		public $helpers = array('Form','Html');
		//public $layout = 'frontlayout';
		
	
		
		function index(){			
			//$this->set('title_for_layout',' ');
			$this->layout = 'mobilelayout';
			
			global $username;
			global $user_level;
			global $loguser;
			global $setngs;
			global $siteChanges;
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
			$userid = $loguser[0]['User']['id'];
			// echo "<pre>";print_r($loguser);die;
			$this->set('username',$username);
			if($user_level == 'god'){
				$this->redirect('/mobile/admin');
			}
			$this->loadModel('Homepagesettings');
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Shop');
			$this->loadModel('Follower');
			$homepageModel = $this->Homepagesettings->find('first');
			//echo $homepageModel['Homepagesettings']['layout'];
			if ($homepageModel['Homepagesettings']['layout'] == 'default'){
			
				$this->layout = 'mobilelayout';
			
				
				$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
				$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
					
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}
					
				
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$items_gallery = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}else{
					$items_gallery = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}
				
				$this->set('prnt_cat_data',$prnt_cat_data);
				$this->set('items_data',$items_data);
				$this->set('userid',$userid);
				$this->set('loguser',$loguser);
				$this->set('items_list_data',$items_list_data);
				$this->set('items_gallery',$items_gallery);
				$this->set('layout','mobilelayout');
			}else{
				$this->loadModel('Comment');
				$widgets = explode('(,)',$homepageModel['Homepagesettings']['widgets']);
				$sliderproperty = $homepageModel['Homepagesettings']['properties'];
				$sliderproperty = json_decode($sliderproperty,true);
				foreach ($widgets as $widget){
					$itemCount = $sliderproperty['widgets'][$widget]['widgetitmcnt'];
					$widgettype = $sliderproperty['widgets'][$widget]['widgettype'];
					switch ($widget){
						case 'Recently Added':
							$recentlyaddedModel = $this->Item->find('all',array('conditions'=>array(
								'Item.status'=>'publish'),'order'=>'Item.id DESC',
								'limit'=>$itemCount));
							$this->set('recentlyaddedModel',$recentlyaddedModel);
							$this->set('recentlyaddedwidgettype',$widgettype);
							break;
						case 'Most Popular':
							$mostpopularModel = $this->Item->find('all',array('conditions'=>array(
								'Item.status'=>'publish'),'order'=>'Item.fav_count DESC',
								'limit'=>$itemCount));
							$this->set('mostpopularModel',$mostpopularModel);
							$this->set('mostpopularwidgettype',$widgettype);
							break;
						case 'Most Commented':
							$mostcommentedModel = $this->Item->find('all',array('conditions'=>array(
								'Item.status'=>'publish'), 'order'=>'Item.comment_count desc',
								'limit'=>$itemCount));
							$this->set('mostcommentedModel',$mostcommentedModel);
							$this->set('mostcommentedwidgettype',$widgettype);
							break;
						case 'Featured Items':
							$featuredModel = $this->Item->find('all',array('conditions'=>array(
								'Item.status'=>'publish','Item.featured'=>'1'), 'order'=>'Item.id desc',
								'limit'=>$itemCount));
							$this->set('featuredModel',$featuredModel);
							$this->set('featuredwidgettype',$widgettype);
							break;
						case 'Top Stores':
							$shopsdet = $this->Shop->find('all',array('conditions'=>array('User.user_level <>'=>'god',
								'Shop.paypal_id <>'=>'','item_count >'=>'0'), 'order'=>array('item_count DESC', 
								'follow_count DESC'), 'limit'=>$itemCount));
							$topshoparr = array();
							$skey = 0;
							foreach ($shopsdet as $shopdata){
								$topshoparr[$skey]['username_url'] = $shopdata['User']['profile_image'];
								$topshoparr[$skey]['username'] = $shopdata['User']['username'];
								$topshoparr[$skey]['username_url_ori'] = $shopdata['User']['username_url'];
								$topshoparr[$skey]['item_count'] = $shopdata['Shop']['item_count'];
								$userid = $shopdata['User']['id'];
								$topshoparr[$skey]['itemModel'] = $this->Item->find('all',array(
										'conditions'=>array('Item.user_id'=>$userid, 'Item.status <>'=>
										'draft'), limit=>'9','order'=>array('Item.fav_count DESC',
										'Item.id DESC')));
								$skey += 1;
							}
							//echo "<pre>";print_r($topshoparr);die;
							$this->set('shopsdet',$topshoparr);
							break;
						case 'Most Popular Categories':
							$popcatModel = $this->Item->find('all',array('recursive'=>'-1',
								'fields' => array('count(Item.category_id) as count,Item.category_id'),
								'conditions'=>array('Item.status'=>'publish'),'group' => array('
								Item.category_id'), 'order'=>'count(Item.category_id) DESC','limit'=>'6'));
							$popcatarr = array();
							$lastcatid = '';
							$mkey = 0;
							foreach($popcatModel as $popcat){
								$lastcatid = $popcat['Item']['category_id'];
								$catModel = $this->Category->find('first',array('conditions'=>array('id'=>$lastcatid)));
								$popcatarr[$mkey]['catname'] = $catModel['Category']['category_name'];
								$popcatarr[$mkey]['catnameurl'] = $catModel['Category']['category_urlname'];
								$popcatarr[$mkey]['catcount'] = $popcat[0]['count'];
								$popitemModel = $this->Item->find('all',array('conditions'=>array(
										'Item.category_id'=>$lastcatid,'Item.status'=>'publish'),
										limit=>'9','order'=>array('Item.fav_count DESC', 'Item.id DESC')));
								$popcatarr[$mkey]['catitemModel'] = $popitemModel;
								$mkey += 1;
							}
							$this->set('popcatarr',$popcatarr);
							break;
					}
				}
				//echo "<pre>";print_r($mostcommentedModel);die;
				$this->layout = 'mobilelayout';
				$this->set('layout','mobilelayout');
				$this->set('homepageModel',$homepageModel);
			}
				$this->set('setngs',$setngs);
		}
		
	function getmoregallery() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->loadModel('Item');
		$startIndex = $_POST['startIndex'];
		$offset = 20;
		global $username;
		global $user_level;
		global $loguser;
		global $setngs;
		global $siteChanges;
		
		
		$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
	
		if(!empty($items_data)){
			foreach($items_data as $key=>$itms){
				$username = $itms['User']['username'];
				$favorte_count = $itms['Item']['fav_count'];
				$itemId = $itms['Item']['id'];
				$itemTitle = $itms['Item']['item_title_url'];
				if(isset($itms['Photo'][0])){
					$image_name = $itms['Photo'][0]['image_name'];
					$data = '<li>';
					$data .= '<a class="thumb" href="'.$_SESSION['media_url'].'media/items/original/'.$image_name.'" title="'.$itms['Item']['item_title'].'-~_~-'.SITE_URL.'listing/'.$itemId.'/'.$itemTitle.'">';
					$data .= '<img src="'.$_SESSION['media_url'].'media/items/thumb70/'.$image_name.'" alt="'.$itms['Item']['item_title'].'" width="75px" height="75px"/>';
					$data .= '</a>';
					$data .= '<div class="caption">';
					$data .= '<div class="image-title"><a href="'.SITE_URL.'listing/'.$itemId.'/'.$itemTitle.'">'.$itms['Item']['item_title'].'</a></div>';
					$data .= '<div class="image-desc"><span class="username"><em><i>  by &nbsp;&nbsp;  </i><a href="'.SITE_URL."people/".$username.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span></div>';
					$data .= '</div>';
					$data .= '</li>';
				}
				$responce[] = $data;
			}
		}
		
		if (count($responce) > 0){
			echo json_encode($responce);
		}else {
			echo 0;
		}
	}
		
	function getMorePosts() {
			$this->autoRender = false;
			$this->loadModel('Item');
			$startIndex = $_GET['startIndex'];
			$offset = $_GET['offset'];
			$followingId = explode(',', $_GET['followid']);
			global $username;
			global $user_level;
			global $loguser;
			global $setngs;
			global $siteChanges;
			
			$roundProf = "";
			if ($siteChanges['profile_image_view'] == "round") {
				$roundProf = "border-radius:40px;";
			}
			$userid = $loguser[0]['User']['id'];

			if ($_GET['loadmoretab'] == 'following') {
				
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
			}elseif ($_GET['loadmoretab'] == 'featured') {
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft','Item.featured'=>'1'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.featured'=>'1'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
			}else{			
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
			}
			if (count($items_data) != 0) {
				foreach($items_data as $key=>$itms){
					$usercmntcount='';
				$itm_id = $itms['Item']['id'];
				$user_id = $itms['Item']['user_id'];
				$item_title_url = $itms['Item']['item_title_url'];
				$item_title = $itms['Item']['item_title'];
				$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
				
				if(isset($itms['Photo'][0])){
					$image_name = $itms['Photo'][0]['image_name'];
				}
				$username_url = $itms['User']['profile_image'];
				$username = $itms['User']['username'];
				
				$username_url_ori = $itms['User']['username_url'];
				$favorte_count = $itms['Item']['fav_count'];
				$comment_count = $itms['Item']['comment_count'];
				$shop_address = $itms['Shop']['shop_address'];
				//$cdate = $itms['Item']['created_on'];
				//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
				$item_titletwo = UrlfriendlyComponent::limit_char($item_title,16);
				echo "<div class='ui-body ui-body-a' style='border-radius:5px;margin-top:-7px;'>";
				echo  '<li imgid="'.$image_name.'"  class="big" style="list-style:none;margin-top:5px;">'; 
				
				
					echo "<div class='userimagesthirtyfive'>";
					//echo '<div style="with:98%!important;padding:5px;height:45px;"><div style="width:70%;float:left;">';
			if(!empty($username_url)){
					
					echo  "<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."width:50px;height:50px;'></a>
					<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
						
					</a>";
					//echo '<small id="font_s_time">'.UrlfriendlyComponent::txt_time_diff($cdate).'</small>';
				}else{
					
					echo  "<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard'>
					<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."width:50px;height:50px;'></a>
					<a href='".SITE_URL."mobile/people/".$username_url_ori."' class='userv vcard' style='text-decoration:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:120px;font-size: 11px;position: relative; left:7px;top: -10px;font-weight:normal!important;color:#979797!important;'>
					<i class='arrow-sml' style='margin-top: 17px;'>@$username</i>
					<br />
					</a>";
					}
					echo  "<a data-ajax='false' style='text-decoration:none;margin-top:-50px;font-weight: bold ! important;float:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;position: relative; left:60px;color: #373D48;width:120px;font-size:15px;' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm'>".$item_titletwo."</a>";
					//echo '</div> <div style="width:28%;float:left;">';
					echo "<div style='font-weight:bold;margin-top:-40px;float:right;'>
                            <b style='color:#969696!important;'> ".$_SESSION['currency_symbol'].$item_price."</b></div>";
					//echo '</div></div>';
					echo  '</div>';
					
				
				
				echo  '<div class="figure-item" style="margin-top:5px;background:#FBFCFC">';
				
				
				$mediaul = trim($_SESSION['media_url']);
				$border = "";
				list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
				list($width_ori, $height_ori) = getimagesize($mediaul."media/items/original/".$image_name);
				//list($width, $height) = getimagesize($_SESSION['media_url']."media/items/thumb350/".$image_name);
				echo  "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				//echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
				//echo  '<span class="figure classic">';
				//echo  '<em class="back"></em>';
				if ($height_ori < 640){
					$border = "border-radius:0;";
				}
				//echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='background:#F9F9F9;".$border."' >";
				//echo  '</span>';
				//echo  '<span class="figure vertical">';
				//echo  '<em class="back"></em>';
				echo  "<center><img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' style='background:#FBFCFC;' data-height=".$height." data-width=".$width."></center>";
				//echo  '</span>';
				//echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '</a>';
				//echo  '<em class="figure-detail back">';
				//echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
				//echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."mobile/people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"> </a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
				//echo  '</em>';
				
			
				
				foreach($itms['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}
				
				$comment_count = 0;
				foreach($itms['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];		
					$comment_count++;		
				}
				echo '<div style="margin-top:-15px;">
				<div style="width:70%;float:left;height:20px;">';
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) && in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" iteid="'.$itms['Item']['id'].'" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacydbtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacyd.png" style="margin: -1px;margin-left:-8px;"></span> 
    <span style="margin-left:2px;top:-2px;position:relative;color:#188EE6;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'">
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacy.png" style="margin: -1px;margin-left:-8px;"></span>
     <span style="margin-left:2px;top:-2px;position:relative;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</span>
     <input type="hidden" value="'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'">
     </span></a>';
				}
				echo '</div> <div style="width:28%;float:left;text-align:right;">';
				echo "<a data-ajax='false' href='".SITE_URL."mobile/listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='figure-img' id='img_id".$itms['Item']['id']."'>";
				echo '<span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" style="margin-right:-5px;float:right;margin-top:20px;">
				<span style="position: relative;float: right;margin-top:5px;" class="comment">
				<div style="width:auto;border:1px solid #D5D9DC;border-radius:5px;height:26px; !important;float:left;">
				<img src="'.SITE_URL.'images/menu/chat.png" style="margin-top:5px;">
				 <span style="color:#707070!important;margin-right:4px;top:-2px;position:relative;">'.$comment_count.'</span></div></span></span>';
				echo "</a>";
							
				echo  '</div>';
				echo  '</li></div><br />';
		
					}
				} else {
					echo 'false';
				}
		
			}
			
		function changeTab () {
			$this->layout = 'ajax';
			$this->loadModel('Item');
			global $setngs;
			global $siteChanges;
			global $username;
			global $user_level;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			if (isset($_GET['feed']) && $_GET['feed'] == 'following') {
				$filter = $_GET['feed'];
				$this->loadModel('Follower');
				$following = $this->Follower->findAllByfollow_user_id($userid);
				if (count($following) > 0){
					foreach ($following as $follow) {
						$followingId[] = $follow['Follower']['user_id'];
					}
				
					if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
						$followDetails = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft','Item.user_id'=>$followingId),'limit'=>'10','order'=>array('Item.id'=>'desc')));
					}else{
						$followDetails = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>'10','order'=>array('Item.id'=>'desc')));
					}
					
					//$followDetails = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId),'limit'=>'10','order'=>array('Item.id'=>'desc')));
				}else {
					$followDetails = array();
				}
			}elseif (isset($_GET['feed']) && $_GET['feed'] == 'featured'){
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$followDetails = $this->Item->find('all',array('conditions'=>array('Item.status <>'=>'draft','Item.featured'=>'1'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}else{
					$followDetails = $this->Item->find('all',array('conditions'=>array('Item.status'=>'publish','Item.featured'=>'1'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}
				
				//$followDetails = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				$followingId[] = array();
			}else {
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$followDetails = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}else{
					$followDetails = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				}
				
				//$followDetails = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				$followingId[] = array();
			}
			//echo "<pre>";print_r($followDetails);die;
			$this->set('itemDetails',$followDetails);
			$this->set('followid',$followingId);
			$this->set('userid',$userid);
					$this->set('setngs', $setngs);
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
		}
		
		function login($demo = ''){
			
		/*if($_SERVER['HTTP_REFERER']!=SITE_URL.'/mobile/login'){
				$_SESSION['referal'] = $_SERVER['HTTP_REFERER'];
			}*/
			global $setngs;
			$this->set('title_for_layout','- Sign in ');
			$this->layout='mobilelayout';
			if($this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			if ($demo == '') {
				$userName = '';
				$password = '';
			} else if ($demo == 'userdemo') {
				$userName = 'demo@fantacy.com';
				$password = '123456';
			}  else if ($demo == 'admindemo') {
				$userName = 'admin@fantacy.com';
				$password = '123456';
			}
			$this->set('userName',$userName);
			$this->set('password',$password);
			
			if(!empty($this->request->data)){
			
				$email = $this->request->data['email'];
				$password = $this->request->data['password'];
				
				if((!empty($email)) && (!empty($password))){
					$pass = $this->Auth->password($password);
					$userdata = $this->User->find('all',array('conditions'=>array('email'=>$email,'password'=>$pass)));
				
					if(!empty($userdata)){
						if ($userdata[0]['User']['user_status'] == 'enable') {
							if ($userdata[0]['User']['activation'] == 1) {
								if($this->Auth->login($userdata)){
									$cookie['email'] = $email;
									$cookie['pass'] = $pass;
									if($userdata[0]['User']['user_level'] !='god'){
										$this->Cookie->write('User',$cookie,true,'+2 weeks');
									}else{
										$this->Cookie->write('Admin',$cookie,true,'+2 weeks');
									}
									$this->request->data['User']['id'] = $userdata[0]['User']['id'];
									$this->request->data['User']['last_login'] = date('Y-m-d H:i:s');
									$this->User->save($this->request->data);
									//$this->Session->setFlash('Successfully login');
									//$this->Session->setFlash(__('Successfully login'));
									$this->Session->setFlash('Successfully login');
									
									//echo $_SERVER['HTTP_REFERER'];die;
									/*if(!isset($_SESSION['referal'])){
										$redirctt = '/mobile/';
									}else{
										$redirctt = $_SESSION['referal'];
									}*/
									
									//echo "<script> window.location = '/mobile/';</script>";
									//header("Location:/fantacy/mobile/login");	
									//echo "<script>window.location.reload();</script>";
									//$this->render("index");
									
									$this->redirect("/mobile/");
								}
							} else {
$this->Session->setFlash('Please activate your account by the email sent to you');
								//$this->Session->setFlash('Please activate your account by the email sent to you', 'default', array(), 'bad');
								$this->redirect('/mobile/login');
							}
						} else {
$this->Session->setFlash('Your account has been disbled please contact our support');
							//$this->Session->setFlash('Your account has been disbled please contact our support', 'default', array(), 'bad');
							$this->redirect('/mobile/login');
						}
						
						
					}else{
						$this->Session->setFlash('Please enter correct email and password');
						//$this->Session->setFlash('Please enter correct email and password', 'default', array(), 'bad');
						//$this->Session->setFlash('Something good.', 'default', array(), 'good');
						$this->redirect('/mobile/login');	
					}
				}
			}
			
		}
		
		
		public function signup(){
			$this->layout='mobilelayout';
			$this->set('title_for_layout','- Sign up ');
			global $setngs;
			
			if(!empty($_GET['referrer'])){
				$reffername = $_GET['referrer'];
				//echo $reffername;die;
				$usr_datas = $this->User->findByUsernameUrl($reffername);
				$refferrer_user_id = $usr_datas['User']['id'];
			}
			
			if($this->isauthenticated()){
				$this->redirect('/mobile/');
			}	
			if(!empty($this->request->data)){
				//$captcha1 = $this->request->data['signup']['Type the text'];
				//$getc = $this->Captcha->getCode();					
				$username = $_SESSION['username'] = $this->request->data['signup']['username'];
				$firstname = $_SESSION['firstname'] = $this->request->data['signup']['firstname'];
				//$lastname = $_SESSION['lastname'] = $this->request->data['signup']['lastname'];
				$email = $_SESSION['email'] = $this->request->data['signup']['email'];	
				$password = $_SESSION['password'] = $this->request->data['signup']['password'];
				$nmecounts = $this->User->find('count',array('conditions'=>array('username'=>$username)));
				$emlcounts = $this->User->find('count',array('conditions'=>array('email'=>$email)));
				// echo "<pre>";print_r($nmecounts);die;
				if($nmecounts > 0){
					$this->Session->setFlash("username already exists");
					$this->redirect($this->referer());
				}else if($emlcounts > 0){
					$this->Session->setFlash("Email already exists");
					$this->redirect($this->referer());
				}/* else if($getc != $captcha1){
					$this->Session->setFlash("Captcha code Invalid");
					$this->redirect($this->referer());
				} */else{
					$name=$this->request->data['User']['username'] = $username;
					$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
					$this->request->data['User']['first_name'] = $firstname;
					//$this->request->data['User']['last_name'] = $lastname;
					$emailaddress = $this->request->data['User']['email'] = $this->request->data['signup']['email'];
					$this->request->data['User']['password'] = $this->Auth->password($password);
					//$this->request->data['User']['gender'] = $gender;
					
					if(!empty($this->request->data['refferid'])){
					$reff_id['reffid'] = $this->request->data['refferid'];
					$reff_id['first'] = 'first';
					
						$json_ref_id = json_encode($reff_id);
					}else{
						$json_ref_id=0;
					}
					//echo $json_ref_id;die;
					
					$reffer_id = $this->request->data['User']['referrer_id'] = $json_ref_id;
					
					$this->request->data['User']['user_level'] = 'normal';
					$this->request->data['User']['user_status'] = 'disable';
					$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
					$uniquecode = $this->Urlfriendly->get_uniquecode(8);
					$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
					$this->User->save($this->request->data);
					$userid = $this->User->getLastInsertID();
					
					$this->loadModel('Shop');
					$this->request->data['Shop']['user_id'] = $userid;
					$this->request->data['Shop']['seller_status'] = 2;
					$this->Shop->save($this->request->data);
					
					$this->loadModel('Userinvite');
					$userinvite = $this->Userinvite->findByInvited_email($emailaddress);
					
					if(empty($userinvite) && !empty($reffer_id)){
						$this->Userinvite->create();
						$this->request->data['Userinvite']['user_id'] = $reff_id['reffid'];
						$this->request->data['Userinvite']['invited_email'] = $emailaddress;
						$this->request->data['Userinvite']['status'] = 'Joined';
						$this->request->data['Userinvite']['invited_date'] = time();
						$this->request->data['Userinvite']['cdate'] = time();
						$this->Userinvite->save($this->request->data);
						
					}
					
					if(!empty($reffer_id)){
						$this->Userinvite->updateAll(array('Userinvite.status' =>"'Joined'"), array('Userinvite.invited_email' => $emailaddress,'Userinvite.user_id' => $reff_id['reffid']));
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
					$this->Email->to = $emailaddress;
					$this->Email->subject = "Welcome to ".$setngs[0]['Sitesetting']['site_name'];
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'userlogin';		
					$this->set('name', $name);
					$this->set('urlname', $urlname);
					$this->set('email', $emailaddress);
					$this->set('siteurl',SITE_URL);
					$this->set('setngs',$setngs);
					$emailid = base64_encode($emailaddress);
					$pass = base64_encode($password);
					$this->set('access_url',SITE_URL."mobile/verification/".$emailid."~".$refer_key."~".$pass);
					
					$this->Email->send();
					
					$this->Session->setFlash('An email was sent to your mail box, please activate your account and login.');
					$this->redirect('/mobile/');
					
				}
			}else{
				$_SESSION['username'] = '';
				$_SESSION['firstname'] = '';
				$_SESSION['email'] = '';
				$_SESSION['password'] = '';
				$this->set('siteurl',SITE_URL);
				$this->set('site_na',$setngs[0]['Sitesetting']['site_name']);
				if(!empty($_GET['referrer'])){
					//echo "<pre>";print_r($jsonvalue);die;
					$this->set('refferrer_user_id',$refferrer_user_id);
				}
			}
		}
		
		
		public function forgotpassword(){
			$this->layout='mobilelayout';
			$this->set('title_for_layout','- Forgot Password ');
			global $setngs;
			//echo $setngs[0]['Sitesetting']['noreply_email'];die;
			if(!empty($this->request->data)){
				$email = $this->request->data['email'];
		
				$usr_datas = $this->User->findByEmail($email);
				if(count($usr_datas) > 0){
					
				
				$name = $usr_datas['User']['username'];
				$reg_email = $usr_datas['User']['email'];
				$use_id = $usr_datas['User']['id'];
				$uniquecode_pass = $this->Urlfriendly->get_uniquecode(6);
		
				if(!empty($reg_email)){
						
					$this->loadModel('User');
					$this->request->data['User']['id'] = $use_id;
					$this->request->data['User']['password'] = $this->Auth->password($uniquecode_pass);
					$this->User->save($this->request->data);
					
					if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
						$this->Email->smtpOptions = array(
							'port' => $setngs[0]['Sitesetting']['smtp_port'],
							'timeout' => '30',
							'host' => 'ssl://smtp.gmail.com',
							'username' => $setngs[0]['Sitesetting']['noreply_email'],
							'password' => $setngs[0]['Sitesetting']['noreply_password']);
				
						$this->Email->delivery = 'smtp';
					}
					$this->Email->to = $reg_email;
					$this->Email->subject = "Password Reset";
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'passwordreset';
					$this->set('reg_email', $reg_email);
					$this->set('name', $name);
					$this->set('uniquecode_pass', $uniquecode_pass);
					//$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key."~".$pass);
		
					//$this->Email->send();
		
					$this->Session->setFlash(__('Password sent. Check your email immediately.'));
					$this->redirect('/mobile/');
		
				}
				}else{
					$this->Session->setFlash('Email id is not found Please register to our site.');
					$this->redirect($this->referer());
				}
			}
		}
				
		
		
		
		
		public function verification($userid = null){
			$this->layout='mobilelayout';
			$this->set('title_for_layout','- Welcome ');
			$userval = explode("~", $userid);
			//$email ='s@mail.com';
			//$veri_code = 'OPfFKL9B';
			
			//echo $email. ' , '. $veri_code;die;
			
			$email = base64_decode($userval[0]);
			$veri_code = $userval[1];
			$userdetails=  $this->User->find('all',array('conditions'=>array('email'=>$email,'refer_key'=>$veri_code)));
			if(!empty($userdetails)){
				$id=$userdetails[0]['User']['id'];
				$active=$userdetails[0]['User']['activation'];
				//echo "<pre>";print_r($active);die;
					
				if($active == 0){
					$prefix = $this->User->tablePrefix;
					//$this->User->query("Update ".$prefix."users set activation = '1',user_status = 'enable' where id = $id");
					
					$this->request->data['User']['id'] = $id;
					$this->request->data['User']['activation'] = '1';
					$this->request->data['User']['user_status'] = 'enable';
					$this->User->save($this->request->data);
					// $name = $userdetails[0]['User']['first_name'].' '.$userdetails[0]['User']['last_name'];
					if($this->Auth->login($userdetails)){
						
						$this->loadModel('Item');
						$this->loadModel('Category');
						$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
						foreach($prnt_cat_data as $parentCat){
							$parentCatId = $parentCat['Category']['id'];
							$category_name = $parentCat['Category']['category_name'];
							$ItemDatas = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$parentCatId,'Item.status'=>'publish'),'order'=>array('Item.id'=>'desc')));
							//echo "<pre>";print_r($pho_datas);	die;
							$allitemdatta[$parentCatId]['category_name'] = $category_name;
							$allitemdatta[$parentCatId]['parentCatId'] = $parentCatId;
								
							foreach($ItemDatas as $key=>$ppl_dt1){
								$itemIdses= $ppl_dt1['Item']['id'];
								$itemnames = $ppl_dt1['Item']['item_title'];
								$itemnamesUrl = $ppl_dt1['Item']['item_title_url'];
								$photimgName = $ppl_dt1['Photo'][0]['image_name'];
						
								if ($key < 4){
									$allitemdatta[$parentCatId]['Itemidd'][$key] = $itemIdses;
									//$allitemdatta[$user_id][$key]['item_title'] = $itemnames;
									//$allitemdatta[$user_id][$key]['item_title_url'] = $itemnamesUrl;
									$allitemdatta[$parentCatId]['image_name'][$key] = $photimgName;
									//$allitemdatta[$parentCatId][$key]['category_name'] = $category_name;
									//$allitemdatta[$parentCatId][$key]['parentCatId'] = $parentCatId;
									//$allitemdatta[$key]['cateids'] = $parentCatId;
									//$alldatta = $ppl_dt1[$user_id][$key][$itemIdses];
								}else {
									break;
								}
									
							}
						}
						
						$itemvalforfant = $this->Item->find('all',array('conditions'=>array('Item.status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
							
						
						//echo "<pre>";print_r($allitemdatta);die;
						
						$this->set('itemvalforfant',$itemvalforfant);
						$this->set('userid',$userid);
						$this->set('allitemdatta',$allitemdatta);
						
						//$cookie['email'] = $email;
						//$cookie['pass'] =  $this->Auth->password($userval[2]);
						//$this->Cookie->write('User',$cookie,true,'+2 weeks');
						//$this->request->data['User']['id'] = $userdata[0]['User']['id'];
						//$this->request->data['User']['last_login'] = date('Y-m-d H:i:s');
						//$this->User->save($this->request->data);
		
					}
						
					$this->Session->setFlash('Your account is Verified, please login and continue');
					$this->redirect('/');
				}else if($active == 1){
					if($this->Auth->login($userdetails)){
						$cookie['email'] = $email;
						$cookie['pass'] =  $this->Auth->password($userval[2]);
						$this->Cookie->write('User',$cookie,true,'+2 weeks');
							
					}
						
					$this->Session->setFlash('Your account was already Verified');
					$this->redirect('/');
				}
			}else{
				$this->Session->setFlash('You are not authenticated.Please signup ');
				$this->redirect('/');
			}
		}
		
		function logout(){
			$this->Session->destroy();
			/* $this->Cookie->destroy();
			if($this->isauthorized()){
				setcookie ("Admin", "", time() - 3600);
			}else{
				setcookie ("User", "", time() - 3600);				
			} 
			*/
			
			
			$this->redirect("/mobile/login");
			//echo "<script>window.location.href='/mobile/';</script>";

			
			
		}
		
		/* function userprofiles($name = null,$usrstates = null,$pagev = null){
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','- '.ucwords($name));
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$_SESSION['username_urls'] = $name;
			$this->loadModel('Item');
			$this->loadModel('Photo');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			//$this->loadModel('Log');
			//$this->loadModel('Comment');
			if(empty($name)){
				$this->Session->setFlash('Sorry, something went wrong');
				$this->redirect($this->referer());
			}
			//$this->set('title_for_layout',$name.' on Anekart');
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
		
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
		
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('setngs',$setngs);
			$usr_datas = $this->User->findByUsernameUrl($name);
			$current_page_userid = $usr_datas['User']['id'];
			$this->set('name',$name);
			$shopdatas = $itematas = $pho_datas = array();
			$this->loadModel('Follower');
			$flwrscnt = $this->Follower->flwrscnt($usr_datas['User']['id']);
			$followcnt = $this->Follower->followcnt($usr_datas['User']['id']);
			$flwrusrids = array();
			$totl_flwrs = 0;
			if(!empty($flwrscnt)){
				foreach($flwrscnt as $flws){
					$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					$flwrusrids[$flws['Follower']['follow_user_id']] = $flws['Follower']['follow_user_id'];
				}
		
			}
			$this->set('flwrusrids',$flwrusrids);
			if(!empty($followcnt)){
				foreach($followcnt as $flcnt){
					$flwngusrids[] = $flcnt['Follower']['user_id'];
				}
			}				
			$this->set('totl_flwrs',$totl_flwrs);
			$this->set('followcnt',$followcnt);
			$this->set('flwrscnt',$flwrscnt);
			$people_details = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwrusrids)));
				
			$people_details_for_following = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwngusrids)));
			foreach($people_details as $ppl_dtl){
				foreach($ppl_dtl['Itemfav'] as $ppl_dt){
					$ppl_dtda = $ppl_dt['item_id'];
					$pho_datass[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
				}
			}
				
	
		
			foreach($people_details_for_following as $ppl_dtl){
				foreach($ppl_dtl['Itemfav'] as $ppl_dt){
					$ppl_dtda = $ppl_dt['item_id'];
					$pho_datass_for_following[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
				}
			}
			
			//echo "<pre>";print_r($people_details_for_following);die;
			if(empty($usrstates)){
					
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$usr_datas['User']['id']),'order'=>array('Item.id'=>'desc')));
				$this->set('item_datas',$item_datas);
				if(!empty($usr_datas['Itemfav'])){
					foreach($usr_datas['Itemfav'] as $itms){
						$itmid[] = $itms['item_id'];
					}
					$itematas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
				}
		
			}
			
			
			//$userid = $loguser[0]['User']['id'];
			$itemdatasall = $this->Item->find('all',array('order' => 'RAND()'));
				
				
			$itemListsAll = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id'])));
				
			//$userdatasall = $this->User->findById($userid);
			$userfeatureid = $usr_datas['User']['featureditemid'];
			
				
			//echo "<pre>";print_r($people_details_for_following);die;
			$this->set('itemdatasall',$itemdatasall);
			$this->set('people_details',$people_details);
			$this->set('people_details_for_following',$people_details_for_following);
			$this->set('itematas',$itematas);
			if(!empty($pho_datass)){
				$this->set('pho_datass',$pho_datass);
			}
			if(!empty($pho_datass_for_following)){
				$this->set('pho_datass_for_following',$pho_datass_for_following);
			}
			$this->set('usr_datas',$usr_datas);
			$this->set('usrstates',$usrstates);
			$this->set('userid',$loguser[0]['User']['id']);
			$this->set('userfeatureid',$userfeatureid);
			$this->set('itemListsAll',$itemListsAll);
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
				
				
		} */
		
		function getmoreprofile(){
			$this->layout = 'ajax';
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Item');
			$this->loadModel('Photo');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			$this->loadModel('Follower');
			$this->loadModel('Wantownit');
			$this->loadModel('Log');
			$offset = $_GET['startIndex'];
			$limit = $_GET['offset'];
			$tab = $_GET['tab'];
			
			$usr_datas = $this->User->findByUsernameUrl($_SESSION['username_urls']);
			//$selectedTab = 'fantacy';$selectedTab = 'lists';$selectedTab = 'added';
			//$selectedTab = 'followers';$selectedTab = 'following';$selectedTab = 'wantit';
			//$selectedTab = 'ownit';
			if ($tab == 'added') {
				$item_datas = $this->Item->find('all',array('conditions'=>array(
						'Item.user_id'=>$usr_datas['User']['id']), 'order'=>array('Item.id'=>'desc'), 
						'offset'=>$offset, 'limit'=>$limit));
				$this->set('item_datas', $item_datas);
			}elseif ($tab == 'fantacy') {
				$favitemModel = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id']), 
						'offset'=>$offset, 'limit'=>$limit));
				$itematas = array();
				if (!empty($favitemModel)){
					foreach($favitemModel as $itms){
						$itmid[] = $itms['Itemfav']['item_id'];
					}
					$itematas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
				}
				$this->set('itematas', $itematas);
			}elseif ($tab == 'wantit') {
				$wantOwnModel = $this->Wantownit->find('all',array('fields'=>array('itemid'),
						'conditions'=>array('userid'=>$userid,'type'=>'want'),'offset'=>$offset, 
						'limit'=>$limit));
				$wantModel = array();
				foreach($wantOwnModel as $want){
					$wantModel[] = $want['Wantownit']['itemid'];
				}
				if (!empty($wantModel)){
					$wantItemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$wantModel)));
				}else{
					$wantItemModel = array();
				}
				$this->set('wantItemModel',$wantItemModel);
			}elseif ($tab == 'ownit') {
				$wantOwnModel = $this->Wantownit->find('all',array('fields'=>array('itemid'),
						'conditions'=>array('userid'=>$userid,'type'=>'own'),'offset'=>$offset, 
						'limit'=>$limit));
				$ownModel = array();
				foreach($wantOwnModel as $own){
					$ownModel[] = $own['Wantownit']['itemid'];
				}
				if (!empty($ownModel)){
					$ownItemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$ownModel)));
				}else{
					$ownItemModel = array();
				}
				$this->set('ownItemModel',$ownItemModel);
			}elseif($tab == 'lists'){
				$itemListsAll = $this->Itemlist->find('all',array('conditions'=>array(
						'user_id'=>$usr_datas['User']['id']),'offset'=>$offset, 
						'limit'=>$limit));
				
				$list_items = array();
				foreach ($itemListsAll as $key => $itemLists){
					$list_itemides = json_decode($itemLists['Itemlist']['list_item_id'], true);
					for ($i = 0; $i < 8; $i++){
						if (isset($list_itemides[$i]) && !in_array($list_itemides[$i], $list_items)){
							$list_items[] = $list_itemides[$i];
						}
					}
				}
				
				$itemdatasall = $this->Item->find('all',array('conditions'=>array('Item.id'=>$list_items),'order'=>array('Item.id'=>'desc')));
					
				//echo "<pre>";print_r($itemdatasall);die;
				$this->set('itemdatasall',$itemdatasall);
				$this->set('itemListsAll',$itemListsAll);
			}elseif ($tab == 'followers') {
				$flwrs = $this->Follower->flwrscntlimit($usr_datas['User']['id'], $offset, $limit);
				if(!empty($flwrs)){
					foreach($flwrs as $flws){
						$flwrusrids[$flws['Follower']['follow_user_id']] = $flws['Follower']['follow_user_id'];
					}
						
				}
				$people_details = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwrusrids)));
				//echo "<pre>";print_r($people_details);die;
				foreach($people_details as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$ppl_dtda = $ppl_dt['item_id'];
						$pho_datass[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
					}
				}
				if(!empty($pho_datass)){
					$this->set('pho_datass',$pho_datass);
				}
				$followcnt = $this->Follower->followcnt($usr_datas['User']['id']);
				$this->set('followcnt',$followcnt);
				$this->set('people_details',$people_details);
			}elseif ($tab == 'following') {
				$follow = $this->Follower->followcntlimit($usr_datas['User']['id'], $offset, $limit);
				if(!empty($follow)){
					foreach($follow as $flcnt){
						$flwngusrids[] = $flcnt['Follower']['user_id'];
					}
				}
				$people_details_for_following = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwngusrids)));
				foreach($people_details_for_following as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$ppl_dtda = $ppl_dt['item_id'];
						$pho_datass_for_following[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
					}
				}
				if(!empty($pho_datass_for_following)){
					$this->set('pho_datass_for_following',$pho_datass_for_following);
				}
				$followcnt = $this->Follower->followcnt($usr_datas['User']['id']);
				$this->set('followcnt',$followcnt);
				$this->set('people_details_for_following',$people_details_for_following);
			}
			$this->set('tab', $tab);
			$this->set('userid',$loguser[0]['User']['id']);
			$this->set('usr_datas',$usr_datas);
		}
		
		function userprofiles($name = null,$usrstates = null,$pagev = null){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- '.ucwords($name));
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$_SESSION['username_urls'] = $name;
			$this->loadModel('Item');
			$this->loadModel('Photo');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
		 	$this->loadModel('Wantownit');
			$this->loadModel('Log');
			//$this->loadModel('Comment');
			if(empty($name)){
				//$this->Session->setFlash('Sorry, something went wrong');
				$this->redirect($this->referer());
			}
			//$this->set('title_for_layout',$name.' on Anekart');
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
		
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
		
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('setngs',$setngs);
			$usr_datas = $this->User->findByUsernameUrl($name);
			$current_page_userid = $usr_datas['User']['id'];
			$this->set('name',$name);
			$shopdatas = $itematas = $pho_datas = array();
			$this->loadModel('Follower');
			$flwrscnt = $this->Follower->flwrscnt($usr_datas['User']['id']);
			$followcnt = $this->Follower->followcnt($usr_datas['User']['id']);
			$flwrs = $this->Follower->flwrscntlimit($usr_datas['User']['id'],0,15);
			$follow = $this->Follower->followcntlimit($usr_datas['User']['id'],0,15);
			$flwrusrids = array();
			$totl_flwrs = 0;
			if(!empty($flwrscnt)){
				foreach($flwrscnt as $flws){
					$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					//$flwrusrids[$flws['Follower']['follow_user_id']] = $flws['Follower']['follow_user_id'];
				}
		
			}
			if(!empty($flwrs)){
				foreach($flwrs as $flws){
					$flwrusrids[$flws['Follower']['follow_user_id']] = $flws['Follower']['follow_user_id'];
				}
			
			}
			$this->set('flwrusrids',$flwrusrids);
			if(!empty($follow)){
				foreach($follow as $flcnt){
					$flwngusrids[] = $flcnt['Follower']['user_id'];
				}
			}
			
			$this->set('totl_flwrs',$totl_flwrs);
			$this->set('followcnt',$followcnt);
			$this->set('flwrscnt',$flwrscnt);
			
			if(isset($_REQUEST['followers'])){
				$people_details = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwrusrids)));
				//echo "<pre>";print_r($people_details);die;
				foreach($people_details as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$ppl_dtda = $ppl_dt['item_id'];
						$pho_datass[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
					}
				}
				if(!empty($pho_datass)){
					$this->set('pho_datass',$pho_datass);
				}
				$this->set('people_details',$people_details);
			}else{
				$people_details = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwrusrids)));
				$this->set('people_details',$people_details);
			}
			
			if(isset($_REQUEST['following'])){
				$people_details_for_following = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwngusrids)));
				foreach($people_details_for_following as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$ppl_dtda = $ppl_dt['item_id'];
						$pho_datass_for_following[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
					}
				}
				if(!empty($pho_datass_for_following)){
					$this->set('pho_datass_for_following',$pho_datass_for_following);
				}
				$this->set('people_details_for_following',$people_details_for_following);
			}else{
				$people_details_for_following = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id'=>$flwngusrids)));
				$this->set('people_details_for_following',$people_details_for_following);
			}
				
			//echo "<pre>";print_r($people_details_for_following);die;
			if(empty($usrstates)){
					
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$usr_datas['User']['id']),'order'=>array('Item.id'=>'desc'),'limit'=>'15'));
				$item_datas_count = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$usr_datas['User']['id'])));
				$this->set('item_datas',$item_datas);
				$this->set('item_datas_count',$item_datas_count);
				
				$favitemModel = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id']),
						'limit'=>15));
				$favitemCount = $this->Itemfav->find('count',array('conditions'=>array(
						'user_id'=>$usr_datas['User']['id'])));
				$this->set('favitemCount',$favitemCount);
				//echo "<pre>";print_r($favitemModel);die;
				if(!empty($favitemModel)){
					foreach($favitemModel as $itms){
						$itmid[] = $itms['Itemfav']['item_id'];
					}
					$itematas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
					$this->set('itematas',$itematas);
					//echo implode(',', $itmid)."<pre>";print_r($itmid);print_r($itematas);die;
				}
				$this->set('startIndex',15);
		
			}
			if(isset($_REQUEST['wantit'])){
				$wantOwnModel = $this->Wantownit->find('all',array('fields'=>array('itemid'),'conditions'=>array('userid'=>$userid,'type'=>'want'),'limit'=>15));
				$wantModel = array();
				foreach($wantOwnModel as $want){
					$wantModel[] = $want['Wantownit']['itemid'];
				}
				if (!empty($wantModel)){
					$wantItemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$wantModel)));
				}else{
					$wantItemModel = array();
				}
				$this->set('wantItemModel',$wantItemModel);
			}
			$wantCount = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,
							'type'=>'want')));
			$this->set('wantCount',$wantCount);
				
			if(isset($_REQUEST['ownit'])){
				$wantOwnModel = $this->Wantownit->find('all',array('fields'=>array('itemid'),'conditions'=>array('userid'=>$userid,'type'=>'own'),'limit'=>15));
				$ownModel = array();
				foreach($wantOwnModel as $own){
					$ownModel[] = $own['Wantownit']['itemid'];
				}
				if (!empty($ownModel)){
					$ownItemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$ownModel)));
				}else{
					$ownItemModel = array();
				}
				$this->set('ownItemModel',$ownItemModel);
			}
			$OwnCount = $this->Wantownit->find('count',array('conditions'=>array('userid'=>$userid,
									'type'=>'own')));
			$this->set('ownCount',$OwnCount);
			
			/* $loguserdetails = $this->Log->find('all',array('conditions' =>array('user_id' =>$current_page_userid),'limit'=>3,'order'=>array('id'=>'desc')));
		
		
			foreach($loguserdetails as $log){
			$not_type[$log['Log']['id']] = $log['Log']['type'];
			$notific_id[$log['Log']['id']] = $log['Log']['notification_id'];
			//$Log_cdate[$log['Log']['id']] = $log['Log']['cdate'];
				
			if($log['Log']['type'] == 'comment'){
			$getLogvalues[] = $this->Comment->findById($log['Log']['notification_id']);
			}
			if($log['Log']['type'] == 'favorite'){
			$getLogvalues[] = $this->Item->findById($log['Log']['notification_id']);
			}
			if($log['Log']['type'] == 'additem'){
			$getLogvalues[] = $this->Item->findById($log['Log']['notification_id']);
			}
				
			if($log['Log']['type'] == 'follow'){
			$getLogvalues[] = $this->User->findById($log['Log']['follow_id']);
			}
				
			}
		
		
			$this->set('getLogvalues',$getLogvalues);
			$this->set('loguserdetails',$loguserdetails); */
				
			//$userid = $loguser[0]['User']['id'];
		
			if(isset($_REQUEST['lists'])){
				$itemListsAll = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id']),'limit'=>15));
			
				//$userdatasall = $this->User->findById($userid);
				//$userfeatureid = $usr_datas['User']['featureditemid'];
				
				$list_items = array();
				foreach ($itemListsAll as $key => $itemLists){
					$list_itemides = json_decode($itemLists['Itemlist']['list_item_id'], true);
					for ($i = 0; $i < 8; $i++){
						if (isset($list_itemides[$i]) && !in_array($list_itemides[$i], $list_items)){
							$list_items[] = $list_itemides[$i];
						}
					}
				}
				
				$itemdatasall = $this->Item->find('all',array('conditions'=>array('Item.id'=>$list_items),'order'=>array('Item.id'=>'desc')));
			
				//echo "<pre>";print_r($itemdatasall);die;
				$this->set('itemdatasall',$itemdatasall);
				$this->set('itemListsAll',$itemListsAll);
			}else{
				$itemListsAll = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id'])));
				$this->set('itemListsAll',$itemListsAll);
			}
			
			
			if(isset($_GET['news'])){
			
				$postmessage = $this->Log->find('all',array('conditions'=>array('Log.user_id'=>$userid,'Log.type'=>'sellermessage'),'order'=>array('Log.id'=>'desc')));
				$this->set('postmessage',$postmessage);
				//echo "<pre>";print_r($postmessage);die;
			
			}
				
			if(isset($_GET['userapprove'])){
				//echo $current_page_userid;die;
				$itemcreateduserid = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$current_page_userid),'fields' => array('Item.id','Item.user_id'),'order'=>array('Item.id'=>'desc')));
				foreach($itemcreateduserid as $itemuserids){
					$itemUserids[] = $itemuserids['Item']['id'];
				}
				//echo "<pre>";print_r($itemUserids);die;
			
			
				$this->loadModel('Fashionuser');
				$fashionuser = $this->Fashionuser->find('all',array('conditions'=>array('Fashionuser.itemId'=>$itemUserids),'order'=>array('Fashionuser.id'=>'desc')));
				/*
				 $this->paginate = array('conditions'=>array('Fashionuser.itemId'=>$itemUserids),'limit'=>2,'order'=>array('Fashionuser.id'=>'desc'));
				$fashionuser = $this->paginate('Fashionuser');
				$pagecount = $this->params['paging']['Fashionuser']['count'];
				$this->set('pagecount',$pagecount); */
				$this->set('fashionuser',$fashionuser);
				//echo "<pre>";print_r($fashionuser);die;
			}
				
			if(isset($_GET['photos'])){
				$this->loadModel('Shopuserphoto');
				$shpusrimgg = $this->Shopuserphoto->find('all',array('conditions'=>array('Shopuserphoto.shop_id'=>$current_page_userid,'Shopuserphoto.status'=>'yes'),'order'=>array('Shopuserphoto.id'=>'desc')));
				$this->set('shpusrimgg',$shpusrimgg);
				//echo "<pre>";print_r($postmessage);die;
					
			}
				
			if(isset($_GET['shopphotoapprove'])){
				//echo $current_page_userid;die;
				/* $itemcreateduserid = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$current_page_userid),'fields' => array('Item.id','Item.user_id'),'order'=>array('Item.id'=>'desc')));
				 foreach($itemcreateduserid as $itemuserids){
				$itemUserids[] = $itemuserids['Item']['id'];
				} */
				//echo "<pre>";print_r($itemUserids);die;
					
					
				$this->loadModel('Shopuserphoto');
				$inshoppageuserimgapprove = $this->Shopuserphoto->find('all',array('conditions'=>array('Shopuserphoto.shop_id'=>$current_page_userid),'order'=>array('Shopuserphoto.id'=>'desc')));
				/*
				 $this->paginate = array('conditions'=>array('Fashionuser.itemId'=>$itemUserids),'limit'=>2,'order'=>array('Fashionuser.id'=>'desc'));
				$fashionuser = $this->paginate('Fashionuser');
				$pagecount = $this->params['paging']['Fashionuser']['count'];
				$this->set('pagecount',$pagecount); */
				$this->set('inshoppageuserimgapprove',$inshoppageuserimgapprove);
				//echo "<pre>";print_r($fashionuser);die;
			}
			
			$this->set('usr_datas',$usr_datas);
			$this->set('usrstates',$usrstates);
			$this->set('userid',$loguser[0]['User']['id']);
			//$this->set('userfeatureid',$userfeatureid);
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
		
		
		}
		
		function manageprofile($name = null){
			global $loguser;
			if(!$this->isauthenticated())
			$this->redirect('/');
			
			if(empty($name)){
				$this->Session->setFlash('Sorry, something went wrong');
				$this->redirect($this->referer());
			}
			
			$this->set('title_for_layout',$name);
			//manage/profile
			
			if(!$loguser[0]['User']['id']){
				$this->Session->setFlash('You are not authenticate to edit others profile.');
				$this->redirect($this->referer());
			}
			
			$usr_datas = $this->User->findById($loguser[0]['User']['id']);
			//echo "<pre>";print_R($usr_datas);die;
			
			if(!empty($this->request->data)){
				// echo "<pre>";print_R($this->request->data);die;
				
				$this->request->data['User']['id'] = $loguser[0]['User']['id'];
				$username = $this->request->data['User']['username'] = $loguser[0]['User']['username'];
				//$name = $this->request->data['User']['username'];
				$name = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
				$this->request->data['User']['location'] = $this->request->data['User']['city'];
				$this->request->data['User']['about'] = $this->request->data['User']['about'];
				$this->request->data['User']['profile_image'] = $this->request->data['image'];
				
				$this->User->save($this->request->data);
				$this->redirect('/people/'.$name);
			}
			
			$this->set('usr_datas',$usr_datas);
			$this->set('name',$name);
		}
		
		
		/* add Follow users */
		function addflw_usrs(){
			global $loguser;
			$logusrid = $loguser[0]['User']['id'];
			$userid = $_REQUEST['usrid'];
			$this->loadModel('Follower');
			$this->loadModel('Shop');
			$flwalrdy = $this->Follower->find('count',array('conditions'=>array('user_id'=>$userid,'follow_user_id'=>$logusrid)));
			//echo "<pre>";print_r($flwalrdy);die;
			
			if($flwalrdy > 0){
				echo "error";
			}else{
				$this->request->data['Follower']['user_id'] = $userid;
				$this->request->data['Follower']['follow_user_id'] = $logusrid;
				$this->Follower->save($this->request->data);
				
				$flwrscnt = $this->Follower->flwrscnt($userid);
				$totl_flwrs = 0;
				if(!empty($flwrscnt)){
					foreach($flwrscnt as $flws){
						$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					}
					$totl_flwrs -= 1;
				}
				$this->Shop->updateAll(array('follow_count' => "'$totl_flwrs'"), array('user_id' => $userid));
				
				$logdetails = $this->logs('follow','0',$logusrid,$userid);
				
				echo 0;
			}	
			die;
		}
		
		function delerteflw_usrs(){
			global $loguser;
			$logusrid = $loguser[0]['User']['id'];
			$userid = $_REQUEST['usrid'];
			$this->loadModel('Follower');
			$this->loadModel('Shop');
			$flwalrdy = $this->Follower->find('count',array('conditions'=>array('user_id'=>$userid,'follow_user_id'=>$logusrid)));
			
			if($flwalrdy > 0){
				$this->Follower->deleteAll(array('user_id' => $userid,'follow_user_id' => $logusrid));
				$flwrscnt = $this->Follower->flwrscnt($userid);
				$totl_flwrs = 0;
				if(!empty($flwrscnt)){
					foreach($flwrscnt as $flws){
						$totl_flwrs = $totl_flwrs + $flws[0]['totl_flwrscnt'];
					}
					$totl_flwrs -= 1;
				}
				$this->Shop->updateAll(array('follow_count' => "'$totl_flwrs'"), array('user_id' => $userid));
				
				echo 0;
			}else{
				echo "error";
			}
			die;
		}
		
		function conversation(){
			global $loguser;
			$this->set('title_for_layout','Conversation');
			$this->loadModel('Conversation');
			$logusrid = $loguser[0]['User']['id'];
			$msgdata = $this->Conversation->find('all',array('conditions'=>array('msg_id'=>'1','OR' => array(array('Conversation.user1' => $logusrid),array('Conversation.user2' => $logusrid)))));
			
			$msgdat_unread = $this->Conversation->find('all',array('conditions'=>array('user2read'=>'no','user2'=>$logusrid),'fields'=>array('con_id')));
			
			foreach($msgdata as $msg){
				$msg1 = $msg['Conversation']['con_id'];
				$msgcountdata[$msg1] = $this->Conversation->find('count',array('conditions'=>array('con_id'=>$msg1)));
			}
			
			foreach($msgdat_unread as $msgunread){
				$msgdat_unread1[] = $msgunread['Conversation']['con_id'];
			}
		
			if(isset($msgdat_unread1)){
				$this->set('msgdat_unread',$msgdat_unread1);
			}
			$this->set('msgdata',$msgdata);
			$this->set('msgcountdata',$msgcountdata);
		
		}
		
		function composemsg(){
			global $loguser;
			$this->set('title_for_layout','Conversation');
			$this->loadModel('Conversation');
			$this->loadModel('User');
			$prefix = $this->Conversation->tablePrefix;
			if(!empty($this->request->data)){
				
				$recipientname = $this->request->data['conversionmsg']['username'];
				$logusrid = $loguser[0]['User']['id'];
				$usr_datas = $this->User->findByUsername($recipientname);
				if(!empty($usr_datas)){
				$recipient_id  = $usr_datas['User']['id'];
				}else{
				$recipient_id  = '0';
				}
				$countno = $this->User->query("select count(*) as count from ".$prefix."conversations");
				$countid = $countno[0][0]['count'];
				if($countid==0){
					$countid = '1';
				}else{
					$countid +=1;
				}
					$this->request->data['Conversation']['con_id'] = $countid;
					$this->request->data['Conversation']['msg_id'] = '1';
					$this->request->data['Conversation']['user1'] = $logusrid;
					$this->request->data['Conversation']['user2'] = $recipient_id;
					$this->request->data['Conversation']['subject'] = $this->request->data['conversionmsg']['subject'];
					$this->request->data['Conversation']['message'] = $this->request->data['conversionmsg']['message'];
					$this->request->data['Conversation']['user1read'] = 'yes';
					$this->request->data['Conversation']['user2read'] = 'no';
					$this->request->data['Conversation']['created'] = time();
					$this->Conversation->save($this->request->data);
					$this->redirect('/conversation');
			}
		}
		
		function readmsg($conver_id = null){
			global $loguser;
			$this->set('title_for_layout','Conversation');
			$this->loadModel('Conversation');
			$logusrid = $loguser[0]['User']['id'];
			$prefix = $this->Conversation->tablePrefix;
			
			if(!empty($this->request->data)){
				
				$rowcounts = $this->Conversation->find('all',array('conditions'=>array('Conversation.con_id'=>$conver_id)));
				
				$rowcounts = count($rowcounts);
				
				$rowcounts +=1;
				//$conver_id +=1;
				$this->Conversation->create();
				$this->request->data['Conversation']['con_id'] = $conver_id;
				$this->request->data['Conversation']['msg_id'] =$rowcounts;
				$this->request->data['Conversation']['user1'] = $logusrid;
				$this->request->data['Conversation']['user2'] = $this->request->data['replymsg']['user2val'];
				$this->request->data['Conversation']['message'] = $this->request->data['replymsg']['message'];
				$this->request->data['Conversation']['user1read'] = 'yes';
				$this->request->data['Conversation']['user2read'] = 'no';
				$this->request->data['Conversation']['created'] = time();
				$this->Conversation->save($this->request->data);
				
				$this->redirect('/conversation');
			}else{
			//echo "Update ".$prefix."conversations set user2read = 'yes' where id = $conver_id";die;
			$this->Conversation->query("Update ".$prefix."conversations set user2read = 'yes' where con_id = $conver_id and user1 != $logusrid");
			$conver_msg = $this->Conversation->find('all',array('conditions'=>array('Conversation.con_id'=>$conver_id),'order'=>'Conversation.msg_id '));
			$this->set('conver_msg',$conver_msg);
			$this->set('conver_id',$conver_id);
				
			}
			
					
		}
		
		function shopsearch($name = null){
			$this->loadModel('Shop');
			$this->loadModel('Photo');
			if(!empty($this->request->data)){
				$search_val = $this->request->data['search_shop'];
				$this->paginate = array('conditions'=>array('Shop.shop_name like'=>$search_val."%"),'limit'=>20,'order'=>array('Shop.id'=>'desc'));
				$shop_details = $this->paginate('Shop');
				$img_dtls = $this->Photo->find('all');
			}
			$this->set('shop_details',$shop_details);
			$this->set('img_dtls',$img_dtls);
		
		}
		
		function peoplesearch($name = null){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Find Friends ');
			global $loguser;
			global $siteChanges;
			$user_id = $loguser[0]['User']['id'];
			$this->loadModel('User');
			$this->loadModel('Photo');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Follower');
			$this->loadModel('Category');
			$followcnt = $this->Follower->followcnt($loguser[0]['User']['id']);
			
			
			if(!empty($this->request->data)){
				$username_val = $this->request->data['search_people'];
			}
				if(!empty($username_val)){
					//$this->paginate =  array('conditions'=>array('user_level <>'=>'god','username like'=>$srcs.'%'),'limit'=>10,'order'=>array('id'=>'desc'));
					$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.username like'=>$username_val."%",'User.id <>'=>$user_id),'limit'=>5,'order'=>array('User.id'=>'desc')));
				}else{
					//$this->paginate =  array('conditions'=>array('user_level <>'=>'god'),'limit'=>10,'order'=>array('id'=>'desc'));
					$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id <>'=>$user_id),'limit'=>5,'order'=>array('User.id'=>'desc')));
				}
		
				foreach($people_details as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$ppl_dtda = $ppl_dt['item_id'];
						$pho_datas[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
					}
				}
				
				$getsimilaruser = $this->User->find('all',array('conditions'=>array('User.id'=>$loguser[0]['User']['id'])));
				foreach($getsimilaruser as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
							$users_item_favides[] = $ppl_dt['item_id'];
					}
				}
				//echo "<pre>";print_r($users_item_favides);	die;
				$sameitemfav = $this->Itemfav->find('all',array('conditions'=>array('Itemfav.item_id'=>$users_item_favides,'Itemfav.item_id <>'=>$loguser[0]['User']['id'])));
				
				foreach($sameitemfav as $ppl_dtl){
					//echo "<pre>";print_r($ppl_dtl['Itemfav']['user_id']);
					$similar_users[] = $ppl_dtl['Itemfav']['user_id'];
						
				}
				
				//die;
				$similar_users = array_unique($similar_users);
				//echo "<pre>";print_r($similar_users);	die;
				$similaruser_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.id <>'=>$user_id,'User.id'=>$similar_users),'order'=>array('User.id'=>'desc')));
				//echo "<pre>";print_r($similaruser_details);	die;
				foreach($similaruser_details as $ppl_dtl){
					foreach($ppl_dtl['Itemfav'] as $ppl_dt){
						$allitem_id = $ppl_dt['item_id'];
						$allitem_id_img[$allitem_id] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$allitem_id)));
					}
				}
			
			$this->set('similaruser_details',$similaruser_details);
			$this->set('allitem_id_img',$allitem_id_img);
			if(isset($pho_datas)){
				$this->set('pho_datas',$pho_datas);
			}
			if(isset($people_details)){
				$this->set('people_details',$people_details);
			}
			if(isset($username_val)){
				$this->set('username_val',$username_val);
			}
			$this->set('userid',$loguser[0]['User']['id']);
			
			$this->set('followcnt',$followcnt);
			$this->set('roundProf',$siteChanges['profile_image_view']);
		
		}
		
		
		function daily_update(){
			$this->loadModel('Item');
			$this->loadModel('User');
			$this->loadModel('Itemfav');
			$itm_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order'=>'Item.id DESC'));
			foreach ($itm_data as $items){
				$bef_time = $items['Item']['created_on'];
				$date_dif = $this->Urlfriendly->date_diff($bef_time,time());
				if($date_dif['days']==0){
					$item_idd[] = $items['Item']['id'];
				}
		
			}
			if(!empty($item_idd)){
			foreach ($item_idd as $findid){
				$find_item_id = $this->Itemfav->find('count',array('conditions'=>array('Itemfav.item_id'=>$findid)));
				$find_item_ids[$findid] = $find_item_id;
			}
			arsort($find_item_ids);
			$users_data = $this->User->find('all',array('conditions'=>array('user_level <>'=>'god','User.subs'=>1)));
			$item_count = 0;
			foreach ($find_item_ids as $key=>$val){
				if($item_count<12){
					$items_data[] = $this->Item->find('all',array('conditions'=>array('Item.id'=>$key)));
				}else{
					break;
				}
				$item_count++;
			}
				
			foreach ($users_data as $userr){
				//$user_email = $userr['User']['email'];
				$this->Email->to = "saravananm@hitasoft.com";
				$this->Email->subject = "Best of the week! Anekart's top picks for you";
				$this->Email->from = "anekart@anekart.com";
				$this->Email->sendAs = "html";
				$this->Email->template = 'daily_update_email';
				$this->set('items_data',$items_data);
		
				
				$this->Email->send();
		
			}
			}
		}
		
     
		/* function user_update(){
			global $loguser;
			$this->layout = 'frontlayout';
			$this->set('title_for_layout','- Settings');
			if(!empty($this->request->data)){
				$this->request->data['User']['id'] = $loguser[0]['User']['id'];
				$this->request->data['User']['profile_image'] = $this->request->data['src'];
		     	$this->User->save($this->request->data);
				$this->Session->setFlash('Successfully Updated', 'default', array(), 'good');
				$this->redirect('/people/');
		
			}
		
			$this->set('usr_datas',$usr_datas);
	      	$this->set('roundProf',$siteChanges['profile_image_view']);
		} */
		
		
		function user_update(){
			$this->layout = 'ajax';
			$this->autoRender = false;
			global $loguser;
			if(!empty($this->request->data)){
				$this->loadModel('Fashionuser');
				//echo "<pre>";print_r($this->request->data);die;
				$this->request->data['Fashionuser']['user_id'] = $loguser[0]['User']['id'];
				$this->request->data['Fashionuser']['userimage'] = $this->request->data['src'];
				$this->request->data['Fashionuser']['itemId'] = $this->request->data['ItemId'];
				$this->request->data['Fashionuser']['cdate'] = time();
				if($this->request->data['src'] != 'usrimg.jpg' && $this->request->data['src'] != ''){
					$this->Fashionuser->save($this->request->data);
				}
			}
		}

		function findusers() {
			$this->autoRender = false;
			global $loguser;
			global $siteChanges;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('User');
			$this->loadModel('Photo');
			$this->loadModel('Item');
			$this->loadModel('Follower');
			$startIndex = $_GET['startIndex'];
			$offset = $_GET['offset'];
			$username_val = $_GET['enteredname'];
				
			$followcnt = $this->Follower->followcnt($loguser[0]['User']['id']);
			
			$roundImage = "";
			if($siteChanges['profile_image_view'] == "round") {
				$roundImage = "border-radius:50px;";
			}
			if(!empty($username_val)){
				$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.username like'=>$username_val."%",'User.id <>'=>$userid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('User.id'=>'desc')));
			}else{
				$people_details =  $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god','User.activation <>'=>'0','User.id <>'=>$userid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('User.id'=>'desc')));
			}
				
			foreach($people_details as $ppl_dtl){
				foreach($ppl_dtl['Itemfav'] as $ppl_dt){
					$ppl_dtda = $ppl_dt['item_id'];
					$pho_datas[$ppl_dtda] = $this->Photo->Item->find('all',array('conditions'=>array('Item.id'=>$ppl_dtda)));
				}
			}
				
			if (count($people_details) != 0) {
		
	
			if(!empty($people_details)){
				foreach($people_details as $key => $ppls){
					//if(!empty($ppls['Itemfav'])){
					//echo "<pre>";print_r($ppls);
					$user_nam = $ppls['User']['username'];
					$user_first = $ppls['User']['first_name'];
					$user_imges = $ppls['User']['profile_image'];
					$user_nam_url = $ppls['User']['username_url'];
	
					echo "<li class='stream-item' style='padding:0;'>";
            		echo "<div class='peopleheaders'>"; 
					if(!empty($user_imges)){
						echo " <a href='".SITE_URL."people/".$user_nam_url."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/".$user_imges."' style='height: 40px; width: 40px; padding: 7px;".$roundImage."' /></a>";
					}else{
						echo " <a href='".SITE_URL."people/".$user_nam_url."' class='vcard'><img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='height: 40px; width: 40px; padding: 7px;".$roundImage."' /></a>";
					}
					echo " <a href='".SITE_URL."people/".$user_nam_url."' class='username' style='position: absolute; top: 10px; left: 55px;'>$user_first</a>";
					echo " <a href='".SITE_URL."people/".$user_nam_url."' class='nick' style='position: absolute; top: 27px; left: 55px;'>@".$user_nam_url."</a>";
						
					foreach($followcnt as $flcnt){
					$flwrcntid[] = $flcnt['Follower']['user_id'];
						
					}
					if($userid != $ppls['User']['id']){
					if(!in_array($ppls['User']['id'],$flwrcntid)){
					$flw = true;
					}else{
						$flw = false;
					}
						
					if($flw){
					echo "<span class='follow' id='foll".$ppls['User']['id']."'>";
					echo '<button type="button" id="follow_btn'.$ppls['User']['id'].'" class="btnblu" onclick="getfollows('.$ppls['User']['id'].')">';
							echo '<span class="foll'.$ppls['User']['id'].'" >Follow</span>';
						echo '</button>';
					echo "</span>";
					}else{
					echo "<span class='follow' id='unfoll".$ppls['User']['id']."'>";
					echo '<button type="button" id="unfollow_btn'.$ppls['User']['id'].'" class="greebtn" onclick="deletefollows('.$ppls['User']['id'].')">';
						echo '<span class="unfoll'.$ppls['User']['id'].'" >Following</span>';
					echo '</button>';
					echo "</span>";
					}				
					echo '<span id="changebtn'.$ppls['User']['id'].'" ></span>';
					}
					echo '</div>';
					echo '<span  class="things">';
					foreach($ppls['Itemfav'] as $key=>$img_dtel){
					$itemid = $img_dtel['item_id'];
					$count=0;
					foreach($pho_datas as $key=>$val){
					if(!empty($val) and $count<4){
				if($itemid == $key){
				//echo "<pre>";print_r($val);
				echo "<a href='".SITE_URL."listing/".$itemid."/".$val[0]['Item']['item_title_url']."' >";
				if(!empty($val)){
					echo "<img src='".$_SESSION['media_url']."media/items/thumb70/".$val[0]['Photo'][0]['image_name']."' width='30px' height='30px' /> &nbsp";
				}else{
				echo "<img src='".$_SESSION['media_url']."media/items/thumb70/usrimg.jpg'  width='30px' height='30px' />";
				}
				echo "</a>";
				}
				$count++;
				}
				}
				}
					
					
				echo "</span></li>";
				}
			}
	
			}else{
				echo 'false';
			}
		}
	
		/**
		 * Raja Hussain
		 * To list the items purchased by the 
		 * User
		 */
		function purchaseditem () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			$itemModel = array();
		
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('Forexrate');
			
			$forexrateModel = $this->Forexrate->find('all');
			$currencySymbol = array();
			foreach($forexrateModel as $forexrate){
				$cCode = $forexrate['Forexrate']['currency_code'];
				$cSymbol = $forexrate['Forexrate']['currency_symbol'];
				$currencySymbol[$cCode] = $cSymbol;
			}
		
			$ordersModel = $this->Orders->find('all',array('conditions'=>array('userid'=>$userid),'order'=>array('orderid'=>'desc')));
			$orderid = array();
			foreach ($ordersModel as $value) {
				$orderid[] = $value['Orders']['orderid'];
			}
			if(count($orderid) > 0) {
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemid = array();
				foreach ($orderitemModel as $value) {
					$orid = $value['Order_items']['orderid'];
					if (!isset($oritmkey[$orid])){
						$oritmkey[$orid] = 0;
					}
					$itemid[] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemname'] = $value['Order_items']['itemname'];
					$orderitems[$orid][$oritmkey[$orid]]['itemtotal'] = $value['Order_items']['itemprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemsunitprice'] = $value['Order_items']['itemunitprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemssize'] = $value['Order_items']['item_size'];
					$orderitems[$orid][$oritmkey[$orid]]['quantity'] = $value['Order_items']['itemquantity'];
					$oritmkey[$orid]++;
				}
				/* if (count($itemid) > 0) {
					$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid)));
				}
				foreach($itemModel as $item) {
					$itemArray[$item['Item']['id']] = $item['Item'];
				} */
			}
			$orderDetails = array();
			foreach ($ordersModel as $key => $orders){
				$orderid = $orders['Orders']['orderid'];
				$orderCurny = $orders['Orders']['currency'];
				$orderDetails[$key]['orderid'] = $orders['Orders']['orderid'];
				$orderDetails[$key]['price'] = $orders['Orders']['totalcost'];
				$orderDetails[$key]['saledate'] = $orders['Orders']['orderdate'];
				$orderDetails[$key]['status'] = $orders['Orders']['status'];
				$itemkey = 0;
				foreach ($orderitems[$orderid] as $orderkey => $orderitem) {
					//$itemTable = $itemArray[$orderitem];
					$orderDetails[$key]['orderitems'][$itemkey]['itemname'] = $orderitems[$orderid][$orderkey]['itemname'];
					$orderDetails[$key]['orderitems'][$itemkey]['quantity'] = $orderitems[$orderid][$orderkey]['quantity'];
					$orderDetails[$key]['orderitems'][$itemkey]['price'] = $orderitems[$orderid][$orderkey]['itemtotal'];
					$orderDetails[$key]['orderitems'][$itemkey]['unitprice'] = $orderitems[$orderid][$orderkey]['itemsunitprice'];
					$orderDetails[$key]['orderitems'][$itemkey]['size'] = $orderitems[$orderid][$orderkey]['itemssize'];
					$orderDetails[$key]['orderitems'][$itemkey]['cSymbol'] = $currencySymbol[$orderCurny];
					$itemkey++;
				}
			}			
			//echo "<pre>";print_r($orderitems);die;
			$this->set('orderDetails',$orderDetails);
			
		}
		
		function buyerorderdetails($orderid){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Trackingdetails');
			$this->loadModel('Photos');
			$this->loadModel('Forexrate');
			
			$orderModel = $this->Orders->findByorderid($orderid);
			$merchantid = $orderModel['Orders']['merchant_id'];
			$userModel = $this->User->findByid($userid);
			$merchantModel = $this->User->findByid($merchantid);
			$userEmail = $userModel['User']['email'];
			$shipppingId = $orderModel['Orders']['shippingaddress'];
			$currencyCode = $orderModel['Orders']['currency'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shipppingId);
			$trackingModel = $this->Trackingdetails->findByorderid($orderid);
			$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
			
			$forexrateModel = $this->Forexrate->find('first',array('conditions'=>array(
					'currency_code'=>$currencyCode)));
			$currencySymbol = $forexrateModel['Forexrate']['currency_symbol'];
			$itemModel = array();
			foreach($orderitemModel as $okey => $orderitem){
				$itemModle[$okey]['itemname'] = $orderitem['Order_items']['itemname'];
				$itemModle[$okey]['itemsize'] = $orderitem['Order_items']['item_size'];
				$itemModle[$okey]['itemprice'] = $orderitem['Order_items']['itemprice'];
				$itemModle[$okey]['itemquantity'] = $orderitem['Order_items']['itemquantity'];
				$itemModle[$okey]['shippingprice'] = $orderitem['Order_items']['shippingprice'];
				$itemModle[$okey]['itemunitprice'] = $orderitem['Order_items']['itemunitprice'];
				$itemid = $orderitem['Order_items']['itemid'];
				$photoModel = $this->Photos->findByitem_id($itemid);
				$itemModle[$okey]['itemimage'] = $photoModel['Photos']['image_name'];
				$itemurlname = $this->Urlfriendly->utils_makeUrlFriendly($orderitem['Order_items']['itemname']);
				$itemModle[$okey]['itemurl'] = 'listing/'.$itemid."/".$itemurlname;
				
				//$itemModle[$okey][''] = $orderitem['Order_items'][''];
			}
			
			//echo "<pre>";print_r($itemModle);die;
			
			$this->set('orderModel', $orderModel);
			$this->set('orderitemModel',$orderitemModel);
			$this->set('userModel',$userModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('trackingModel',$trackingModel);
			$this->set('itemModle',$itemModle);
			$this->set('currencyCode',$currencyCode);
			$this->set('currencySymbol',$currencySymbol);
		}
		
		function buyerconversation($orderid){
			global $loguser;
			global $siteChanges;
			global $setngs;
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Conversation');
			$this->loadModel('Orders');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Ordercomments');
				
			$orderModel = $this->Orders->findByorderid($orderid);
			$ordercommentsModel = $this->Ordercomments->find('all',array('conditions'=>array('orderid'=>$orderid),'order'=>'id DESC'));
			$buyerid = $orderModel['Orders']['userid'];
			$merchantid = $orderModel['Orders']['merchant_id'];
			$buyerModel = $this->User->findByid($buyerid);
			$merchantModel = $this->User->findByid($merchantid);
			$sellerName = $merchantModel['User']['first_name'];
			
			$this->set('orderModel', $orderModel);
			$this->set('buyerModel',$buyerModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('ordercommentsModel',$ordercommentsModel);
			$this->set('sellerName',$sellerName);
			$this->set('roundProf',$siteChanges['profile_image_view']);
		}
	
		/**
		 * Raja Hussain
		 * To list the orders history
		 * the User have received
		 */
		function myorders () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			$itemModel = array();
		
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('Forexrate');
				
			$forexrateModel = $this->Forexrate->find('all');
			$currencySymbol = array();
			foreach($forexrateModel as $forexrate){
				$cCode = $forexrate['Forexrate']['currency_code'];
				$cSymbol = $forexrate['Forexrate']['currency_symbol'];
				$currencySymbol[$cCode] = $cSymbol;
			}
			
			$timeline = strtotime('-1 month');
			$status = 'Paid';
			$ordersModel = $this->Orders->find('all',array('conditions'=>array('merchant_id'=>$userid,'orderdate >'=>$timeline,'status <>'=>$status),'order'=>array('orderid'=>'desc')));
			$orderid = array();
			foreach ($ordersModel as $value) {
				$orderid[] = $value['Orders']['orderid'];
			}
			if(count($orderid) > 0) {
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemid = array();
				foreach ($orderitemModel as $value) {
					$orid = $value['Order_items']['orderid'];
					if (!isset($oritmkey[$orid])){
						$oritmkey[$orid] = 0;
					}
					$itemid[] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemname'] = $value['Order_items']['itemname'];
					$orderitems[$orid][$oritmkey[$orid]]['itemtotal'] = $value['Order_items']['itemprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemsunitprice'] = $value['Order_items']['itemunitprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemssize'] = $value['Order_items']['item_size'];
					$orderitems[$orid][$oritmkey[$orid]]['quantity'] = $value['Order_items']['itemquantity'];
					$oritmkey[$orid]++;
				}
				/* if (count($itemid) > 0) {
					$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid)));
				}
				foreach($itemModel as $item) {
					$itemArray[$item['Item']['id']] = $item['Item'];
				} */
			}
			$orderDetails = array();
			foreach ($ordersModel as $key => $orders){
				$orderid = $orders['Orders']['orderid'];
				$orderCurny = $orders['Orders']['currency'];
				$orderDetails[$key]['orderid'] = $orders['Orders']['orderid'];
				$orderDetails[$key]['price'] = $orders['Orders']['totalcost'];
				$orderDetails[$key]['saledate'] = $orders['Orders']['orderdate'];
				$orderDetails[$key]['status'] = $orders['Orders']['status'];
				$itemkey = 0;
				foreach ($orderitems[$orderid] as $orderkey => $orderitem) {
					//$itemTable = $itemArray[$orderitem];
					$orderDetails[$key]['orderitems'][$itemkey]['itemname'] = $orderitems[$orderid][$orderkey]['itemname'];
					$orderDetails[$key]['orderitems'][$itemkey]['quantity'] = $orderitems[$orderid][$orderkey]['quantity'];
					$orderDetails[$key]['orderitems'][$itemkey]['price'] = $orderitems[$orderid][$orderkey]['itemtotal'];
					$orderDetails[$key]['orderitems'][$itemkey]['unitprice'] = $orderitems[$orderid][$orderkey]['itemsunitprice'];
					$orderDetails[$key]['orderitems'][$itemkey]['size'] = $orderitems[$orderid][$orderkey]['itemssize'];
					$orderDetails[$key]['orderitems'][$itemkey]['cSymbol'] = $currencySymbol[$orderCurny];
					$itemkey++;
				}
			}			
			//echo "<pre>";print_r($orderitems);die;
			$this->set('orderDetails',$orderDetails);
		
		}
		
		function oldmyorders () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$itemModel = array();
		
			$this->loadModel('Orders');
			$this->loadModel('Order_items');
			$this->loadModel('Item');
			$this->loadModel('Forexrate');
				
			$forexrateModel = $this->Forexrate->find('all');
			$currencySymbol = array();
			foreach($forexrateModel as $forexrate){
				$cCode = $forexrate['Forexrate']['currency_code'];
				$cSymbol = $forexrate['Forexrate']['currency_symbol'];
				$currencySymbol[$cCode] = $cSymbol;
			}
		
			$ordersModel = $this->Orders->find('all',array('conditions'=>array('merchant_id'=>$userid),'order'=>array('orderid'=>'desc')));
			$orderid = array();
			foreach ($ordersModel as $value) {
				$orderid[] = $value['Orders']['orderid'];
			}
			if(count($orderid) > 0) {
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemid = array();
				foreach ($orderitemModel as $value) {
					$orid = $value['Order_items']['orderid'];
					if (!isset($oritmkey[$orid])){
						$oritmkey[$orid] = 0;
					}
					$itemid[] = $value['Order_items']['itemid'];
					$orderitems[$orid][$oritmkey[$orid]]['itemname'] = $value['Order_items']['itemname'];
					$orderitems[$orid][$oritmkey[$orid]]['itemtotal'] = $value['Order_items']['itemprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemsunitprice'] = $value['Order_items']['itemunitprice'];
					$orderitems[$orid][$oritmkey[$orid]]['itemssize'] = $value['Order_items']['item_size'];
					$orderitems[$orid][$oritmkey[$orid]]['quantity'] = $value['Order_items']['itemquantity'];
					$oritmkey[$orid]++;
				}
				/* if (count($itemid) > 0) {
					$itemModel = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid)));
				}
				foreach($itemModel as $item) {
					$itemArray[$item['Item']['id']] = $item['Item'];
				} */
			}
			$orderDetails = array();
			foreach ($ordersModel as $key => $orders){
				$orderid = $orders['Orders']['orderid'];
				$orderCurny = $orders['Orders']['currency'];
				$orderDetails[$key]['orderid'] = $orders['Orders']['orderid'];
				$orderDetails[$key]['price'] = $orders['Orders']['totalcost'];
				$orderDetails[$key]['saledate'] = $orders['Orders']['orderdate'];
				$orderDetails[$key]['status'] = $orders['Orders']['status'];
				$itemkey = 0;
				foreach ($orderitems[$orderid] as $orderkey => $orderitem) {
					//$itemTable = $itemArray[$orderitem];
					$orderDetails[$key]['orderitems'][$itemkey]['itemname'] = $orderitems[$orderid][$orderkey]['itemname'];
					$orderDetails[$key]['orderitems'][$itemkey]['quantity'] = $orderitems[$orderid][$orderkey]['quantity'];
					$orderDetails[$key]['orderitems'][$itemkey]['price'] = $orderitems[$orderid][$orderkey]['itemtotal'];
					$orderDetails[$key]['orderitems'][$itemkey]['unitprice'] = $orderitems[$orderid][$orderkey]['itemsunitprice'];
					$orderDetails[$key]['orderitems'][$itemkey]['size'] = $orderitems[$orderid][$orderkey]['itemssize'];
					$orderDetails[$key]['orderitems'][$itemkey]['cSymbol'] = $currencySymbol[$orderCurny];
					$itemkey++;
				}
			}			
			//echo "<pre>";print_r($orderitems);die;
			$this->set('orderDetails',$orderDetails);
		
		}
		
		function orderstatus(){
			$this->autoLayout = false;
			$this->autoRender = false;
			$orderid = $_POST['orderid'];
			$status = $_POST['chstatus'];
			
			$this->loadModel('Orders');
			$statusDate = time();
			//$this->Orders->updateAll(array('merchant_id' => $user_id, 'totalcost' => $totalcost), array('orderid' => $orderId));
			$this->Orders->updateAll(array('status' => "'$status'", 'status_date' => "'$statusDate'"), array('orderid' => $orderid));
			
		}
		
		function markshipped($orderid = NULL) {
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			
			/*Todo:
				Get the values of the order base on the id
				get the values of the buyer to send the email
				change the order status as shipped
				and navigate to the my orders
			*/
			if (!isset($_POST['orderid'])) {
				$this->layout = 'mobilelayout';
				$this->set('title_for_layout','- Mark Shipped');
				$this->loadModel('Orders');
				$this->loadModel('Shippingaddresses');
				$orderModel = $this->Orders->findByorderid($orderid);
				$userid = $orderModel['Orders']['userid'];
				$userModel = $this->User->findByid($userid);
				$userEmail = $userModel['User']['email'];
				$shipppingId = $orderModel['Orders']['shippingaddress'];
				$shippingModel = $this->Shippingaddresses->findByshippingid($shipppingId);
				
				//echo "<pre>";print_r($orderModel);print_r($userModel);print_r($shippingModel);die;
				$this->set('orderModel', $orderModel);
				$this->set('userModel',$userModel);
				$this->set('shippingModel',$shippingModel);
			}else{
				$this->layout = 'ajax';
				$this->set('title_for_layout','- Mark Shipped');
				$this->loadModel('Orders');
				$this->loadModel('Order_items');
				$orderid = $_POST['orderid'];
				$buyeremail = $_POST['buyeremail'];
				$subject = $_POST['subject'];
				$message = $_POST['message'];
				$usernameforcust = $_POST['buyername'];
				
				$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$orderid)));
				$itemmailids = array();$itemname = array();
				$totquantity = array();$custmrsizeopt = array();
				foreach ($orderitemModel as $value) {
					$itemmailids[] = $value['Order_items']['itemid'];
					$itemname[] = $value['Order_items']['itemname'];
					if (!empty($value['Order_items']['item_size'])) {
						$custmrsizeopt[] = $value['Order_items']['item_size'];
					}else{
						$custmrsizeopt[] = '0';
					}
					$totquantity[] = $value['Order_items']['itemquantity'];
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
				$this->Email->to = $buyeremail;
				$this->Email->subject = $subject;
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'markedshipped';
				$this->set('custom',$usernameforcust);
				$this->set('message',$message);
				$this->set('loguser',$loguser);
				$this->set('itemname',$itemname);
				$this->set('itemid',$itemmailids);
				$this->set('tot_quantity',$totquantity);
				$this->set('sizeopt',$custmrsizeopt);
				/* $emailidcust = base64_encode($custom[0]);
				$orderIdcust = base64_encode($orderId);
				$this->set('access_url',$_SESSION['site_url']."custupdate/".$emailidcust."~".$orderIdcust);
				$this->set('access_url_n_d',$_SESSION['site_url']."custupdatend/".$emailidcust."~".$orderIdcust); */
				$this->Email->send();
				
				$this->Orders->updateAll(array('status' => "'Shipped'"), array('orderid' => $orderid));
				$this->redirect('/orders');
			}
		}
		
		function trackingdetails($orderid){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Tracking Details');
			global $loguser;
			global $siteChanges;
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			
			$this->loadModel('Orders');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Trackingdetails');
			$orderModel = $this->Orders->findByorderid($orderid);
			$userid = $orderModel['Orders']['userid'];
			$userModel = $this->User->findByid($userid);
			$userEmail = $userModel['User']['email'];
			$shipppingId = $orderModel['Orders']['shippingaddress'];
			$shippingModel = $this->Shippingaddresses->findByshippingid($shipppingId);
			$trackingModel = $this->Trackingdetails->findByorderid($orderid);
			
			//echo "<pre>";print_r($orderModel);print_r($userModel);print_r($shippingModel);die;
			$this->set('orderModel', $orderModel);
			$this->set('userModel',$userModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('trackingModel',$trackingModel);
		}
		
		function sellerconversation($orderid){
			global $loguser;
			global $siteChanges;
			global $setngs;
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Conversation');
			$this->loadModel('Orders');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Ordercomments');
				
			$orderModel = $this->Orders->findByorderid($orderid);
			$ordercommentsModel = $this->Ordercomments->find('all',array('conditions'=>array('orderid'=>$orderid),'order'=>'id DESC'));
			$buyerid = $orderModel['Orders']['userid'];
			$merchantid = $orderModel['Orders']['merchant_id'];
			$buyerModel = $this->User->findByid($buyerid);
			$buyerName = $buyerModel['User']['first_name'];
			$merchantModel = $this->User->findByid($merchantid);
			
			$this->set('orderModel', $orderModel);
			$this->set('buyerModel',$buyerModel);
			$this->set('merchantModel',$merchantModel);
			$this->set('ordercommentsModel',$ordercommentsModel);
			$this->set('buyerName',$buyerName);
			$this->set('roundProf',$siteChanges['profile_image_view']);
		}
		
		function getrecentcmnt(){
			$this->autoLayout = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$this->loadModel('Ordercomments');
			$this->loadModel('Orders');
			$currentcont = $_POST['currentcont'];
			$orderid = $_POST['orderid'];
			$contacter = $_POST['contact'];
			
			$orderModel = $this->Orders->findByorderid($orderid);
			$ordercommentsModel = $this->Ordercomments->find('all',
					array('conditions'=>array('orderid'=>$orderid),'offset'=>$currentcont,'limit'=> '40'));
			//print_r($ordercommentsModel);die;
			if (!empty($ordercommentsModel)){
				$latestcount = $currentcont + count($ordercommentsModel);
				$buyerid = $orderModel['Orders']['userid'];
				$merchantid = $orderModel['Orders']['merchant_id'];
				$buyerModel = $this->User->findByid($buyerid);
				$merchantModel = $this->User->findByid($merchantid);
				
				if ($contacter == 'seller'){
					$this->set('buyerModel',$buyerModel);
					$this->set('merchantModel',$merchantModel);
				}else{
					$this->set('buyerModel',$merchantModel);
					$this->set('merchantModel',$buyerModel);
				}
				$this->set('contacter',$contacter);
				$this->set('roundProf',$siteChanges['profile_image_view']);
			}
				$this->set('ordercommentsModel',$ordercommentsModel);
				$this->set('latestcount',$latestcount);
		}
		
		function getmorecomment() {
			$this->autoLayout = FALSE;
			$this->autoRender = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$this->loadModel('Ordercomments');
			$this->loadModel('Orders');
			$userid = $loguser[0]['User']['id'];
			$offset = $_POST['offset'];
			$orderid = $_POST['orderid'];
			$contacter = $_POST['contact'];
			
			$orderModel = $this->Orders->findByorderid($orderid);
			$ordercommentsModel = $this->Ordercomments->find('all',
					array('conditions'=>array('orderid'=>$orderid),'order'=>'id DESC','offset'=>$offset,
							'limit'=>'5'));
			if (!empty($ordercommentsModel)){
				$latestcount = $currentcont + count($ordercommentsModel);
				$buyerid = $orderModel['Orders']['userid'];
				$merchantid = $orderModel['Orders']['merchant_id'];
				$buyerModel = $this->User->findByid($buyerid);
				$merchantModel = $this->User->findByid($merchantid);
			
				if ($contacter == 'seller'){
					$this->set('buyerModel',$buyerModel);
					$this->set('merchantModel',$merchantModel);
				}else{
					$this->set('buyerModel',$merchantModel);
					$this->set('merchantModel',$buyerModel);
				}
				$this->set('contacter',$contacter);
				$this->set('roundProf',$siteChanges['profile_image_view']);
			}
			$this->set('ordercommentsModel',$ordercommentsModel);
			$this->set('latestcount','0');
			$this->render('getrecentcmnt');
		}
		
		function postordercomment(){
			$this->autoLayout = FALSE;
			$this->autoRender = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$this->loadModel('Ordercomments');
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->request->data['Ordercomments']['orderid'] = $_POST['orderid'];
			$this->request->data['Ordercomments']['merchantid'] = $_POST['merchantid'];
			$this->request->data['Ordercomments']['buyerid'] = $_POST['buyerid'];
			$this->request->data['Ordercomments']['comment'] = $_POST['comment'];
			$this->request->data['Ordercomments']['createddate'] = time();
			$this->request->data['Ordercomments']['commentedby'] = $_POST['postedby'];
			$this->Ordercomments->save($this->request->data);
			
			echo '<div class="cmntcontnr">
			<div class="usrimg">
			<a href="'.SITE_URL.'people/'.$_POST['usrurl'].'" class="url">';
			if(!empty($_POST['usrimg'])){
				echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/'.$_POST['usrimg'].'" alt="" class="photo" style="'.$roundProfile.'">';
			}else{
				echo '<img src="'.$_SESSION['media_url'].'media/avatars/thumb70/usrimg.jpg" alt="" class="photo" style="'.$roundProfile.'">';
			}
				
			echo '</a>';
        	echo '</div>
        			<div class="cmntdetails">
        				<p class="usrname">
        					<a href="'.SITE_URL.'people/'.$_POST['usrurl'].'" class="url">'; 
        	echo $_POST['usrname']; 
        	echo '</a>
        			</p>
        			<p class="cmntdate">'.date('d,M Y',time()).'</p>
        			<p class="comment">'.$_POST['comment'].'</p>
		        </div>
        	</div>';
		}
		
		function updatetrackingdetails(){
			$this->autoLayout = FALSE;
			$this->autoRender = FALSE;
			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->loadModel('Orders');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Trackingdetails');
			$this->loadModel('Order_items');
			
			$buyeremail = $_POST['buyeremail'];
			$subject = "Tracking Order Details";
			$message = "Your tracking order details for the listed item as below";
			
			$this->request->data['Trackingdetails']['orderid'] = $_POST['orderid'];
			$this->request->data['Trackingdetails']['status'] = $_POST['orderstatus'];
			$this->request->data['Trackingdetails']['merchantid'] = $loguser[0]['User']['id'];
			$this->request->data['Trackingdetails']['buyername'] = $_POST['buyername'];
			$this->request->data['Trackingdetails']['buyeraddress'] = $_POST['address'];
			$this->request->data['Trackingdetails']['shippingdate'] = strtotime($_POST['shippingdate']);
			$this->request->data['Trackingdetails']['couriername'] = $_POST['couriername'];
			$this->request->data['Trackingdetails']['courierservice'] = $_POST['courierservice'];
			$this->request->data['Trackingdetails']['trackingid'] = $_POST['trackid'];
			$this->request->data['Trackingdetails']['notes'] = $_POST['notes'];
			if ($_POST['id'] != 0){
				$this->request->data['Trackingdetails']['id'] = $_POST['id'];
				$subject = "Updated Tracking Order Details";
				$message = "Your updated tracking order details for the listed item as below";
			}
			$this->Trackingdetails->save($this->request->data);
			
			$orderitemModel = $this->Order_items->find('all',array('conditions'=>array('orderid'=>$_POST['orderid'])));
			$itemmailids = array();$itemname = array();
			$totquantity = array();$custmrsizeopt = array();
			foreach ($orderitemModel as $value) {
				$itemmailids[] = $value['Order_items']['itemid'];
				$itemname[] = $value['Order_items']['itemname'];
				if (!empty($value['Order_items']['item_size'])) {
					$custmrsizeopt[] = $value['Order_items']['item_size'];
				}else{
					$custmrsizeopt[] = '0';
				}
				$totquantity[] = $value['Order_items']['itemquantity'];
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
			$this->Email->to = $buyeremail;
			$this->Email->subject = $subject;
			$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
			$this->Email->sendAs = "html";
			$this->Email->template = 'trackdetailsmail';
			$this->set('custom',$usernameforcust);
			$this->set('message',$message);
			$this->set('shippingdate',$_POST['shippingdate']);
			$this->set('trackingid',$_POST['trackid']);
			$this->set('courierservice',$_POST['courierservice']);
			$this->set('couriername',$_POST['couriername']);
			$this->set('notes',$_POST['notes']);
			$this->set('loguser',$loguser);
			$this->set('itemname',$itemname);
			$this->set('itemid',$itemmailids);
			$this->set('tot_quantity',$totquantity);
			$this->set('sizeopt',$custmrsizeopt);
			//$this->Email->send();
			
			$this->Orders->updateAll(array('status' => "'Shipped'"), array('orderid' => $_POST['orderid']));
		}
		
		public function viewinvoice ($orderId) {
			$this->loadModel('Invoices');
			$this->loadModel('Orders');
			$this->loadModel('Users');
			$this->loadModel('Order_items');
			$this->loadModel('Invoiceorders');
			$this->loadModel('Item');
			$this->loadModel('Shippingaddresses');
			$this->loadModel('Coupon');
			$this->set('title_for_layout','View Invoice');
			
			$invoiceOrder = $this->Invoiceorders->findByorderid($orderId);
			
			$invoiceId = $invoiceOrder['Invoiceorders']['invoiceid'];
			
			$invoiceModel = $this->Invoices->findByinvoiceid($invoiceId);
			
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
			
			$currencyCode = $orderModel['Orders']['currency'];
			
			$getcouponvalue = $this->Coupon->findById($coupon_id);
			$this->set('getcouponvalue',$getcouponvalue);
			
			//echo $discount_amount;die;
			
			$this->set('getcouponvalue',$getcouponvalue);
			$this->set('orderDetails',$orderModel);
			$this->set('orderItemModel',$orderItemModel);
			$this->set('invoiceModel',$invoiceModel);
			$this->set('userModel',$userModel);
			$this->set('sellerModel',$sellerModel);
			$this->set('shippingModel',$shippingModel);
			$this->set('discount_amount',$discount_amount);
			$this->set('currencyCode',$currencyCode);
		}
		
		
		
		
		function settings()
		{
			$this->layout = 'mobilelayout';
		}
		
		function user_settings(){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			global $siteChanges;
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$usr_datas = $this->User->findById($loguser[0]['User']['id']);
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				$b_year = $this->request->data['setting-birthday-year'];
				$b_month = $this->request->data['setting-birthday-month'];
				$b_day = $this->request->data['setting-birthday-day'];
				
				$birthday_date = $b_year.'-'.$b_month.'-'.$b_day;
				//echo $birthday_date;die;
				$this->request->data['User']['id'] = $loguser[0]['User']['id'];
				$this->request->data['User']['first_name'] =$this->request->data['setting-fullname'];
				//$this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($username);
				$this->request->data['User']['city'] = $this->request->data['city'];
				
				$this->request->data['User']['website'] = $this->request->data['website'];
				$this->request->data['User']['twitter'] = $this->request->data['twitter_email'];
				$this->request->data['User']['age_between'] = $this->request->data['agebtwen'];
				$this->request->data['User']['birthday'] = $birthday_date;
				
				$this->request->data['User']['about'] = $this->request->data['setting-bio'];
				$this->request->data['User']['profile_image'] = $this->request->data['image'];
				$this->request->data['User']['gender'] = $this->request->data['gender'];
				$this->User->save($this->request->data);
				$this->Session->setFlash('Successfully Updated');
				//$this->Session->setFlash('Successfully Updated', 'default', array(), 'good');
				$this->redirect('/mobile/user_settings');
				
			}
				
			$this->set('usr_datas',$usr_datas);
			$this->set('loguser',$loguser);
			$this->set('roundProf',$siteChanges['profile_image_view']);
		}
			

		function password_change(){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Password Change ');
			if(!$this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			global $loguser;
			$usr_datas = $this->User->findById($loguser[0]['User']['id']);
			if(!empty($this->request->data)){
				$exispassword = $this->Auth->password($this->request->data['epassword']);
				$password = $this->request->data['password'];
				$apass = $this->Auth->password($password);
				
				
				if($exispassword == $usr_datas['User']['password']){
				$this->request->data['User']['id'] = $loguser[0]['User']['id'];
				$this->request->data['User']['password'] = $apass;
				$this->User->save($this->request->data);
				$this->Session->setFlash('Password updated successfully.');
				$this->redirect('/mobile/settings/');
				}else{
					$this->Session->setFlash('Existing password is incorrect');
					$this->redirect($this->referer());
				}
			}
			
			$this->set('usr_datas',$usr_datas);
		}
			
		function addshipping($id = null) {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Shipping');
			$this->loadModel('Tempaddresses');
			$this->loadModel('Country');
			if (!$this->isauthenticated()) {
				$this->redirect('/mobile/');
			}
			global $loguser;
			$userid = $loguser[0]['User']['id'];
		
			//echo "<pre>";print_r($this->request->data);die;
			
			if ($id != null) {
				$usr_datas = $this->Tempaddresses->findByshippingid($id);
				$this->set('usr_datas',$usr_datas);
			}
		
			if(!empty($this->request->data)){
				//echo "<pre>";print_R($this->request->data);die;
				$countrycode = $this->request->data['country'];
				$countryModel = $this->Country->findByid($countrycode);
		
				 $countryname = $countryModel['Country']['country'];
		
				$this->request->data['Tempaddresses']['userid'] = $userid;
				$this->request->data['Tempaddresses']['name'] = $this->request->data['fullname'];
				$this->request->data['Tempaddresses']['nickname'] = $this->request->data['nickname'];
				$this->request->data['Tempaddresses']['country'] = $countryname;
				$this->request->data['Tempaddresses']['state'] = $this->request->data['state'];
				$this->request->data['Tempaddresses']['address1'] = $this->request->data['address1'];
				$this->request->data['Tempaddresses']['address2'] = $this->request->data['address2'];
				$this->request->data['Tempaddresses']['city'] = $this->request->data['city'];
				$this->request->data['Tempaddresses']['zipcode'] = $this->request->data['zipcode'];
				$this->request->data['Tempaddresses']['phone'] = $this->request->data['phone'];
				$this->request->data['Tempaddresses']['countrycode'] = $countrycode;
				
				if ($this->request->data['shippingId'] != 0) {
					$shippingid = $this->request->data['shippingId'];
					foreach ($this->request->data['Tempaddresses'] as $key => $value) {
						$this->request->data['Tempaddresses'][$key] = "'".$value."'";
					}
					$this->Tempaddresses->updateAll($this->request->data['Tempaddresses'], array('shippingid' => $shippingid));
					//$this->Tempaddresses->deleteAll(array('shippingid' => $shippingid), false);
				}else {
					$this->Tempaddresses->save($this->request->data);
					$shippingid =  $this->Tempaddresses->getLastInsertID();
				}
				
				if(isset($this->request->data['setdefault'])) {
					$this->request->data['User']['id'] = $userid;
					$this->request->data['User']['defaultshipping'] = $shippingid;
					$this->User->save($this->request->data);
				} 
				$this->redirect('/mobile/shipping');
			}
			$countrylist = $this->Country->find('all');
			$this->set('countrylist',$countrylist);
		}
				
		function shipping () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Shipping');
			$this->loadModel('Tempaddresses');
			if (!$this->isauthenticated()) {
				$this->redirect('/');
			}
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			$usershipdefault = $this->User->findByid($userid);
			$usershipdefault = $usershipdefault['User']['defaultshipping'];
			
			$shippingModel = $this->Tempaddresses->findAllByuserid($userid);
		
			$this->set('shippingModel',$shippingModel);
			$this->set('usershipping',$usershipdefault);
		}

		function defaultshipping () {
			$this->layout = 'ajax';
			$this->autoRender = false;
			$shipid = $_POST['shippingid'];
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			$this->request->data['User']['id'] = $userid;
			$this->request->data['User']['defaultshipping'] = $shipid;
			$this->User->save($this->request->data);
		}
			
		function deleteshipping () {
			$this->layout = 'ajax';
			$this->autoRender = false;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Tempaddresses');
			$shipid = $_POST['shippingid'];
		
			$usershipdefault = $this->User->findByid($userid);
			$usershipdefault = $usershipdefault['User']['defaultshipping'];
			if($usershipdefault == $shipid) {
				$this->User->updateAll(array('defaultshipping' =>'0'), array('User.id' => $userid));
			}
			$this->Tempaddresses->deleteAll(array('shippingid' => $shipid), false);
			//$this->redirect('/shipping');
		}
			
		function user_notifications(){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Notification');
			if(!$this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			global $loguser;
			$usr_datas = $this->User->findById($loguser[0]['User']['id']);
			
			if(!empty($this->request->data)){
				//echo "<pre>";print_r($this->request->data);die;
				
				$news_abt = $this->request->data['news_abt'];
				$somone_flw = $this->request->data['somone_flw'];
				//$somone_shows = $this->request->data['somone_shows'];
				$somone_cmnts = $this->request->data['somone_cmnts'];
				$things_featured = $this->request->data['things_featured'];
				//$somone_mentions = $this->request->data['somone_mentions'];
				
				$notification = array();
				//$notification['somone_flw_push'] = $this->request->data['somone_flw_push'];
				//$notification['somone_shows_push'] = $this->request->data['somone_shows_push'];
				//$notification['somone_cmnts_push'] = $this->request->data['somone_cmnts_push'];
				//$notification['things_featured_push'] = $this->request->data['things_featured_push'];
				//$notification['somone_mentions_push'] = $this->request->data['somone_mentions_push'];
				//$notification['somone_promotions_push'] = $this->request->data['somone_promotions_push'];
				//$notification['somone_likes_ur_item_push'] = $this->request->data['somone_likes_ur_item_push'];
				$notification['frends_flw_push'] = $this->request->data['frends_flw_push'];
				$notification['frends_cmnts_push'] = $this->request->data['frends_cmnts_push'];
				//$notification['frends_earns_push'] = $this->request->data['frends_earns_push'];
				
				$notification = json_encode($notification);
				$notification = str_replace("null","0", $notification);
				$notification = str_replace("NULL","1", $notification);
				//echo "<pre>";print_r($notification);die;
				
				$this->request->data['User']['push_notifications'] = $notification;
				
				if($news_abt == 'NULL'){
					$this->request->data['User']['subs'] = '1';
				}else{
					$this->request->data['User']['subs'] = '0';
				}
				if($somone_flw == 'NULL'){
					$this->request->data['User']['someone_follow'] = '1';
				}else{
					$this->request->data['User']['someone_follow'] = '0';
				}
				
				/* if($somone_shows == 'NULL'){
					$this->request->data['User']['someone_show'] = '1';
				}else{;
					$this->request->data['User']['someone_show'] = '0';
				} */
				
				if($somone_cmnts == 'NULL'){
					$this->request->data['User']['someone_cmnt_ur_things'] = '1';
				}else{;
				$this->request->data['User']['someone_cmnt_ur_things'] = '0';
				}
				
				if($things_featured == 'NULL'){
					$this->request->data['User']['your_thing_featured'] = '1';
				}else{;
				$this->request->data['User']['your_thing_featured'] = '0';
				}
				
				/* if($somone_mentions == 'NULL'){
					$this->request->data['User']['someone_mention_u'] = '1';
				}else{;
				$this->request->data['User']['someone_mention_u'] = '0';
				} */
				
				
				$this->request->data['User']['id'] = $loguser[0]['User']['id'];
				
				$this->User->save($this->request->data);
				$this->Session->setFlash('Successfully Updated');
				//$this->Session->setFlash('Successfully Updated', 'default', array(), 'good');
				
				$this->redirect('/mobile/notifications/');
			}
				
			$this->set('usr_datas',$usr_datas); 
		}
		
		function userlike(){
			global $loguser;
			$userid = $loguser[0]['User']['id'];
				
			$itemid = $_REQUEST['itemid'];
			$this->loadModel('Itemfav');
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$userdatasall = $this->Item->findById($itemid);
			$itemfavs = $this->Itemfav->find('count',array('conditions'=>array('item_id'=>$itemid,'user_id'=>$userid)));
			
			if($itemfavs <= 0){
				
				$this->request->data['Itemfav']['user_id'] = $userid;
				$this->request->data['Itemfav']['item_id'] = $itemid;
				$this->Itemfav->save($this->request->data);
				
				
				$favcountss = $userdatasall['Item']['fav_count'];
				$favcounts = $favcountss + 1;
				$this->request->data['Item']['id'] = $itemid;
				$this->request->data['Item']['fav_count'] = $favcounts;
				$this->Item->save($this->request->data);
				
				$logdetails = $this->logs('favorite',$itemid,$userid,'0');
			}
			$itemlistModel = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid)));
			$listexist = array();
			foreach($itemlistModel as $key=>$itemlist){
				$listexist[$key]['listname'] = $itemlist['Itemlist']['lists'];
				$listexist[$key]['listcheck'] = 0;
				$listItems = json_decode($itemlist['Itemlist']['list_item_id'],true);
				if (in_array($itemid, $listItems)){
					$listexist[$key]['listcheck'] = 1;
				}
			}
			echo json_encode($listexist);
			die;
		}
			
		function userUnlike(){
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$itemid = $_REQUEST['itemid'];
			$this->loadModel('Itemfav');
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$userdatasall = $this->Item->findById($itemid);
			$itemfavs = $this->Itemfav->find('count',array('conditions'=>array('item_id'=>$itemid,'user_id'=>$userid)));
			if($itemfavs > 0){
				$this->Itemfav->deleteAll(array('user_id' => $userid,'item_id' => $itemid));
				$favcountss = $userdatasall['Item']['fav_count'];
				$favcounts = $favcountss - 1;
				$this->request->data['Item']['id'] = $itemid;
				$this->request->data['Item']['fav_count'] = $favcounts;
				$this->Item->save($this->request->data);
				
				$itemlistModel = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid)));
				foreach($itemlistModel as $itemlist){
					$listItems = json_decode($itemlist['Itemlist']['list_item_id'],true);
					$listItems = array_diff($listItems, array($itemid));
					$this->request->data['Itemlist']['id'] = $itemlist['Itemlist']['id'];
					$this->request->data['Itemlist']['list_item_id'] = json_encode($listItems);
					$this->Itemlist->save($this->request->data);
						
					$this->request->data['Itemlist']['id'] = '';
					$this->request->data['Itemlist']['list_item_id'] = '';
				}
				
				echo 1;die;
			}
			
		}
		
		function adduserlist(){
			global $loguser;
			$this->autoRender = false;
			$this->loadModel('Itemlist');
			$userid = $loguser[0]['User']['id'];
			$itemid = array();
			$itemid[] = $_REQUEST['itemid'];
			$newlist = $_REQUEST['newlist'];
			$item_ids = json_encode($itemid);
			$itemlistcount = $this->Itemlist->find('count',array('conditions'=>array('lists'=>$newlist,'user_id'=>$userid)));
				
		
			if($itemlistcount <= 0){
				$this->request->data['Itemlist']['user_id'] = $userid;
				$this->request->data['Itemlist']['list_item_id'] = $item_ids;
				$this->request->data['Itemlist']['lists'] = $newlist;
				$this->request->data['Itemlist']['user_create_list'] = '1';
				$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s');
				$this->Itemlist->save($this->request->data);
								
				echo $newlist;
			}
		}
			
		function totaladduserlist(){
			global $loguser;
			$this->autoRender = false;
			$this->loadModel('Itemlist');
			$userid = $loguser[0]['User']['id'];
			$itemid = $_POST['itemid'];
			$allData = $_POST['alldata'];
			$params = array();
			$lists = array();
			parse_str($_POST['alldata'], $params);
			
			//echo "<pre>";print_r($params);die;
			
			$itemlistModel = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid)));
			foreach($itemlistModel as $itemlist){
				$listexist[] = $itemlist['Itemlist']['lists'];
				if (!in_array($itemlist['Itemlist']['lists'], $params['category_items'])){
					$listItems = json_decode($itemlist['Itemlist']['list_item_id'],true);
					$listItems = array_diff($listItems, array($itemid));
					$this->request->data['Itemlist']['id'] = $itemlist['Itemlist']['id'];
					$this->request->data['Itemlist']['list_item_id'] = json_encode($listItems);
					$this->Itemlist->save($this->request->data);
					
					$this->request->data['Itemlist']['id'] = '';
					$this->request->data['Itemlist']['list_item_id'] = '';
				}
			}
			
			foreach($params['category_items'] as $key=>$para){
				$itemlistcount = $this->Itemlist->find('all',array('conditions'=>array('lists'=>$para,'user_id'=>$userid)));
				if(empty($itemlistcount)){
					$this->Itemlist->create();
					$this->request->data['Itemlist']['user_id'] = $userid;
					$item_lis[] = $itemid;
					$item_ids = json_encode($item_lis);						
					$this->request->data['Itemlist']['list_item_id'] = $item_ids;
					$this->request->data['Itemlist']['lists'] = $para;
					$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s');
					$this->Itemlist->save($this->request->data);
					$item_lis='';
				}else{
					foreach($itemlistcount as $item){
						$lists = json_decode($item['Itemlist']['list_item_id'],true);
						$lists[] = $itemid;
						$lists = array_unique($lists);
						$item_ids = json_encode($lists);
						$this->request->data['Itemlist']['id'] = $item['Itemlist']['id'];
						$this->request->data['Itemlist']['user_id'] = $userid;
						$this->request->data['Itemlist']['list_item_id'] = $item_ids;
						$this->request->data['Itemlist']['lists'] = $para;
						//$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s');
						$this->Itemlist->save($this->request->data);
						$lists='';
					}
					
				}
			}
		}
		
		function sellersignup($additemid=NULL){
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Settings');
			global $loguser;
			$this->loadModel('Shop');
			$userid = $loguser[0]['User']['id'];
			if(!empty($this->request->data)){
				$shop_name = $this->request->data['brand_name'];
				$merchant_name = $this->request->data['merchant_name'];
				$person_phone_number =  $this->request->data['person_phone_number'];
				$paypalId =  $this->request->data['paypalId'];
				$address =  $this->request->data['address'];
				$latitude =  $this->request->data['latitude'];
				$longitude =  $this->request->data['longitude'];
				$status = $this->request->data['status'];
				if ($this->request->data['status'] == '2'){
					$status = 0;
				}
				$this->Shop->updateAll(array('Shop.shop_name' =>"'$shop_name'",'Shop.shop_address' =>
						"'$address'",'Shop.shop_latitude' =>"'$latitude'",'Shop.shop_longitude' =>
						"'$longitude'",'Shop.shop_title' =>"'$merchant_name'",'Shop.phone_no' =>
						"'$person_phone_number'",'Shop.paypal_id' =>"'$paypalId'",
						'Shop.seller_status' =>"'$status'"), array('Shop.user_id' => $userid));
				//echo "<pre>";print_r($this->request->data);die;
				
				$this->User->updateAll(array('User.user_level' =>"'shop'"),
						array('User.id' => $userid));
				if ($status == 1){
					$this->Session->setFlash('Merchant Updated');
					//$this->Session->setFlash('Merchant Updated', 'default', array(), 'good');
					$this->redirect('/mobile/create/item/'.$additemid);
				}else{
					$this->Session->setFlash('Admin Approval Pending');
					//$this->Session->setFlash('Admin Approval Pending', 'default', array(), 'good');
					$this->redirect('/mobile/');
				}
			}else{
				$shopdetails = $this->Shop->findByuser_id($userid);
				$latt = $shopdetails['Shop']['shop_latitude'];
				$longg = $shopdetails['Shop']['shop_longitude'];
				//echo $latt;die;
				if($latt != 0 && $longg != 0 ){
					//$this->redirect('/create/item/'.$additemid);
				}
				$this->set('shopdetails',$shopdetails);
				$this->set('additemid',$additemid);
				//echo "<pre>";print_r($shopdetails);die;
				
			}
		}
			
		public function ajaxSearch () {
			$this->layout = "ajax";
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('User');
			$searchWord = $_POST['searchStr'];
			$prefix = $this->Item->tablePrefix;
			$userContent = '';
			$userDetails = $this->User->query("SELECT * FROM ".$prefix."users WHERE username LIKE '%$searchWord%' LIMIT 5");
			if (count($userDetails) > 0) {
				foreach ($userDetails as $userData) {
					$usernameurl = $userData[$prefix.'users']['username_url'];
					$usernam = $userData[$prefix.'users']['username'];
					$url = SITE_URL.'people/'.$usernameurl;
					if ($userContent == ''){
						$userContent = "<li> <a href='".$url."'>".$usernam."</a></li>";
					}else {
						$userContent = $userContent."<li> <a href='".$url."'>".$usernam."</a></li>";
					}
				}
			} else {
				$userContent = "No Data";
			}
			$itemContent = "";
			$itemDetails = $this->Item->query("SELECT * FROM ".$prefix."items WHERE item_title LIKE '%$searchWord%' LIMIT 5");
			if (count($itemDetails) > 0) {
				foreach ($itemDetails as $itemData) {
					$itemnameurl = $itemData[$prefix.'items']['item_title_url'];
					$itemnam = $itemData[$prefix.'items']['item_title'];
					$itid = $itemData[$prefix.'items']['id'];
					$url = SITE_URL.'listing/'.$itid.'/'.$itemnameurl;
					if ($itemContent == ''){
						$itemContent = "<li> <a href='".$url."'>".$itemnam."</a></li>";
					}else {
						$itemContent = $itemContent."<li> <a href='".$url."'>".$itemnam."</a></li>";
					}
				}
			} else {
				$itemContent = "No Data";
			}
				
			$json = array();
			$json[] = $userContent;
			$json[] = $itemContent;
			echo json_encode($json);
				
		}
			
			
		public function ajaxUserAuto () {
			$this->layout = "ajax";
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Item');
			 $searchWord = $_POST['searchStr']; 
			$prefix = $this->Item->tablePrefix;
			$userContent = '';
			$userDetails = $this->User->query("SELECT * FROM ".$prefix."users WHERE username LIKE '$searchWord%' and user_level !='god' LIMIT 5");
			if (count($userDetails) > 0) {
				$k=0;
				foreach ($userDetails as $userData) {
					$usernameurl = $userData[$prefix.'users']['username_url'];
					$usernam = $userData[$prefix.'users']['username'];
					$userimg = $userData[$prefix.'users']['profile_image'];
					if(empty($userimg)){
						$userimg = "usrimg.jpg";
					}else{
						$userimg = $userimg;
					}
					$url = SITE_URL.'people/'.$usernameurl;
				
					if ($userContent == ''){
						//onclick='getusrname($usernam);'
						$userContent = "<li style='cursor:pointer;min-height:1em;'><table style='width:100%;'><tr><td style='width:40px;'><img class='photo' src='".$_SESSION['media_url']."media/avatars/thumb70/".$userimg."' style='width:30px;height:30px;' ></td><td><input type='hidden' class = 'nam'  value='".$usernam."' /><span class='username' style='margin-left:0px;top:0px;position:relative;'>".$usernameurl."</span></td></tr></table></li>";
					}else {
						$userContent = $userContent."<li style='cursor:pointer;min-height:1em;'><table style='width:100%;'><tr><td style='width:40px;'><img class='photo' src='".$_SESSION['media_url']."media/avatars/thumb70/".$userimg."' style='width:30px;height:30px;'></td><td><input type='hidden' class = 'nam'  value='".$usernam."' /><span class='username' style='margin-left:0px;top:0px;position:relative;'>".$usernameurl."</span></td></tr></table></li>";
					}
					$k++;
				}
			} else {
				$userContent = "No Data";
			}
			$json = array();
			$json[] = $userContent;
			echo json_encode($json);
		}
				
			
		public function notification_email(){
			global $setngs;
			$this->loadModel('User');
			$this->loadModel('Follower');
			$this->loadModel('Item');
			$this->loadModel('Comment');
			$userDatasAll = $this->User->find('all',array('conditions'=>array('User.user_level <>'=>'god')));
			foreach ($userDatasAll as $usr){
				if($usr['User']['someone_follow'] == '1')
				{
					$userFlowerData = $this->Follower->find('all',array('conditions'=>array('Follower.user_id'=>$usr['User']['id'])));
					foreach($userFlowerData as $flwr){
					$bef_time = $flwr['Follower']['followed_on'];
					$date_dif = $this->Urlfriendly->date_diff($bef_time,time());
					if($date_dif['days']==0){
						$flwers_id[] = $flwr['Follower']['follow_user_id'];
					}
					}
					if(isset($flwers_id)){
						foreach ($flwers_id as $flwuserid){
							$userDatasAllForEmail = $this->User->findByid($flwuserid);
							
							
							if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
								$this->Email->smtpOptions = array(
									'port' => $setngs[0]['Sitesetting']['smtp_port'],
									'timeout' => '30',
									'host' => 'ssl://smtp.gmail.com',
									'username' => $setngs[0]['Sitesetting']['noreply_email'],
									'password' => $setngs[0]['Sitesetting']['noreply_password']);
						
								$this->Email->delivery = 'smtp';
							}
							$this->Email->to = $userDatasAllForEmail['User']['email'];
							$this->Email->subject = $usr['User']['username']." is now following you on ".ucwords(strtolower($setngs[0]['Sitesetting']['site_name']));
							$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
							$this->Email->sendAs = "html";
							$this->Email->template = 'notification_mails';
							$this->set('userDatasAllForEmail',$userDatasAllForEmail);
							$this->set('userDatasAll',$userDatasAll);
							$this->set('flowname',$userDatasAllForEmail['User']['username']);
							$this->set('name',$usr['User']['username']);
							$this->set('setngs',$setngs);
							$this->Email->send();
							
							
						}
						
					}
					$flwers_id = '';
					
				}
				/* if($usr['User']['someone_show'] == '1')
				{
					echo "someone_show / ";
				} */
				
				if($usr['User']['someone_cmnt_ur_things'] == '1')
				{
					$userAddItemData = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$usr['User']['id'])));
					
					foreach ($userAddItemData as $itemCmnt){
						//$getComments= $this->Comment->find('all',array('conditions'=>array('Comment.item_id'=>$itemCmnt)));
						foreach ($itemCmnt['Comment'] as $getcmntbydate){
							$bef_timeItem = $getcmntbydate['created_on'];
							$date_dif = $this->Urlfriendly->date_diff($bef_timeItem,time());
							if($date_dif['days']==0){
								$cmnt_user_id= $getcmntbydate['user_id'];
								$cmntUser = $this->User->findById($cmnt_user_id);
								
								if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
									$this->Email->smtpOptions = array(
										'port' => $setngs[0]['Sitesetting']['smtp_port'],
										'timeout' => '30',
										'host' => 'ssl://smtp.gmail.com',
										'username' => $setngs[0]['Sitesetting']['noreply_email'],
										'password' => $setngs[0]['Sitesetting']['noreply_password']);
							
									$this->Email->delivery = 'smtp';
								}
								$this->Email->to = $usr['User']['email'];
								$this->Email->subject = $cmntUser['User']['username']." is commented on your post on ".ucwords(strtolower($setngs[0]['Sitesetting']['site_name']));
								$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
								$this->Email->sendAs = "html";
								$this->Email->template = 'someoneflw_mails';
								$this->set('cmntUser',$cmntUser);
								$this->set('getcmntbydate',$getcmntbydate);
								$this->set('name',$usr['User']['username']);
								$this->set('setngs',$setngs);
								$this->Email->send();
							}
						}
					}
					
				}  
			}
		}
			
		public function loginwith($provider = null) {
			$this->layout = "ajax";
			global $setngs;
			require_once( WWW_ROOT . 'hybridauth/Hybrid/Auth.php' );
			$hybridauth_config = array(
					"base_url" => 'http://' . $_SERVER['HTTP_HOST'] . $this->base . "/hybridauth/", // set hybridauth path
						
					"providers" => array(
							"Facebook" => array(
									"enabled" => true,
									"keys" => array("id" => "657287144301044", "secret" => "33d769d8b0d0eb2e42d2a2e950a5a410"),
									"scope" => 'email',
							),
								
							"Google" => array (
									"enabled" => true,
									"keys"    => array ( "id" => "933744760556-qdb0l7n92r0rse7u42drkvk6tkm10pkv.apps.googleusercontent.com", "secret" => "gWnStvg8njJ_Y4RRlTBO_aVQ" ),
									"scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
									"https://www.googleapis.com/auth/userinfo.email"   , // optional
										
							)
							/* ,
							 "Twitter" => array(
							 		"enabled" => true,
							 		"keys" => array("key" => "IGwaIlxkJPiYcqD644p4Zw", "secret" => "nfHk0HW5SgnP4Sd51OuqCuK29p3vTI9NqRnQXs7k")
							 ) */
							// for another provider refer to hybridauth documentation
					)
			);
			if(!empty($hybridauth_config)){
				$hybridauth = new Hybrid_Auth($hybridauth_config);
			}
			$adapter = $hybridauth->authenticate($provider);
				
			$user_profile = $adapter->getUserProfile();
			
			echo "<pre>";print_r($user_profile);die;
			if (!empty($user_profile)) {
				$user = $this->User->find('all',array('conditions'=>array('email'=>$user_profile->email)));
				//echo "<pre>";print_r($user);die;
				if(!empty($user)){
					$user_status = $user[0]['User']['user_status'];
					if($user_status=='disable'){
						$this->Session->setFlash('Your account has been disbled please contact our support');
						//$this->Session->setFlash('Your account has been disbled please contact our support', 'default', array(), 'bad');
						$this->redirect('/login');
					}
					if($this->Auth->login($user)){
						$cookie['email'] = $user[0]['User']['email'];
						//$cookie['pass'] = $user['User']['password'];
						$this->Cookie->write('User',$cookie,true,'+2 weeks');
						//$this->redirect('/');
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
				}else{
					$image_get = $user_profile->photoURL;
					$image_save = time().'.jpg';
					
					$i = file_get_contents($image_get);
					//chmod($image_save, 0644);
					$t70 = fopen('media/avatars/thumb70/'.$image_save,'wb');
					$f150 = fopen('media/avatars/thumb150/'.$image_save,'wb');
					$f350 = fopen('media/avatars/thumb350/'.$image_save,'wb');
					$fori = fopen('media/avatars/original/'.$image_save,'wb');
					fwrite($t70,$i);
					fwrite($f150,$i);
					fwrite($f350,$i);
					fwrite($fori,$i);
					fclose($t70); 
					fclose($f150); 
					fclose($f350); 
					fclose($fori); 
					if($image_save==''){
						$image_save = 'usrimg.jpg';
					}
					if($provider=='Google'){
						$this->request->data['User']['google_id'] = $user_profile->identifier;
					}
					if($provider=='Facebook'){
						$this->request->data['User']['facebook_id'] = $user_profile->identifier;
					}
					//$name=$this->request->data['User']['username'] = $user_profile->username;
					//$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($name);
					$this->request->data['User']['first_name'] = $user_profile->firstName;
					$this->request->data['User']['last_name'] = $user_profile->lastName;
					$emailaddress = $this->request->data['User']['email'] = $user_profile->email;
					//$this->request->data['User']['password'] = $user_profile->identifier;
					$this->request->data['User']['password'] = $this->Auth->password($user_profile->identifier);
					$this->request->data['User']['user_level'] = 'normal';
					$this->request->data['User']['user_status'] = 'enable';
					$this->request->data['User']['activation'] = '1';
					$this->request->data['User']['profile_image'] = $image_save;
					$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
					$this->request->data['User']['gender'] = $user_profile->gender;
					$uniquecode = $this->Urlfriendly->get_uniquecode(8);
					$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
					$this->User->save($this->request->data);
					$userid = $this->User->getLastInsertID();
						
					$this->loadModel('Shop');
					$this->request->data['Shop']['user_id'] = $userid;
					$this->Shop->save($this->request->data);
					
					
					//$this->User->create();
					$this->request->data['User']['id'] = $userid;
					$uname = $this->request->data['User']['username'] = $user_profile->firstName.$userid;
					$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($uname);
					$this->User->save($this->request->data);
					
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
					$this->Email->subject = "Welcome to".$setngs[0]['Sitesetting']['site_name'];
					$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
					$this->Email->sendAs = "html";
					$this->Email->template = 'userlogin';
					$this->set('name', $uname);
					$this->set('urlname', $urlname);
					$this->set('email', $emailaddress);
					$this->set('siteurl',SITE_URL);
					$emailid = base64_encode($emailaddress);
					//$pass = base64_encode($password);
					$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key);
					//$this->Email->send();
					$user = $this->User->find('all',array('conditions'=>array('email'=>$user_profile->email)));
					if($this->Auth->login($user)){
						$cookie['email'] = $user[0]['User']['email'];
						//$cookie['pass'] = $user['User']['password'];
						$this->Cookie->write('User',$cookie,true,'+2 weeks');
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
					}
				}
			}
		}
				
		public function loginwithtwitter($provider = null) {
			$this->layout = "mobilelayout";
			global $setngs;
			require_once( WWW_ROOT . 'hybridauth/Hybrid/Auth.php' );
			$hybridauth_config = array(
					"base_url" => 'http://' . $_SERVER['HTTP_HOST'] . $this->base . "/hybridauth/", // set hybridauth path
						
					"providers" => array(
							"Twitter" => array(
									"enabled" => true,
									"keys" => array("key" => "IGwaIlxkJPiYcqD644p4Zw", "secret" => "nfHk0HW5SgnP4Sd51OuqCuK29p3vTI9NqRnQXs7k")
							)
							// for another provider refer to hybridauth documentation
					)
			);
			// create an instance for Hybridauth with the configuration file path as parameter
			if(!empty($hybridauth_config)){
				$hybridauth = new Hybrid_Auth($hybridauth_config);
			}
			//echo "<pre>";print_r($hybridauth);die;
			// try to authenticate the selected $provider
			$adapter = $hybridauth->authenticate($provider);
			//echo "<pre>";print_r($adapter);die;
			// grab the user profile
			$user_profile = $adapter->getUserProfile();
			//echo "<pre>";print_r($user_profile);die;
			$authuser = $this->User->find('all',array('conditions'=>array('twitter_id'=>$user_profile->identifier)));
			if(!empty($authuser)){
				if($this->Auth->login($authuser)){
					$cookie['email'] = $authuser[0]['User']['email'];
					//$cookie['pass'] = $user['User']['password'];
					$this->Cookie->write('User',$cookie,true,'+2 weeks');
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
			}else{
				//echo "hi";die;
				$this->set('user_profile',$user_profile);
				$this->set('setngs',$setngs);
			}
		}
				
		public function twittlogin_save(){
			$this->loadModel('User');
			global $setngs;
			if(!empty($this->request->data)){
				$username = $this->request->data['signup']['username'];
				$email = $this->request->data['signup']['email'];	
				$nmecounts = $this->User->find('count',array('conditions'=>array('username'=>$username)));
				$emlcounts = $this->User->find('count',array('conditions'=>array('email'=>$email)));
				// echo "<pre>";print_r($nmecounts);die;
				if($username==''){
					$this->Session->setFlash("Please enter the Username");
					$this->redirect($this->referer());
				}
				if($email=='' ){
					$this->Session->setFlash("Please enter the Email");
					$this->redirect($this->referer());
				}
				
				if($nmecounts > 0){
					$this->Session->setFlash("Username already exists");
					$this->redirect($this->referer());
				}
				if($emlcounts > 0){
					$this->Session->setFlash("Email already exists");
					$this->redirect($this->referer());
				}
				
				$twitphoto = $this->request->data['twitphoto'];
				$twtsmallphoto = str_replace("_normal", "", $twitphoto);
				//echo "<pre>";print_r($onlyconsonants)."<br />";die;
				$image_save = time().'.jpg';
				$small = file_get_contents($twitphoto);
				$big = file_get_contents($twtsmallphoto);
				//chmod($image_save, 0644);
				$t70 = fopen('media/avatars/thumb70/'.$image_save,'wb');
				$f150 = fopen('media/avatars/thumb150/'.$image_save,'wb');
				$f350 = fopen('media/avatars/thumb350/'.$image_save,'wb');
				$fori = fopen('media/avatars/original/'.$image_save,'wb');
				fwrite($t70,$small);
				fwrite($f150,$big);
				fwrite($f350,$big);
				fwrite($fori,$big);
				fclose($t70);
				fclose($f150);
				fclose($f350);
				fclose($fori);
				
				$twitter_id = $this->request->data['twitlogin'];
				$name=$this->request->data['User']['username'] = $this->request->data['signup']['username'];
				$urlname = $this->request->data['User']['username_url'] = $this->Urlfriendly->utils_makeUrlFriendly($name);
				$this->request->data['User']['first_name'] = $this->request->data['signup']['firstname'];
				//$this->request->data['User']['last_name'] = $user_profile->lastName;
				$emailaddress = $this->request->data['User']['email'] = $this->request->data['signup']['email'];
				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['twitlogin']);
				$twit_id = $this->request->data['User']['twitter_id'] = $twitter_id;
				$this->request->data['User']['profile_image'] = $image_save;
				$this->request->data['User']['user_level'] = 'normal';
				$this->request->data['User']['user_status'] = 'enable';
				$this->request->data['User']['activation'] = '1';
				$this->request->data['User']['created_at'] = date('Y-m-d H:i:s');
				//$this->request->data['User']['gender'] = $user_profile->gender;
				$uniquecode = $this->Urlfriendly->get_uniquecode(8);
				$refer_key=$this->request->data['User']['refer_key'] = $uniquecode;
				
				$this->User->save($this->request->data);
				$userid = $this->User->getLastInsertID();
		
				$this->loadModel('Shop');
				$this->request->data['Shop']['user_id'] = $userid;
				$this->Shop->save($this->request->data);
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
				$this->Email->subject = "Welcome to".$setngs[0]['Sitesetting']['site_name'];
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";
				$this->Email->sendAs = "html";
				$this->Email->template = 'userlogin';
				$this->set('name', $name);
				$this->set('urlname', $urlname);
				$this->set('email', $emailaddress);
				$this->set('siteurl',SITE_URL);
				$emailid = base64_encode($emailaddress);
				//$pass = base64_encode($password);
				$this->set('access_url',SITE_URL."verification/".$emailid."~".$refer_key);
				//$this->Email->send();
				//$this->Session->setFlash('An email was sent to your mail box, please activate your account and login.');
		
				$user = $this->User->find('all',array('conditions'=>array('email'=>$emailaddress,'twitter_id'=>$twit_id)));
		
		
				if($this->Auth->login($user)){
					$cookie['email'] = $user[0]['User']['email'];
					//$cookie['pass'] = $user['User']['password'];
					$this->Cookie->write('User',$cookie,true,'+2 weeks');
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
			}
		}
				
			
		public function invite_twit_msg(){
			global $setngs;
			global $username;
			$tweetname = trim($_POST['tweetname']);
			require_once( WWW_ROOT . 'twitteroauth/twitteroauth.php' );
			$connection = new TwitterOAuth('IGwaIlxkJPiYcqD644p4Zw', 'nfHk0HW5SgnP4Sd51OuqCuK29p3vTI9NqRnQXs7k', '301372245-FQLQO7oZI5cbgvTkYVLTbFdJUUsmEQwXKds2iJuR', 'CzG2j2jFuUsVaAfo0gJ7ZZjYTFOmHxniI9JPxXsKg');
			$connection->post('direct_messages/new', array('user_id' => ''.$tweetname.'' , 'text' => 'Join with me '.$setngs[0]['Sitesetting']['site_name'].' '.SITE_URL.'signup?referrer='.$username));
			die;			
		}
			
			
		public function invite_friends($provider=null){
			$this->layout = "mobilelayout";
			$this->set('title_for_layout','- Invite Friends');
			global $setngs;
			if($provider=="Twitter"){
			require_once( WWW_ROOT . 'hybridauth/Hybrid/Auth.php' );
			$hybridauth_config = array(
					"base_url" => 'http://' . $_SERVER['HTTP_HOST'] . $this->base . "/hybridauth/", // set hybridauth path
						
					"providers" => array(
							"Twitter" => array(
									"enabled" => true,
									"keys" => array("key" => "IGwaIlxkJPiYcqD644p4Zw", "secret" => "nfHk0HW5SgnP4Sd51OuqCuK29p3vTI9NqRnQXs7k")
							)
							// for another provider refer to hybridauth documentation
					)
			);
			// create an instance for Hybridauth with the configuration file path as parameter
			if(!empty($hybridauth_config)){
				$hybridauth = new Hybrid_Auth($hybridauth_config);
			}
			//echo "<pre>";print_r($hybridauth);die;
			// try to authenticate the selected $provider
			$adapter = $hybridauth->authenticate("Twitter");
			//echo "<pre>";print_r($adapter);die;
			// grab the user profile
			$user_contacts = $adapter->getUserContacts();
			//echo "<pre>";print_r($user_contacts);die;
			// iterate over the user friends list
			foreach( $user_contacts as $contact ){
				$contact->displayName . " " . $contact->profileURL . "<hr />";
			}
			
			$this->set('user_contacts',$user_contacts); 
			}
			
			if($provider=="Google"){
				//require_once( WWW_ROOT . 'hybridauth/oauth/oauth.php' );
				$client_id = '146312791564.apps.googleusercontent.com';
				$client_secret = 'IMGNi-r0j0BzoPeqLHHM2mgV';
				$redirect_uri = SITE_URL.'invite_friends/Google/';
				$max_results = 500;
				$auth_code = $_GET["code"];
				$fields=array(
						'code'=>  urlencode($auth_code),
						'client_id'=>  urlencode($client_id),
						'client_secret'=>  urlencode($client_secret),
						'redirect_uri'=>  urlencode($redirect_uri),
						'grant_type'=>  urlencode('authorization_code')
				);
				$post = '';
				foreach($fields as $key=>$value) {
					$post .= $key.'='.$value.'&';
				}
				$post = rtrim($post,'&');
				
				$curl = curl_init();
				curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
				curl_setopt($curl,CURLOPT_POST,5);
				curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
				$result = curl_exec($curl);
				curl_close($curl);
				$response =  json_decode($result);
				//echo "<pre>";print_r($response);die;
				$accesstoken = $response->access_token;
				$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
				//$xmlresponse =  curl_file_get_contents($url);
				$curl = curl_init();
				$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
					
				curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
				curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
				curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.
					
				curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
				curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	//To stop cURL from verifying the peer's certificate.
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					
				$xmlresponse = curl_exec($curl);
				curl_close($curl);
				//echo "<pre>";print_r($xmlresponse);die;
				if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
				{
					echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
					exit();
				}
				//echo "<h3>Email Addresses:</h3>";
				$xml =  new SimpleXMLElement($xmlresponse);
				$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
				$result = $xml->xpath('//gd:email');
				
				$this->set('result',$result);
				
			}
			$creditAmount = $setngs[0]['Sitesetting']['site_changes'];
			$creditAmount = json_decode($creditAmount,true);
			$this->set('creditAmount',$creditAmount);
		}
			
			
		public function sendinviteemail() {
			//echo "<pre>";print_r($this->request->data);die;
			global $loguser;
			global $setngs;
			$this->loadModel('Userinvite');
			$setngsemail = $setngs[0]['Sitesetting']['noreply_email'];
			$inviter_email = $loguser[0]['User']['email'];
			$user_id = $loguser[0]['User']['id'];
			$username = $loguser[0]['User']['username'];
			if(!empty($this->request->data)){
			$emailcontacts = $this->request->data['field'];
			foreach ($emailcontacts as $userr){
				//$user_email = $userr['User']['email'];'.$inviter_email.'
				
				$this->Userinvite->create();
				$this->request->data['Userinvite']['user_id'] = $user_id;
				$this->request->data['Userinvite']['invited_email'] = $userr;
				$this->request->data['Userinvite']['status'] = 'Invited';
				$this->request->data['Userinvite']['invited_date'] = time();
				$this->request->data['Userinvite']['cdate'] = time();
				$this->Userinvite->save($this->request->data);
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $userr;
				$this->Email->subject = $inviter_email." Invites You";
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";;
				$this->Email->sendAs = "html";
				$this->Email->template = 'invitemail';
				$this->set('userr',$userr);
				$this->set('loguser',$loguser);
				$this->set('username',$username);
				$this->Email->send();
			
			}
			
			$this->Session->setFlash('Invite sent successfully');
			$this->redirect('/');
			
			}
		}
			
			
		public function sendinviteemailref() {
			//echo "<pre>";print_r($this->request->data);die;
			$this->loadModel('Userinvite');
			global $loguser;
			global $setngs;
			$inviter_email = $loguser[0]['User']['email'];
			$user_id = $loguser[0]['User']['id'];
			$username = $loguser[0]['User']['username'];
			$setngsemail = $setngs[0]['Sitesetting']['noreply_email'];
			$this->autoRender = false;
			
			$emailids = $_POST['emails'];
			$msg = $_POST['msg'];
			$email = explode( ',', $emailids['emails'] );
			//echo "<pre>";print_r($email);die;
			
			foreach ($email as $email){
				
				$this->Userinvite->create();
				$this->request->data['Userinvite']['user_id'] = $user_id;
				$this->request->data['Userinvite']['invited_email'] = $email;
				$this->request->data['Userinvite']['status'] = 'Invited';
				$this->request->data['Userinvite']['invited_date'] = time();
				$this->request->data['Userinvite']['cdate'] = time();
				$this->Userinvite->save($this->request->data);
				
				if($setngs[0]['Sitesetting']['gmail_smtp'] == 'enable'){
					$this->Email->smtpOptions = array(
						'port' => $setngs[0]['Sitesetting']['smtp_port'],
						'timeout' => '30',
						'host' => 'ssl://smtp.gmail.com',
						'username' => $setngs[0]['Sitesetting']['noreply_email'],
						'password' => $setngs[0]['Sitesetting']['noreply_password']);
			
					$this->Email->delivery = 'smtp';
				}
				$this->Email->to = $email;
				$this->Email->subject = $inviter_email." Invites You on ".$setngs[0]['Sitesetting']['noreply_email'];
				$this->Email->from = SITE_NAME."<".$setngs[0]['Sitesetting']['noreply_email'].">";;
				$this->Email->sendAs = "html";
				$this->Email->template = 'invitemail';
				$this->set('userr',$email);
				$this->set('msg',$msg);
				$this->set('loguser',$loguser);
				$this->set('username',$username);
				$this->Email->send();
							
			}
			$email='';
			die;
			
		}
				
		public function user_lists($name=NULL,$id=NULL) {
			$this->layout = "mobilelayout";
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Itemlist');
			$this->loadModel('Item');
			$this->loadModel('Category');
			$name = urldecode($name);
			
			$itemListsAll = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$id,'lists LIKE'=>$name)));
			
			//echo "<pre>";print_r($itemListsAll);
			foreach($itemListsAll as $list){
				$list_itemides = json_decode($list['Itemlist']['list_item_id']);
			}
			
			//echo "<pre>";print_r($list_itemides);die;
			
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$list_itemides),'order' => 'RAND()'));
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('userid',$userid);
			$this->set('item_datas',$item_datas);
			$this->set('lname',$name);
		
		}
			
		public function deactivateacc() {
			$this->layout = "mobilelayout";
			global $setngs;
			$this->loadModel('User');
			$userid = $_POST['userid'];
			$this->request->data['User']['id'] = $userid;
			$this->request->data['User']['user_status'] = 'disable';
			//$this->request->data['User']['activation'] = '2';
			$this->User->save($this->request->data);
			$this->Session->destroy();
			$this->redirect($this->Auth->logout());
			
		}
		
		public function bookmarklet() {
			
			if ($this->Auth->login()) {
			
			$itemId = $_GET['id'];
			$titlee = $_GET['tit'];
			$descriptionn = $_GET['descr'];
			$site_ridirect = $_GET['site_ridirect'];
			$itmeprices = $_GET['itmeprices'];
			$itemId = str_replace("http","http://",$itemId);
			$site_ridirect = str_replace("http","http://",$site_ridirect);
			//$image_get = $itemId;
			$image_save_name = time().'.jpg';
			/* $i = file_get_contents($image_get);
			//chmod($image_save, 0644);
			$t70 = fopen('media/items/thumb70/'.$image_save_name,'wb');
			$f150 = fopen('media/items/thumb150/'.$image_save_name,'wb');
			$f350 = fopen('media/items/thumb350/'.$image_save_name,'wb');
			$fori = fopen('media/items/original/'.$image_save_name,'wb');
			fwrite($t70,$i);
			fwrite($f150,$i);
			fwrite($f350,$i);
			fwrite($fori,$i);
			fclose($t70);
			fclose($f150);
			fclose($f350);
			fclose($fori); */
			
			
			$this->FileUpload->upload($itemId,$image_save_name,"item");
			
			$this->loadModel('Shop');
			$this->loadModel('Item');
			$this->loadModel('Photo');
			$this->loadModel('Shiping');
			global $loguser;
				
			/* for($i=0;$i<1;$i++){
				if(!empty($this->request->data['image'][$i])){
					$imgName = $_SESSION['media_url'].'media/items/original/'.$this->request->data['image'][$i];
					$result = ColorCompareComponent::compare(5, $imgName);
				}
			} */
			//$result = ColorCompareComponent::compare(5, $image_save_name);
				
			//echo "<pre>";print_r($result);die;
			$userid = $loguser[0]['User']['id'];
				
			$shpcnt = $this->Shop->find('all',array('conditions'=>array('user_id'=>$userid)));
			if(!empty($shpcnt)){
				$shop_id = $shpcnt[0]['Shop']['id'];
			}else{
				$this->request->data['Shop']['user_id'] = $userid;
				$this->Shop->save($this->request->data);
				$shop_id = $this->Shop->getLastInsertID();
			}
				
			$this->request->data['Item']['user_id'] = $userid;
			$this->request->data['Item']['shop_id'] = $shop_id;
			$title = $this->request->data['Item']['item_title'] = $titlee;
			$title_url = $this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $descriptionn;
			//$this->request->data['Item']['shop_sec'] = $this->request->data['Item']['shop_sec'];
			//$this->request->data['Item']['recipient'] = $this->request->data['property']['recipient'];
			$this->request->data['Item']['occasion'] = '0';
			$this->request->data['Item']['recipient'] = '0';
			$this->request->data['Item']['bm_redircturl'] = $site_ridirect;
			
		
			$this->request->data['Item']['price'] = $itmeprices;
			$this->request->data['Item']['quantity'] = '0';
			$this->request->data['Item']['size_options'] = '0';
			$this->request->data['Item']['category_id'] = '0';
			$this->request->data['Item']['super_catid'] = '0';
			$this->request->data['Item']['sub_catid'] = '0';
			$ship_from_country = $this->request->data['Item']['ship_from_country'] = '0';
			$processing_time_id = $this->request->data['Item']['processing_time'] = '0';
			if($processing_time_id == 'custom'){
				$this->request->data['Item']['processing_min'] = '0';
				$this->request->data['Item']['processing_max'] = '0';
				$this->request->data['Item']['processing_option'] = '0';
			}
			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
			$this->request->data['Item']['status'] = 'things';
			$this->request->data['Item']['item_color'] = '0';
				
			//echo "<pre>";print_r($this->request->data['Item']);die;
				
			$this->Item->save($this->request->data);
				
			$last_id = $this->Item->getLastInsertID();
				
			//for($i=0;$i<5;$i++){
				$this->Photo->create();
				// echo $this->request->data['image'][$i];
				if(!empty($image_save_name)){
					$this->request->data['Photo']['item_id'] = $last_id;
					$this->request->data['Photo']['image_name'] = $image_save_name;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					// echo "<pre>";print_r($this->request->data['Photo']);die;
					$this->Photo->save($this->request->data);
				}
			//}
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
						$this->request->data['Shiping']['other_item_cost'] = $shps['secondary'];
						$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
			
						$this->Shiping->save($this->request->data);
					}
				}
			}
			if(!empty($_REQUEST['everywhere_shipping'])){
				$this->Shiping->create();
			
				$this->request->data['Shiping']['item_id'] = $last_id;
				$this->request->data['Shiping']['country_id'] = $ship_from_country;
				$this->request->data['Shiping']['primary_cost'] = $_REQUEST['everywhere_shipping'][1]['primary'];
				$this->request->data['Shiping']['other_item_cost'] = $_REQUEST['everywhere_shipping'][1]['secondary'];
				$this->request->data['Shiping']['created_on'] = date("Y-m-d H:i:s");
			
				$this->Shiping->save($this->request->data);
			}
			
			$image_url = SITE_URL.'listing/'.$last_id.'/'.$title_url;
			
			$this->redirect(SITE_URL.'/bookmark1.php?uploaded='.$image_url);
		
			}else{
				//echo SITE_URL.'/bookmark.php?notloggin=yes';die;
				$this->redirect(SITE_URL.'/bookmark.php?notloggin=yes');
			}
		}
			
		public function logs($type=NULL,$itemId=NULL,$userId=NULL,$followId=NULL) {
			
			//cho $type;die;
			$this->loadModel('Log');
			$this->request->data['Log']['type'] = $type;
			$this->request->data['Log']['notification_id'] = $itemId;
			$this->request->data['Log']['user_id'] = $userId;
			$this->request->data['Log']['follow_id'] = $followId;
			//$this->request->data['Log']['follower_id'] = $follwersId;
			$this->request->data['Log']['cdate'] = time();
			
			$this->Log->save($this->request->data);
			
			return true;
		
		}
			
			
	public function push_notifications() {
			$this->layout = 'mobilelayout';
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			
			$this->loadModel('Item');
			$this->loadModel('Comment');
			$this->loadModel('Follower');
			$this->loadModel('Log');
			$this->loadModel('User');
			//$flwrscnt = $this->Follower->flwrscnt($userid);
			
			$flwrscnt = $this->Follower->findAllByfollow_user_id($userid);
			
			foreach($flwrscnt as $flwr){					
				$flwruserid[] = $flwr['Follower']['user_id'];					
			}
			//echo "<pre>";print_r($flwruserid);die;
			//$loguserdetails = $this->Log->find('all',array('conditions' =>array('user_id' =>//$flwruserid),'limit'=>20,'order'=>array('id'=>'desc')));
if(empty($flwruserid)){
$loguserdetails = $this->Log->find('all',array('conditions' =>array('OR' => array(array('user_id' =>$flwruserid),array('type' => 'follow'))),'order'=>array('id'=>'desc')));
}else{
$loguserdetails = $this->Log->find('all',array('conditions' =>array('user_id' =>$flwruserid),'order'=>array('id'=>'desc')));
}


			$userDetails = $this->User->find('first',array('conditions' =>array('User.id' =>$userid)));
			//echo "<pre>";print_r($decoded_value);die;
			
			$decoded_value = json_decode($userDetails['User']['push_notifications']);
			$checkone = 1;
			foreach($loguserdetails as $keyy=>$log){
				$not_type[$log['Log']['id']] = $log['Log']['type'];
				$notific_id[$log['Log']['id']] = $log['Log']['notification_id'];
				//$Log_cdate[$log['Log']['id']] = $log['Log']['cdate'];
				if($decoded_value->frends_cmnts_push == '1'){
					if($log['Log']['type'] == 'comment'){
						$getLogvalues[] = $itemdatasall = $this->Comment->findById($log['Log']['notification_id']);
						$itemcmt[] = $itemdatasall['Comment']['item_id'];
					  	$itemdatas[]=  $itemdata = $this->Item->findById($itemcmt);
		          		// echo "<pre>";print_r($itemdata);die;
		       			//echo "<pre>";print_r($val);die;
			            $get[] =  $itemdata['Photo'][0]['image_name'];
                        $id[]=$itemdata['Item']['id'];
                        
		        	}
				}
				if($decoded_value->frends_flw_push == '1'){
					if($log['Log']['type'] == 'favorite'){
						$getLogvalues[] =  $this->Item->findById($log['Log']['notification_id']);
					}
					if($log['Log']['type'] == 'additem'){
						$getLogvalues[] =  $this->Item->findById($log['Log']['notification_id']);
					}
				       
			
					
					if($log['Log']['type'] == 'sellermessage'){
						$getLogvalues[] = $this->User->findById($log['Log']['user_id']);
					}
				} 
                     if($log['Log']['type'] == 'follow'  && $userid == $log['Log']['follow_id'] ){
			
                     	$getLogvalues1 = $this->Log->find('all',array('conditions'=>array('follow_id'=>$userid,'type'=>'follow')));
                     	foreach($getLogvalues1 as $getlogv){
                     		//echo "<pre>";print_r($getlogv);die;
                     		$userids = $getlogv['Log']['user_id'];
                     		$getLogvalues[] = $this->User->findById($userids);
                     	}
						//$getLogvalues[] = $this->User->findById($log['Log']['user_id']);
                     
                     }
                                        
			
			}
	   		//echo "<pre>";print_r($getLogvalues);die;
			//echo "<pre>";print_r($get);die;
			//echo "<pre>";print_r($loguserdetails);die;
			$this->set('decoded_value',$decoded_value);
			$this->set('getLogvalues',$getLogvalues);
			$this->set('get',$get);
			$this->set('id',$id);
			$this->set('userid',$userid);
			$this->set('itemcmt',$itemcmt);
			$this->set('loguserdetails',$loguserdetails);
			$this->set('itemdata',$itemdata);
			$this->set('itemdatas',$itemdatas);
		}
			
		public function additemusingurl () {
			$this->layout = "ajax";
			$this->autoRender = false;
			$this->loadModel('User');
			$this->loadModel('Item');
			$url = $_GET['url'];
			//$prefix = $this->Item->tablePrefix;
			$url = "http://".$url;
			
			$homepage = file_get_contents($url);
			
			preg_match_all("{<img\\s*(.*?)src=('.*?'|\".*?\"|[^\\s]+)(.*?)\\s*/?>}ims", $homepage, $matches, PREG_SET_ORDER);
			
			/* foreach ($matches as $val) {
				$imgsrc[] = $val[2];
			}		
			$imgsrcss = str_replace(array('\'', '"'), '', $imgsrc); */
			
			foreach ($matches as $val) {
				$imgsrc= $val[2];
				$imgsrcss = str_replace(array('\'', '"'), '', $imgsrc);
				if (strpos($imgsrcss, 'http://') !== false) {
					list($width, $height) = getimagesize($imgsrcss);
					if($width > 50 && $height > 50){
						$final[] = $imgsrcss;
					}
				} elseif(strpos($imgsrcss, '//') !== false){
					$imgsrcss = str_replace('//', 'http://', $imgsrcss);
					list($width, $height) = getimagesize($imgsrcss);
					if($width > 200 && $height > 200){
						$final[] = $imgsrcss;
					}
				}
			}
			
			echo json_encode($final);
				
		}
	
		public function additemsave () {
			$this->layout = "ajax";
			$this->autoRender = false;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Itempost');
			$this->loadModel('Shop');
			$this->loadModel('Item');
			$this->loadModel('Photo');
			$title = $_GET['title'];
			$desc = $_GET['desc'];
			$categoryname = $_GET['categoryname'];
			$oth_siteurl = "http://".$_GET['siteurl'];
			$imageurl = $_GET['imageurl'];
			$additem_prices = $_GET['additem_prices'];
			
			$imageurl = str_replace("http","http://", $imageurl);
			
			$image_save = time().$userid.'.jpg';
			
			$this->FileUpload->upload($imageurl,$image_save,"item");
			
			/* $i = file_get_contents($imageurl);
			//chmod($image_save, 0644);
			$fori = fopen('media/items/original/'.$image_save,'wb');
			fwrite($fori,$i);
			fclose($fori);
			
			require_once( WWW_ROOT . 'pThumb.php' );
			$img=new pThumb();
			
			$img->pSetSize('150', '150');
			$img->pSetQuality(100);
			$img->pCreateCropped('media/items/original/'.$image_save, 150, 150);
			$img->pSave('media/items/thumb150/'.$image_save);
			$img = "";
			
			$img=new pThumb();
			
			$img->pSetSize('70', '70');
			$img->pSetQuality(100);
			$img->pCreateCropped('media/items/original/'.$image_save, 70, 70);
			$img->pSave('media/items/thumb70/'.$image_save);
			$img = "";
			
			$img=new pThumb();
			
			$img->pSetSize('350', '350');
			$img->pSetQuality(100);
			$img->pCreateCropped('media/items/original/'.$image_save, 230, 230);
			$img->pSave('media/items/thumb350/'.$image_save);
			//chmod('media/items/thumb350/'.$image_save, 0644);
			$img = ""; */
			
			$imgName = $_SESSION['media_url'].'media/items/original/'.$image_save;
			$result = ColorCompareComponent::compare(5, $imgName);
			
			/* $this->request->data['Itempost']['title'] = $title;
			$this->request->data['Itempost']['description'] = $desc;
			$this->request->data['Itempost']['user_id'] = $userid;
			$this->request->data['Itempost']['category_id'] = $categoryname;
			$this->request->data['Itempost']['site_url'] = $oth_siteurl;
			$this->request->data['Itempost']['image_name'] = $image_save;
			$this->request->data['Itempost']['item_color'] = json_encode($result);
			$this->request->data['Itempost']['cdate'] = time();
			
			$this->Itempost->save($this->request->data); */
			
			$shpcnt = $this->Shop->find('all',array('conditions'=>array('user_id'=>$userid)));
			if(!empty($shpcnt)){
				$shop_id = $shpcnt[0]['Shop']['id'];
			}else{
				$this->request->data['Shop']['user_id'] = $userid;
				$this->Shop->save($this->request->data);
				$shop_id = $this->Shop->getLastInsertID();
			}
			
			//$last_id = $this->request->data['Item']['id'] = $addedtheitemid;
			$this->request->data['Item']['user_id'] = $userid;
			$this->request->data['Item']['shop_id'] = $shop_id;
			$this->request->data['Item']['item_title'] = $title;
			$this->request->data['Item']['item_title_url'] = $this->Urlfriendly->utils_makeUrlFriendly($title);
			$this->request->data['Item']['item_description'] = $desc;
			//$this->request->data['Item']['occasion'] = $this->request->data['property']['occasion'];
				
			/* if(!empty($this->request->data['recipient'])){
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			}else{
				$this->request->data['Item']['recipient'] = json_encode($this->request->data['recipient']);
			} */
			$this->request->data['Item']['price'] = $additem_prices;
			$this->request->data['Item']['quantity'] = '0';
			//$this->request->data['Item']['size_options'] = $this->request->data['Item']['item_size_options'];
			$this->request->data['Item']['category_id'] = $categoryname;
			//$this->request->data['Item']['super_catid'] = $this->request->data['\'Item\'']['\'supersubcat\''];
			//$this->request->data['Item']['sub_catid'] = $this->request->data['\'Item\'']['\'subcat\''];
			//$ship_from_country = $this->request->data['Item']['ship_from_country'] = $this->request->data['ship_from_country'];
			//$processing_time_id = $this->request->data['Item']['processing_time'] = $this->request->data['processing_time_id'];
			/* if($processing_time_id == 'custom'){
				$this->request->data['Item']['processing_min'] = $this->request->data['processing_min'];
				$this->request->data['Item']['processing_max'] = $this->request->data['processing_max'];
				$this->request->data['Item']['processing_option'] = $this->request->data['processing_time_units'];
			} */
			$this->request->data['Item']['created_on'] = date("Y-m-d H:i:s");
			$this->request->data['Item']['status'] = 'things';
			$this->request->data['Item']['item_color'] = json_encode($result);
			$this->request->data['Item']['bm_redircturl'] = $oth_siteurl;
			$this->Item->save($this->request->data);
			
			$last_id = $this->Item->getLastInsertID();
				
				if(!empty($image_save)){
					$this->request->data['Photo']['item_id'] = $last_id;
					$this->request->data['Photo']['image_name'] = $image_save;
					$this->request->data['Photo']['created_on'] = date("Y-m-d H:i:s");
					// echo "<pre>";print_r($this->request->data['Photo']);die;
					$this->Photo->save($this->request->data);
				//}
			}
			
			$logdetails = $this->logs('additem',$last_id,$userid,'0');
			$retn = $last_id.",".$this->Urlfriendly->utils_makeUrlFriendly($title);
			echo $retn;
			
			die;
		}
			
		public function rssfeed($name=NULL) {
			$this->loadModel('Item');
			$usr_datas = $this->User->findByUsernameUrl($name);
			if(!empty($usr_datas['Itemfav'])){
				foreach($usr_datas['Itemfav'] as $itms){
					$itmid[] = $itms['item_id'];
				}
				$sSQL = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
			}
			
			$aStoriesRSS = array();			
			//$sSQL = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order' => array('Item.id DESC')));
			 
			//$sSQL = "SELECT * FROM `ak_users` ORDER BY `id` DESC";
			//$aStories = $GLOBALS['MySQL']->getAll($sSQL);
			foreach ($sSQL as $iID => $aStoryInfo) {
				//echo "<pre>";print_r($aStoryInfo);die;
				$iStoryID = $aStoryInfo['Item']['id'];
				 
				$aStoriesRSS[$iID]['Guid'] = $iStoryID;
				$aStoriesRSS[$iID]['Title'] = $aStoryInfo['Item']['item_title'];
				$aStoriesRSS[$iID]['Link'] = SITE_URL . 'listing/' . $aStoryInfo['Item']['id'].'/'. $aStoryInfo['Item']['item_title_url'];
				$aStoriesRSS[$iID]['Desc'] = $aStoryInfo['Item']['item_title'];
				$aStoriesRSS[$iID]['DateTime'] = date("Y-m-d", strtotime($aStoryInfo['Item']['created_on']));
				$aStoriesRSS[$iID]['Image_name'] = $aStoryInfo['Photo'][0]['image_name'];
			}
			 
			$oRssFactory = new UrlfriendlyComponent();
			 
			header('Content-Type: text/xml; charset=utf-8');
			echo $oRssFactory->GenRssByData($aStoriesRSS, 'Fatacy\'d', SITE_URL , '',$name);
		
			 
			die;
		
		}
			
		function referrals () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Referrals');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			//$itemModel = array();
			$this->loadModel('Userinvite');
			$invited_friend = $this->Userinvite->find('all',array('conditions'=>array('user_id'=>$userid),'order'=>array('id'=>'desc')));
			$invitedCount = $this->Userinvite->find('count',array('conditions'=>array('user_id'=>$userid)));
			$joinedCount = $this->Userinvite->find('count',array('conditions'=>array('user_id'=>$userid,'status'=>'Joined')));
			$this->set('invited_friend',$invited_friend);
			$this->set('invitCount',$invitedCount);
			$this->set('joinedCount',$joinedCount);
		}
		function credits () {
			$this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Credits');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!$this->isauthenticated()){
				$this->redirect('/mobile/');
			}
			//$itemModel = array();
			$this->loadModel('Userinvitecredit');
			$this->loadModel('User');			
			$prefix = $this->Userinvitecredit->tablePrefix;				
			//echo "SELECT SUM(credit_amount) as total FROM ".$prefix."userinvitecredits WHERE invited_friend = $userid;";
			//die;
			$invite_credits = $this->Userinvitecredit->query("SELECT SUM(credit_amount) as total FROM ".$prefix."userinvitecredits WHERE invited_friend = $userid;");
						
			$creditamt_user = $this->Userinvitecredit->find('all',array('conditions'=>array('Userinvitecredit.invited_friend'=>$userid),'order'=>array('Userinvitecredit.id'=>'desc')));
					
			$available_bal = $this->User->findById($userid);
			//print_r($available_bal);die;
			
			$this->set('invite_credits',$invite_credits[0][0]['total']);
			$this->set('creditamt_user',$creditamt_user);
			$this->set('available_bal',round($available_bal['User']['credit_total'],2));
				
		}
			
		function gift_cards () {
			 $this->layout = 'mobilelayout';
			$this->set('title_for_layout','- Gift Card');
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$email = $loguser[0]['User']['email'];
			$username = $loguser[0]['User']['username'];
			if(!$this->isauthenticated()){
				$this->redirect('/');
			}
			$this->loadModel('Giftcard');
		
			$giftcarddets = $this->Giftcard->find('all',array('conditions'=>array('Giftcard.user_id'=>$userid,'Giftcard.status'=>'Paid'),'order'=>array('Giftcard.id'=>'desc')));
			$giftcarddets_recv = $this->Giftcard->find('all',array('conditions'=>array('Giftcard.reciptent_email'=>$email,'Giftcard.status'=>'Paid'),'order'=>array('Giftcard.id'=>'desc')));
			
			$this->set('giftcarddets',$giftcarddets); 
			$this->set('giftcarddets_recv',$giftcarddets_recv); 
				
		}
			

		public function searches($searchWord=null) {
			$this->layout = 'mobilelayout';
			$this->loadModel('Item');
			$this->loadModel('User');
			$this->loadModel('More');
			$this->loadModel('Itemlist');
			$prefix = $this->Item->tablePrefix;
				
			$userDetails = $this->User->find('all',array('conditions'=>array('User.username LIKE'=>"$searchWord%",'User.activation <>'=>"0",'User.user_level <>'=>"god")));
			//$userDetails = $this->User->query("SELECT * FROM ".$prefix."users  WHERE username LIKE '%$searchWord%' and activation !=0  and user_level !='god' ");
			//$itemlistDetails=$this->Item->query("SELECT * FROM ".$prefix."itemlists WHERE lists LIKE '%$searchWord%'");
			//$itemDetails = $this->Item->query("SELECT * FROM ".$prefix."items INNER JOIN ".$prefix."photos ON  ".$prefix."items.id= ".$prefix."photos.item_id WHERE item_title LIKE '%$searchWord%'  and ".$prefix."items.status = 'publish'  LIMIT 50");
			$itemDetails = $this->Item->find('all',array('conditions'=>array('Item.item_title LIKE'=>"%$searchWord%",'Item.status LIKE'=>"publish")));
			//echo "<pre>";print_r($itemListsAll);die;
			$this->set('searchWord',$searchWord);
			$this->set('itemDetails',$itemDetails);
			$this->set('userDetails',$userDetails);
			$this->set('itemlistDetails',$itemlistDetails);
			$this->set('prefix',$prefix);
			//echo "<pre>";print_r($itemDetails);die;
						
		}
			
		public function captcha()  {
			$this->autoRender = false;
			$this->Captcha->generate();
		}

			
		public function nearme() {
			 $this->set('title_for_layout',' ');
			$this->layout = 'mobilelayout';
			global $username;
			global $user_level;
			global $loguser;
			global $setngs;
			global $siteChanges;
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
				
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Shop');
			$userid = $loguser[0]['User']['id'];
			// echo "<pre>";print_r($loguser);die;
			$this->set('username',$username);
			if($user_level == 'god'){
				$this->redirect('/admin');
			}
			
			$lat = $_GET['lat'];
			$lng = $_GET['long'];
			$kilometer = $_GET['kilometer'];
			if(isset($kilometer)){
				$kilometer = $kilometer * 0.1 / 11;
			}else{
				$kilometer = 25 * 0.1 / 11;				
			}
			
			//echo $kilometer;die;
			$Distance = $kilometer; // Range in degrees (0.1 degrees is close to 11km)
			$LatN = $lat + $Distance;
			$LatS = $lat - $Distance;
			$LonE = $lng + $Distance;
			$LonW = $lng - $Distance;
				
			$nearme = $this->Shop->find('all',array('conditions'=>array('Shop.shop_latitude BETWEEN ? AND ?' => array($LatS,$LatN) , 'Shop.shop_longitude BETWEEN ? AND ?' => array($LonW,$LonE))));
				
			foreach($nearme as $n){
				foreach($n['Item'] as $itmms)
					$itemid[] = $itmms['id'];
			}
				
			//echo "<pre>";print_r($itemid);die;
			
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			//$items_data = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid,'Item.status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
				
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			
			//$items_gallery = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order'=>array('Item.id'=>'desc')));

			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$items_data = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid,'status <>'=>'draft'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
			}else{
				$items_data = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemid,'status'=>'publish'),'limit'=>'20','order'=>array('Item.id'=>'desc')));
			}
					
				
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$items_gallery = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'order'=>array('Item.id'=>'desc')));
			}else{
				$items_gallery = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order'=>array('Item.id'=>'desc')));
			}
			
			
			
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_data',$items_data);
			$this->set('userid',$userid);
			$this->set('loguser',$loguser);
			$this->set('setngs',$setngs);
			$this->set('items_list_data',$items_list_data);
			$this->set('items_gallery',$items_gallery); 
			$this->set('lat',$lat); 
			$this->set('lng',$lng); 
			
		
		
		}
		
		
		function getMorenearme() {
			$this->autoRender = false;
			$this->loadModel('Item');
			$this->loadModel('Shop');
			$startIndex = $_GET['startIndex'];
			$offset = $_GET['offset'];
			$followingId = explode(',', $_GET['followid']);
			global $username;
			global $user_level;
			global $loguser;
			global $setngs;
			global $siteChanges;
				
			$roundProf = "";
			if ($siteChanges['profile_image_view'] == "round") {
				$roundProf = "border-radius:40px;";
			}
			$userid = $loguser[0]['User']['id'];
			
			
			
			$lat = $_GET['lat'];
			$lng = $_GET['long'];
				
			$Distance = 0.25; // Range in degrees (0.1 degrees is close to 11km)
			$LatN = $lat + $Distance;
			$LatS = $lat - $Distance;
			$LonE = $lng + $Distance;
			$LonW = $lng - $Distance;
			
			$nearme = $this->Shop->find('all',array('conditions'=>array('Shop.shop_latitude BETWEEN ? AND ?' => array($LatS,$LatN) , 'Shop.shop_longitude BETWEEN ? AND ?' => array($LonW,$LonE))));
			
			foreach($nearme as $n){
				foreach($n['Item'] as $itmms)
					$itemid[] = $itmms['id'];
			}
			
		
			if ($_GET['loadmoretab'] == 'following') {
				
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					//$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
					$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft','Item.user_id'=>$followingId,'Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId,'Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}
				
				
				//$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish','Item.user_id'=>$followingId,'Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
			}else {
				
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					//$items_data = $this->Item->find('all',array('conditions'=>array('status <>'=>'','Item.user_id'=>$followingId),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
					$items_data = $this->Item->find('all',array('conditions'=>array('Item.status <>'=>'draft','Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}else{
					$items_data = $this->Item->find('all',array('conditions'=>array('Item.status'=>'publish','Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
				}
				
				//$items_data = $this->Item->find('all',array('conditions'=>array('Item.status'=>'publish','Item.id'=>$itemid),'limit'=>$offset,'offset'=>$startIndex,'order'=>array('Item.id'=>'desc')));
			}
		if (count($items_data) != 0) {
				foreach($items_data as $key=>$itms){
					$usercmntcount='';
					$itm_id = $itms['Item']['id'];
					$user_id = $itms['Item']['user_id'];
					$item_title_url = $itms['Item']['item_title_url'];
					$item_title = $itms['Item']['item_title'];
					$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
					if(isset($itms['Photo'][0])){
						$image_name = $itms['Photo'][0]['image_name'];
					}
					$username_url = $itms['User']['profile_image'];
					$username = $itms['User']['username'];
					$username_urlss = $itms['User']['username_url'];
					$favorte_count = $itms['Item']['fav_count'];
					$shop_address = $itms['Shop']['shop_address'];
				
					//$cdate = $itms['Item']['created_on'];
					//$cdate = UrlfriendlyComponent::txt_time_diff(strtotime($cdate));
					$item_titletwo = UrlfriendlyComponent::limit_char($item_title,20);
				
				echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'" class="big" >'; 
				echo  '<div class="figure-item">';
				
							
				$mediaul = trim($_SESSION['media_url']);
				list($width, $height) = getimagesize($mediaul."media/items/thumb350/".$image_name);
				echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
				echo  "<span class='figure grid' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ><em class='back'></em></span>";
				echo  '<span class="figure classic">';
				echo  '<em class="back"></em>';
				echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' >";
				echo  '</span>';
				echo  '<span class="figure vertical">';
				echo  '<em class="back"></em>';
				echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."'  data-height=".$height." data-width=".$width.">";
				echo  '</span>';
				echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '</a>';
				echo  '<em class="figure-detail">';
				echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" > </span>';
				echo  '<span class="username"><em><i> &nbsp; &nbsp;</i><a href="'.SITE_URL."people/".$username_urlss.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'"></a>   <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></em></span>';
				echo  '</em>';
				
				echo '<ul class="function">';
				echo '<li class="share shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share btnforlike  glyphicons share" style="padding: 3px 0px;" ><span class="shareimg123"></span></a></li>';
			/* 	if(!empty($usercmntcount)){
					$cmnt = " ".count($usercmntcount);
				}else{
					$cmnt = " 0";
				}
				echo '<span class="comment shareli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons comments btnforlike" style="padding: 3px 4px; width: auto;">'.$cmnt.'</span></span>';
				echo '<span class="fantcyHeart heartli" style="margin-top: 0px; margin-right: 0px; background: none repeat scroll 0% 0% transparent; border: medium none;"><span class="shareimg123 glyphicons heart btnforlike" style="padding: 3px 4px; width: auto;"> '.$favorte_count.'</span></span>';
				 */
				echo '</ul>';
				
				foreach($itms['Itemfav'] as $useritemfav){
					if($useritemfav['user_id'] == $userid ){
						$usecoun[] = $useritemfav['item_id'];
					}
				}	
				
				foreach($itms['Comment'] as $usrcmnts){
					$usercmntcount[] = $usrcmnts['id'];					
				}
				
				if(isset($itms['Itemfav'][0]['user_id']) && isset($usecoun) &&  in_array($itm_id,$usecoun)){
				echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
				}else{
				echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
				}
				
				//echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm' >".$item_titletwo.' | '.$item_price." USD </a>";
				
				echo "<div class='userimagesthirtyfive'>";
					if(!empty($username_url)){
						echo  "<a href='".SITE_URL."people/".$username_urlss."' class='userv vcard'>
						<img src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
						<i class='arrow-sml' style='margin-top: 17px;'>$username</i>
						<br />						
						</a>";
					}else{
						echo  "<a href='".SITE_URL."people/".$username_urlss."' class='userv vcard '>
						<img src='".$_SESSION['media_url']."media/avatars/thumb70/usrimg.jpg' style='".$roundProf."'>
						<i class='arrow-sml' style='margin-top: 17px;'>$username </i>
						<br />
						</a>";
						}
				echo  "<div style='text-align:left;'><a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  title ='".$item_title."' class='titleforitm' >".$item_titletwo.'  <b'.$_SESSION['currency_symbol'].$item_price."</b> </a></div>";
				echo  '</div>';
				
				
				
				echo  '</div>';
				echo  '</li>';
		
					}
				} else {
					echo 'false';
				}
		
		}
		
		
		function sellerpost(){
			//$this->layout = 'frontlayout';
			$this->loadModel('Log');
			global $username;
			global $username_url;
			global $loguser;
			$logusrid = $loguser[0]['User']['id'];
			$logusername = $loguser[0]['User']['username'];
				
			if(!empty($this->request->data)){
		
				//echo "<pre>";print_r($this->request->data);die;
				$messagess = $this->request->data['sellermsg']['message'];
				$this->request->data['Log']['type'] = 'sellermessage';
				$this->request->data['Log']['seller_message'] = $messagess;
				$this->request->data['Log']['user_id'] = $logusrid;
				$this->request->data['Log']['cdate'] = time();
				$this->Log->save($this->request->data);
		
		
				$this->loadModel('Userdevice');
				$this->loadModel('Follower');
				$flwrscnt = $this->Follower->followcnt($logusrid);
				foreach($flwrscnt as $flwww){
					$useriddd = $flwww['Follower']['user_id'];
					$userddett = $this->Userdevice->findByUser_id($useriddd);
					if(!empty($userddett)){
						$deviceTToken = $userddett['Userdevice']['deviceToken'];
						if(isset($deviceTToken)){
							$messages = $logusername." is added news";
							$this->pushnot($deviceTToken,$messages);
						}
					}
				} 
		
		
		
				$this->redirect(SITE_URL.'people/'.$username_url."?news");
			}
				
		}
		function changeuserimgstatuss ($fId,$status) {
		
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Fashionuser');
		
			$prefix = $this->Fashionuser->tablePrefix;
		
			if ($status == 'Yes') {
				$this->Fashionuser->query("UPDATE ".$prefix."fashionusers SET status='No' WHERE id = ".$fId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = "<button class='btn btn-success' onclick='changeUserImgStatus(".$fId.",\"No\");'>Show</button>";
			}else {
				$this->Fashionuser->query("UPDATE ".$prefix."fashionusers SET status='Yes' WHERE id = ".$fId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = "<button class='btn btn-warning' onclick='changeUserImgStatus(".$fId.",\"Yes\");'>Hide</button>";
			}
			echo $result;
		}
		
		
		function inshopuseraddimage($loguserid,$shopIId,$srcimage){
			$this->layout = 'ajax';
			$this->autoRender = false;
			$this->loadModel('Shopuserphoto');
			global $loguser;
			$logusrid = $loguser[0]['User']['id'];
		
			$this->request->data['Shopuserphoto']['userimage'] = $srcimage;
			$this->request->data['Shopuserphoto']['user_id'] = $logusrid;
			$this->request->data['Shopuserphoto']['shop_id'] = $shopIId;
			$this->request->data['Shopuserphoto']['cdate'] = time();
			$this->request->data['Shopuserphoto']['status'] = 'No';
			if($srcimage !=''){
				$this->Shopuserphoto->save($this->request->data);
			}
			//$this->redirect(SITE_URL.$username_url."?photos");
				
		
		}
		
		function changeStatusForuserphotoinshppage ($suId,$status) {
		
			//echo $status;die;
				
			$this->autoLayout = false;
			$this->autoRender = false;
			$this->loadModel('Shopuserphoto');
		
			$prefix = $this->Shopuserphoto->tablePrefix;
		
			if ($status == 'Yes') {
				$this->Shopuserphoto->query("UPDATE ".$prefix."shopuserphotos SET status='No' WHERE id = ".$suId.";");//updateAll(array('status'=>'"draft"'), array('id'=>$itemId));
				$result = "<button class='btn btn-success' onclick='changeStatusForuserphotoinshppage(".$suId.",\"No\");'>Show</button>";
			}else {
				$this->Shopuserphoto->query("UPDATE ".$prefix."shopuserphotos SET status='Yes' WHERE id = ".$suId.";");//updateAll(array('status'=>'"publish"'), array('id'=>$itemId));
				$result = "<button class='btn btn-warning' onclick='changeStatusForuserphotoinshppage(".$suId.",\"Yes\");'>Hide</button>";
			}
			echo $result;
		}
		
		function mostpopular(){
			$this->set('title_for_layout',' ');
			$this->layout = 'mobilelayout';
			global $username;
			global $user_level;
			global $loguser;
			global $setngs;
			global $siteChanges;
			$this->set('profileImgStyle',$siteChanges['profile_image_view']);
			if($user_level == 'god'){
				$this->redirect('/admin');
			}
			$userid = $loguser[0]['User']['id'];
			$this->loadModel('Category');
			$this->loadModel('Item');
			$this->loadModel('Itemfav');
			$this->loadModel('Itemlist');
			$this->loadModel('Shop');
				
			$items_data = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'limit'=>'20','order'=>array('Item.fav_count'=>'desc')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
				
			$items_gallery = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order'=>array('Item.id'=>'desc')));
		
				
			$this->set('username',$username);
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_data',$items_data);
			$this->set('userid',$userid);
			$this->set('loguser',$loguser);
			$this->set('setngs',$setngs);
			$this->set('items_list_data',$items_list_data);
			$this->set('items_gallery',$items_gallery);
				
		
		}
		
		
		
		function savecategoryLists($cateids){
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			if(!empty($cateids)){
				$cateIdds = explode(',' , $cateids);
				foreach($cateIdds as $cattid){
					$this->loadModel('Category');	
					
					$prnt_cat_datas = $this->Category->findById($cattid);
					//echo "<pre>";print_r($prnt_cat_datas['Category']['category_name']);die;
					$category_name = $prnt_cat_datas['Category']['category_name'];
					$this->loadModel('Itemlist');			
					
					$this->Itemlist->create();
					$this->request->data['Itemlist']['user_id'] = $userid;
					$this->request->data['Itemlist']['list_item_id'] = '';
					$this->request->data['Itemlist']['lists'] = $category_name;
					$this->request->data['Itemlist']['created_on'] = date('Y-m-d H:i:s');
					$this->Itemlist->save($this->request->data);;
				}
				
				echo "1";die;
			}else{				
				echo "0";die;
			}	
			
		}
		
		function pushnot($deviceToken=NULL,$message=NULL,$badge=NULL){
			$this->loadModel('Userdevice');
			$userddett = $this->Userdevice->find('first',array('conditions'=>array('deviceToken'=>$deviceToken)));
			if($userddett['Userdevice']['type'] == 0){
				include_once( WWW_ROOT . 'PushNotification.php' );
				//Selecting the first parameter as live or test cases if you are going to use test means use sandbox.
				if($userddett['Userdevice']['mode'] == 1){
					$certifcUrl =  WWW_ROOT . 'fancyclonepush.pem';
					$push = new PushNotification("sandbox",$certifcUrl);
				}else{
					//$certifcUrl =  WWW_ROOT . 'milymarketpush.pem';
					$certifcUrl =  WWW_ROOT . 'fancyclonepush.pem';
					$push = new PushNotification("production",$certifcUrl);
				}
				$push->setDeviceToken($deviceToken);
				$push->setPassPhrase("");
				$push->setBadge($badge);
				$push->setMessageBody($message);
				$push->sendNotification();
			}else{
				$this->send_push_notification($deviceToken, $message);
			}
		}
		
		function send_push_notification($registatoin_ids, $message) {
		
		
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';
			$registatoin_ids = array($registatoin_ids);
			$message = array("price" => $message);
			$fields = array(
					'registration_ids' => $registatoin_ids,
					'data' => $message,
			);
		
			$headers = array(
					'Authorization: key=AIzaSyBWzx6q4_JYxYE1DTxLsl6VKvRsJPrKE5g',
					'Content-Type: application/json'
			);
			//print_r($headers);
			// Open connection
			$ch = curl_init();
		
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
		
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
			// Execute post
			$result = curl_exec($ch);
			if ($result === FALSE) {
				//die('Curl failed: ' . curl_error($ch));
			}
		
			// Close connection
			curl_close($ch);
			//echo $result;
		}

		
		
		function collections()
		{
				$this->loadModel('Itemfav');
				$this->loadModel('Item');
				$this->loadModel('User');
				$this->layout = "mobilelayout";
				
				

			global $loguser;
			global $siteChanges;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$name = $loguser[0]['User']['username_url'];
			$_SESSION['username_urls'] = $name;
			//$this->loadModel('Comment');

			//$this->set('title_for_layout',$name.' on Anekart');
			//$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
		
			//$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
		
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('setngs',$setngs);
			$usr_datas = $this->User->findByUsernameUrl($name);
			$current_page_userid = $usr_datas['User']['id'];
			$this->set('name',$name);
			$shopdatas = $itematas = $pho_datas = array();
				
				
				
				
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.user_id'=>$usr_datas['User']['id']),'order'=>array('Item.id'=>'desc'),'limit'=>'20'));
				$item_datas_count = $this->Item->find('count',array('conditions'=>array('Item.user_id'=>$usr_datas['User']['id'])));
				$this->set('item_datas',$item_datas);
				$this->set('item_datas_count',$item_datas_count);
				
				$favitemModel = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id']),
						'limit'=>20));
				$favitemCount = $this->Itemfav->find('count',array('conditions'=>array(
						'user_id'=>$usr_datas['User']['id'])));
				$this->set('favitemCount',$favitemCount);
				//echo "<pre>";print_r($favitemModel);die;
				if(!empty($favitemModel)){
					foreach($favitemModel as $itms){
						$itmid[] = $itms['Itemfav']['item_id'];
					}
					$itematas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
					$this->set('itematas',$itematas);
					//echo implode(',', $itmid)."<pre>";print_r($itmid);print_r($itematas);die;
				}
				$this->set('startIndex',20);
				$this->set('userid',$loguser[0]['User']['id']);
		}
		
		function getmorecollections()
		{
				$this->loadModel('Itemfav');
				$this->loadModel('Item');
				$this->loadModel('User');
				
			global $loguser;
			global $siteChanges;
			global $setngs;
			$offset = $_GET['startIndex'];
			$limit = $_GET['offset'];
			$userid = $loguser[0]['User']['id'];
			$name = $loguser[0]['User']['username_url'];
			$_SESSION['username_urls'] = $name;
			//$this->loadModel('Comment');

			//$this->set('title_for_layout',$name.' on Anekart');
			//$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
		
		
			//$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
		
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('setngs',$setngs);
			$usr_datas = $this->User->findByUsernameUrl($name);
			$current_page_userid = $usr_datas['User']['id'];
			$this->set('name',$name);
			
				$favitemModel = $this->Itemfav->find('all',array('conditions'=>array('user_id'=>$usr_datas['User']['id']), 
						'offset'=>$offset, 'limit'=>$limit));
				$itematas = array();
				if (!empty($favitemModel)){
					foreach($favitemModel as $itms){
						$itmid[] = $itms['Itemfav']['item_id'];
					}
					$itematas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itmid)));
				}
				$this->set('itematas', $itematas);	
				$this->set('userid',$loguser[0]['User']['id']);
				
		}
		
		function comments($id)
		{
			
			$this->layout = "mobilelayout";
			$this->loadModel('Comment');
			$this->loadModel('Item');
			global $loguser;
			
			$item_datas = $this->Item->find('all',array('conditions'=>array('Item.id'=>$id,'Item.status <>'=>'draft')));
			$commentss_item = $this->Comment->find('all',array('conditions'=>array('Comment.item_id'=>$id),'order'=>array('Comment.id'=>'desc'),'group'=>array('Comment.id')));
			$this->set('item_datas',$item_datas[0]);
			$this->set('commentss_item',$commentss_item);
			$this->set('userid',$loguser[0]['User']['id']);
		}
				
}
