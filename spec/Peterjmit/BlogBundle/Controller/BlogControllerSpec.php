<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class BlogControllerSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        ManagerRegistry $registry,
        ObjectManager $manager,
        ObjectRepository $repository,
        EngineInterface $templating
    ) {
        $container->has('doctrine')->willReturn(true);
        $container->get('doctrine')->willReturn($registry);
        $container->get('templating')->willReturn($templating);

        $registry->getManager()->willReturn($manager);
        $manager->getRepository('PeterjmitBlogBundle:Blog')->willReturn($repository);

        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action(
        ObjectRepository $repository,
        EngineInterface $templating,
        Response $mockResponse
    ) {
        $repository->findAll()->willReturn(array());

        $templating
            ->renderResponse(
                'PeterjmitBlogBundle:Blog:index.html.twig',
                array('posts' => array()),
                null
            )
            ->willReturn($mockResponse)
        ;

        $response = $this->indexAction();

        $response->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
