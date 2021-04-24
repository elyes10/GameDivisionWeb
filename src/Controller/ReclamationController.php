<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Reclamation;
use App\Form\ActualiteType;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/rec", name="rec")
     */
    public function affiche(ReclamationRepository $rep)

    {
        $rec = $rep->findBy([], ['id' => 'DESC']);
        return $this->render('reclamation/index.html.twig', [
            'rec' => $rec
        ]);
    }
    /**
     * @Route("/d/{id}",name="d")
     */
    public function supprimer($id,ReclamationRepository $rep)
    {
        $em = $this->getDoctrine()->getManager();
        $rec = $rep->find($id);
        $em->remove($rec);
        $em->flush();//les deux lignes la supprission
        $this->addFlash('success', "rec supprimé avec succes!");
        return $this->redirectToRoute('rec');
    }


    /**
     * @Route("/update/{id}",name="update")
     */
    public function valider(int $id){
        $rec = new Reclamation();
        $em=$this->getDoctrine()->getManager();
        $rec=$em->getRepository(Reclamation::class)->find($id);
        $rec->setTraite("traité");

            $em->flush();
            $this->addFlash('success', "Blog modifié!");
            return $this->redirectToRoute('rec');

    }

    /**
     * @Route("/add", name="ajouter")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addReclamation(Request $request): Response
    {
        $rec = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $rec);
//        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $rec->setImage($fileName);
            try{
                $file->move(
                    $this->getParameter('Image_directory'),
                    $fileName
                );

            }
            catch (FileNotFoundException $e){}

            $em = $this->getDoctrine()->getManager();
            $rec->setTraite("non traité");

            $rec->setID_U(5);

            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute("rec");

        }

        return $this->render('reclamation/add.html.twig',array(
            'form'=> $form->createView()));
    }
}