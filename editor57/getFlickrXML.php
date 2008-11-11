<?php

// Request Yahoo! REST Web Service using
// file_get_contents. PHP4/PHP5
// Author: Rasmus Lerdorf and Jason Levitt
// February 1, 2006

error_reporting(E_ALL);

$request =  'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=4f86e02b0501dc9ee4287ede2850f08d&tags='.$_REQUEST['tags'];

// Make the request
$xml = file_get_contents($request);

// Retrieve HTTP status code
list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);

// Check the HTTP Status code
switch($status_code) {
	case 200:
		// Success
		break;
	case 503:
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 503. That means: Service unavailable. An internal problem prevented us from returning data to you.');
		break;
	case 403:
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 403. That means: Forbidden. You do not have permission to access this resource, or are over your rate limit.');
		break;
	case 400:
		// You may want to fall through here and read the specific XML error
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 400. That means:  Bad request. The parameters passed to the service did not match as expected. The exact error is returned in the XML response.');
		break;
	default:
		die('Your call to Yahoo Web Services returned an unexpected HTTP status of:' . $status_code);
}

// Output the XML
header('Content-Type: text/xml');
 echo $xml;
//echo htmlspecialchars($xml, ENT_QUOTES);
?>
