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




