<?php

class Alasota_Flickr_AuthController extends Mage_Core_Controller_Front_Action {
    
    /**
     * It should open in popup
     */
    public function loginAction() {
        $config = new \Alasota_Flickr_Model_Config();
        $consumer = new Zend_Oauth_Consumer(array(
            'callbackUrl' => $config->getPageAddr() . '/flickr/auth/success',
            'siteUrl' => 'http://www.flickr.com/services/oauth',
            'consumerKey' => $config->getConsumerKey(),
            'consumerSecret' => $config->getConsumerSecret(),
            'requestTokenUrl' => 'http://www.flickr.com/services/oauth/request_token',
            'accessTokenUrl' => 'http://www.flickr.com/services/oauth/access_token',
            'authorizeUrl' => 'http://www.flickr.com/services/oauth/authorize'
        ));

        $token = $consumer->getRequestToken();
        $_SESSION['FLICKR_REQUEST_TOKEN'] = serialize($token);
        $consumer->redirect(array("perms" => 'read'));
    }
    
    
    /**
     * 
     * This page close pup
     */
    public function successAction() {
        $config = new \Alasota_Flickr_Model_Config();
        $consumer = new Zend_Oauth_Consumer(array(
            'callbackUrl' => $config->getPageAddr() . '/flickr/auth/success',
            'siteUrl' => 'http://www.flickr.com/services/oauth',
            'consumerKey' => $config->getConsumerKey(),
            'consumerSecret' => $config->getConsumerSecret(),
            'requestTokenUrl' => 'http://www.flickr.com/services/oauth/request_token',
            'accessTokenUrl' => 'http://www.flickr.com/services/oauth/access_token',
            'authorizeUrl' => 'http://www.flickr.com/services/oauth/authorize'
        ));

        $token = $consumer->getAccessToken($_GET, unserialize($_SESSION['FLICKR_REQUEST_TOKEN']));
        $_SESSION['FLICKR_ACCESS_TOKEN'] = serialize($token);
        return $this->getResponse()->setBody('<html><head><script>window.close();</script></head><body></body></html>');
    }
}
