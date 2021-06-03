<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Form\LinkFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UrlLinks;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UrlLinksRepository;


class LinkShortenerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request, EntityManagerInterface $entityManager,UrlLinksRepository $repository): Response
    {
      //CREATE FORM
      $form = $this->createForm(LinkFormType::class);
      $form->handleRequest($request);
      //If form is valid
      if($form->isSubmitted() && $form->isValid()){
        $data = $form->getData();

        ////////////////////////////Check if user enters more than one choice
        if($form['view']->getData() != null and $form['redirect']->getData() != null and $data['original_link'] != null){
          echo "Please enter one choice";
          return $this->render('homepage.html.twig', [
            'LinkForm' => $form->createView()
          ]);
        }
        if($form['redirect']->getData() != null and $data['original_link'] != null){
          echo "Please enter one choice";
          return $this->render('homepage.html.twig', [
            'LinkForm' => $form->createView()
          ]);
        }
        if($data['original_link'] != null and $form['view']->getData() != null ){
          echo "Please enter one choice";
          return $this->render('homepage.html.twig', [
            'LinkForm' => $form->createView()
          ]);
        }




        if($form['view']->getData() != null){//If user enters Url
          $short_link = $form['view']->getData();
          $repository = $entityManager->getRepository(UrlLinks::class);
          $link = $repository->findOneBy(['short_link'=> $short_link]);

          return $this->render('short_link_info_page.html.twig', [
            'id' => $link->getId(),
            'original_link' => $link->getOriginalLink(),
            'short_link' => $link->getShortLink(),
          ]);
        }
        elseif($form['redirect']->getData() != null){//If user enter short link to look up
          $short_link = $form['redirect']->getData();
          $repository = $entityManager->getRepository(UrlLinks::class);
          $link = $repository->findOneBy(['short_link'=> $short_link ]);
          if($link == null){
            echo $short_link .'is not a valid short link!!!';
          }else{
            return $this->redirect($link->getOriginalLink());
          }
        }
        elseif(filter_var($data['original_link'], FILTER_VALIDATE_URL))//If user enter want to redirect with short link
        {
          $link = new UrlLinks();

          $str_org_link = $data['original_link'];
          $url_parts = parse_url($str_org_link);
          $url_host = $url_parts['host'];
          $dot_index = stripos($url_host, ".");
          $url_host = substr($url_host,$dot_index + 1, strlen($url_host));

          //Create unique strings of 5 - 9 alphanumeric characters
          $max_num = rand(5,9);
          $alphanumeric_characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
          $unique_string = substr(str_shuffle($alphanumeric_characters), 0, $max_num);

          $short_link = $url_host.'/'.$unique_string;

          //Set and add to database
          $link->setShortLink($short_link)
               ->setOriginalLink($str_org_link);
          $entityManager->persist($link);
          $entityManager->flush();

          return $this->render('info_page.html.twig', [
            'id' => $link->getId(),
            'original_link' => $link->getOriginalLink(),
            'short_link' => $link->getShortLink(),
          ]);
        }else{
          echo $data['original_link'].'is not a valid Url!!!';
        }
      }
      return $this->render('homepage.html.twig', [
        'LinkForm' => $form->createView()
      ]);
    }
}
