**TO RUN THIS SYMFONY APPLICATION**

- Start your MySQL server 
- Install the project
- Open a terminal prompt in the project folder
- From the terminal, run : yarn install (to install the javascript and CSS dependencies)
- From the terminal, run : yarn run encore dev (to build the javascript and CSS webpack files)
- From the terminal, run : composer install (to install the PHP and Symfony dependencies)
- Change the .env file content if your MySQL user is not root or has a non-empty password
- Change the .env file content if you want to use a different database name from 'hotix' (see below) 
- From the terminal, run : php bin/console doctrine:database:create (to create the database) 
- From the terminal, run : php bin/console doctrine:migrations:migrate (to create the tables)
- From the terminal, run : php bin/console doctrine:fixtures:load (to load the tables with fake data)
- From the terminal, run : php bin/console server:run (to run the PHP/Symfony built-in HTTP server)
- Evaluate :) 

Note :
'hotix' was the name of the Property Management application I started working on in May 1989 as a junior analyste
programmeur. The app was developped using the Thoroughbred Business Basic language and was running in character mode 
user interface on dumb terminals connected through RS-232 wiring (9600 bps !) to powerful host servers with 80286 CPUs, 
RAM of 2 Mb and huge 80 Mb hard disks. At the time this Property Management application was deployed mainly in hotels
and restaurants of the AccorHotels group. This is also why I named the three hotels in my database Novobis, Mertel and 
Icure as a joke with three of the Accor brands (Novotel, Mercure & Ibis).    
