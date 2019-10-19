<?php

namespace App\Controller;

use App\Entity\FlightTimes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Form\FlightType;
/**
 * Class FlightTimesController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class FlightTimesController extends FOSRestController
{
    /**
     * Loads all flight times
     * @Rest\Get("/flights")
     * @return Response
     */
    public function load_all_flights()
    {
        $flights = $this->getDoctrine()->getRepository(FlightTimes::class)->findAll();

        return $this->handleView($this->view($flights));

    }
    /**
     * Add new flight details
     * @Rest\Post("/flight")
     * @return Response
     */
    public function new_flight(Request $request){
        $flight = new FlightTimes();
        $form = $this->createForm(FlightType::class, $flight);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if($form->isSubmitted() && $form->isValid()){
            $entity_manager = $this->getDoctrine()->getManager();
            $entity_manager->persist($flight);
            $entity_manager->flush();
            return $this->handleView($this->view(['status'=>'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }
}
