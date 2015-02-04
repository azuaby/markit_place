

<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */




$cakeDescription = __d('cake_dev', $setngs[0]['Sitesetting']['site_name']);
$userid = $loguser[0]['User']['id'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">




<style>

img{
        display: inline-block;
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 100%;

    }

.ui-panel-inner { 
  padding: 0 !important;
}
.message
{
  	background: -moz-linear-gradient(center top , #ffffff, #ffffff) repeat-x scroll 0 0 #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset;
    color: #d9573b;
    margin-bottom: 30px;
    padding: 7px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}

</style>
	<title>
		Mobile
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
		<?php echo $username ?>
	</title>

	<?php $MOB_URL = "http://localhost/fantacy/mobile/"; ?>
	<?php
	
	
	$params=$this->params;
		$controller=$params['controller'];
		$action=$params['action'];
	
	echo $this->Html->meta('icon');

	echo $this->Html->script('jquery-1.10.2.min');
	echo $this->Html->script('jquery.mobile-1.4.2.min');
	echo $this->Html->script('responsiveImg');
	echo $this->Html->css('jquery.mobile-1.4.2.min');
	
	echo $this->Html->css('jquery.mobile.external-png-1.4.2.min');
echo $this->Html->css('jquery.mobile.icons-1.4.2.min');
echo $this->Html->css('jquery.mobile.external-png-1.4.2.min');
echo $this->Html->css('jquery.mobile.inline-svg-1.4.2.min');
echo $this->Html->css('jquery.mobile.structure-1.4.2.min');
echo $this->Html->css('jquery.mobile.theme-1.4.2.min');

echo $this->Html->css('glyphicons');



		//echo $this->Html->script('jquery.min');
		//echo $this->Html->script('jquery.ui');
		//echo $this->Html->script('jquery');
		//echo $this->Html->script('bootstrap');
		echo $this->Html->script('bootstrap-dropdown');
		echo $this->Html->script('jquery.selectlist');
		
				

	//echo $this->Html->script('jquery.main');

	

	echo $this->Html->script('mobilefrontnew');
	echo $this->Html->script('custommobileScriptnew');
	

	
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');

	
	?>
	
</head>
<script type="text/javascript">

function chkopen()
{
if( $(".ui-panel").hasClass("ui-panel-open") == true ){
$('html').css("overflow","auto");
   $('body').css("overflow", "auto");
document.ontouchmove = function(e){ return true; }

}else{


$ (document). delegate ('.ui-panel-inner', 'touchmove', true);
//document.ontouchmove = function(e){ e.preventDefault(); }
$(document).delegate('.ui-panel-wrapper', 'touchmove', true);​



}
}
var OSName="unknown OS";
if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) OSName="Windows 8";
if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) OSName="Windows 7";
if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) OSName="Windows Vista";
if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) OSName="Windows XP";
if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) OSName="Windows 2000";
if (window.navigator.userAgent.indexOf("Mac")!=-1) OSName="Mac/iOS";
if (window.navigator.userAgent.indexOf("X11")!=-1) OSName="UNIX";
if (window.navigator.userAgent.indexOf("Linux")!=-1) OSName="Linux";
//alert('Your OS: '+OSName);
</script>
<body>
<div data-role="page" id="mainpage">

 <?php

 if($userid=="")
 echo $this->element('mobilecontent');
 else
 echo $this->element('mobilelogincontent');
  
 ?> 
 
 


      <div data-role="header" data-theme="a" style="background-color:#FFFFFF;height:50px;width:100%;position:fixed;z-index:1000;">
    
     <a href="#myPanel" onclick="chkopen()" data-dismissible="false" data-role="none" style="background-color:#FFFFFF;margin-top:10px;"><img src='<?php echo SITE_URL; ?>images/menu/icon-menu.png'></a>
        <center style="margin-top:14px;">
        	<?php
	        	if(!empty($setngs[0]['Sitesetting']['site_logo'])){
    		    	echo '<img src="'.SITE_URL.'images/logo/'.$setngs[0]['Sitesetting']['site_logo'].'" style="width:139px;">';
    		    }
    		    else
    		    {
    		    	echo '<img src="'.SITE_URL.'images/logo/logo.png" style="width:139px;">';
    		    }
    		?>
        </center>
       
			

        <?php
        echo '<a data-mini="true" data-inline="true" data-role="none" href="#add-form" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">
        <img src="'.SITE_URL.'images/menu/categoryicon.png" style="width:32px;left:-5px;margin-top:5px;position:relative;"></a>';
        ?>
	    
          <div style="margin-top:50px;margin-right:10px; min-height:auto !important;" data-role="panel" data-position="right" data-display="overlay" data-theme="a" id="add-form">
          <div class="ui-body ui-body-a" style="background:#F1F1F1;text-align:center;font-size:17px;font-weight:normal !important;">
          <span>Category</span>
          </div>
          <div class="ui-body ui-body-a" style="border:none;">
          <table style="width:100%;"><thead><tr><th></th></th></thead><tbody>
				<?php $count = count($parent_categori);
				$index=  0;
					foreach($parent_categori as $cate){
					$index++;
					if($index==$count)
					{
						echo '<tr><td>';
						echo '<li style="list-style:none;"><a data-ajax="false" style="text-decoration:none;color:#8E8E8E;font-weight:normal !important;font-size:13px;" href="'.SITE_URL.'mobile/shop/'.$cate['Category']['category_urlname'].'">';
						 echo __($cate['Category']['category_name']); 
						 echo '</a></li>';
						 echo '</td></tr>';
					}
					else
					{
						echo '<tr><td>';
						echo '<li style="list-style:none;"><a data-ajax="false" style="text-decoration:none;color:#8E8E8E;font-weight:normal !important;font-size:13px;" href="'.SITE_URL.'mobile/shop/'.$cate['Category']['category_urlname'].'">';
						 echo __($cate['Category']['category_name']); 
						 echo '</a></li><hr>';
						 echo '</td></tr>';
					}
						 
						 
						 
					}
				?>
				</table>
				</div>
     
    </div>
     
        <!--?php
         if($userid=="")
         {
		if($_SERVER['REQUEST_URI']=="/fantacy/mobile/login")
		{
		echo '<a href="'.$MOB_URL.'signup">Sign Up</a>';
		}
		else
		{
        	echo '<a href="'.$MOB_URL.'login">Sign In</a>';
		}
        }
        else
        {
	        echo '<a href="'.$MOB_URL.'logout">Sign Out</a>';
        }
        ?-->
    </div><!-- /header -->
   <div data-role="main" class="ui-content" id="mainpage1">  
    <br /><br /><br />

   
				<?php
echo '<div class="alert alert-success" align="center">'.$this->Session->flash().'</div>';
?>
	
       <?php 
       echo $content_for_layout; 
        ?>      
    </div><!-- /content -->
    <!--div data-role="footer" data-position="fixed" data-theme="a">
        <h4>Page Footer</h4>
    </div-->
    </body>
</html>
