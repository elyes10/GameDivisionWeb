<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualite", name="actualite")
     */
    public function view(Request $request, PaginatorInterface $paginator): Response

    {
        $actualites = $this->getDoctrine()->getRepository(Actualite::class)->findBy(
            array(),        // $where
            array('clicks' => 'DESC')                // $OrderBy
        );
        $actualites = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1),
            4
        );

        $latest = $this->getDoctrine()->getRepository(Actualite::class)->findBy(
            array(),        // $where
            array('date' => 'DESC'),    // $orderBy
            2,                        // $limit
            0                          // $offset
        );

        return $this->render('front.html.twig',array(
            'actualites'=> $actualites,
            'latest' => $latest));
    }

    /**
     * @Route("/add_actualite", name="add_actualite")
     */
    public function add_actualite(Request $request): Response

    {
        $act = new Actualite();
        $form = $this->createForm(ActualiteType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $act->setImage($fileName);
            try{
                $file->move(
                    $this->getParameter('Image_directory'),
                    $fileName
                );
            }
            catch (FileNotFoundException $e){}
            $act->setClicks(0);
            $act->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($act);
            $em->flush();
            return $this->redirectToRoute("actualite");

        }

        return $this->render('actualite/add.html.twig',array(
            'form'=> $form->createView()));
    }

    /**
     * @Route("/view/{id}", name="view_actu_by_id")
     */
    public function view_actu_by_id(int $id): Response

    {
        $actualite = $this->getDoctrine()->getRepository(Actualite::class)->find($id);
        $actualite->setClicks($actualite->getClicks() + 1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->render('actualite/view.html.twig',array(
            'actualite'=> $actualite));
    }

//hellooo
}
