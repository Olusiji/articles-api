# Built With Lumen PHP Framework


[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

A simple API for managing blog articles or other form of authored content. Simple to deploy within your infrastructure and can work with your existing mobile or web front-end.
App contains 3 docker containers
- Lumen Microservice
- Nginx WebServer
- MySql Database

To run the service clone the repo to an instance (preferably Linux) with Docker and Docker-Compose installed.
Run the following command from the project directory.

`sh deploy.sh`
 
 Make sure to copy the Client Id and Secret Generated to generate access tokens for authenticated endpoints.
## API documentation

The postman documentation for the API can be found here [Postman Docs](https://documenter.getpostman.com/view/3272396/SVmsUKnY).

## To run unit tests

`docker-compose exec app ./vendor/bin/phpunit`

## License

The service is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
