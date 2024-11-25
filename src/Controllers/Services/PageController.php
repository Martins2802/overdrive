<?php

namespace Src\Controllers\Services;
use Src\helpers\ClearUrl;
use Src\helpers\SlugController;

class PageController 
{
    private String $url;
    private array $urlArray;
    private String $urlController = '';
    private String $urlParam = '';
    public function __construct()
    {
        if(!empty(filter_input(INPUT_GET,'url',FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET,'url',FILTER_DEFAULT);

            $this->url = ClearUrl::clearUrl($this->url);
            $this->urlArray = explode("/", $this->url);
            if(isset($this->urlArray[0])) {
                $this->urlController = SlugController::slugController($this->urlArray[0]);
            }else {
                $this->urlController = SlugController::slugController("Login");
            }
            if(isset($this->urlArray[1])) {
                $this->urlParam = $this->urlArray[1];
            }

        }else {
            $this->urlController = SlugController::slugController("Login");
        }
    }
    public function loadPage():void
    {
        $loadPageAdm = new LoadPageAdm();

        $loadPageAdm -> loadPageAdm($this->urlController, $this->urlParam);
    }
}
    