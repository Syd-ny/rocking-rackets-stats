<?php

namespace App\Controllers;

use App\Models\AppUser;

class SecurityController extends CoreController
{
    /**
     * Méthode qui affiche le formulaire de login
     */
    public function login(){

        $this->show("security/login");
    }

    /**
     * Méthode qui traite le form de login
     */
    public function loginValid(){

        global $router;
        // Je récupère les champs en post
        $pseudo = filter_input(INPUT_POST, "pseudo");
        $password = filter_input(INPUT_POST, "password");

        // Je récupère l'utilisateur en bdd s'il existe
        $user = AppUser::findByPseudo($pseudo);
        
        // dd($user->getPassword(), $password);
        // Je compare son mdp au mdp fournis si un utilisateur a bien été trouvé
        if($user && password_verify($password,$user->getPassword())){
            // La création de la session permet de garder cet état de "connecté"
            $_SESSION["user"] = $user;
            header("Location: ".$router->generate("main-home"));
            exit;
        }else{
            // TODO redirection page login avec message d'erreur
            header("Location: ".$router->generate("security-login"));
            exit;
        }

    }

    /**
     * Deconnecte l'utilisateur courant
     */
    public function logout(){

        global $router;

        // Je unset la session qui supprime "l'état" connecté
        unset($_SESSION['user']);
        header("Location: ".$router->generate('main-home'));
    }
}