<?php


namespace GPI\AuctionBundle\Controller;

use GPI\AuctionBundle\Entity\Auction;
use GPI\CoreBundle\Model\Auction\UpdateAuctionCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuctionEditController extends Controller
{
    public function editAction($id, Request $request)
    {
        /**
         * @var $repo \GPI\AuctionBundle\Entity\AuctionRepository
         */
        $repo = $this->get('gpi_auction.auction_repository');
        /**
         * @var $auction \GPI\AuctionBundle\Entity\Auction
         */
        $auction = $repo->find($id);

        if (!$auction && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                'No Auction found for id ' . $id
            );
        }

        $command = new UpdateAuctionCommand();
        $command->setName($auction->getName());
        $command->setContent($auction->getContent());
        $command->setCategories($auction->getCategories());

        $form = $this->createForm('auction_update', $command);

        $form->handleRequest($request);

        if ($form->isValid()) {

            /**
             * @var $auctionService /GPI/AuctionBundle/Service/Auction
             */
            $auctionService = $this->get('gpi_auction.service.auction');
            $auction = $auctionService->editAuction($command, $auction);

            $em = $this->getDoctrine()->getManager();
            $em->persist($auction);
            $em->flush();
            return $this->redirect($this->generateUrl('sonata_user_profile_show'));
        }

        return $this->render(
            'GPIAuctionBundle:EditAuction:index.html.twig',
            array(
                'form' => $form->createView(),
                'documents' => $auction->getDocuments()
            )
        );
    }
}
