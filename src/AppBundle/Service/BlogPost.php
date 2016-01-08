<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.blog_post")
 */
class BlogPost
{
    private $entity_manager;

    /**
     * @param EntityManager $entity_manager
     * @DI\InjectParams({
     *   "entity_manager" = @DI\Inject("entity_manager")
     * })
     */
    public function __construct(EntityManager $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    public function run(BlogArticle $blog_article)
    {
        
    }
}
