<?php
if (isset($_GET['order'])) {
    $url = "https://api.helloasso.com/v5/items/{$_GET['order']}/";
    $authorization = "Bearer " . $bearer_token;
    $data_forms = curlApiGet($url, $authorization);
} else {
    if(!isset($_GET['formType'])) {
        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/items?pageIndex=1&pageSize=50&withDetails=true&sortOrder=Desc&sortField=Date";
    } else {
        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/payments/search?pageSize=50&formType={$_GET['formType']}&sortOrder=Desc&sortField=Date";
    }
    
    $authorization = "Bearer " . $bearer_token;
    $data_forms = curlApiGet($url, $authorization);

}