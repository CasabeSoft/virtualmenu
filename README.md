# VirtualMenu - Catering menu managment

![VirtualMenu menu managment](docs/img/VirtualMenu_Menu_Manage_demo00.png)

VirtualMenu is a tool to manage daily menus, offer menus to clients and recieve orders.

## History and present

This was developed in the 2012's spring's weekends as a prove of concept for a restaurant willing to automatize part of their catering activity. The software was never used but it could be used, as is. A landing page with a compact list of it's functionalities can be seen at http://virtualmenu.casabesoft.com.

Now it's old, with outdated technologies, but could be improved progressively and become a useful and free tool for anyone managing a catering service serving regular menus.

## Setup

### Prerequisites

0. PHP >= 5.6
0. MySQL

### Dev tools

0. From the project base path run:
```
$ bin/composer-install.sh
$ php composer.phar install
```

### Host name resolution

Edit the ``hosts`` file adding this line:
```
127.0.0.1       virtualmenu.dev
```

### DB config

0. From the project base path run:
```
$ mysql -u root -p < db/create-db-0.1.sql
```
0. Create a MySQL user "virtualmenu" with password "virtualmenu" (which you should change, later)
0. Grant access to "virtualmenu" user to the "virtualmenu" database, created in the first step.

### Running the server

From the project base path run:
```
$ php -S virtualmenu.dev:8000
```

## Contributions

Every contribution is welcome. Even if you don't know how to contribute but have an idea to improve or extend the functionality, the ideas are welcome too.

On the other hand, if you want to contribute but don't know where to start, checkout the list of [open issues](https://github.com/CasabeSoft/virtualmenu/issues).

### Code conventions

Please, be sure to check your code fallow the project code conventions, even, if you see that the _actual code_ don't.

0. CodeIngiter conventions should be followed in the PHP code coupled with the CI framework.
0. PSR-2 should be followed in any other PHP file where CodeIgniter conventions don't applies.
0. Regarding documentation you:
  * *must* document every public element
  * *should* document every protected element
  * *can* optionally document private elements which complexity seems to require it.
