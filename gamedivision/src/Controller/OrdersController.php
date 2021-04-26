<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Repository\CartRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class OrdersController extends AbstractController
{
    /**
     * @Route("/", name="orders_index", methods={"GET"})
     */
    public function index(): Response
    {
        $orders = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->findAll();

        return $this->render('orders/index.html.twig', [
            'orders' => $orders,
        ]);
    }
    /**
     * @Route("/addCommande", name="addCommande")
     */
    public function addCommande(CartRepository $cartRepository,ProductsRepository $repository,MailerInterface $mailer){
        $order = new Orders();
        //this->getUser()
        $order->setUserId(10);
        $order->setAdrLivraison($_GET['state']);
        $order->setPostCode($_GET['zip']);
        $order->setCountry($_GET['country']);
        $date = new \DateTime();
        $s = $date->format('Y-m-d H:i:s');
        $order->setDate($s);
        $order->setListeProduit($_GET['listProduits']);
        $carts = $cartRepository->findAll();
        $prixTotal = 0;
        foreach ($carts as $c){
            $prod = $repository->find($c->getProductId());
            $prixTotal += $c->getQuantite() * $prod->getPrice();


        }
        $order->setTotalPrice($prixTotal);
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
                //mailing start
        $listprodmail=$order->getListeProduit();
        $email = (new Email())
            ->from('game.division10@gmail.com')
            ->to('elyes.zarrad@esprit.tn')
            ->subject('Order confirmation')
            ->embed(fopen('assets/Images/order.png', 'r'), 'order.png')
            ->text('Your order is confirmed , ORDER LIST: '.$listprodmail.' ' );


        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }

        //mailing end
        return $this->redirectToRoute('affichecart');
       // $order->set()

    }

    /**
     * @Route("/Ordernew", name="orders_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('orders_index');
        }

        return $this->render('orders/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param OrdersRepository $repo
     * @return Response
     * @Route("/ordershistory", name="orders_show")
     */
    public function show(OrdersRepository $repo): Response
    {  $order=$repo->findAll();
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @param OrdersRepository $repo
     * @return Response
     * @Route("/ordersback", name="orders_show_back")
     */
    public function showOrdersBackend(OrdersRepository $repo): Response
    {  $order=$repo->findAll();
        return $this->render('orders/show_orders_back.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{orderId}/edit", name="orders_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orders $order): Response
    {
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orders_index');
        }

        return $this->render('orders/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{orderId}", name="orders_delete", methods={"POST"})
     */
    public function delete(Request $request, Orders $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getOrderId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orders_index');
    }
    /**
     * @param OrdersRepository $repo
     * @return Response
     * @Route("/pdforders", name="pdforders")
     */
    public function orderspdf(OrdersRepository $repo): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $order=$repo->findAll();
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('pdfOrders.html.twig', [
            'title' => "orders pdf",
            'order' => $order,
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();
        // write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir') . '/public';

        $pdfFilepath =  $publicDirectory . '/ordersPdf.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);


        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);

    }
    /**
     * @return Response
     * @Route("/showbackend", name="showback")
     */
    public function showbackend(): Response
    {
        return $this->render('back.html.twig');
    }

    /**
     * @Route("/orderstatus/{id}", name="changestatus")
     */
    function change_order_status($id){
        $entityManager = $this->getDoctrine()->getManager();
        $order = $entityManager->getRepository(Orders::class)->find($id);

        if (!$order) {
            throw $this->createNotFoundException(
                'No order found for id '.$id
            );
        }

        $order->setStatus("Delivered");
        $entityManager->flush();

        return $this->redirectToRoute('orders_show_back');

    }
    /**
     * @param OrdersRepository $repo
     * @return Response
     * @Route("/ordersfilter", name="orders_show_filter")
     */
    public function showOrdersFiltered(OrdersRepository $repo): Response
    {  $order=$repo->findBy(['status' => 'preparation']) ;
        return $this->render('orders/show_orders_back.html.twig', [
            'order' => $order,
        ]);
    }
}
