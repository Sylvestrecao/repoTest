<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", options={"expose"=true}, name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $birds = $em->getRepository('AppBundle:Bird')->findAll();

        return $this->render('AppBundle:Default:index.html.twig', array(
            'birds' => $birds
        ));
    }

    /**
     * @Route("/search", options={"expose"=true}, name="search")
     * @Method("POST")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            $query = $request->request->get('Bird_Query');

            $birds = $em->getRepository('AppBundle:Bird')->findQueryBirds($query);

            return new JsonResponse($birds);
        }
    }

    /**
     * @Route("/search-bird/{id}", options={"expose"=true}, name="search_bird",  requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function searchBirdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $bird = $em->getRepository('AppBundle:Bird')->find($id);

        return $this->render('AppBundle:Default:show.html.twig', array(
            'bird' => $bird
        ));

    }

    /**
     * @Route("/profile", options={"expose"=true}, name="user_profile")
     * @Method("GET")
     */
    public function profileAction(Request $request)
    {
        var_dump('mabranche');
        return $this->render('AppBundle:Default:profile.html.twig');

    }
}
