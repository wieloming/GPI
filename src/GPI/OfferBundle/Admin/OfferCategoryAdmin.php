<?php

namespace GPI\OfferBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\Component\Product\Pool;
use Knp\Menu\ItemInterface as MenuItemInterface;

class OfferCategoryAdmin extends Admin
{
    protected $parentAssociationMapping = 'product';

    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $correctAction = in_array(
            $action,
            array('edit')
        );
        if (!$childAdmin && !$correctAction) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            $this->trans(
                'offer.sidemenu.link_offer_edit',
                array(),
                'SonataOfferBundle'
            ),
            array(
                'uri' => $admin->generateUrl(
                    'edit',
                    array('id' => $id)
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setTranslationDomain('SonataOfferBundle');
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        if (!$this->isChild()) {
            $formMapper->add(
                'offer',
                'sonata_type_model_list',
                array(),
                array(
                    'admin_code' => 'gpi_offer.admin.offer'
                )
            );
        }

        $formMapper
            ->add('category')
            ->add('main')
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {
        if (!$this->isChild()) {
            $list
                ->addIdentifier('id')
                ->addIdentifier(
                    'offer',
                    null,
                    array(
                        'admin_code' => 'gpi_offer.admin.offer'
                    )
                );
        }

        $list
            ->addIdentifier('category');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $filter
     *
     * @return void
     */
    public function configureDatagridFilters(DatagridMapper $filter)
    {
        if (!$this->isChild()) {
            $filter
                ->add('category');
        }
    }
}
