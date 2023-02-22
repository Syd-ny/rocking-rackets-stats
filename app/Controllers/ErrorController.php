<?php

namespace App\Controllers;


class ErrorController extends CoreController
{

    public function __construct()
    {
        
    }
    /**
     * Méthode gérant l'affichage de la page 404
     *
     * @return void
     */
    public function err404()
    {
        http_response_code(404);

        $this->show('error/err404');
    }

    /**
     * Méthode gérant l'affichage de la page 403
     *
     * @return void
     */
    public function err403()
    {

        http_response_code(403);

        $this->show('error/err403');
    }
}
