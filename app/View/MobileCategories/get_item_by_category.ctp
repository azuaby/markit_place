<div class="ui-select">
<div class="ui-body ui-body-a">
			<table width="100%"><thead><tr><th></th><th></th></tr></thead><tbody><tr><td>
				<a data-ajax="false" href="<?php echo SITE_URL; ?>mobile/shop/browse" class="shop-home" style="text-decoration:none;font-size:15px;color:#373D48;"><?php echo __('Shop'); ?></a>
					<?php	
				$bread = "mobile/shop/browse";
				if ($prev['1'] != 'browse') {
					for ($j=1;$j<count($prev);$j++) { 
					$last = $prev[$j];
					$bread = "mobile/shop";
					for ($i=1;$i<=$j;$i++) {
						$bread = $bread."/".$prev[$i];
						
					}
				?>
				
                <span class='last'>/ <a data-ajax="false" href=" <?php echo SITE_URL.$bread?>" style="text-decoration:none;font-size:15px;color:#373D48;"><?php echo ucwords($last); ?> </a></span>
				
				<?php } }?>
				</td><td align='right'>
    <div align="right"><a href="#myPopup1" data-rel="popup" data-position-to="window" class="ui-btn ui-btn-inline ui-corner-all">Filterlist</a></div>
    </td></tr></tbody></table>
		
	</div><br />
		<div>	
			<div class="sns-right">
                
			</div>
			
			

		<div id="content" style="margin-top:-20px;">
		
		<div class="search-frm">
					<div class="search">
					<div data-role="popup" id="myPopup1" class="ui-content">
					 <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
						<div class = "styled selectdiv"> Category :
						<select id="sub-category1" class="shop-select sub-category selectboxdiv">
					<?php
						if ($categoryData != null) {
						$categoryName = $categoryData['Category']['category_urlname'];
					?>
							<option value=""><?php echo ucwords($resultCategory); ?></option>
					<?php	if ($categoryName != $resultCategory) {
								$categoryName = $categoryName."/".$resultCategory;
							}
							foreach ($subCategory as $scat) { 
							$subCategoryUrl = $scat['Category']['category_urlname'];
							$subCategory = $scat['Category']['category_name'];
							if ($resultCategory != $subCategoryUrl)
							echo '<option value="shop/'.$categoryName.'/'.$subCategoryUrl.'">&nbsp;&nbsp;'.$subCategory.'</option>';
						} }else {
							echo '<option value="">'; echo __('Any Category'); echo '</option>';
							foreach ($subCategory as $scat) { 
							$subCategoryUrl = $scat['Category']['category_urlname'];
							echo '<option value="shop/'.$subCategoryUrl.'">&nbsp;&nbsp;'.ucwords($subCategoryUrl).'</option>';
							}
						}?>
						</select>
							<div class="out" style="display:none;"><?php echo __(ucwords($resultCategory));?></div>
						</div>
						<?php 
						//echo "<pre>";print_r($price_val);die;
						foreach ($price_val as $pric){
							$range[-1] = 'Any Price';
							$range[$pric['Price']['from'].'-'.$pric['Price']['to']] = $_SESSION['currency_symbol'] .$pric['Price']['from'].'-'.$pric['Price']['to'];
						
						}
						?>
						<div class = "styled selectdiv">
						Price : 
						<select id="price-range1" class="shop-select price-range selectboxdiv">
						<?php
						
						
							//$priceList = array('-1'=>'Any Price',$range);
							foreach ($range as $key => $value) {
								if ($price == $key) {
									echo '<option value="'.$key.'" selected >';echo __($value);echo '</option>';
									$selectData = $value;
								} else {
									echo '<option value="'.$key.'" >';echo __($value);echo '</option>';
								}
							} ?>
						</select>
							<div class="out" style="display:none;"><?php echo __($selectData);?></div>
						</div>
						
						<?php 
						//echo "<pre>";print_r($price_val);die;
						foreach ($color_val as $clr){
							//$clrrange[] = 'Any Color';
							$clrrange[$clr['Color']['color_name']] = $clr['Color']['color_name'];
						
						}
						?>
						
						
						<div class = "styled selectdiv">
						Color : 
						<select id="color-filter1" class="shop-select color-filter selectboxdiv">
						<?php
							//$colorList = array(''=>'Any Color','red'=>'Red','pink'=>'Pink','purple'=>'Purple','blue'=>'Blue','skyblue'=>'Skyblue','green'=>'Green','yellow'=>'Yellow','orange'=>'Orange','brown'=>'Brown','black'=>'Black','white'=>'White','silver'=>'Siver','gold'=>'Gold',);
							echo '<option value="" >';echo __('Any Color');echo '</option>';
							$selectData = 'Any Color';
							foreach ($clrrange as $key => $value) {
								if ($color == $key) {
									echo '<option value="'.$key.'" selected >';echo __($value);echo '</option>';
									$selectData = $value;
								} else {
									echo '<option value="'.$key.'" >';echo __($value);echo '</option>';
								}
							} ?>
                        </select>
							<div class="out" style="display:none;"><?php echo __($selectData);?></div>
                        </div>
						<div class = "styled selectdiv">
						Newest : 
                        <select id="sort-by-price1" class="shop-select sort-by-price selectboxdiv">
                        <?php
							$priceSort = array(''=>'Newest',
												'asc'=>'Price: Low to High',
												'desc'=>'Price: High to Low',);
							foreach ($priceSort as $key => $value) {
								if ($sortPrice == $key) {
									echo '<option value="'.$key.'" selected >';echo __($value);echo '</option>';
									$selectData = $value;
								} else {
									echo '<option value="'.$key.'" >';echo __($value);echo '</option>';
								}
						} ?>
                            <!--<option value="">Newest</option>
                            <option value="asc">Price: Low to High</option>
                            <option value="desc">Price: High to Low</option>-->
                        </select>
							<div class="out" style="display:none;"><?php echo __($selectData);?></div>
							
							<button onclick="updatelist1()">Update</button>
						</div> <!--- Popup ---->
							
                        </div>

					</div>
				</div>
	<div class="itemLoader" style="display:none;">
					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading....">
				</div>
		
		
			<ol class="stream" style="margin-left:-40px;"><?php
		  
		  /* 	if(!empty($items_data)){
			foreach($items_data as $key=>$itms){
			
			if(@isset($user_idss[$itms['Item']['user_id']])){
				$user_idss[$itms['Item']['user_id']] = $user_idss[$itms['Item']['user_id']]+1;
			}else{
				$user_idss[$itms['Item']['user_id']] = 1;
			}
			
			
			}
			//print_r($items_data);die;
			}
		   */
			//echo "<pre>";print_r($items_data);die;
		  
		if(!empty($item)){
			
			foreach($item as $key=>$itms){
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
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'" >
    <img id="im'.$itms['Item']['id'].'" src="'.SITE_URL.'images/logo/fantacyd.png" style="margin: -1px;margin-left:-8px;"></span> 
    <span style="margin-left:2px;top:-2px;position:relative;color:#188EE6;" class="itemdd'.$itms['Item']['id'].'" id="faval'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</span>
    <input type="hidden" value="'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'">
    </span></a>';
				}else{
				echo  '<a class="button fantacy" style="cursor:default;background-color:#FFFFFF;font-size: 15px;
    padding: .45em 10px .4em;" onclick = "itemcou1('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" >
    <!--div id="itemff'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/menu/fantacybtn.png"></div-->
    <span class="ui-body ui-body-a" style="width:82px;;margin-top:3px;border-radius:5px;height:15.5px;"><span id="spandd'.$itms['Item']['id'].'">
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
			}
		?>

		</ol>
			
			                <input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
                <input type="hidden" value="<?php echo $bread; ?>" id="currentCatPath">
			<div id="infscr-loading" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			
				<div id="index-loading" style="display:none;line-height:34;text-align:center;min-height:600px;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>images/loading.gif">
					<!--span class="loading">Loading...</span-->
				</div>

		</div>
		<!-- / content 

		<a href="#header" id="scroll-to-top"><span>Jump to top</span></a>
-->
	</div>
	<!-- / container -->
</div>




