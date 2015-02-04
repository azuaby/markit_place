<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<style type="text/css">
.http-error{
   text-align:center;
}
.http-error h1 {
    color: #444444;
    line-height: 1em;
    text-shadow: 1px 1px 0 #FFFFFF;
    border-bottom:0px;
}
.row-fluidoo{
	font-size:5em
}
/*
html{
	background:none !important;
}
*/

    </style>

<body class="http-error"> 
<div class="row-fluid">
<?php
if (Configure::read('debug') > 0 ):
	echo '<h2 style="text-align:center;">'.$name.'</h2>';
endif;
?>
    <div class="http-error">
        <h1 class="row-fluidoo">Oops!</h1>
        <p class="info">Something went wrong, please try again.</p>
        <p><i class="icon-home"></i></p>
        <p><a href="<?php echo SITE_URL; ?>">Back to the home page</a></p>
    </div>
</div>


<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
	//echo "saravana235";
endif;
?>
