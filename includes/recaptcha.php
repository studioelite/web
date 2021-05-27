<?php
    
    function recaptchaSiteVerify($action, $response) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $secret = "6Lfif_cUAAAAAGDMr0Ify8iCSI7qqisPIaxorjm_";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            "secret" => $secret,
            "remoteip" => $_SERVER["REMOTE_ADDR"],
            "action" => $action,		
            "response" => $response
        ));
        $curlData = curl_exec($curl);
        curl_close($curl);

        $curlJson = json_decode($curlData, true);
        $result = $curlJson["success"] ? $curlJson["score"] >= 0.5 : false;
        
        return boolval($result);
    }

?>