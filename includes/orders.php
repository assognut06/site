<?php
if (isset($_GET['order'])) {
    $url = "https://api.helloasso.com/v5/items/{$_GET['order']}/";
    $authorization = "Bearer " . $bearer_token;
    $data_forms = curlApiGet($url, $authorization);
} else {
    if(!isset($_GET['formType'])) {
        if(isset($_GET['pageIndex']))
        {
            $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/items?pageIndex={$_GET['pageIndex']}&pageSize=20&withDetails=true&sortOrder=Desc&sortField=Date";

        } else {
            $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/items?pageIndex=1&pageSize=20withDetails=true&sortOrder=Desc&sortField=Date";
        }
    } else {
        $url = "https://api.helloasso.com/v5/organizations/{$organizationSlug}/forms/{$_GET['formType']}/{$_GET['formSlug']}/items?withDetails=false&sortOrder=Desc&sortField=Date";
    }
    
    $authorization = "Bearer " . $bearer_token;
    $data_forms = curlApiGet($url, $authorization);

}