<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Recup_APIController implements ControllerInterface
{
	public function execute(Request $request): string|null
	{

		return TwigCore::getEnvironment()->render('recup__a_p_i/recup__a_p_i.html.twig',
		    [
		        "titre"   => 'Recup_APIController',
		        "request" => $request
		    ]
		);
	}
}
