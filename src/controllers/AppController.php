<?php

class AppController{
    private $request;
    public function __construct(){
        $this->request = $_SERVER['REQUEST_METHOD'];
    }
    protected function isPost(): bool{
        return $this->request === 'POST';
    }
    protected function isGet(): bool{
        return $this->request === 'GET';
    }
    protected function render(string $template = null, array $variables = []){
        $templatePath = 'public/views/'.$template.'.php';
        if(file_exists($templatePath)){
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        else{
            $output = "File not found";
        }
        print $output;
    }
    protected function renderWhenCookiesAreSet($template, array $variables = []){
        if(!(isset($_COOKIE['name']) && isset($_COOKIE['surname']) && isset($_COOKIE['id']))){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }
        else $this->render($template, $variables);
    }
}