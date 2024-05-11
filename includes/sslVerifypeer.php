<?php
if($_SERVER['HTTP_HOST']=='localhost'){
	curl_setopt_array($curl, [
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
    ]);
}