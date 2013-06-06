<?php

namespace Roozbeh\NewsShowBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\SecurityContext;

use Roozbeh\NewsShowBundle\Entity;

use Symfony\Component\Form;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NewsShowBundle:Default:index.html.twig');
    }

    public function newsAction()
    {
        $news_results = $this->getDoctrine()->getRepository('NewsShowBundle:News')->findAll();
        $arr = array('newsSumItems' => $news_results );

        return $this->render('NewsShowBundle:Default:news.html.twig',$arr);
    }

    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }


        $a = new Entity\Author();


        $form = $this->createFormBuilder($a)
            ->add('Username', 'text')
            ->add('Password', 'password')
            ->add('Firstname' ,'text')
            ->add('Lastname', 'text')
            ->add('Categories','entity', array('class' => 'NewsShowBundle:Category' , 'property' => 'name' ,'multiple' => 'true' , 'expanded' => 'true') )
            ->add('signUp', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $newAuthor = $form->getData();

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($newAuthor);
            $password = $encoder->encodePassword($newAuthor->getPassword() , $newAuthor->getSalt());
            $newAuthor->setPassword($password);

            //try
            //{
                $em->persist($newAuthor);
                $em->flush();
            //}
            //catch(\Exception $e)
            //{
             //   $form->addError(new Form\formError("Failed. Maybe username already exists?"));
            //}
        }

        return $this->render(
            'NewsShowBundle:Default:login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
                'form' => $form->createView()
            )
        );
    }

    public function searchAction()
    {
        if($this->getRequest()->request->has('q'))
        {
            $news_results = $this->getDoctrine()->getRepository('NewsShowBundle:News')->findAll();

            return new JsonResponse($news_results);
        }

        if($this->getRequest()->request->has('c'))
        {
            $news_results = $this->getDoctrine()->getRepository('NewsShowBundle:News')->findBy(array('category'=> $this->getRequest()->request->get('c') ));
            return new JsonResponse($news_results);
        }

        $categories = $this->getDoctrine()
            ->getRepository('NewsShowBundle:Category')
            ->findAll();

        return $this->render('NewsShowBundle:Default:search.html.twig',array('categories' => $categories));
    }

    public function writeAction(Request $request)
    {
        $a = new Entity\News();

        $usr= $this->get('security.context')->getToken()->getUser();

        $cats = $usr->getCategories();

        foreach ($cats as $cat)
        {
            $choices[] = $cat->getName();
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($a)
            ->add('title', 'text')
            ->add('summary', 'textarea')
            ->add('text' ,'textarea')
            ->add('datetime', 'datetime')
            //->add('category','choice' , array( 'choices' => $choices ) )
            ->add('category','entity',array('class'=> 'NewsShowBundle:Category' , 'property' => 'name'))
            ->add('write', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $news = $form->getData();
            $news->setAuthor($usr);
            if( $usr->hasCategory( $news->getCategory() ) )
            {
                $em->persist($news);
                $em->flush();
            }
            else
                $form->addError(new Form\formError("Failed. You are not allowed to post in that group."));
        }

        return $this->render('NewsShowBundle:Default:write.html.twig',array('form'=>$form->createView()));
    }
}
