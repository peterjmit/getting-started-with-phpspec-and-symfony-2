<?php

namespace spec\Peterjmit\BlogBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Peterjmit\BlogBundle\Doctrine\BlogRepository;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class BlogControllerSpec extends ObjectBehavior
{
    function let(
        BlogRepository $repository,
        EngineInterface $templating
    ) {
        $this->beConstructedWith($repository, $templating);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Peterjmit\BlogBundle\Controller\BlogController');
    }

    function it_should_respond_to_index_action(
        BlogRepository $repository,
        EngineInterface $templating,
        Response $mockResponse
    ) {
        $repository->findAll()->willReturn(array('An array', 'of blog', 'posts!'));

        $templating
            ->renderResponse(
                'PeterjmitBlogBundle:Blog:index.html.twig',
                array('posts' => array('An array', 'of blog', 'posts!'))
            )
            ->willReturn($mockResponse)
        ;

        $response = $this->indexAction();

        $response->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }

    function it_shows_a_single_blog_post(
        BlogRepository $repository,
        EngineInterface $templating,
        Response $response
    ) {
        $repository->find(1)->willReturn('A blog post');

        $templating
            ->renderResponse(
                'PeterjmitBlogBundle:Blog:show.html.twig',
                Argument::withEntry('post', 'A blog post')
            )
            ->willReturn($response)
        ;

        $this->showAction(1)->shouldReturn($response);
    }

    function it_throws_an_exception_if_a_blog_post_doesnt_exist(BlogRepository $repository)
    {
        $repository->find(999)->willReturn(null);

        $this
            ->shouldThrow('Symfony\Component\HttpKernel\Exception\NotFoundHttpException')
            ->duringShowAction(999)
        ;
    }
}
