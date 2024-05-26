<?php
class APIHandler {
    private $baseUrl = "https://api.helloasso.com/v5";
    private $authorization;

    public function __construct($bearerToken) {
        $this->authorization = "Bearer " . $bearerToken;
    }

    private function curlApiGet($url) {
        $curl = curl_init();
        require('sslVerifypeer.php'); // Dépend de votre configuration sslVerifypeer
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: ' . $this->authorization));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);
        return json_decode($response);
    }

    public function getData($endpoint) {
        $url = $this->baseUrl . $endpoint;
        // die($url);
        return $this->curlApiGet($url);
    }
}
?>
