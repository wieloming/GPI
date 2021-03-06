<?php


namespace GPI\Sonata\BlockBundle\Block;


use Doctrine\ORM\EntityManager;
use GPI\AuctionBundle\Entity\AuctionFilterParams;
use GPI\AuctionBundle\Entity\AuctionRepository;
use GPI\CoreBundle\Model\Auction\AuctionStatus;
use GPI\CoreBundle\Model\Service\Cron;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Knp\Component\Pager\Paginator;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use GPI\Sonata\ClassificationBundle\Entity\CategoryRepository;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Symfony\Component\HttpFoundation\RequestStack;

class AuctionBlockService extends BaseBlockService implements PaginatorAwareInterface
{

    /**
     * @var CategoryRepository
     */
    private $catRepo;


    private $or;
    /**
     * @var $paginator \Knp\Component\Pager\Paginator
     */
    private $paginator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /** @var \GPI\CoreBundle\Model\Service\Cron  */
    private $cron;

    /**
     * @param string $name
     * @param EngineInterface $templating
     * @param AuctionRepository $or
     * @param EntityManager $em
     * @param CategoryRepository $catRepo
     * @param Cron $cron
     */
    public function __construct($name, EngineInterface $templating, AuctionRepository $or, EntityManager $em, CategoryRepository $catRepo, Cron $cron)
    {
        $this->name = $name;
        $this->templating = $templating;
        $this->or = $or;
        $this->em = $em;
        $this->catRepo = $catRepo;
        $this->cron = $cron;

    }

    public function getName()
    {
        return 'Lista Aukcji';
    }

    public function getDefaultSettings()
    {
        return array();
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title' => 'Lista Aukcji',
            'template' => 'GPISonataBlockBundle:Block:block_core_auction.html.twig',
        ));
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('title', 'text', array('required' => false)),
            )
        ));
    }


    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    public function setRequest(RequestStack $request_stack)
    {
        $this->request = $request_stack->getCurrentRequest();
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $this->cron->cron5();


        $searchParams = new AuctionFilterParams();
        $categorySlug = $this->request->get('categorySlug');
        $searchParams->setCategory($this->catRepo->findOneBy(array('slug' => $categorySlug)));
        $searchParams->setName($this->request->get('name'));


        $auctions = $this->or->filterBy($searchParams);

        $settings = $blockContext->getSettings();

        $pagination = $this->paginator->paginate(
            $auctions,
            $this->request->query->get('page', 1),
            5
        );

        return $this->renderResponse($blockContext->getTemplate(), array(
            'pagination' => $pagination,
            'block' => $blockContext->getBlock(),
            'settings' => $settings,
            'searchParam'=> $searchParams->getName(),
            'auctionStatus' => new AuctionStatus()
        ), $response);
    }

    /**
     * Sets the KnpPaginator instance.
     *
     * @param Paginator $paginator
     *
     * @return mixed
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }
}