# Antlia Registration Plugin

Antlia Registration is a WordPress plugin that allows the registration of clients to a specific website providing the registration of three different kinds of types: CLT, PJ, and Coop.

## Getting Started

To get started, you will have to:

1. Clone the project into your WordPress plugins folder or use a compressed file.
2. Upload the plugin and activate it on the /wp-admin/plugins.php page.

Antlia Registration also depends on a few vendors, including:

- Composer
- wp-mail
- frankmayer/criminal-record-checker

Make sure to install these vendors before the plugin can be used.

## Description

Antlia Registration allows the registration of three different types of clients. In this registration process, the plugin checks the possibility of the client being a criminal and searches some criminal records through parameters like nome, nome_mae, nome_pai, and nascimento. The plugin then registers and stores the client information on FTP before sending a confirmation email to the client's email address.

## Plugin Configuration

Antlia Registration Plugin contains the following five files:

- mail.php: responsible for sending mail services to the client with his/her information and/or attachments;
- register-clt.php: responsible for registering and storing the information of the client type CLT on FTP and returning the file path;
- register-pj.php: responsible for registering and storing the information of the client type PJ on FTP and returning file path;
- register-coop.php: responsible for registering and storing the information of the client type coop on FTP and returning file path;
- criminal-checker.php: responsible for checking if the person is a criminal or not.

## API

The plugin's API contains three routes:

- /wp-json/registration-api/v1/register-clt: registration for people with a type CLT;
- /wp-json/registration-api/v1/register-pj: registration for people with a type PJ;
- /wp-json/registration-api/v1/register-coop: registration for people with a type Coop.

## Functions

This plugin relies on four functions:

- antlia_registration_register_routes(): registers the specified routes in the API;
- antlia_registration_clt(WP_REST_Request $request): function responsible for processing the request and invoking register_clt() and check_criminal_records();
- antlia_registration_pj(WP_REST_Request $request): function responsible for processing the request and invoking register_pj().
- antlia_registration_coop(WP_REST_Request $request): function responsible for processing the request and invoking register_coop().

## Technologies and Libraries Used

- PHP
- WordPress
- Composer
- PHPOffice
- wp-mail


## Running Antlia Registration Plugin with Docker


The project is configured to use docker in development environment, configuration file defines two services: a WordPress instance and a MySQL database to store the application data and user information.


To run Antlia Registration plugin with Docker, you need to have Docker installed on your computer. Once you have it installed, follow the steps below:

1. Clone the repository to your local machine.

2. Navigate to the project directory 

3. Build and run the Docker container with the following command:

`docker-compose up -d`

Once the container is up and running, you can access the WordPress site by entering http://localhost:8080 in your web browser.


To activate the Antlia Registration plugin, log in to the WordPress dashboard and navigate to the "Plugins" section. Search for "Antlia Registration" and click on "Activate".

That's it! You have successfully set up Antlia Registration plugin with Docker.

## Author

**Marcelino Sandroni**

*Software Developer*

Email: [marcelino.sandroni@gmail.com](mailto:marcelino.sandroni@gmail.com)

GitHub: https://github.com/marcelinosandroni

Linkedin: https://www.linkedin.com/in/marcelinosandroni

Feel free to contact me if you have any questions or feedback about this project.


## Contributing

Contributions are welcome! To contribute, feel free to fork this repository and create a Pull Request or use the Issues section to report a bug or suggest a new feature, see more in the [CONTRIBUTING]( ./CONTRIBUTING.md ) section.

## License

This project is licensed under the MIT License.
