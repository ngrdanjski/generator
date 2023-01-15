<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        return $this->render('homepage/index.html.twig', [
            'media' => $entityManager->getRepository(Media::class)->findAll(),
        ]);
    }
}
