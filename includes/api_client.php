<?php
function fetch_remote_users($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); // ✅ critical fix

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        return [];
    }

    $data = json_decode($response, true);

    return is_array($data) ? $data : [];
}
?>