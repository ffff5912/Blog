<?php
namespace AppBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\Category;
use AppBundle\Repository\RepositoryInterface;

/**
 * @DI\Service("app.category_service")
 */
class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * @param CategoryRepository $repository
     * @DI\InjectParams({
     *   "repository" = @DI\Inject("app.category_repository")
     * })
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ArrayCollection<Category>
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param  Category $category
     * @return Category
     */
    public function add(Category $category)
    {
        $this->repository->add($category);

        return $category;
    }

    /**
     * @param  Category $category
     */
    public function remove(Category $category)
    {
        $this->repository->remove($category);
    }

    public function update()
    {
        $this->repository->flush();
    }
}
