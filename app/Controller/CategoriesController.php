<?php
	App::uses('AppController', 'Controller');
	
	class CategoriesController extends AppController{
		public $names =  'Categories';
		public $uses = array('Category');
		public $components = array('Email','Auth','Session','Cookie','Urlfriendly','RequestHandler');
		public $helpers = array('Form','Html');
		// public $layout = 'admin';
		
		function view_category(){
			$this->layout = 'admin';
			global $loguser;
			if(!$this->isauthorizedpersn())
				$this->redirect('/');
				
			$this->set('title_for_layout','Category Management');
			
			$main_catdata = $this->Category->find('all');
			//$super_sub_catdata = $this->Category->find('all',array('conditions'=>array('category_parent <>'=>0)));
			// $sub_sub_catdata = $this->Category->find('all',array('conditions'=>array('category_parent <>'=>0,'category_sub_parent <>'=>0)));
			$this->paginate = array('conditions'=>array('Category.category_name <>'=>''),'limit'=>10,'order'=>array('Category.id'=>'desc'));
			$super_sub_catdata = $this->paginate('Category');
			$pagecount = $this->params['paging']['Category']['count'];
			
			$this->set('main_catdata',$main_catdata);
			$this->set('super_sub_catdata',$super_sub_catdata);
			$this->set('pagecount',$pagecount);
			// $this->set('sub_sub_catdata',$sub_sub_catdata);
			
			// echo "<pre>";print_r($sub_sub_catdata);die;
		}
		
		function show_categories () {
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0)));
			$allCategory = $this->Category->find('all',array('conditions'=>array('category_parent !='=>0),'order'=>'category_parent'));
			//echo "<pre>";print_r($allCategory);die;
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('allCategory',$allCategory);
			$this->set('userid',$userid);
		}
		
		function delete_category_admin($catId = null) {
			$this->autoLayout = false;
			$this->autoRender = false;
			
			$this->loadModel('Category');
			$this->loadModel('Item');
			$item_cat_data = $this->Item->find('all',array('conditions'=>array('category_id'=>$catId)));
			$item_supcat_data = $this->Item->find('all',array('conditions'=>array('super_catid'=>$catId)));
			$item_subcat_data = $this->Item->find('all',array('conditions'=>array('sub_catid'=>$catId)));
			/* if($catId != null) {
				$this->Category->delete($catId);
			} */
			
			if(empty($item_cat_data) && empty($item_supcat_data) && empty($item_subcat_data)){
			    $this->Category->deleteAll(array('Category.id' => $catId), false);
			}
			//$prefix = $this->Category->tablePrefix;
			//echo "delete from ".$prefix."categories where id=".$catId." ";die;
			// $this->User->delete($id);
			//echo "delete from ".$prefix."users where id=".$id." ";die;
			//$this->Category->query("delete from ".$prefix."categories where id=".$catId." ");
			//die;
			
		}
		
		function show_color ($color = 'BLACK',$loadMore = 0) {
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'frontlayout';
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$itemByColor = $this->Item->find('all',array('conditions'=>array('Item.item_color like'=>'%'.$color.'%','status <>'=>'draft'),'order'=>array('Item.id'=>'desc'),'limit'=>'20'));
			}
			else {
				$itemByColor = $this->Item->find('all',array('conditions'=>array('Item.item_color like'=>'%'.$color.'%','status'=>'publish'),'order'=>array('Item.id'=>'desc'),'limit'=>'20'));
			}
			
			
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			
			$this->set('itemByColor',$itemByColor);
			$this->set('loadMore',$loadMore);
			$this->set('color',$color);
			$this->set('userid',$userid);
			$this->set('prc',0);
		}
		
		function show_price ($price = '1-20') {
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'frontlayout';
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			
			//if ($price != 500) {
				$prices = explode('-', $price);
				$prices1=$prices[0] / $_SESSION['currency_value'];
				$prices2=$prices[1] / $_SESSION['currency_value'];

				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$itemByPrice = $this->Item->find('all',array('conditions'=>array('and' => array(
										                        array('Item.price >= ' => $prices1,
										                              'Item.price <= ' => $prices2)),'status <>'=>'draft'),'order'=>array('Item.id'=>'desc'),'limit'=>'20'));
				}
				else {
					$itemByPrice = $this->Item->find('all',array('conditions'=>array('and' => array(
										                        array('Item.price >= ' => $prices1,
										                              'Item.price <= ' => $prices2)),'status'=>'publish'),'order'=>array('Item.id'=>'desc'),'limit'=>'20'));
				}
			
			
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('itemByColor',$itemByPrice);
			$this->set('color',$price);
			$this->set('prc',1);
			$this->set('loadMore',0);
			$this->set('userid',$userid);
			$this->render('show_color');
		}
		
		public function getmorepricecolor (){
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'ajax';
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$this->loadModel('Category');
			
			$color = $_POST['color'];
			$price = $_POST['price'];
			$offset = $_GET['startIndex'];
			$limit = $_GET['offset'];
			
			if ($color == ''){
				$prices = explode('-', $price);
				$prices1=$prices[0] / $_SESSION['currency_value'];
				$prices2=$prices[1] / $_SESSION['currency_value'];
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$itemByPrice = $this->Item->find('all',array('conditions'=>array('and' => array(
						array('Item.price >= ' => $prices1,
								'Item.price <= ' => $prices2)),'status <>'=>'draft'),'order'=>array('Item.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
				}
				else {
					$itemByPrice = $this->Item->find('all',array('conditions'=>array('and' => array(
						array('Item.price >= ' => $prices1,
								'Item.price <= ' => $prices2)),'status'=>'publish'),'order'=>array('Item.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
				}
				
				$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
				$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				$this->set('color',$_SESSION['currency_symbol'].$price);
				$this->set('loadMore',0);
				$this->set('itemByColor',$itemByPrice);
			}else{
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$itemByColor = $this->Item->find('all',array('conditions'=>array('Item.item_color like'=>'%'.$color.'%','status <>'=>'draft'),'order'=>array('Item.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
				}
				else {
					$itemByColor = $this->Item->find('all',array('conditions'=>array('Item.item_color like'=>'%'.$color.'%','status'=>'publish'),'order'=>array('Item.id'=>'desc'),'offset'=>$offset,'limit'=>$limit));
				}
					
					
				$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
				$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
				$this->set('color',$color);
				$this->set('loadMore',1);
				$this->set('itemByColor',$itemByColor);
			}
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('userid',$userid);
		}
		
		public function showByCategory ($category, $subCat = null ) {

			if ($this->RequestHandler->isMobile()) {
				$this->layout = "mobilelayout";
			        $this->redirect('/mobile/shop/browse');
			}
		
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'frontlayout';
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$this->loadModel('Color');
			$this->loadModel('Price');
			global $setngs;
			
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'shop')));
			$this->set('banner_datas',$banner_datas);				
			
			if ($category == 'browse') {
				$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
				
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$itemByCategory = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
				}
				else {
					$itemByCategory = $this->Item->find('all',array('conditions'=>array('status '=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
				}
				$categoryData = null;
				$categoryId = 0;
			}else {
				$categoryData = $this->Category->findByCategory_urlname($category); 
				$categoryId = $categoryData['Category']['id'];
				if ($subCat == null) {
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>'0')));
					
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id' => $categoryId,'status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
				}
				else {
					$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id' => $categoryId,'status'=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
				}
					$this->set('subCatName',null);
				}else {
					$subCatBread = $this->Category->findByCategory_urlname($subCat);
					$categoryId = $categoryId."-".$subCatBread['Category']['id'];
					$subCatData = $this->Category->findByCategory_urlname($subCat);
					$subCatId = $subCatData['Category']['id'];
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>$subCatId)));
					if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id'=>$categoryId,'super_catid'=>$subCatId,'status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
					}
					else {
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id'=>$categoryId,'super_catid'=>$subCatId,'status'=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
					}

					$this->set('subCatName',$subCat);
				}
			}
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			
			$price_val = $this->Price->find('all');
			$color_val = $this->Color->find('all');
				
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('item',$itemByCategory);
			$this->set('subCategory',$subCategory);
			$this->set('categoryData',$categoryData);
			$this->set('categoryId',$categoryId);
			$this->set('userid',$userid);
			$this->set('color_val',$color_val);
			$this->set('price_val',$price_val);
			$this->set('setngs',$setngs);
		}
		
		
		
		
		public function showByRelation ($category, $subCat = null ) {
		
			if ($this->RequestHandler->isMobile()) {
		   		$this->layout = "mobilelayout";
	       			$this->redirect('/mobile/recomendations/browse');
			}
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'frontlayout';
			$this->loadModel('Item');
			$this->loadModel('Recipients');
			$this->loadModel('Itemlist');
			$this->loadModel('Color');
			$this->loadModel('Price');
				
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'shop')));
			$this->set('banner_datas',$banner_datas);						
				
			if ($category == 'browse') {
				$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$itemByCategory = $this->Item->find('all',array('conditions'=>array('status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
				}
				else {
					$itemByCategory = $this->Item->find('all',array('conditions'=>array('status'=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
				}
				$categoryData = null;
				$categoryId = 0;
			}else {
				$categoryData = $this->Category->findByCategory_urlname($category);
				$categoryId = $categoryData['Category']['id'];
				if ($subCat == null) {
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>'0')));
					if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id' => $categoryId,'status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
					}
					else {
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id' => $categoryId,'status'=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
					}
					$this->set('subCatName',null);
				}else {
					$subCatBread = $this->Category->findByCategory_urlname($subCat);
					$categoryId = $categoryId."-".$subCatBread['Category']['id'];
					$subCatData = $this->Category->findByCategory_urlname($subCat);
					$subCatId = $subCatData['Category']['id'];
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$categoryId,'category_sub_parent'=>$subCatId)));
					if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id'=>$categoryId,'super_catid'=>$subCatId,'status <>'=>'draft'),'order'=>'Item.id DESC','limit'=>'20'));
					}
					else {
						$itemByCategory = $this->Item->find('all',array('conditions'=>array('category_id'=>$categoryId,'super_catid'=>$subCatId,'status'=>'publish'),'order'=>'Item.id DESC','limit'=>'20'));
					}
					$this->set('subCatName',$subCat);
				}
			}
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
				
			
			$price_val = $this->Price->find('all');
			$color_val = $this->Color->find('all');
			
			$recipients = $this->Recipients->find('all');
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('item',$itemByCategory);
			$this->set('subCategory',$subCategory);
			$this->set('categoryData',$categoryData);
			$this->set('categoryId',$categoryId);
			$this->set('relationList',$recipients);
			$this->set('userid',$userid);
			$this->set('color_val',$color_val);
			$this->set('price_val',$price_val);
		}
		
		public function getItemByRelation () {
		
			if ($this->RequestHandler->isMobile()) {
			   	//$this->layout = "mobilelayout";
		       		$this->redirect('/mobile/recomendations/browse');
			}
		
			global $loguser;
			global $setngs;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'ajax';
			$this->loadModel('Item');
			$this->loadModel('Recipients');
			$this->loadModel('Itemlist');
			$this->loadModel('Color');
			$this->loadModel('Price');
			
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'shop')));
			$this->set('banner_datas',$banner_datas);				
				
			$category = $_POST['category'];
			$category = explode('/', $category);
			$count = count($category);
			$resultCategory = $category[$count-1];
			//$resultCategoryId = $this->Category->findBycategory_urlname(lcfirst($resultCategory));
			//$resultCategoryId = $resultCategoryId['Category']['id'];
			$prefix = $this->Item->tablePrefix;
			$prevCat = explode('-',$_POST['catids']);
			$categoryId = '';
			
			$startIndex = 0;
			$offset = 20;
			if (isset($_GET['startIndex'])){
				$startIndex = $_GET['startIndex'];
			}
				
			if ($prevCat[0] == 0 && $category['1'] != 'browse') {
				$newCategory = $this->Category->findBycategory_urlname($category['1']);
				$prevCat[0] = $newCategory['Category']['id'];
			}
				
			for ($i=1;$i<$count;$i++) {
				$resultCategoryId = $this->Category->findBycategory_urlname($category[$i]);
				$resultCategoryId = $resultCategoryId['Category']['id'];
				if ($categoryId == '') {
					$categoryId = $resultCategoryId;
				}else {
					$categoryId = $categoryId."-".$resultCategoryId;
				}
			}
				
			if ($category['1'] == 'browse') {
				$count = 1;
			}
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$status = " AND status!='draft' ";
			}
			else {
				$status = " AND status='publish' ";
			}
			$orderby = ' ORDER BY id DESC ';
				
			//echo $count;echo "<pre>";print_r($category);
			switch($count) {
				case 1:
					$query = "SELECT * FROM ".$prefix."items WHERE 1 ";
					
					$query .= $status;
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						//$query = $query." AND price >= ".$price[0];
						//$query = $query." AND price <= ".$price[1];
						$query = $query." AND price >= ".$price1;
						$query = $query." AND price <= ".$price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['gender'] != '') {
						$query = $query." AND occasion = ".$_POST['gender'];
					}
					if ($_POST['relation'] != '') {
						$query = $query.' AND recipient REGEXP \'("\[.*"'.$_POST['relation'].'".*\]")\'';
					} 
					$query .= $orderby;
					$query .= 'limit '.$startIndex.','.$offset;
					$item = $this->Item->query($query);
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
					break;
				case 2:
					$query = "SELECT * FROM ".$prefix."items WHERE category_id = $resultCategoryId";
					
					$query .= $status;
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						//$query = $query." AND price >= ".$price[0];
						//$query = $query." AND price <= ".$price[1];
						$query = $query." AND price >= ".$price1;
						$query = $query." AND price <= ".$price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['gender'] != '') {
						$query = $query." AND occasion = ".$_POST['gender'];
					}
					if ($_POST['relation'] != '') {
						$query = $query.' AND recipient REGEXP \'("\[.*"'.$_POST['relation'].'".*\]")\'';
					}
					$query .= $orderby;
					$query .= 'limit '.$startIndex.','.$offset;
					$item = $this->Item->query($query);
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>0)));
					break;
				case 3:
					$query = "SELECT * FROM ".$prefix."items WHERE category_id = $prevCat[0] AND super_catid = ".$resultCategoryId;
					
					$query .= $status;
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						//$query = $query." AND price >= ".$price[0];
						//$query = $query." AND price <= ".$price[1];
						$query = $query." AND price >= ".$price1;
						$query = $query." AND price <= ".$price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['gender'] != '') {
						$query = $query." AND occasion = ".$_POST['gender'];
					}
					if ($_POST['relation'] != '') {
						$query = $query.' AND recipient REGEXP \'("\[.*"'.$_POST['relation'].'".*\]")\'';
					}
					$query .= $orderby;
					$query .= 'limit '.$startIndex.','.$offset;
					$item = $this->Item->query($query);
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>$resultCategoryId)));
					break;
				case 4:
					$query = "SELECT * FROM ".$prefix."items WHERE category_id = $prevCat[0] AND
					super_catid = ".$prevCat[1]." AND sub_catid =".$resultCategoryId;
					$query .= $status;
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						//$query = $query." AND price >= ".$price[0];
						//$query = $query." AND price <= ".$price[1];
						$query = $query." AND price >= ".$price1;
						$query = $query." AND price <= ".$price2;
					}elseif($_POST['price'] == '501') {
					$query = $query." AND price >=  501";
					}
					if ($_POST['gender'] != '') {
						$query = $query." AND occasion = ".$_POST['gender'];
					}
					if ($_POST['relation'] != '') {
						$query = $query.' AND recipient REGEXP \'("\[.*"'.$_POST['relation'].'".*\]")\'';
					}
					$query .= $orderby;
					$query .= 'limit '.$startIndex.','.$offset;
					$item = $this->Item->query($query);
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>$prevCat[1])));
							break;
			}
								
			if (count($item)>0) {
				$prefix = $this->Item->tablePrefix;
				foreach ($item as $value) {
					$itemId[] = $value[$prefix.'items']['id'];
				}
				if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
					$item = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemId,'status <>'=>'draft'),'order'=>"Item.price DESC"));
				}
				else {
					$item = $this->Item->find('all',array('conditions'=>array('Item.id'=>$itemId,'status'=>'publish'),'order'=>"Item.price DESC"));
				}
			}
				$categoryData = null;
				if ($category['1'] != 'browse') {
					$categoryData = $this->Category->findByCategory_urlname($category[1]);
			}
			$recipients = $this->Recipients->find('all');
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			
			
			$price_val = $this->Price->find('all');
			$color_val = $this->Color->find('all');
			
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('item',$item);
			$this->set('userid',$userid);
			$this->set('subCategory',$subCategory);
			$this->set('categoryData',$categoryData);
			$this->set('categoryId',$categoryId);
			$this->set('prev',$category);
			$this->set('resultCategory',$resultCategory);
			$this->set('price',$_POST['price']);
			$this->set('relation',$_POST['relation']);
			$this->set('relationList',$recipients);
			$this->set('gender',$_POST['gender']);
			$this->set('color_val',$color_val);
			$this->set('price_val',$price_val);
				
			if (isset($_GET['startIndex'])){
				$this->render('categoryloadmore');
			}
						//echo $query;die;
		//echo "<pre>";print_r($item);die;
		}
		
		public function getItemByCategory () {
		
		
			if ($this->RequestHandler->isMobile()) {
          	 		//$this->layout = "mobilelayout";
      				$this->redirect('/mobile/shop/browse');
			}
			global $setngs;
			global $loguser;
			$userid = $loguser[0]['User']['id'];
			$this->layout = 'ajax';
			$this->loadModel('Item');
			$this->loadModel('Itemlist');
			$this->loadModel('Color');
			$this->loadModel('Price');
			
			$this->loadModel('Banner');
			
			$banner_datas = $this->Banner->find('first',array('conditions'=>array('Banner.banner_type'=>'shop')));
			$this->set('banner_datas',$banner_datas);				
			
			$category = $_POST['category'];
			$category = explode('/', $category);
			$count = count($category);
			$resultCategory = $category[$count-1];
			//$resultCategoryId = $this->Category->findBycategory_urlname(lcfirst($resultCategory));
			//$resultCategoryId = $resultCategoryId['Category']['id'];
			$prefix = $this->Item->tablePrefix;
			$prevCat = explode('-',$_POST['catids']);
			$categoryId = '';
			
			$startIndex = 0;
			$offset = 20;
			if (isset($_GET['startIndex'])){
				$startIndex = $_GET['startIndex'];
			}
			
			if ($prevCat[0] == 0 && $category['1'] != 'browse') {
				$newCategory = $this->Category->findBycategory_urlname($category['1']);
				$prevCat[0] = $newCategory['Category']['id'];
			}
			
			for ($i=1;$i<$count;$i++) {
				if ($i == 1){
					//$resultCategoryId = $this->Category->findBycategory_urlname($category[$i]);
					$resultCategoryId = $this->Category->find('all',array('conditions'=>array('category_urlname'=>$category[$i])));
				}else if ($i == 2){
					$resultCategoryId = $this->Category->find('all',array('conditions'=>array('category_urlname'=>$category[$i],'category_parent'=>$resultCategoryId)));
				}else {
					$resultCategoryId = $this->Category->find('all',array('conditions'=>array('category_urlname'=>$category[$i],'category_sub_parent'=>$resultCategoryId)));
				}
				//echo "<pre>";print_r($resultCategoryId);die;
				$resultCategoryId = $resultCategoryId[0]['Category']['id'];
				if ($categoryId == '') {
					$categoryId = $resultCategoryId;
				}else {
					$categoryId = $categoryId."-".$resultCategoryId;
				}
			}
			
			if ($category['1'] == 'browse') {
				$count = 1;
			}
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
				$conditions['Item.status'] != 'draft';
				$status = " AND status !='draft' ";
			}
			else {
				$conditions['Item.status'] = 'publish';
				$status = " AND status='publish' ";
			}
			
			$status = " AND status='publish' ";
			if ($_POST['sortPrice'] == 'desc') {
				$orderby = "ORDER BY price DESC ";
				$sorting = 'Item.price DESC';
			}elseif ($_POST['sortPrice'] == 'asc') {
				$orderby = "ORDER BY price ASC ";
				$sorting = 'Item.price ASC';
			}else {
				$orderby = "ORDER BY id DESC ";
				$sorting = 'Item.id DESC';
			}
			//$orderby = ' ORDER BY id DESC ';
			//echo $count;echo "<pre>";print_r($category);
			switch($count) {
				case 1:
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						//$conditions['Item.price >='] = $price[0];
						//$conditions['Item.price <='] = $price[1];
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						$conditions['Item.price >='] = $price1;
						$conditions['Item.price <='] = $price2;
						
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['color'] != '') {
						$conditions['Item.item_color LIKE'] = "%".$_POST['color']."%";
					}
					if ($_POST['q'] != '') {
						$conditions['Item.item_title LIKE'] = $_POST['q']."%";
					}
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>'0')));
					break;
				case 2:
					$conditions['Item.category_id'] = $resultCategoryId;
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						$conditions['Item.price >='] = $price1;
						$conditions['Item.price <='] = $price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['color'] != '') {
						$conditions['Item.item_color LIKE'] = "%".$_POST['color']."%";
					}
					if ($_POST['q'] != '') {
						$conditions['Item.item_title LIKE'] = $_POST['q']."%";
					}
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>0)));
					break;
				case 3:
					$conditions['Item.category_id'] = $prevCat[0];
					$conditions['Item.super_catid'] = $resultCategoryId;
					
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						$conditions['Item.price >='] = $price1;
						$conditions['Item.price <='] = $price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['color'] != '') {
						$conditions['Item.item_color LIKE'] = "%".$_POST['color']."%";
					}
					if ($_POST['q'] != '') {
						$conditions['Item.item_title LIKE'] = $_POST['q']."%";
					}
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>$resultCategoryId)));
					break;
				case 4:
					$conditions['Item.category_id'] = $prevCat[0];
					$conditions['Item.super_catid'] = $prevCat[1];
					$conditions['Item.sub_catid'] = $resultCategoryId;
						
					if ($_POST['price'] != '' && $_POST['price'] != '-1' && $_POST['price'] != '501') {
						$price = explode('-', $_POST['price']);
						$price1=$price[0] / $_SESSION['currency_value'];
						$price2=$price[1] / $_SESSION['currency_value'];
						$conditions['Item.price >='] = $price1;
						$conditions['Item.price <='] = $price2;
					}elseif($_POST['price'] == '501') {
						$query = $query." AND price >=  501";
					}
					if ($_POST['color'] != '') {
						$conditions['Item.item_color LIKE'] = "%".$_POST['color']."%";
					}
					if ($_POST['q'] != '') {
						$conditions['Item.item_title LIKE'] = $_POST['q']."%";
					}
					$subCategory = $this->Category->find('all',array('conditions'=>array('category_parent'=>$prevCat[0],'category_sub_parent'=>$prevCat[1])));
					break;
			}
			if($setngs[0]['Sitesetting']['affiliate_enb']=='enable'){
			$conditions['Item.status !='] = 'draft';
			}
			else
			{
			$conditions['Item.status'] = 'publish';
			}
			$item = $this->Item->find('all',array('conditions'=>$conditions,'order'=>$sorting,'limit'=>$offset,'offset'=>$startIndex));
			
			$categoryData = null;
			if ($category['1'] != 'browse') {
				$categoryData = $this->Category->findByCategory_urlname($category[1]);
			}
			$items_list_data = $this->Itemlist->find('all',array('conditions'=>array('user_id'=>$userid,'user_create_list'=>'1')));
			$prnt_cat_data = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			
			
			$price_val = $this->Price->find('all');
			$color_val = $this->Color->find('all');
			
			
			$this->set('prnt_cat_data',$prnt_cat_data);
			$this->set('items_list_data',$items_list_data);
			$this->set('item',$item);
			$this->set('subCategory',$subCategory);
			$this->set('categoryData',$categoryData);
			$this->set('categoryId',$categoryId);
			$this->set('prev',$category);
			$this->set('resultCategory',$resultCategory);
			$this->set('price',$_POST['price']);
			$this->set('color',$_POST['color']);
			$this->set('sortPrice',$_POST['sortPrice']);
			$this->set('userid',$userid);
			$this->set('q',$_POST['q']);
			$this->set('color_val',$color_val);
			$this->set('price_val',$price_val);
				
			if (isset($_GET['startIndex'])){
				$this->render('categoryloadmore');
			}
			//echo $query;die;
			//echo "<pre>";print_r($item);die;
		}
		
		function edit_category($id = null){
			$this->layout = 'admin';
			$this->set('title_for_layout','Category Management');
			global $loguser;
			if(!$this->isauthorizedpersn())
				$this->redirect('/admin/view/category');
			if(empty($id)){
				$this->Session->setFlash('You url is not valid ');
				$this->redirect('/admin/view/category');
			}	
			$mainsunprnts = array();
			$spit = explode('~',$id);
			$mainsec_prnts = $this->Category->find('all',array('conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));
			
			$mainsec = $this->Category->find('all',array('conditions'=>array('id'=>$spit[0],'category_urlname'=>$spit[1])));
			
			if(empty($mainsec)){
				$this->Session->setFlash('No Category found for this url');
				$this->redirect('/admin/view/category');
			}	
			
			if(!empty($mainsec)){
				// $ctgry_prnt = $mainsec[0]['Category']['category_parent'];
				$ctgry_subprnt = $mainsec[0]['Category']['category_sub_parent'];
				$mainsunprnts = $this->Category->find('all',array('conditions'=>array('id'=>$ctgry_subprnt)));
			} 
			// echo "<pre>";print_r($mainsec);die;
			$this->set('mainsec',$mainsec);
			$this->set('mainsec_prnts',$mainsec_prnts);
			$this->set('mainsunprnts',$mainsunprnts);
			
			if(!empty($this->request->data)){
				//echo "<pre>";print_r($this->request->data);
				//die;
				$cats_data = $cats_sub_data = 0;
				if($_REQUEST['disabled'] == 'no'){
					$categoryname = $this->request->data['Category']['categoryname'];
					$cats_data = $this->Category->find('count',array('conditions'=>array('category_name'=>$categoryname,'category_parent'=>$this->request->data['Category']['categories'])));
				}
				if(!empty($this->request->data['Category']['categoryname_2'])){
					$cat_sub_par_id = $this->request->data['Category']['subparid'];
					if ($cat_sub_par_id == 0){
						$cats_sub_data = $this->Category->find('count',array('conditions'=>array('category_name'=>$this->request->data['Category']['categoryname_2'],'category_sub_parent'=>$this->request->data['Category']['secid'],'category_parent'=>$this->request->data['Category']['categories'])));
					}else{
						$cats_sub_data = $this->Category->find('count',array('conditions'=>array('category_name'=>$this->request->data['Category']['categoryname_2'],'category_sub_parent'=>$this->request->data['Category']['subparid'],'category_parent'=>$this->request->data['Category']['categories'])));
					}
				}	
				// echo "<pre>";print_r($cats_data);die;
				if($cats_data > 0 && empty($this->request->data['Category']['categoryname_2'])){
					$this->Session->setFlash('Category name Already Exists try another.');
					$this->redirect('/admin/edit/category/'.$id);
				}else if($cats_sub_data > 0){
					$this->Session->setFlash('Category sub name Already Exists for this category.');
					$this->redirect('/admin/edit/category/'.$id);
				}else{
					if($_REQUEST['disabled'] == 'no' && $cats_data == 0){
						$this->Category->create();
						$this->request->data['Category']['id'] = $this->request->data['Category']['secid'];
						$this->request->data['Category']['category_name'] = $this->request->data['Category']['categoryname'];
						$this->request->data['Category']['category_urlname'] = $this->Urlfriendly->utils_makeUrlFriendly($categoryname);
						if(empty($this->request->data['Category']['categories'])){
							$this->request->data['Category']['category_parent'] = 0;
						}else{
							$this->request->data['Category']['category_parent'] = $this->request->data['Category']['categories'];
						}
						if(empty($this->request->data['Category']['categoryname'])){
							$this->Session->setFlash('Please Enter Category Name');
							$this->redirect('/admin/edit/category/'.$id);
						}
						$this->request->data['Category']['created_by'] = $loguser[0]['User']['id'];
						$this->request->data['Category']['created_at'] = date('Y-m-d H:i:s');
						
						// var_dump($this->Category->save($this->request->data['Category'],array('validate'=>false,'fieldList' => array('user_id'=> $loguser[0]['User']['id']))));
						$this->Category->save($this->request->data);
						// echo "<pre>";print_r($this->data['Category']);die;
						$ids = $this->request->data['Category']['secid'];
					}else{
						$ids = $mainsec[0]['Category']['category_sub_parent'];
					}
					// echo $ids;die;
					if(!empty($this->request->data['Category']['categoryname_2'])){
						$this->Category->create();
						if($_REQUEST['disabled'] == 'yes'){
							$this->request->data['Category']['id'] = $this->request->data['Category']['secid'];
						}else{
							$this->request->data['Category']['id'] = '';
						}
						$catnme = $this->request->data['Category']['category_name'] = $this->request->data['Category']['categoryname_2'];
						$this->request->data['Category']['category_urlname'] = $this->Urlfriendly->utils_makeUrlFriendly($catnme);
						
						$this->request->data['Category']['category_parent'] = $this->request->data['Category']['categories'];
						//$this->request->data['Category']['category_sub_parent'] = $ids;
						if ($cat_sub_par_id == 0){
							$this->request->data['Category']['category_sub_parent'] = $this->request->data['Category']['secid'];
						}else{
							$this->request->data['Category']['category_sub_parent'] = $this->request->data['Category']['subparid'];
						}
						
						$this->request->data['Category']['created_by'] = $loguser[0]['User']['id'];
						$this->request->data['Category']['created_at'] = date('Y-m-d H:i:s');
						// echo "<pre>";print_r($this->data['Category']);die;
						$this->Category->save($this->request->data);
					}else{
						if(empty($this->request->data['Category']['categoryname_2'])){
							$this->Session->setFlash('Please Enter Category Name');
							$this->redirect('/admin/edit/category/'.$id);
						}
					}
				}	
				// die;
				$this->Session->setFlash('Successfully Updated');
				$this->redirect('/admin/view/category');
			}
			$this->set('id',$id);
		}
		
		
		/* ajax call for super sub categry */
		function suprsubcategry(){
			$this->layout = 'ajax';
			$this->loadModel('Category');
			$cateid = $_REQUEST['cate_id'];
			$suprsub = $_REQUEST['suprsub'];
			
			$catsdata = array();
			if($suprsub == 'yes'){
				$catsdata = $this->Category->find('all',array('conditions'=>array('category_parent'=>$cateid,'category_sub_parent'=>0)));
			}else{
				$catsdata = $this->Category->find('all',array('conditions'=>array('category_sub_parent'=>$cateid)));
			}
			
			if(!empty($catsdata)){
				foreach($catsdata as $cts){
					$cats_arr[] = array('ID'=>$cts['Category']['id'],'Name'=>$cts['Category']['category_name']);
				}
				// [ { "ID" :"1", "Name":"Scott"},{ "ID":"2", "Name":"Jon"} ]
				// print_r($cats_arr);
				echo json_encode($cats_arr);
			}else{
				echo 0;
			}
			die;
		}
		
		
		/* view items by category */
		function view_details_categitem($ids = null,$sprctnme = null,$subctnme=null){
			$this->layout = 'default';
			
			global $loguser;
			
			// echo $ids.'<br />';
			// echo $sprctnme.'<br />';
			// echo $subctnme.'<br />';
			// echo $_REQUEST['ref'].'<br />';
			// die;
			if(!empty($_REQUEST['ref'])){
				$ref = $_REQUEST['ref'];
			}else{
				$ref = '';
			}
			if(empty($ref) && (!empty($subctnme) || !empty($sprctnme))){
				$this->redirect('browse/'.$ids);
			}
			
			if(empty($ids)){
				$this->Session->setFlash('You url is not valid ');
				$this->redirect('/');
			}
			
			$item_datas = $super_cat_datas = array();
			$spit = explode('~',$ids);
			// echo "<pre>";print_r($spit);
			$this->set('title_for_layout',$spit[1]);
			
			if($ref == 'sub_cat_titles' && !empty($subctnme)){
				$super_cat_datas = $this->Category->findByCategoryUrlname($subctnme);
				// echo "<pre>";print_r($super_cat_datas);
				$sprcatids = $super_cat_datas['Category']['category_sub_parent'];
				$sub_catid = $super_cat_datas['Category']['id'];
				
				$catdatas = $this->Category->find('all',array('conditions'=>array('category_parent'=>$spit[0],'Category.category_sub_parent'=>$sprcatids)));
				
			}else if($ref == 'super_sub_cat_titles' && !empty($sprctnme)){
				$super_cat_datas = $this->Category->findByCategoryUrlname($sprctnme);
				$sprcatids = $super_cat_datas['Category']['id'];
				
				$catdatas = $this->Category->find('all',array('conditions'=>array('category_parent'=>$spit[0],'Category.category_sub_parent'=>$sprcatids)));
				
			}else{
				$super_cat_datas = $this->Category->find('all',array('conditions'=>array('category_parent'=>$spit[0])));
				$catdatas = $this->Category->find('all',array('conditions'=>array('category_parent'=>$spit[0],'Category.category_sub_parent'=>0)));
			}
			
			/* if(!empty($super_cat_datas)){
				foreach($super_cat_datas as $sprcat){
					$sprcatids[] = $sprcat['Category']['id'];
				}
			} */
			$this->loadModel('Item');
			// $item_datas = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$spit[0],'Item.super_catid'=>$sprcatids)));
			if($ref == 'sub_cat_titles' && !empty($subctnme)){
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$spit[0],'Item.super_catid'=>$sprcatids,'Item.sub_catid'=>$sub_catid)));
				
			}else if($ref == 'super_sub_cat_titles' && !empty($sprctnme)){
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$spit[0],'Item.super_catid'=>$sprcatids)));
				
			}else{
				$item_datas = $this->Item->find('all',array('conditions'=>array('Item.category_id'=>$spit[0])));
			}
			
			// echo "<pre>";print_r($catdatas);die;
			// echo "<pre>";print_r($item_datas);die;
			
			
			$this->set('super_cat_datas',$super_cat_datas);
			$this->set('item_datas',$item_datas);
			$this->set('catdatas',$catdatas);
			$this->set('ids',$ids);
			$this->set('caturl',$spit[1]);
			$this->set('ref',$ref);
			$this->set('subctnme',$subctnme);
			$this->set('sprctnme',$sprctnme);
			
			// die; 
		}
		
	}
