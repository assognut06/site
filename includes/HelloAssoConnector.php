<?php
require_once 'APIHandler.php';

class HelloAssoConnector
{
    private $apiHandler;
    private $organizationSlug;

    public function __construct($bearerToken, $organizationSlug)
    {
        $this->apiHandler = new APIHandler($bearerToken);
        $this->organizationSlug = $organizationSlug;
    }



    public function fetchData()
    {
        if (isset($_GET['order'])) {
            $endpoint = "/items/{$_GET['order']}/";
        } else {
            if (isset($_GET['page']) && ($_GET['page'] === 'admin') && !isset($_GET['item']) && !isset($_GET['payment'])) {
                $endpoint = "/organizations/{$this->organizationSlug}/";
            } else {
                if (isset($_GET['payment'])) {
                       $endpoint = "/payments/{$_GET['payment']}/";
                } else {
                    $endpoint = $this->buildEndpoint();
                }
            }
        }

        return $this->apiHandler->getData($endpoint);
    }


    private function buildEndpoint()
    {

        // Check if the only GET parameter is 'page' and its value is 'admin'
        if (isset($_GET['item']) && $_GET['item'] === 'payments') {
            $endpoint = "/organizations/{$this->organizationSlug}/payments/search?";
        } else {
            $endpoint = "/organizations/{$this->organizationSlug}/items?";
        }

        $params = [
            'pageIndex' => isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 1,
            'pageSize' => isset($_GET['tierTypes']) ? 4 : 12,
            'withDetails' => 'true',
            'sortOrder' => 'Desc',
            'sortField' => 'Date'
        ];

        if (!isset($_GET['formType'])) {
            if (isset($_GET['tierTypes'])) {
                $params['tierTypes'] = 'Donation';
            }
        } else {
            $endpoint = "/organizations/{$this->organizationSlug}/forms/{$_GET['formType']}/{$_GET['formSlug']}/items?";
        }

        $endpoint .= http_build_query($params);
        // die($endpoint);
        return $endpoint;
    }
}
