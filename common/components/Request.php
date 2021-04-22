<?php
namespace common\components;

class Request extends \yii\web\Request {
    public $web;
    public $adminUrl;

    public function getBaseUrl(){
        return str_replace($this->web, "", parent::getBaseUrl()) . $this->adminUrl;
    }
    
    public function getActualBaseUrl(){
        return str_replace($this->web, "", parent::getBaseUrl());
    }
    
    public function resolvePathInfo(){
        if($this->getUrl() === $this->adminUrl){
            return "";
        }else{
            return parent::resolvePathInfo();
        }
    }
}