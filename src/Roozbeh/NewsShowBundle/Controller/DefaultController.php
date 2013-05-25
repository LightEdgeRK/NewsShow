<?php

namespace Roozbeh\NewsShowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

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

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        if( $request->query->get('signout') == 'true' )
        {
            $session->remove('logged');
            $session->remove('user_name');
            return $this->render('NewsShowBundle:Default:login.html.twig');
        }
        else
        {
            $session->set('logged',true);
            $session->set('user_name','Roozbeh');
            return $this->newsAction();
        }




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
