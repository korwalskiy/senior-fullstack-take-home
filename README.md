# senior-fullstack-take-home

All source code in this repo should not be used in production. This is for development purpose only. Feel free to clone/fork the repo and modify as expected.

## Overview

A simple microservice application using REST, SOAP and Webhooks. The SOAP server is written in PHP, allowing you call procedures remotely. JSON is used over XML for simplicity. REST is done through Python Flask, which is also responsible for handling webhook requests from GitHub and publishing updates to React via WebSocket.


## Highlevel Architecture Overview

![Architecture](architecture.svg)


The entire application is expected to be dockerized and deployed on [AWS Elastic Beanstalk](https://aws.amazon.com/elasticbeanstalk/)


## What has been done for me?

The following have been implemented for you to make it easier for you to get started. The requirments document should contain all the information you need to get started.

1. A SOAP server written in PHP
2. A SOAP client written in Python
3. Project bootstraped for PHP, Python and React
4. An ORM written in PHP (don't use in production 😉)
5. PHPUnit has been setup correctly
6. ORM thorougly tested 😉 🤔 😉
7. And lots more

## What I have done?

1. ### DOCKER-COMPOSE PROJECT

    Do a one time ```docker compose build``` and subsequently ```docker compose up``` to spawn all servers and services required by the project.

2.  ### MYSQL DB INSTANCE
    A dockerised mysql:8 instance with production and test databases have been bootstrapped for use.

    Create a ```.env``` by providing the required value for the key specified therein ```.env.example```.

3.  ### PHP SOAP SERVER
    A dockerised php soap server is composed for use for db interaction; it does ```schema.sql``` importation on start.

    Create a ```.env``` by providing the required values for the keys specified therein ```.env.example```.

    Required soap services have been exposed for consumption by the flask api. This involved authoring extra methods in the ActiveRecord class, creating model entities and service classes.

4.  ### FLASK API SERVER
    A dockerised flask api server is composed for interaction with the soap server, github webhook, and react web app.

    Create a ```.env``` by providing the required values for the keys specified therein ```.env.example```.

    Required api endpoints have been exposed for consumption by github webhook and react web app

    [Click to import Endpoints Collection into Postman](https://www.getpostman.com/collections/c9d5557c298c1cc17fd3)

        -   /api/ [GET]
        -   /api/soap [GET]
        -   /api/companies [GET]
        -   /api/company [POST]
        -   /api/company/<int:id> [GET]
        -   /api/company/<int:id>/delete [DELETE]
        -   /api/company/<int:id>/employees [GET]
        -   /api/company/<int:id>/employee/<int:employee_id> [GET]
        -   /api/company/<int:id>/employee/delete [DELETE]
        -   /api/company/<int:id>/services [GET]
        -   /api/company/<int:id>/service/<int:service_id> [GET]
        -   /api/company/<int:id>/service/delete [DELETE]
        -   /api/company/<int:company_id>/service/<int:service_id>/rate [GET]
        -   /api/employees [GET]
        -   /api/employee [POST]
        -   /api/employee/<int:id> [GET]
        -   /api/employee/<int:id>/delete [DELETE]
        -   /api/servicecategories [GET]
        -   /api/servicecategory [POST]
        -   /api/servicecategory/<int:id> [GET]
        -   /api/servicecategory/<int:id>/delete [DELETE]
        -   /api/services [GET]
        -   /api/service [POST]
        -   /api/service/<int:id> [GET]
        -   /api/service/<int:id>/delete [DELETE]
        -   /api/service/<int:service_id>/rate [GET]
        -   /api/service/<int:service_id>/rate [POST]
        -   /api/webhook [POST]

5.  ### REACT WEB APP
    A dockerised react web app is composed for use.

    Create a ```.env``` by providing the required value for the key specified therein ```.env.example```.
