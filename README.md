Run your application:
    1. Change to the project directory
    2. Create your code repository with the git init command
    3. Execute the php -S 127.0.0.1:8000 -t public command
    4. Browse to the http://localhost:8000/ URL.

       Quit the server with CTRL-C.
       Run composer require server --dev for a better web server.

  * Read the documentation at https://symfony.com/doc


 Database Configuration


  * Modify your DATABASE_URL config in .env

  * Configure the driver (mysql) and
    server_version (5.7) in config/packages/doctrine.yaml


 How to test?


  * Write test cases in the tests/ folder
  * Run php bin/phpunit

php bin/console cache:clear --no-warmup -e prod

etape et commandes git:
-> composer require server --dev (librairie pour dev)
-> php bin/console server:run (demarage serveur)
-> php bin/console make:controller (creer un controller)
-> php bin/console make:entity (creer l'entity)
-> php bin/console doctrine:database:create
-> php bin/console make:migration (check entre les dossier et la bdd et fait une maj)
-> php bin/console doctrine:migration:migrate (met les informations sur le serveur)
-> php bin/console make:form


settup fixture: fausse donner pour la bdd
-> composer require orm-fixtures --dev (import la librairie pour faire)
-> php bin/console make:fixtures (creer le dossier fixture)
-> php bin/console doctrine:fixtures:load (envoi les fausses infos dans la bdd)

-> creer facilement un faker-> aller sur php faker (le premier)->settup => composer require fzaninotto/faker --dev