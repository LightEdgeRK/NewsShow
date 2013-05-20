<?php

namespace Roozbeh\NewsShowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NewsShowBundle:Default:index.html.twig', array('name' => $name));
    }

    public function newsAction()
    {
        $arr = array('mehdi' => 12,'rzb'=> 34);
        return $this->render('NewsShowBundle:Default:news.html.twig', $arr);
    }
}
