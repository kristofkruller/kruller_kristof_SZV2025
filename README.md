# ENV
## root .env file must have:
DB_HOST=
DB_NAME=szerviz_db
DB_USER=
DB_PASS=
SEED_PORT=
XAMPP_ROOT=
POST_CALL=

example: 
DB_HOST=localhost:1234
DB_NAME=szerviz_db
DB_USER=root
DB_PASS=

SEED_PORT=1234

XAMPP_ROOT=/kruller_kristof_SZV2025/
GET_ALL_CALL=http://localhost:1234/kruller_kristof_SZV2025/controller/get_termekek.php
POST_CALL=http://localhost:1234/kruller_kristof_SZV2025/controller/termek_leadas.php

XAMPP root a redirecthez kell.
A call kell hogy ne file path legyen a hívás ami unsafe. 

# DEPENDENCY

php composer innen:
`https://getcomposer.org/`

releváns parancsok:
`composer install`

`composer update`

`composer dump-autoload`

# RUN 
Ha a `.env` file ki van töltve projekt rootban és composer ok seeding kell:

`php ./config/seed.php`

Ezt követően a webserverrel futtatható.
