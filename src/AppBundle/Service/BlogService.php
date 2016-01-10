<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\BlogArticle;
use AppBundle\Repository\BlogArticleRepository;

/**
 * @DI\Service("app.blog_service")
 */
class BlogService
{
    /**
     * @var BlogArticleRepository
     */
    private $repository;

    /**
     * @param EntityManager $entity_manager
     * @DI\InjectParams({
     *   "repository" = @DI\Inject("app.blog_article_repository")
     * })
     */
    public function __construct(BlogArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPosts()
    {
        return $this->repository->findAll();
    }

    /**
     * @param  BlogArticle $blog_article
     * @return
     */
    public function add(BlogArticle $blog_article)
    {
        $this->repository->add($blog_article);
    }
}