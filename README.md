# Squawk Generator

The purpose of this web application is to allow a user flying on the ivao network to generate a transponder code according to his departure airfield.


# Use
The application has 2 main parts, the first one manages the airports and their associated squawkcodes and the second one allows the user to enter his callsign in order for the system to generate an adapted squawk code. 

## Add an airport

Before you can generate a code, you will need to enter the transponder codes for your departure airport. To do this, simply click on the "Manage my airports" button and add a new airport.

## Generate a squawk

To generate a code, simply go to the home page, launch a refresh by clicking on the "refresh" button and type in your callsign so that the system recognizes your flight and delivers your code along with your flight plan.

# API

An api is available in order to generate code without going through the graphical interface.

## Generate a code

You just have to GET this url `http://squawk.test/api/squawk/<callsign> `and complete the end of it. For example, if your callsign is AFR2604, the request will be `http://squawk.test/api/squawk/AFR2604`. If the system recognizes your callsign, it will then deliver your code in json format: `{"code":1003}`. Otherwise, the system will respond with a 404 error. 
Tips: if the callsign is not found, you can call the url http://squawk.test/refresh to start a page refresh. 


# Installation

The project has been developed with version 7.11 of laravel. All you have to do is configure access to the database in .env and launch `php artisan migrate`.

