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
        <h1 class="row-fluidoo">Site is under Maintenance</h1>
        <?php if ($adminmessage == ""){$adminmessage = "Please come back in few minutes";} ?>
        <p class="info"><?php echo $adminmessage; ?></p>
        <p><i class="icon-refresh"></i></p>
        <p><a href="<?php echo SITE_URL; ?>">Check Now</a></p>
    </div>
</div>