<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Favourites;
use App\Repository\CartRepository;
use App\Repository\ProductsRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
    /**
     * @param CartRepository $repo
     * @return Response
     * @Route("/affichecarte", name="affichecart")
     */
    public function affiche_cart(CartRepository $repo,ProductsRepository $repository)
    {
        //$repo=$this->getDoctrine()->getRepository(Cart::class);
        $cart=$repo->findAll();
        $produits=[];
        $listProduit = "";
        $prixTotal = 0;
        foreach($cart as $panier){
            $prod = $repository->find($panier->getProductId());

            $produits[] = $prod;
            $prixTotal += $prod->getPrice() * $panier->getQuantite();
            $listProduit = $listProduit ."/product name: ".$prod->getProductName()." product id:".$prod->getProductId()." productQuantity : ".$panier->getQuantite();
        }


        return $this->render('/cart/index.html.twig', [
            'cart' => $cart,'produit'=>$produits,'listproduit'=>$listProduit,'prixTotal'=>$prixTotal
        ]);
    }

    /**
     * @param CartRepository $repo1
     * @param ProductsRepository $repo
     * @return Response
     * @Route("/afficheprod/{id}", name="cartproduct")
     */
    public function cart_product($id , ProductsRepository $repo,CartRepository $repo1)
    {
        $cart=$repo1->findAll();



        //$repo=$this->getDoctrine()->getRepository(Cart::class);
        $product=$repo->find($id);
        $names = [];
        foreach($cart as $panier){
            $prod = $repo->find($panier->getProductId());
            $names[] = $prod->getProductName();

        }

        return $this->render('/cart/index.html.twig', [
            'cart' => $cart,
            'product' => $product,'names'=>$names

        ]);
    }


    /**
     * @param CartRepository $repo
     * @return Response
     * @Route("/deletecart/{id}", name="deleteFunc")
     */
    public function delete_cart($id, CartRepository $repository){
      $cart=$repository->find($id);
      $em=$this->getDoctrine()->getManager();
      $em->remove($cart);
      $em->flush();
      return $this->redirectToRoute('affichecart');
    }

    /**
     * @param CartRepository $repo
     * @return Response
     * @Route("/deletecartall", name="deletecartall")
     */
    public function delete_cartall( CartRepository $repository){
        $cart=$repository->findAll();
        foreach ($cart as $panier){
        $em=$this->getDoctrine()->getManager();
        $em->remove($panier);
        $em->flush();}
        return $this->redirectToRoute('affichecart');
    }

    /**
     * @Route("/addtocart{id}", name="add2cart")
     * @param $id
     * @return Response1
     */
    public function addtocart($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $cart= new Cart();
        $repository=$this->getDoctrine()->getRepository(Cart::class);
        $cart->setProductId($id) ;
        $cart->setQuantite(1);
        $cart->setUserId(10) ;
        $entityManager->persist($cart);
        $entityManager->flush();

        return $this->redirectToRoute("favs");
    }


    /**
     * @Route("/quantityPlus",name="quantityPlus")
     */
    public function addQuantityPlus(CartRepository $repository,ProductsRepository $productsRepository){

        $id  = $_GET['id'];
        $quantity  = $_GET['quantite'];
        $em = $this->getDoctrine()->getManager();
        $cart = $repository->find($id);
        $cart->setQuantite($quantity+1);


        $em->flush();
        $carts = $repository->findAll();
        $listProduit = "";
        $prixTotal =0;
        foreach($carts as $panier){
            $prod = $productsRepository->find($panier->getProductId());
            $listProduit = $listProduit ."/product name: ".$prod->getProductName()." product id:".$prod->getProductId()." productQuantity : ".$panier->getQuantite();
            $prixTotal += $prod->getPrice() * $panier->getQuantite();
        }



        return $this->json(['quantite'=>$quantity+1,'list'=>$listProduit,'prix'=>$prixTotal]);



    }
    /**
     * @Route("/quantityMoin",name="quantityMoin")
     */
    public function addQuantityMoin(CartRepository $repository,ProductsRepository $productsRepository){

        $id  = $_GET['id'];
        $quantity  = $_GET['quantite'];
        $em = $this->getDoctrine()->getManager();
        $cart = $repository->find($id);
        $cart->setQuantite($quantity-1);
        $em->flush();
        $carts = $repository->findAll();
        $listProduit = "";
        $prixTotal =0;
        foreach($carts as $panier){
            $prod = $productsRepository->find($panier->getProductId());
            $listProduit = $listProduit ."/product name: ".$prod->getProductName()." product id:".$prod->getProductId()." productQuantity : ".$panier->getQuantite();
            $prixTotal += $prod->getPrice() * $panier->getQuantite();

        }





        return $this->json(['quantite'=>$quantity-1,'list'=>$listProduit,'prix'=>$prixTotal]);



    }


}

