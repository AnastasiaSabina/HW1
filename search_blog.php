<?php
/*******************************************************
    Ritorna un JSON con i risultati dell'API selezionata
********************************************************/
require_once 'auth.php';

// Se la sessione è scaduta, esco
if (!checkAuth()) exit;

header('Content-Type: application/json');

searchBlog();

// Restituisci la risposta come JSON



function searchBlog() {
	$curl = curl_init();
	
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://byword-article-generation.p.rapidapi.com/rapidapi?keyword=Beauty",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: byword-article-generation.p.rapidapi.com",
			"X-RapidAPI-Key: d07a27e949mshac5bb27ac631802p1cc8a5jsn0fe4fc7d6578"
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
