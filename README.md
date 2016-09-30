# Shoe Stores


#### _A to do list using MySQL, September 26, 2016_

#### By _**Katy Henning**_

## Description

A site that shows a chain of shoe stores and the brands that are sold at those stores.

## Setup/Installation Requirements

* Clone the repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Specifications

* The program takes the input of a new shoe brand:
  * Input: "Nike"
  * Output: "Nike"

* The program takes a new store and returns that store info:
  * Input: "SW 5th and Washington"
  * Output: "SW 5th and Washington"

* The program can add shoe brands to the stores list:
  * Input: "SW 5th and Washington" now sells Nike
  * Output: show all brands at "SW 5th and Washington": "Nike"

* The program can add stores to the shoes list:
  * Input: "SW 5th and Washington" now sells Nike
  * Output: You can buy Nike at the SW 5th and Washington location

## SQL Commands

* CREATE DATABASE shoes;
* use shoes;
* CREATE TABLE brands (brand_name VARCHAR(255), id serial PRIMARY KEY);
* CREATE TABLE stores (store_name VARCHAR(255), id serial PRIMARY KEY);
* CREATE TABLE stores_brands (brand_id INT, store_id INT, id serial PRIMARY KEY);

## Known Bugs

There are no known bugs at this time.

## Support and Contact Details

For questions or comments, please contact me through GitHub.

## Technologies Used

* _PHP_
* _Silex_
* _Twig_
* _Bootstrap_
* _MySQL_

### License

*This website is licensed under the MIT license.*  
Copyright (c) 2016 **_Katy Henning_**
