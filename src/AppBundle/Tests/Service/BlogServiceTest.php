<?php
namespace AppBundle\Tests\Service;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\BlogArticle;
use AppBundle\Repository\BlogArticleRepository;
use AppBundle\Service\BlogService;

class BlogServiceTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @var BlogService
     */
    private $blog_service;

    /**
     * @var BlogArticleRepository
     */
    private $repository;

    /**
     * @test
     */
    public function addSuccess()
    {
        $blog_article = new BlogArticle();
        $blog_article->setId(1);
        $blog_article->setTitle('test');
        $blog_article->setContent('content');

        $this->repository->expects($this->once())
            ->method('add');

        // arrange
        $this->repository->expects($this->any())
            ->method('find')
            ->with(1)
            ->will($this->returnValue($blog_article));

        $this->blog_service->add($blog_article);

        $this->assertEquals($blog_article, $this->repository->find(1));
    }

    /**
     * @test
     */
    public function getAllPostsSuccess()
    {
        $blogs = new ArrayCollection();
        $blog_article = new BlogArticle();
        $blog_article->setId(1);
        $blog_article->setTitle('test');
        $blog_article->setContent('content');
        $blogs->add($blog_article);

        $blog_article = new BlogArticle();
        $blog_article->setId(2);
        $blog_article->setTitle('test_2');
        $blog_article->setContent('content_2');
        $blogs->add($blog_article);

        $this->repository->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($blogs));

        $posts = $this->blog_service->getAllPosts();

        $post = $posts->first();
        $this->assertCount(2, $posts->toArray());
        $this->assertInstanceOf('AppBundle\Entity\BlogArticle', $post);
        $this->assertEquals(1, $post->getId());
    }

    protected function setUp()
    {
        $this->repository = $this->getMockBuilder(BlogArticleRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blog_service = new BlogService($this->repository);
    }
}
