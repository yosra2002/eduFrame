<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Service\DatabaseService;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class JackieController implements ControllerInterface
{
    public function execute(Request $request): string|null
    {
        //request gere lensemble des req  http
        $stateCrud = "create";
        $user = null;


        //etape1: recuperation de l'objet de la connexion a la base de donnée
        $connect = DatabaseService::getConnect();
        //etape crud creation dun nv nom //verifier si on est en methode post
        if ($request->get("stateCrud") == "create" && $request->getHttpMethod() == "POST" && $request->get('nom') != null) {
            //query=requete
            $connect->query("INSERT INTO user(id,nom)VALUES (NULL,'" . $request->get('nom') . "')");
        }
        //suppri le nom
        if ($request->get("stateCrud") == "supprimer" && $request->getHttpMethod() == "GET" && $request->get('user_id') != null) {

            $connect->query("DELETE FROM user WHERE user.id=" . $request->get('user_id'));
        }

        // Mise à jour du nom

        // if ($request->get("stateCrud")=="update"&&$request->getHttpMethod()=="GET"&&$request->get('user_id')!=null) {
        //  $connect->query("UPDATE user SET user.nom = '" . $request->get('user_id') . "' WHERE id = " . $request->get('user_id'));
         $com=$connect->fetch();
        // Mise à jour du nom
        if ($request->get("stateCrud") == "update" && $request->getHttpMethod() == "POST" && $request->get('user_id') != null && $request->get('nom') != null) {
            $user_id = $request->get('user_id');
            $nom = $request->get('nom');
            $connect->query("UPDATE user SET nom = '" . $nom . "' WHERE id = " . $user_id);
        }



          //liste des users
        //etp2:Ecrire ma requete SQL
        //$statement=préparer et valider ma requete
        $statement=$connect->query("SELECT * FROM user");
        //etp3 recup des données
        //executer la requete sql
        $users=$statement->fetchAll();

		return TwigCore::getEnvironment()->render('jackie/jackie.html.twig',
		    [
		        "titre"   => 'JackieController',
		        "request" => $request,
                 "listeusers"=>$users,
                "stateCrud"=>$stateCrud,
                "com"=>$com
		    ]
		);
	}


}
