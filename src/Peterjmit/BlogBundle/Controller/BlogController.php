<?php

namespace Peterjmit\BlogBundle\Controller;

use Peterjmit\BlogBundle\Doctrine\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController
{
    private $repository;
    private $templating;

    public function __construct(BlogRepository $repository, EngineInterface $templating)
    {
        $this->repository = $repository;
        $this->templating = $templating;
    }

    public function indexAction()
    {
        $posts = $this->repository->findAll();

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:index.html.twig', array(
            'posts' => $posts
        ));
    }

    public function showAction($id)
    {
        $post = $this->repository->find($id);

        if (!$post) {
            throw new NotFoundHttpException(sprintf('Blog post %s was not found', $id));
        }

        return $this->templating->renderResponse('PeterjmitBlogBundle:Blog:show.html.twig', array(
            'post' => $post
        ));
    }
}
