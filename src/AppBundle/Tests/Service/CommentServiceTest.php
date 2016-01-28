<?php
namespace AppBundle\Tests\Service;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Comment;
use AppBundle\Repository\CommentRepository;
use AppBundle\Service\CommentService;

class CommentServiceTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @var CommentService
     */
    private $Comment_service;

    /**
     * @var CommentRepository
     */
    private $repository;

    /**
     * @test
     */
    public function addSuccess()
    {
        $comment = new Comment();
        $comment->setComment('test');

        $this->repository->expects($this->once())
            ->method('add');

        $result = $this->comment_service->add($comment);

        $this->assertInstanceOf('AppBundle\Entity\Comment', $result);
    }

    protected function setUp()
    {
        $this->repository = $this->getMockBuilder(CommentRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->comment_service = new CommentService($this->repository);
    }
}
