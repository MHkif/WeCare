<?php
/*
   * App Router Class
   * Creates URL & loads Router controller
   * URL FORMAT - /controller/method/params
   */
class Router
{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
       
        $url = $this->url();
        if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->currentController . '.php';
       
        $this->currentController = new $this->currentController;

        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }


        $this->params = $url ? array_values($url) : [];
        call_user_func([$this->currentController, $this->currentMethod], $this->params);
    }

    public function url()
    {
        if (isset($_GET['url'])) {
            // Use the PHP rtrim() function to remove the whitespace
            //  or other characters from the end of a string.
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }

        return ['0' => $this->currentController];
    }
}
