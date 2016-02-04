<?php
namespace AppBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\BlogArticle;
use AppBundle\Repository\RepositoryInterface;

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
     * @param BlogArticleRepository $repository
     * @DI\InjectParams({
     *   "repository" = @DI\Inject("app.blog_article_repository")
     * })
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ArrayCollection<BlogArticle>
     */
    public function getAllPosts()
    {
        return $this->repository->findAll();
    }

    /**
     * @param  BlogArticle $blog_article
     */
    public function add(BlogArticle $blog_article)
    {
        $this->repository->add($blog_article);

        return $blog_article;
    }

    /**
     * @param  BlogArticle $blog_article
     */
    public function remove(BlogArticle $blog_article)
    {
        $this->repository->remove($blog_article);
    }
}
