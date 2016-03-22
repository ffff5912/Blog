<?php
namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @param  [string] $year
     * @param  [string] $month
     * @return ArrayCollection<BrogArticle>
     */
    public function getPostByYearAndMonth($year, $month)
    {
        $posts = $this->repository->findByYearAndMonth($year, $month);
        $post_collection = new ArrayCollection($posts);

        return $post_collection;
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
