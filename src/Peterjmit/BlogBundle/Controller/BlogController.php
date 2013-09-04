<?php

namespace Peterjmit\BlogBundle\Controller;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class BlogController
{
    private $doctrine;
    private $templating;

    public function __construct(ManagerRegistry $doctrine, EngineInterface $templating)
    {
        $this->doctrine = $doctrine;
        $this->templating = $templating;
    }

    public function indexAction()
    {
        $entityManager = $this->doctrine->getManager();
        $posts = $entityManager->getRepository('PeterjmitBlogBundle:Blog')->findAll();

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:index.html.twig', array(
            'posts' => $posts
        ));
    }

    public function showAction($id)
    {
        $entityManager = $this->doctrine->getManager();
        $post = $entityManager->getRepository('PeterjmitBlogBundle:Blog')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('Blog post %s was not found', $id));
        }

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:show.html.twig', array(
            'posts' => $posts
        ));
    }
}
