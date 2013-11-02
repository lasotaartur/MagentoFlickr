<?php

class Alasota_Flickr_IndexController extends Mage_Core_Controller_Front_Action {

    public function callAction() {
        $config = new \Alasota_Flickr_Model_Config();
        $token = unserialize($_SESSION['FLICKR_ACCESS_TOKEN']);
        $client = $token->getHttpClient(array(
            'callbackUrl' => $config->getPageAddr() . '/flickr/auth/success',
            'siteUrl' => 'http://www.flickr.com/services/oauth',
            'consumerKey' => $config->getConsumerKey(),
            'consumerSecret' => $config->getConsumerSecret(),
            'requestTokenUrl' => 'http://www.flickr.com/services/oauth/request_token',
            'accessTokenUrl' => 'http://www.flickr.com/services/oauth/request_token',
            'authorizeUrl' => 'http://www.flickr.com/services/oauth/authorize'
        ));
        $client->setUri("http://api.flickr.com/services/rest/");
        $client->setMethod(Zend_Http_Client::GET);
        $client->setParameterGet("api_key", $config->getConsumerKey());
        $client->setParameterGet('format', 'json');
        
        foreach($_POST as $name=>$value){
            $client->setParameterGet($name, $value);
        } 
        $response = $client->request();
        echo str_replace(array('jsonFlickrApi({', '})'), array('{', '}'), $response->getBody());
    }
}
