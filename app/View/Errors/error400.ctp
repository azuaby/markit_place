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
/*html{
	background:none !important;
}*/


    </style>

<body class="http-error"> 
<div class="row-fluid">
    <div class="http-error">
        <h1 class="row-fluidoo">Oops!</h1>
        <p class="info">This page doesn't exist.</p>
        <p><i class="icon-home"></i></p>
        <p><a href="<?php echo SITE_URL; ?>">Back to the home page</a></p>
    </div>
</div>

<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
	//echo "saravanan11";
endif;
?>
