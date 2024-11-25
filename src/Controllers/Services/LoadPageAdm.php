<?php

namespace Src\Controllers\Services;

use Src\helpers\GenerateLog;

class LoadPageAdm
{
    private string $urlController = '';
    private string $urlParam = '';
    private string $classLoad;
    private array $listPgPublic = ["Login","Error403"];
    private array $listPgPrivate  = ["Dashboard","ListUsers"];
    private array $listDirectory = ["login", "dashboard", "users","errors"];
    public function loadPageAdm(string | null $urlController, string | null $urlParam) : void
    {
        $this->urlController = $urlController;  // Atribuindo o parâmetro à variável de instância
        $this->urlParam = $urlParam;

        if(!$this->checkPageExists()) {
            GenerateLog::generateLog("error", "Página não encontrada!", ['pagina' => $this->urlController,
            'parametro' => $this->urlParam]);
            die("Erro 002: Por favor, tente novamente. Caso o erro persista, entre em contato
            com o administrador {$_ENV['EMAIL_ADM']}");
        } 

        if(!$this->checkControllersExists()) {
            GenerateLog::generateLog("error", "Controller não encontrada!", ['pagina' => $this->urlController,
            'parametro' => $this->urlParam]);
            die("Erro 003: Por favor, tente novamente. Caso o erro persista, entre em contato
            com o administrador {$_ENV['EMAIL_ADM']}");
        }
        
    }

    private function checkPageExists():bool
    {
        if(in_array($this->urlController, $this->listPgPublic)) {
            return true;
        }

        if(in_array($this->urlController, $this->listPgPrivate)) {
            return true;
        }

        return false;
    }

    private function checkControllersExists():bool
    {
        foreach($this->listDirectory as $directory)
        {
            $this->classLoad = "\\Src\\Controllers\\$directory\\" . $this->urlController;
            if(class_exists($this->classLoad)) {
                $this->loadMethod();
                return true;
            }
        }
        return false;
    }

    private function loadMethod() :void
    {
        $classLoad = new $this->classLoad();

        if(method_exists($classLoad, "index")){
            $classLoad -> {"index"}($this->urlParam);
            GenerateLog::generateLog("info", "Página acessada!", ['pagina' => $this->urlController,
            'parametro' => $this->urlParam]);
        }else{
            GenerateLog::generateLog("error", "Método não encontrado!", ['pagina' => $this->urlController,
            'parametro' => $this->urlParam]);
            die("Erro 004: Por favor, tente novamente. Caso o erro persista, entre em contato
            com o administrador {$_ENV['EMAIL_ADM']}");
        }
    }
}