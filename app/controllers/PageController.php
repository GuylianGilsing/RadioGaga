<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Core\Views\TwigView;

class PageController
{
    public function displayHomePage(Request $request, Response $response)
    {
        $output = "";

        $view = new TwigView('home');
        $view->setRequest($request);
        $view->load();

        $output = $view->render();

        $response->getBody()->write($output);
        return $response;
    }
}