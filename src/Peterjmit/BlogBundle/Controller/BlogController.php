<?php

namespace Peterjmit\BlogBundle\Controller;

use Peterjmit\BlogBundle\Model\BlogManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController
{
    private $manager;
    private $templating;

    public function __construct(BlogManagerInterface $manager, EngineInterface $templating)
    {
        $this->manager = $manager;
        $this->templating = $templating;
    }

    public function indexAction()
    {
        $posts = $this->manager->findAll();

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:index.html.twig', array(
            'posts' => $posts
        ));
    }

    public function showAction($id)
    {
        $post = $this->manager->find($id);

        if (!$post) {
            throw new NotFoundHttpException(sprintf('Blog post %s was not found', $id));
        }

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:show.html.twig', array(
            'post' => $post
        ));
    }
}
