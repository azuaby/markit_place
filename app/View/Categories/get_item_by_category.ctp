<style>
#exte{
width:175px !important;

}
</style>
<div class="wrapper-content list" style="float:left;width:300px;position:fixed;margin-left: 10px;">
    <div id="content" style="box-shadow:none">
		<div class="search-frm" style="border-top-left-radius: 4px;border-top-right-radius: 4px;height:450px;">
            <div class="search">
			    <div class = "styled selectdiv">
					<select class="shop-select sub-category selectboxdiv" onchange="loadItem()">
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
					<div class="out" ><?php echo __(ucwords($resultCategory));?></div>
				</div>
				<?php 
				//echo "<pre>";print_r($price_val);die;
				foreach ($price_val as $pric){
					$range[-1] = 'Any Price';
					$range[$pric['Price']['from'].'-'.$pric['Price']['to']] = $_SESSION['currency_symbol'] .$pric['Price']['from'].'-'.$pric['Price']['to'];
				
				}
				?>
				<div class = "styled selectdiv">
						
					<select class="shop-select price-range selectboxdiv" onchange="loadItem()">
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
					<div class="out" ><?php echo __($selectData);?></div>
				</div>
						
				<?php 
				//echo "<pre>";print_r($price_val);die;
				foreach ($color_val as $clr){
					//$clrrange[] = 'Any Color';
					$clrrange[$clr['Color']['color_name']] = $clr['Color']['color_name'];
				
				}
				?>
				
				
				<div class = "styled selectdiv">
					<select class="shop-select color-filter selectboxdiv" onchange="loadItem()">
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
					<div class="out" ><?php echo __($selectData);?></div>
                </div>
				<div class = "styled selectdiv" id="">
                    <select class="shop-select sort-by-price selectboxdiv" id="exte" onchange="loadItem()">
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
					<div class="out" ><?php echo __($selectData);?></div>
                </div>
			    <span class="label" style="opacity: 1;margin-left: -428px;margin-top: 114px;">
					<i class="ic-search"></i>
					<em class="hidden"><?php echo __('Search');?></em>
				</span>
				<a class="del-val" href="#" style="opacity: 0;margin-left: -560px;margin-top: 117px;;">
					<i class="ic-del"></i>
					<em class="hidden">Delete</em>
				</a>
				<input class="search-string" type="text" value="<?php echo $q; ?>" placeholder="<?php echo __('Filter by keyword'); ?>" style="width:111px; padding:5px 16px 0px 30px; ">
			</div>
		</div>
	</div>
</div>
<div class="wrapper-content list shopcont">
		<?php
	if($managemoduleModel['Managemodule']['display_banner']=="yes")
	{					
		if($banner_datas['Banner']['status']=='Active')
		{					
			echo '<div>';
			echo $banner_datas['Banner']['html_source'];
			echo '</div>';
		}
	}
		?>	
    <ul class="breadcrumbs">
	    <li><a href="<?php echo SITE_URL; ?>shop/browse" class="shop-home"><?php echo __('Shop'); ?></a></li>
    <?php	
	    $bread = "shop/browse";
	    if ($prev['1'] != 'browse') {
		    for ($j=1;$j<count($prev);$j++) { 
		    $last = $prev[$j];
		    $bread = "shop";
		    for ($i=1;$i<=$j;$i++) {
			    $bread = $bread."/".$prev[$i];
			
		    }
	    ?>
	
        <li class='last'>/ <a href=" <?php echo SITE_URL.$bread?>" ><?php echo ucwords($last); ?> </a></li>
	
	    <?php } }?>
    </ul>
	<div class="sns-right">
                
	</div>
	<div class="itemLoader" style="display:none;">
		<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading....">
	</div>
	<ol class="stream">
        <?php
                 if(!empty($item)){
                
 foreach ($item as $itms) { 
        	$itm_id = $itms['Item']['id'];
			$item_title_url = $itms['Item']['item_title_url'];
			$item_title = $itms['Item']['item_title'];
			$image_name = $itms['Photo'][0]['image_name'];
			$price = $itms['Item']['price'];
			$user_id = $itms['Item']['user_id'];
			$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
			
			$item_title = UrlfriendlyComponent::limit_char($item_title,12);
	
			if(isset($itms['Photo'][0])){
				$image_name = $itms['Photo'][0]['image_name'];
			}
			
			$username_url = $itms['User']['profile_image'];
			if($username_url == ''){
				$username_url = 'usrimg.jpg';
			}
			$username = $itms['User']['username'];
			
			$username_url_ori = $itms['User']['username_url'];
			$favorte_count = $itms['Item']['fav_count'];
        
			echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'">';
			
			echo  '<div class="figure-product-new mini">';
			echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
			//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
			
			echo "<figure>";
			echo '<span class="back"></span>';
			$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
			echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
			//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
			echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='display:none;' >";
			echo "</figure>";
			echo  '</a>';
			echo  '<em class="figure-detail">';
			echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
			<img style='width: 35px; height: 35px; position: relative; top: 10px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
			<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 28px; left: 42px;'>$username + $favorte_count</i>
			</a>";
			echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="position: relative; top: 10px; left: 7px;" >'.$item_title.'</span>';
			echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="position: relative; top: 10px; left: 7px;"><b> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
			//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
			echo  '</em>';
			
			echo '<ul class="function">';
			echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
			echo '</ul>';
			
			foreach($itms['Itemfav'] as $useritemfav){
				if($useritemfav['user_id'] == $userid ){
					$usecoun[] = $useritemfav['item_id'];
				}
			}
//						if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
//						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//						}else{
//						echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//						}
			
            if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
			echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
			echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
			}else{
			echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
            echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
            echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
            echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
            echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
			echo  '<a class="button fantacy" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
			}
			
			echo  '</div>';
			echo  '</li>';
	 }
	 }
	 else{
	 echo '<div style="height:200px">';
	 echo '<center style="font-size:23px;margin-top:100px;">No items found</center>';
	echo '<center style="font-size:14px;"> Search something related</li> </center> ';
     echo '</div>';
	 } 


?>
	</ol>
    <input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
    <input type="hidden" value="<?php echo $bread; ?>" id="currentCatPath">

    <div id="infscr-loading" style="display:none;text-align:center;">
		<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
	</div>
</div>




<!--					<?php
				if($managemoduleModel['Managemodule']['display_banner']=="yes")
				{					
					if($banner_datas['Banner']['status']=='Active')
					{					
						echo '<div>';
						echo $banner_datas['Banner']['html_source'];
						echo '</div>';
					}
				}
					?>	
			<ul class="breadcrumbs">
				<li><a href="<?php echo SITE_URL; ?>shop/browse" class="shop-home"><?php echo __('Shop'); ?></a></li>
		<?php	
				$bread = "shop/browse";
				if ($prev['1'] != 'browse') {
					for ($j=1;$j<count($prev);$j++) { 
					$last = $prev[$j];
					$bread = "shop";
					for ($i=1;$i<=$j;$i++) {
						$bread = $bread."/".$prev[$i];
						
					}
				?>
				
                <li class='last'>/ <a href=" <?php echo SITE_URL.$bread?>" ><?php echo ucwords($last); ?> </a></li>
				
				<?php } }?>
			</ul>
			<div class="sns-right">
                
			</div>
			<div id="content" style="box-shadow:none">
				<div class="search-frm">
					<div class="search">
						<div class = "styled selectdiv">
						<select class="shop-select sub-category selectboxdiv" onchange="loadItem()">
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
							<div class="out" ><?php echo __(ucwords($resultCategory));?></div>
						</div>
						<?php 
						//echo "<pre>";print_r($price_val);die;
						foreach ($price_val as $pric){
							$range[-1] = 'Any Price';
							$range[$pric['Price']['from'].'-'.$pric['Price']['to']] = $_SESSION['currency_symbol'] .$pric['Price']['from'].'-'.$pric['Price']['to'];
						
						}
						?>
						<div class = "styled selectdiv">
						
						<select class="shop-select price-range selectboxdiv" onchange="loadItem()">
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
							<div class="out" ><?php echo __($selectData);?></div>
						</div>
						
						<?php 
						//echo "<pre>";print_r($price_val);die;
						foreach ($color_val as $clr){
							//$clrrange[] = 'Any Color';
							$clrrange[$clr['Color']['color_name']] = $clr['Color']['color_name'];
						
						}
						?>
						
						
						<div class = "styled selectdiv">
						<select class="shop-select color-filter selectboxdiv" onchange="loadItem()">
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
							<div class="out" ><?php echo __($selectData);?></div>
                        </div>
						<div class = "styled selectdiv" id="exte">
                        <select class="shop-select sort-by-price selectboxdiv" id="exte" onchange="loadItem()">
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
<!--                        </select>
							<div class="out" ><?php echo __($selectData);?></div>
                        </div>
						   <span class="label" style="opacity: 1;margin-left:136px;">
						<i class="ic-search"></i>
						<em class="hidden"><?php echo __('Search');?></em>
						</span>
						<a class="del-val" href="#" style="opacity: 0;margin-left:140px;">
						<i class="ic-del"></i>
						<em class="hidden">Delete</em>
						</a>
						<input class="search-string" type="text" value="<?php echo $q; ?>" placeholder="<?php echo __('Filter by keyword'); ?>" style="width:110px;">
					</div>
				</div>
				<div class="itemLoader" style="display:none;">
					<img src="<?php echo SITE_URL; ?>images/loading.gif" alt="Loading....">
				</div>
				<ol class="stream">
                    <?php
                             if(!empty($item)){
                            
			 foreach ($item as $itms) { 
                    	$itm_id = $itms['Item']['id'];
						$item_title_url = $itms['Item']['item_title_url'];
						$item_title = $itms['Item']['item_title'];
						$image_name = $itms['Photo'][0]['image_name'];
						$price = $itms['Item']['price'];
						$user_id = $itms['Item']['user_id'];
						$item_price = round($itms['Item']['price'] * $_SESSION['currency_value'], 2);
						
						$item_title = UrlfriendlyComponent::limit_char($item_title,12);
				
						if(isset($itms['Photo'][0])){
							$image_name = $itms['Photo'][0]['image_name'];
						}
						
						$username_url = $itms['User']['profile_image'];
						if($username_url == ''){
							$username_url = 'usrimg.jpg';
						}
						$username = $itms['User']['username'];
						
						$username_url_ori = $itms['User']['username_url'];
						$favorte_count = $itms['Item']['fav_count'];
                    
						echo  '<li imgid="'.$image_name.'" auserid="'.$user_id.'">';
						
						echo  '<div class="figure-product-new mini">';
						echo  "<a href='".SITE_URL."listing/".$itm_id."/".$item_title_url."' alt='".$item_title."'  class='figure-img' id='img_id".$itms['Item']['id']."'>";
						//echo  "<span class='figure' style='background-size:cover' data-ori-url='".$_SESSION['media_url']."media/items/original/".$image_name."' data-310-url='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' ></span>";
						
						echo "<figure>";
						echo '<span class="back"></span>';
						$img = $_SESSION['media_url']."media/items/thumb350/".$image_name;
						echo '<span class="figure" style="background: url(\''.$img.'\'); background-repeat: no-repeat;background-position: 50% 50%;background-size: cover; float: left; width: 207px; height: 207px;"></span>';
						//echo  "<img src='".$_SESSION['media_url']."media/items/thumb350/".$image_name."' >";
						echo  "<img src='".$_SESSION['media_url']."media/items/original/".$image_name."' style='display:none;' >";
						echo "</figure>";
						echo  '</a>';
						echo  '<em class="figure-detail">';
						echo  "<a href='".SITE_URL."people/".$username_url_ori."' class='userv vcard'>
						<img style='width: 35px; height: 35px; position: relative; top: 10px;' src='".$_SESSION['media_url']."media/avatars/thumb70/".$username_url."' style='".$roundProf."'>
						<i class='arrow-sml' style='color: rgb(138, 143, 156); margin-top: 28px; left: 42px;'>$username + $favorte_count</i>
						</a>";
						echo  '<span class="figcaption" id="figcaption_titles'.$itms['Item']['id'].'" figcaption_title ="'.$item_title.'" style="position: relative; top: 10px; left: 7px;" >'.$item_title.'</span>';
						echo  '<span class="price" id="price_vals'.$itms['Item']['id'].'" price_val="'.$item_price.'" style="position: relative; top: 10px; left: 7px;"><b> '.$_SESSION['currency_symbol'].$item_price.' </b> </span>';
						//echo  '<span class="username"><em><i> &nbsp; by &nbsp;  </i><a href="'.SITE_URL."people/".$username_url_ori.'"  id="user_n'.$itms['Item']['id'].'" usernameval ="'.$username.'">'.$username.'</a>  + <span class="fav_count" id="fav_count'.$itms['Item']['id'].'" fav_counts ="'.$favorte_count.'" >'.$favorte_count.'</em></span>';
						echo  '</em>';
						
						echo '<ul class="function">';
						echo '<li class="share" ><a href="#" id="btn_share"  onclick = "share_post('.$itm_id.');"  class="btn-share"  ><span class="shareimg"></span></a></li>';
						echo '</ul>';
						
						foreach($itms['Itemfav'] as $useritemfav){
							if($useritemfav['user_id'] == $userid ){
								$usecoun[] = $useritemfav['item_id'];
							}
						}
//						if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
//						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"  ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['liked_btn_cmnt'].'</div></a>';
//						}else{
//						echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" ><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span><div class="itemdd'.$itms['Item']['id'].'">'.$setngs[0]['Sitesetting']['like_btn_cmnt'].'</div></a>';
//						}
						
                        if(isset($itms['Itemfav'][0]['user_id']) &&  in_array($itm_id,$usecoun)){
						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
		                echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
	                    echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
                        echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                        echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
						echo  '<a class="button fantacyd edit" iteid="'.$itms['Item']['id'].'" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'" ><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 4px;margin-top:6px;"></span></a>';
						}else{
						echo  '<a class="button fantacy" onclick = "itemcou('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: -65px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
		                echo $this->Form->create('cart', array('url' => array('controller' => '/', 'action' => '/pays'), 'onsubmit' => 'return validateaddcart();'));
	                    echo '<input type="hidden" value="'.$itms['Item']['id'].'" name="listing_id">';
                        echo '<input type="hidden" value="1" name="quantity" id="qty_opt">';
                        echo '<button type="submit" class="button fantacyd edit" style="margin-left: -25px;background-color: rgba(255, 255, 255, 0);"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin-left: 5px;margin-top:6px;"></button></form>';
						echo  '<a class="button fantacy" onclick = "share_post('.$itms['Item']['id'].');"  id="dd'.$itms['Item']['id'].'" style="margin-left: 15px;"><span id="spandd'.$itms['Item']['id'].'"><img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_likebtn_logo'].'" style="height: 32px; width: 32px; margin: 6px;"></span></a>';
						}
						
						echo  '</div>';
						echo  '</li>';
				 }
				 }
				 else{
				 echo '<div style="height:200px">';
				 echo '<center style="font-size:23px;margin-top:100px;">No items found</center>';
				echo '<center style="font-size:14px;"> Search something related</li> </center> ';
                 echo '</div>';
				 } 


?>
				</ol>
                <input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
                <input type="hidden" value="<?php echo $bread; ?>" id="currentCatPath">
                
                <div id="infscr-loading" style="display:none;text-align:center;">
					<img alt='Loading...' src="<?php echo SITE_URL; ?>img/loading.gif">
				</div>
			</div>
