<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Service\DatabaseService;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HelloController implements ControllerInterface
{
	public function execute(Request $request): string|null
	{

      $connect=DatabaseService::getConnect();
      //PHP PDO

        $statement=$connect->query(query: "SELECT * FROM user");

        var_dump($statement->fetchAll());
		return TwigCore::getEnvironment()->render('hello/hello.html.twig',
		    [
		        "titre"   => 'HelloController',
		        "village" => $request->get('ville')//variable cree ici vont etre dispo dans .twig
		    ]
		);
	}

}
