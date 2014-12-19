<?php

namespace GPI\OfferBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OfferAdminController extends CRUDController
{
    public function deactivateAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        /**
         * @var $object \GPI\OfferBundle\Entity\Offer
         */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if($object->isDeactivated()){
            $this->addFlash('sonata_flash_error', 'Oferta jest już wyłączona.');
        }else{
            $object->deactivate();
            $this->getDoctrine()->getManager()->flush($object);
            $this->addFlash('sonata_flash_success', 'Wyłączono ofertę');
        }

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    public function activateAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        /**
         * @var $object \GPI\OfferBundle\Entity\Offer
         */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if(!$object->isDeactivated()){
            $this->addFlash('sonata_flash_error', 'Oferta jest już włączona.');
        }else{
            $object->activate();
            $this->getDoctrine()->getManager()->flush($object);
            $this->addFlash('sonata_flash_success', 'Włączono ofertę');
        }

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}