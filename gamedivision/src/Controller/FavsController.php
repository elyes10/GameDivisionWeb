<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Favourites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FavsController extends AbstractController
{
    /**
     * @Route("/favs", name="favs")
     */
    public function index(): Response
    {
        $currentPage = 20;
        $repository=$this->getDoctrine()->getRepository(Products::class);
        $products=$repository->findAll();
       // $paginator = $this->paginate($products, $currentPage);

     //   return $paginator;
        return $this->render('favs/index.html.twig', [
            'controller_name' => 'FavsController','products'=>$products
        ]);
    }
    public function inputcontrol($i,$j):? int
    {
        $repository=$this->getDoctrine()->getRepository(Favourites::class);
        $result=$repository->findBy(array('user_id' => $i,'Product_id'=>$j)
          );
        if($result!=null)
        {
            return 1;
        }
        else {
            return - 1;
        }
    }
    /**
     * @Route("/addtofavs{id}", name="add2favs")
     */

    public function add($id)
    {
        $activ_user_id=30;
        $entityManager = $this->getDoctrine()->getManager();
        $Fav = new Favourites($activ_user_id,$id);
        $repository=$this->getDoctrine()->getRepository(Favourites::class);
       // $result=$repository->findBy(['userId' => $activ_user_id],['productId'=>$id]);
       // if($result==null)
        //{
            $entityManager->persist($Fav);
        $entityManager->flush();
        //}
        return $this->redirectToRoute('favs');
    }
    /**
     * @Route("/deletefromfavs{id}", name="delete")
     */
    public function delete($id)
    {
        $activ_user_id=10;
        $em = $this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getRepository(Favourites::class);
        $Fav = new Favourites($activ_user_id,$id);
        //$repository=$this->getDoctrine()->getRepository(Favourites::class);
        //$f=$repository->findBy(['userId' => $activ_user_id],['productId'=>$id]);
        $query = $em->createQuery('
        delete  from
       App\Entity\Favourites f 
        where f.userId = :_user
        and f.productId = :_product
        ');
        $query->setParameter(":_user", $activ_user_id);
        $query->setParameter(":_product", $id);
        $products = $query->getResult();
        return $this->redirectToRoute('list');
        return $this->render('favs/myfavourites.html.twig', [
            'controller_name' => 'FavsController','products'=>$products,]);


    }
    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {
        $activ_user_id=10;
        $repository=$this->getDoctrine()->getRepository(Favourites::class);
        $em= $this->getDoctrine()->getManager();

        $query = $em->createQuery('
        select
        p.productId as id,p.productName as n,p.category as c,p.price as pr,p.quantity as q,p.teamId as t,p.img as i
        from App\Entity\Products p
        LEFT JOIN App\Entity\Favourites f WITH f.productId=p.productId
        where f.userId = :_user
        
        ');
        $query->setParameter(":_user", $activ_user_id);
        $products = $query->getResult();

        return $this->render('favs/myfavourites.html.twig', [
            'controller_name' => 'FavsController','products'=>$products,
        ]);
    }

}
