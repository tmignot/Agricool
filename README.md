# Agricool

### Install  :

* get MongoDB up and running
* get php-mongodb driver installed
* get composer and php installed
* clone this project
* go to your clone directory
* run `composer install`
* run `php factory/cooltainers.php`
* start a php web server that serves the `public/` directory *example `php -S localhost:8000 -t ./public`*

### Usage :
	
1. List all cooltainers:

>$ curl -X GET -d "key=**[secret]**" http://localhost:8000/cooltainers

2. Show a specific cooltainer:
	
>$ curl -X GET -d "key=**[secret]**" http://localhost:8000/cooltainers/{id}

_with {id} the $oid of the cooltainer you want to retrieve informations from_

3. Create a new cooltainer:

>$ curl -H 'Content-Type: application/json' http://localhost:8000/cooltainers -d '{
>"key":"**[secret]**",
>"name":"[NAME]",
>"ip":"xxx.xxx.xxx.xxx",
>"plant\_type":"Tomatoe",
>"location":{
>"address":"Somewhere near Paris",
>"lat":"48.002454",
>"lng":"1.23452"}}'

_with required keys:_

* **name** (the name a the cooltainer)

* **ip** (ip of the new container, maybe to start comunicating with it)

_Lots of values are meant to be updated by the cooltainer itself, or eventually retrieved from the cooltainer by the server, such as sensors values or the status. Such values are not accessible for writing._
