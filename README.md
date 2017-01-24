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

On the other hand, if you want to contribute but don't know where to start, here is a small list of immediate needs:

0. Upgrade [CodeIgniter](https://github.com/bcit-ci/CodeIgniter) to a recent version.
0. Migrate [Blueprint](https://github.com/joshuaclayton/blueprint-css) to [Bootstrap](https://github.com/twbs/bootstrap) or any other modern CSS framework.
0. Migrate [JsViews](http://github.com/BorisMoore/jsviews) to [Knockout](https://github.com/knockout/knockout), [KendoUI Core](https://github.com/telerik/kendo-ui-core) or any other modern template system (previous step to a full front-end framework migration for using [React](https://github.com/facebook/react) or [Angular](https://github.com/angular/angular).
0. Remove the config based server name resolution.
0. Replace the sub-domain client identification mechanism by a user associated to client mechanism.
