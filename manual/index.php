<?php

function getCoindeskCurrentPrices()
{
    $uri = "https://api.coindesk.com/v1/bpi/currentprice.json";
    
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   
        CURLOPT_FOLLOWLOCATION => true,   
        CURLOPT_MAXREDIRS      => 10,     
        CURLOPT_CONNECTTIMEOUT => 120,    
        CURLOPT_TIMEOUT        => 120,    
        CURLOPT_URL            => $uri,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FAILONERROR => true
    ); 

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $content = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }

    if (isset($error_msg)) {
        print($error_msg);
        die(1);
    }

    curl_close($ch);

    return $content;
}

$json = getCoindeskCurrentPrices();

function prettifyCoindeskResponse($c) {
    $j = json_decode($c);
    print("Current Coindesk crypto outlook: " . PHP_EOL);
    foreach ($j->bpi as $value) {
        print_r("Code: " . $value->code . PHP_EOL);
        print_r("Symbol: " . $value->symbol . PHP_EOL);
        print_r("Rate: " . $value->rate . PHP_EOL);
        print_r("Description: " . $value->description . PHP_EOL);
        print_r(PHP_EOL);
    }
    // Exit after completion
    // 0 indicates success
    exit(0);
}

prettifyCoindeskResponse($json);
