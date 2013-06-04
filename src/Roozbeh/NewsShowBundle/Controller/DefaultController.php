<?php

namespace Roozbeh\NewsShowBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;

use Roozbeh\NewsShowBundle\Entity;

use Symfony\Component\Form;

class newsSummary
{
    public $title;
    public $author;
    public $summary;
    public $time;
    public $groupName;
    public $ImgSrc;
    function __construct($t,$a,$s,$ti,$gn,$src)
    {
        $this->title=$t;
        $this->author=$a;
        $this->summary=$s;
        $this->time=$ti;
        $this->groupName=$gn;
        $this->ImgSrc=$src;
    }
}

class DefaultController extends Controller
{
    public function indexAction()
    {
        //return $this->render('NewsShowBundle:Default:index.html.twig', array('name' => $name));
        return $this->render('NewsShowBundle:Default:index.html.twig');
    }

    public function newsAction()
    {
        $items[] = new newsSummary('test1','roozbeh1','charand e mozakhraf 1','9:30 1' , 'siasi 1' , 'bundles/newsshow/images/jafang.jpg');
        $items[] = new newsSummary('test2','roozbeh2','charand e mozakhraf charand e mozakhraf charand e mozakhraf charand e mozakhraf charand e mozakhraf charand e mozakhraf ','9:30 2' , 'siasi 2' , 'bundles/newsshow/images/jafang.jpg');
        $items[] = new newsSummary('test3','roozbeh3','charand e mozakhraf 3','9:30 3' , 'siasi 3' , 'bundles/newsshow/images/jafang.jpg');
        $arr = array('newsSumItems' => $items );

        return $this->render('NewsShowBundle:Default:news.html.twig',$arr);
    }

    public function loginAction(Request $request)
    {
        //$request = $this->getRequest();
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
        return $this->render('NewsShowBundle:Default:search.html.twig');
    }

    public function writeAction()
    {
        return $this->render('NewsShowBundle:Default:write.html.twig');
    }
}
