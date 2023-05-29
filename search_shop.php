<?php

require_once 'auth.php';

// Se la sessione è scaduta, esco
if (!checkAuth()) exit;

header('Content-Type: application/json');

shop();
function shop(){
    $query = urlencode($_GET["brand"]);
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://makeup.p.rapidapi.com/products.json?brand=".$query,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: makeup.p.rapidapi.com",
		"X-RapidAPI-Key: 717d04f1efmsh2600b42b960659ap17d671jsnb6bf889b94f2"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
    
}
?>
