PHP 7.2.18 (cli) (built: Apr 30 2019 23:32:39) ( ZTS MSVC15 (Visual C++ 2017) x64 )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies

Composer version 1.9.0 2019-08-02 20:55:32

Set the files in your host folder and load it in browser ex. localhost:

http://localhost/

and install phpmyadmin and set a new database settings:

    servername = localhost
    username = root
    password = ""
    dbname = hero_game

To run test just run command, ex:

vendor\bin\phpunit --bootstrap vendor\autoload.php tests\HeroTest