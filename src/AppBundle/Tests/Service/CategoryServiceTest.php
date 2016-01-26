<?php
namespace AppBundle\Tests\Service;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Service\CategoryService;

class CategoryServiceTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @var CategoryService
     */
    private $category_service;

    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * @test
     */
    public function addSuccess()
    {
        $category = new Category(1);
        $category->setName('test');

        $this->repository->expects($this->once())
            ->method('add');

        $result = $this->category_service->add($category);

        $this->assertInstanceOf('AppBundle\Entity\Category', $result);
    }

    /**
     * @test
     */
    public function getAllSuccess()
    {
        $categories = new ArrayCollection();
        $categories->add(
            $this->createCategory(1, 'test1'),
            $this->createCategory(2, 'test2')
        );

        $this->repository->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($categories));

        $result = $this->category_service->getAll();

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $result);
        $this->assertInstanceOf('AppBundle\Entity\Category', $result->get(0));
        $this->assertTrue(1 === $result->get(0)->getId());
    }

    private function createCategory($id, $name)
    {
        $category = new Category($id);
        $category->setName($name);

        return $category;
    }

    protected function setUp()
    {
        $this->repository = $this->getMockBuilder(CategoryRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->category_service = new CategoryService($this->repository);
    }
}
