<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Post;

class WebController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function homePageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $recentWorks = $em->getRepository('AppBundle:Work')->findAll();

        return array(
            'recentWorks' => $recentWorks
        );
    }

    /**
     * @Route("/portfoli", name="recent_works")
     * @Template()
     */
    public function recentWorksPageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $recentWorks = $em->getRepository('AppBundle:Work')->findAll();

        return array(
            'recentWorks' => $recentWorks
        );
    }

    /**
     * @Route("/blog/tecnologic", name="blog_tecnologic" , defaults={"type" = "tecno"})
     * @Route("/blog/culinari", name="blog_culinari", defaults={"type" = "culinari"})
     * @Template()
     */
    public function blogPageAction(Request $request , $type = 'tecno')
    {

        $em = $this->getDoctrine()->getManager();
        if($type == 'tecno'){
            $posts = $em->getRepository('AppBundle:Post')->findByType(POST::TYPE_TECNOLOGIC);
        }
        if($type == 'culinari'){
            $posts = $em->getRepository('AppBundle:Post')->findByType(POST::TYPE_CULINARI);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $this->get('request')->query->get('page', 1),5
        );

        return array(
            'posts' => $pagination
        );
    }

    /**
     * @Route("/blog/post/{post}", name="blog_view_page" )
     * @ParamConverter("post", class="AppBundle:Post")
     * @Template()
     */
    public function blogViewPageAction(Request $request , Post $post)
    {

        return array(
            'post' => $post
        );
    }



    /**
     * @Route("/llibres", name="books")
     * @Template()
     */
    public function booksPageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $posts = array();

        //$recentWorks = $em->getRepository('AppBundle:Blog')->findAll();

        return array(
            'posts' => $posts
        );
    }

    /**
     * @Route("/contacte", name="contacte")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo($this->getParameter('contact_form_to'))
                    ->setBody(
                        $this->renderView(
                            'AppBundle:Mail:contact.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'name' => $form->get('name')->getData(),
                                'message' => $form->get('message')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', "S'ha enviat el email correctament, he anat a comprar, quan torni de la peixateria et responc.");

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }


}
