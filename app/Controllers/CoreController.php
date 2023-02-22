<?php

namespace App\Controllers;


abstract class CoreController
{

    public function __construct(){
   
        
        global $match;
        
       
        $routeName = $match["name"];

        
        $acl = [
            //"main-home" => ["admin", "user"],

        ];

       
        if(array_key_exists($routeName, $acl)){
            $this->checkAuthorizations($acl[$routeName]);
        }

        // ! CSRF TOKEN

    
        $csrfTokenToCreate = [
            //"main-home",
        ];

        if(in_array($routeName,$csrfTokenToCreate)){
            $token = bin2hex(random_bytes(32));
            
            $_SESSION["csrfToken"] = $token;
        }

        $csrfTokenToCheck = [
        ];

        if(in_array($routeName, $csrfTokenToCheck)){

            if(isset($_POST["csrfToken"])){
                $token = $_POST['csrfToken'];
            }else{
                $token = null;
            }

            if(isset($_SESSION['csrfToken'])){
                $sessionToken = $_SESSION['csrfToken'];
            }else{
                $sessionToken = null;
            }

            if($token != $sessionToken || empty($token)){
                $errorController = new ErrorController();
                $errorController->err403();
                exit;
            }else{
                unset($_SESSION['csrfToken']);
            }
        }
    }
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, array $viewData = [])
    {
        global $router;

        
        $viewData['currentPage'] = $viewName;

        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        extract($viewData);
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
        
        unset($_SESSION["alert"]);
    }

    /**
     * Check si un des roles fournis correspond bien au role de l'utilisateur
     * 
     * @param array $roles roles autorisés 
     * @return void|true
     */
    protected function checkAuthorizations(array $roles){

        if(isset($_SESSION['user'])){
            
            $userRole = $_SESSION['user']->getRole();

            if(in_array($userRole,$roles)){
                return true;
            }else{
                $errorController = new ErrorController();

                $errorController->err403();
                exit;
            }
          
        }else{
            global $router;

            header("Location: ".$router->generate("security-login"));
        }
    }

    /**
     * Méthode permettant de stocker un message flash dans la session
     * @param string $type le type de message correspondant à un type bootstrap
     * @param array $messages les messages à afficher
     */
    protected function alert(string $type, array $messages){
        $_SESSION['alert'] = [
            "type" => $type,
            "messages" => $messages
        ];
    }
}
