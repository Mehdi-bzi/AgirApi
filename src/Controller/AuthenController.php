<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AuthenController extends AbstractController
{
    private $tokenStored;

    public function __construct(TokenStorageInterface $tokenStored){
        $this->tokenStored = $tokenStored;
    }
    /**
     * @Route("/authen", name="authen")
     */
    public function index(): Response
    {
        return $this->render('authen/index.html.twig', [
            'controller_name' => 'AuthenController',
        ]);
    }

    public function getAgirUser(): Response{
        return $this->json(['username' => 'jane.doe']);
        // return $this->json($this->tokenStored->getToken()->getUser());
        // return $this->json($this->getUser());
        // return $this->json($this->get('security.token_storage')->getToken()->getUser());
    }
}
