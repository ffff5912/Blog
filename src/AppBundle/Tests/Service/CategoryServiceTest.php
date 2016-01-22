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

    protected function setUp()
    {
        $this->repository = $this->getMockBuilder(CategoryRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->category_service = new CategoryService($this->repository);
    }
}
