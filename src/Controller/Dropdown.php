<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Dropdown extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(){
        return $this->render('browseFilter/_dropdown.html.twig');
    }
}