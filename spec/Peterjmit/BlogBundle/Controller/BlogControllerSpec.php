<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action()
    {
        $response = $this->indexAction();

        $response->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
