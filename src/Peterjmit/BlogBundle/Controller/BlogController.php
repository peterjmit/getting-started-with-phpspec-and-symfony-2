<?php

namespace Peterjmit\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $posts = $entityManager->getRepository('PeterjmitBlogBundle:Blog')->findAll();

        return $this->render('PeterjmitBlogBundle:Blog:index.html.twig', array(
            'posts' => $posts
        ));
    }
}
