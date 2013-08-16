<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

class BlogControllerSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        ManagerRegistry $registry,
        ObjectManager $manager,
        ObjectRepository $repository
    ) {
        $container->has('doctrine')->willReturn(true);
        $container->get('doctrine')->willReturn($registry);

        $registry->getManager()->willReturn($manager);
        $manager->getRepository('PeterjmitBlogBundle:Blog')->willReturn($repository);

        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action(ObjectRepository $repository)
    {
        $repository->findAll()->willReturn(array());

        $response = $this->indexAction();

        $response->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
