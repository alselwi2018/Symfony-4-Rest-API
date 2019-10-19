# Symfony-4-Rest-API
# To start creating a Symfony 4 Rest API
# Create a new Symfony project using composer
composer create-project symfony/skeleton Symfony-project
# Start the server of the symfony-project 
# In the terminal add
cd Symfony-project
php bin/console server:start
# If you did't install server bundle yet then type
composer require symfony/web-server-bundle
# then add the required bundles for the FOS Rest API
composer require friendsofsymfony/rest-bundle
composer require sensio/framework-extra-bundle
composer require jms/serializer-bundle
composer require symfony/validator
composer require symfony/form
composer require symfony/orm-pack
#  * Modify your DATABASE_URL config in .env
# you should change in the .env file where it has this DATABASE_URL=mysql://root:@127.0.0.1:3306/fos-flight
# The reason we add sensio/framework-extra-bundle for defining the annotation of the route and jms/serializer-bundle to serialize and deserialize the resources
# in the bundles.php file we get
<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    FOS\RestBundle\FOSRestBundle::class => ['all' => true],
    Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle::class => ['all' => true],
    JMS\SerializerBundle\JMSSerializerBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
];
?>
# now go back to the terminal to add the entities that stores the resources into the database I will use the flight ticketing type
# create the database first by typing
php bin/console doctrine:database:create
# in my database it created fos-flight as i mention it in Modify you DATABASE_URL in previous steps
# if you get this message There are no commands defined in the "make" namespace.
# you should install maker bundle
composer require symfony/maker-bundle --dev 
# then type the entities
php bin/console make:entity FlightTimes
# Then add the required columns to the entity
# To create the entity in the database 
php bin/console make:migration
php bin/console doctrine:migrations:migrate
# After that create the form type to handle the get and post of REST API
# Then open config->packages you will see fos_rest.yaml. add the following to it
fos_rest:
routing_loader: 
default_format: json
include_format: false 
body_listener: true 
format_listener: 
rules: 
- { path: '^/',priorities ['json'], fallback_format: json, prefer_extension: false }
param_fetcher_listener: true
access_denied_listener: 
json: true
view: 
view_response_listener: 'force' 
formats: 
json: true
# open config->services.yaml and add the following
Sensio_framework_extra.view.listener:
    alias: Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener
# To solve the issue with sensio_framework_extra you need to add it at config->services.yaml and then add the Sensio_framework_extra.view.listener: under service: with indent then it should work
# add the controller from the terminal or command if you use windows 
# in my FlightTimeController looks like this below
<?php

namespace App\Controller;

use App\Entity\FlightTimes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class FlightTimesController
 * @package App\Controller
 * @Route("/api_flight", name="api_flight_")
 */
class FlightTimesController extends FOSRestController
{
    /**
     * Loads all flight times
     * @Rest\Get("/flight/times")
     * @return Response
     */
    public function load_all_flights()
    {
        $flights = $this->getDoctrine()->getRepository(FlightTimes::class)->findAll();

        return $this->handleView($this->view($flights));

    }
    /**
     * Add new flight details
     * @Rest\Post("/flight/time")
     * @return Response
     */
    public function new_flight(Request $request){
        $flight = new FlightTimes();
        $form = $this->createForm(FlightTimes::class, $flight);
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
?>
# in my controller I have two routes for get and post rest api which are /rest/api/flights to get all flights and /rest/api/flight to post new data
# then install postman from https://www.getpostman.com 
# in postman you can test the result with post it shows status ok to send data to the entity and for loading all the api use get




