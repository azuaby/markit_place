<?php 
if (isset($_POST['form1'])){
	echo "<script>alert('activate form1');</script>";
}
$currencyCode = array('AUD' => 'AUD', 'BRL' => 'BRL', 'CAD' => 'CAD', 'CZK' => 'CZK', 'DKK' => 'DKK', 'EUR' => 'EUR', 'HKD' => 'HKD', 'HUF' => 'HUF', 'ILS' => 'ILS', 'JPY' => 'JPY', 'MYR' => 'MYR', 'MXN' => 'MXN', 'NOK' => 'NOK', 'NZD' => 'NZD', 'PHP' => 'PHP', 'PLN' => 'PLN', 'GBP' => 'GBP', 'RUB' => 'RUB', 'SGD' => 'SGD', 'SEK' => 'SEK', 'CHF' => 'CHF', 'TWD' => 'TWD', 'THB' => 'THB', 'TRY' => 'TRY', 'USD' => 'USD' );

?>
<html>
	<head>
		<title>Markit Installation</title>
		<link rel="stylesheet" href="css/install.css" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
		<script type="text/javascript" src="js/install.js"></script>
	</head>
	<body>
		<div class="formhead">
			<h2>Markit Installation</h2>
		</div>
		<div class="errormsg">Something</div>
		<div class="confirmation">
			<p>Before Starting the Installation, please be sure that you are having the following things</p>
			<ol>
				<li>Database Name</li>
				<li>Database Username</li>
				<li>Database Password</li>
				<li>Website Name and Url</li>
				<li>Server should allow executing the shell commands</li>
			</ol>
			<div style="text-align:center;color:red;font-size:13px;">Note: Don't Refresh or press the back button of the Browser during the Installation. </div>
			<button class="indexstart" onclick="contnue();">Continue >> </button>
		</div>
		<div class="steps step1">
			<div class="stephead">Website Information</div>
			<div class="form">
				<form method="post" action="" onsubmit="return step1();">
					<label>Enter the Website Name</label>
					<input id="sitetitle" type="text" name="sitetitle" placeholder="ex. Markit" /></br></br>
					<label>Enter the Website Url</label>
					<input id="siteurl" type="text" name="siteurl" placeholder="ex. http://www.example.com" /></br></br>
					<div class="loading"><img src="../images/loading_blue.gif" alt="Processing...." /></div>
					<input type="submit" value="Next >" />
					<input type="button" value="< Back" onclick="back('1');" />
				</form>
			</div>
		</div>
		<div class="steps step2">
			<div class="stephead">Database Information</div>
			<div class="form">
				<form method="post" action="" onsubmit="return step2();">
					<label>Enter the Data base name</label>
					<input id="dbname" type="text" name="dbname" placeholder="ex. Markit" /></br></br>
					<label>Enter the Host name</label>
					<input id="dbhost" type="text" name="dbhost" placeholder="ex. localhost, 192.1168.2.1" /></br></br>
					<label>Enter the Data base Username</label>
					<input id="dbusername" type="text" name="dbusername" placeholder="Username" /></br></br>
					<label>Enter the Data base Password</label>
					<input id="dbpassword" type="password" name="dbpassword" placeholder="Password" /></br></br>
					<div class="loading"><img src="../images/loading_blue.gif" alt="Processing...." /></div>
					<input type="submit" value="Next >" />
					<input type="button" value="< Back" onclick="back('2');" />
				</form>
			</div>
		</div>
		<div class="step3 steps">
			<div class="stephead">Database Installation</div>
			<div class="form">
				<p>Please click the below button to install the Database</p>
				<form method="post" action="" onsubmit="return step3();">
					<div class="loading"><img src="../images/loading_blue.gif" alt="Processing...." /></div>
					<input type="submit" value="Install" />
					<input type="button" value="< Back" onclick="back('3');" />
				</form>
			</div>
		</div>
		<div class="step4 steps">
			<div class="stephead">Demo Data Installation</div>
			<div class="form">
				<p>Would you like to Install Demo Data ?</p>
				<form method="post" action="" onsubmit="return step4();">
					<div class="loading"><img src="../images/loading_blue.gif" alt="Processing...." /></div>
					<input type="submit" value="Install" />
					<input type="button" value="Skip" onclick="skip();" />
				</form>
			</div>
		</div>
		<div class="steps step5">
			<div class="stephead">Website Default Currency</div>
			<div class="form">
				<form method="post" action="" onsubmit="return step5();">
					<label>Select the Currency Code</label>
					<select id="currencycode" name="currencycode" />
					<?php foreach ($currencyCode as $key => $code){ ?>
						<option value="<?php echo $key; ?>"><?php echo $code; ?></option>
					<?php } ?>
					</select>
					</br></br>
					<div class="loading"><img src="../images/loading_blue.gif" alt="Processing...." /></div>
					<input type="submit" value="Next >" />
					<input type="button" value="< Back" onclick="back('4');" />
				</form>
			</div>
		</div>
		<div class="finishpopup">
			<div class="installfinsh">Installation Finished</div>
			<button class="finish" onclick="loadsite();">Launch Markit</button>
		</div>
	</body>
</html>
