<?php

namespace Controller;

use Studoo\EduFramework\Core\ConfigCore;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController implements ControllerInterface
{
    /**
     * @param Request $request Requête HTTP
     * @return string|null
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function execute(Request $request): string|null
    {
        var_dump(ConfigCore::getConfig('version'));//voir la version du framework
        return TwigCore::getEnvironment()->render('home/Home.html.twig',
            [
                'titre'   => 'Hello World !',
                'requete' => $request
            ]
        );
    }

}
