## with-slim

Full-stack made easy with [Slim 3](https://slimframework.com)

### Library

1. [Eloquent](https://github.com/illuminate/database) - ORM DB
2. [Twig](https://github.com/twigphp/Twig) - Template Engine
3. [PHPMailer](https://github.com/PHPMailer/PHPMailer) - Mailler
4. [Phinx](https://github.com/cakephp/phinx) - DB Migration
5. [Monolog](https://github.com/Seldaek/monolog) - Logging For PHP

### How To Use?

    Make Migration
        vendor/bin/phinx create [name]
    Make Seed
        vendor/bin/phinx seed:create [name]
    Run Migration
        vendor/bin/phinx migrate -e [option]
    Run Seed
        vendor/bin/phinx seed:run -e [option]

    n-option = testing, development or production (phinx.yml)

    Install Libs

        composer install

    Run This Service

        composer start

### Example App!

1. [Blog](https//github.com/aasumitro/with-slim)
2. [Forum](https//github.com/aasumitro/with-slim)

### License

with-slim is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
