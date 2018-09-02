BOOKSTORE.COM
=========

Application is built using php 7.1 and Symfony 3.4 framework.
To get application running follow these steps:
1) install web server if you don't have one, configure and run;
2) run `composer install` from CLI;
At this point you will be asked to provide database connection credentials.
3) run `php bin/console doctrine:schema:create` to get all necessary tables in database you work with
4) go to `{domain}/home` page where application will be up and running;
5) for running unit tests run `phpunit test/AppBundle/Controller/ApiControllerTest.php`

Application schema
=================

Application schema can be found in `app\Resources\pictures\release_v1.0.png`;

Possible Risks
==============

1) Security - Login/ Logout functionality is not the best;
Can be improved if using FOSUserBundle;
2) Performance in case of excessive data inflow;
3) Running `composer update` may break minimum stability requirements;

Why Symfony?
============

Symfony framework structure represents Java Enterprise framework Spring.
Spring is used in high- scalability and high- load applications. 
Symfony is a php version of Spring framework. Comparing to Laravel, Symfony has high
abstraction level (SOLID, Inversion of control) - objects are more independent.


