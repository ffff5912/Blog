<?php
namespace AppBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\Comment;
use AppBundle\Repository\CommentRepository;

/**
 * @DI\Service("app.comment_service")
 */
class CommentService
{
    /**
     * @var CommentRepository
     */
    private $repository;

    /**
    * @param CommentRepository $repository
     * @DI\InjectParams({
     *   "repository" = @DI\Inject("app.comment_repository")
     * })
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Comment $comment
     */
    public function add(Comment $comment)
    {
        $this->repository->add($comment);
    }
}
