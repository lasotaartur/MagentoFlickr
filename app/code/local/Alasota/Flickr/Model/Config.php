<?php

class Alasota_Flickr_Model_Config
{
    private $consumerKey = '86748f9fb06a48ee21a1d52f5212312';
    private $consumerSecret = '769900c297e2132';
    private $pageAddr = 'http://www.test.com';
    
    /**
     * 
     * @return string
     */
    public function getConsumerKey() {
        return $this->consumerKey;
    }

    /**
     * 
     * @return string
     */
    public function getConsumerSecret() {
        return $this->consumerSecret;
    }
    
    /**
     * 
     * @return string
     */
    public function getPageAddr() {
        return $this->pageAddr;
    }
}