<?php

$filetype = $_POST['filetype'];
$absopath = $path = dirname(__FILE__);

$realpath = explode('/',$path);
$dircnt = count($realpath);
$dircnt -= 3;
$path = '/';
for ($i=1; $i < $dircnt; $i++) {
	$path .= $realpath[$i].'/';
}
//echo $path;

if ($filetype == 'config') {
	$siteurl = $_POST['siteurl'];
	$sitename = $_POST['sitename'];
	$handle = @fopen($path."app/Config/config.php","w") or die('Permission Denied Cannot open file');
	$data = '<?php
		$config["Settings"] =array(
			"SITE_URL"=>"'.$siteurl.'",
			"SITE_TITLE"=>"'.$sitename.'",
			"FB_ID"=>"1425530534380712",
			"FB_SECRET"=>"bfa030b853423a97149a170331a438b4",
			"GOOGLE_ID"=>"344848660096-vf6h635s355ouqjncfhapmh6ap34pbkt.apps.googleusercontent.com",
			"GOOGLE_SECRET"=>"G7tL33RTidfd5aHGnDgRIF_b",
			"TWITTER_ID"=>"YVqFPjfIcl0wRQerGqFkiSPTY",
			"TWITTER_SECRET"=>"bTpEAQCEYXp1QYVo0wPUktBFRPm7qWLnTdzFtKVPPNANEIPrWB",
			"GMAIL_CLIENT_SECRET"=>"lnQZff7Xro0T2kMDPndVE-Dx",
			"GMAIL_CLIENT_ID"=>"344848660096-5fo8e710bem99rdj8ebstg3oj0gfe77p.apps.googleusercontent.com"
		); ?>';
	fwrite($handle, $data);
	fclose($handle);
	@chmod($path."app/Config/config.php", 0644);
	echo "success";
}else if ($filetype == 'database') {
	$dbName = $_POST['dbname'];
	$dbhost = $_POST['dbhost'];
	$dbUser = $_POST['dbusername'];
	$dbPassword = $_POST['dbpassword'];
	
        $con=@mysqli_connect($dbhost,$dbUser,$dbPassword,$dbName);

        // Check connection
        if (mysqli_connect_errno())
        {
             echo "Failed to connect to MySQL: " . mysqli_connect_error(); die;
        }

	$handle = @fopen($path."app/Config/database.php","w") or die('Permission Denied Cannot open file');
	$data = '<?php
		class DATABASE_CONFIG {
		
			public $default = array(
				"datasource" => "Database/Mysql",
				"persistent" => false,
				"host" => "'.$dbhost.'",
				"login" => "'.$dbUser.'",
				"password" => "'.$dbPassword.'",
				"database" => "'.$dbName.'",
				"prefix" => "fc_",
				//"encoding" => "utf8",
			);
			
		}';
	fwrite($handle, $data);
	fclose($handle);
	@chmod($path."app/Config/database.php", 0644);
	echo "success";
}else if ($filetype == 'databaseinstall') {
	$db = $_POST['dbname'];
	$dbhost = $_POST['dbhost'];
	$dbuser = $_POST['dbusername'];
	$dbpass = $_POST['dbpassword'];
	$file = $absopath.'/sql/fancyclone.sql';
	$command = 'mysql'
	. ' --host=' . $dbhost
	. ' --user=' . $dbuser
	. ' --password=' . $dbpass
	. ' --database=' . $db
	. ' --execute="SOURCE ' . $absopath
	; 
	
	$output1 = shell_exec($command . '/sql/fancyclone.sql" 2>&1');
	//echo $command . '/sql/fancyclone.sql"';
	//$output2 = shell_exec($command . '/site_structure.sql"');
	if ($output1 != ''){
		echo $output1;
	}else{
		echo "success";
	}
}else if ($filetype == 'demodata') {
	$db = $_POST['dbname'];
	$dbhost = $_POST['dbhost'];
	$dbuser = $_POST['dbusername'];
	$dbpass = $_POST['dbpassword'];
	$command = 'mysql'
	. ' --host=' . $dbhost
	. ' --user=' . $dbuser
	. ' --password=' . $dbpass
	. ' --database=' . $db
	. ' --execute="SOURCE ' . $absopath
	; 
	
	$output1 = shell_exec($command . '/sql/fancyclonedemo.sql"');
	//echo $command . '/sql/fancyclone.sql"';
	//$output2 = shell_exec($command . '/site_structure.sql"');
	echo "success";
}else if ($filetype == 'currency') {
	$dbName = $_POST['dbname'];
	$dbhost = $_POST['dbhost'];
	$dbUser = $_POST['dbusername'];
	$dbPassword = $_POST['dbpassword'];
	$currencycode = $_POST['currencycode'];
	
	$currencyName = array('AUD' => 'Australian Dollar', 'BRL' => 'Brazilian Real', 
			'CAD' => 'Canadian Dollar', 'CZK' => 'Czech Koruna', 
			'DKK' => 'Danish Krone', 'EUR' => 'Euro', 'HKD' => 'Hong Kong Dollar', 
			'HUF' => 'Hungarian Forint', 'ILS' => 'Israeli New Sheqel', 
			'JPY' => 'Japanese Yen', 'MYR' => 'Malaysian Ringgit', 
			'MXN' => 'Mexican Peso', 'NOK' => 'Norwegian Krone', 
			'NZD' => 'New Zealand Dollar', 'PHP' => 'Philippine Peso', 
			'PLN' => 'Polish Zloty', 'GBP' => 'Pound Sterling', 
			'RUB' => 'Russian Ruble', 'SGD' => 'Singapore Dollar', 
			'SEK' => 'Swedish Krona', 'CHF' => 'Swiss Franc', 
			'TWD' => 'Taiwan New Dollar', 'THB' => 'Thai Baht', 
			'TRY' => 'Turkish Lira', 'USD' => 'U.S. Dollar' );
	
	$currencySymbol = array('AUD' => '$', 'BRL' => 'R$', 'CAD' => '$', 'CZK' => 'Kč', 'DKK' => 'kr', 
			'EUR' => '€', 'HKD' => '$', 'HUF' => 'Ft', 'ILS' => '₪', 'JPY' => '¥', 'MYR' => 'RM',
			'MXN' => '$', 'NOK' => 'kr', 'NZD' => '$', 'PHP' => '₱', 'PLN' => 'zł', 'GBP' => '£',
			'RUB' => 'руб', 'SGD' => '$', 'SEK' => 'kr', 'CHF' => 'CHF', 'TWD' => 'NT$', 'THB' => '฿',
			'TRY' => 'も', 'USD' => '$' );
	$currencysymbol = $currencySymbol[$currencycode];
	$currencyname = $currencyName[$currencycode];
	
        $con=@mysqli_connect($dbhost,$dbUser,$dbPassword,$dbName);

        // Check connection
        if (mysqli_connect_errno())
        {
             echo "Failed to connect to MySQL: " . mysqli_connect_error(); die;
        }
    
    $sql = "INSERT INTO fc_forexrates (currency_code, currency_symbol, currency_name, price, status) 
    			VALUES ('$currencycode','$currencysymbol','$currencyname',1,'enable')";
    
    if (!mysqli_query($con,$sql))
    {
    	die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
	
	echo "success";
}else if ($filetype == 'remove') {
	$jsfile = $absopath.'/js/install.js';
	$cssfile = $absopath.'/css/install.css';
	$sqlfile = $absopath.'/sql/fancyclone.sql';
	$sqlfile1 = $absopath.'/sql/fancyclonedemo.sql';
	$indfile = $absopath.'/index.php';
	$wrfile = $absopath.'/writer.php';
	$jsfold = $absopath.'/js/';
	$cssfold = $absopath.'/css/';
	$sqlfold = $absopath.'/sql/';
	unlink($jsfile);
	unlink($cssfile);
	unlink($indfile);
	unlink($wrfile);
	unlink($sqlfile);
	unlink($sqlfile1);
	rmdir($jsfold);
	rmdir($cssfold);
	rmdir($sqlfold);
	rmdir($absopath);
	echo "success";
}
