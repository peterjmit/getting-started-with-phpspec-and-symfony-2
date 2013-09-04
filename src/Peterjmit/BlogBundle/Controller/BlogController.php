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

    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository('PeterjmitBlogBundle:Blog')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('Blog post %s was not found', $id));
        }

        return $this->render('PeterjmitBlogBundle:Blog:show.html.twig', array(
            'posts' => $posts
        ));
    }
}
