Xervice
=====================

[![Build Status](https://travis-ci.org/xervice/xervice.svg?branch=master)](https://travis-ci.org/xervice/xervice)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/xervice/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/xervice/?branch=master)


Description
---------------
That's a default xervice application.

* Session are stores in redis
* Events goes to RabbitMQ
* Logs goes to RabbitMQ
* PostgreSql is configured
* Default indexController in Application
* Preconfigured kernel
* Public-Directory with simple index.php
* Exception-Handling
    * Without debug it will save exceptions in the log-queue in RabbitMQ
    * With debug exceptions will be displayed in your browser
* Development module for generating autocomplete
* Preconfigured console command
* Webpack frontend with bootstrap
    * Search automatically for scss and js files in your theme folder
* Atomic design
    * You can add atoms, molecules, organisms and templates to your module theme folder and reuse them in your pages.
        * Directory structure:
            * Presentation
                * Theme
                    * atomic
                        * atoms
                        * molecules
                        * organisms
                    * templates
                    * pages
        * Example in Application/Presentation/Theme



Installation
-----------------
```
composer create-project xervice/xervice myXerviceApplication [version]
```

Configuration
-----------------

***Define new routes***
src/App/Application/Plugins/Routing/Routing.php


***Define new twig paths***
src/App/Application/Plugins/Twig/PathLoader.php


***Configuration***
You can change your configuration in the config-files. For default it will take your config_production.php for system specifig configs.
You should save your password into the config_local.php file (example config_local.dist.php).



Using
-----------------

* Install Redis
* Install RabbitMq
* Install PostgreSql
* Install nginx
* Change configs
* Test local with php
    * php -S localhost:8000 -t public/
* Run Application in your browser


***Install***
```
composer install
npm install
```

***Generate frontend***
```
npm run build
```