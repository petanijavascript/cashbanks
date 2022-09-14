//<?php
//// prints e.g. 'Current PHP version: 4.1.1'
//echo 'Current PHP version: ' . phpversion();

//// prints e.g. '2.0' or nothing if the extension isn't enabled
//echo phpversion('tidy');
//?>

<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	//header('Location: '.$uri.'/xampp/');
    header('Location: '.$uri.'/cashbank/public/');
	exit;
?>
Something is wrong with the XAMPP installation :-(
