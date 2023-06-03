<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class IndexController extends AbstractController
{

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', ['apiUrl' => $this->getFetchUrl()]);
    }

    protected function getFetchUrl(): string
    {
        return $this->router->generate('app_gpt_api', [], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
