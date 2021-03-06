bearded-calendar
=================

It is a simple calendar web application based on Kohana PHP Framework,
version 3.2 (development).

installation
------------

First, run the install shell script:

    $ ./install.sh

to fetch kohana 3.2 core and modules from github (no need to hold original sources
inside this repository). This script will load the dependency as a git submodule
and will set an appropriate branch. Then run another script to set the permissions:

    $ ./permissions.sh

of the `aplication/cache` and `application/logs` directories.

The project was developed in `apache2` server with `mod_rewrite` installed.

All SQL scripts reside in the `sql` directory:
 * `prepare_env.sql` - creates a MySQL database, creates a user with corresponding privileges
 * `model.sql` - creates tables and relations used among the project

To access the application frm the browser, the best way is to configure a virtual
host, e.g. http://bearded-calendar/

loading fixtures
----------------

To start using the project with some fixture data, request following URLs from
the browser (request kohana app directly):

 * http://bearded-calendar/cdata/users - loads test users into the database
 * http://bearded-calendar/cdata/notes - loads test calendar notes

Alternatively, there's a MySQL `fixtures.sql` script in the `sql` directory (it
holds `users` records).

login
-----

Use the 4 test users to login:

 * John Lennon: `jl`
 * Paul McCartney: `pmc`
 * George Harrison: `gh`
 * Ringo Starr: `rs`

You may login with the same password as the username (login:`jl`, password:`jl`)

navigation
----------

 * monthly -> daily: click on specific day cell
 * daily -> monthly: click on the month/year
 * login widget is at the bottom

standards
---------

 * full inline documentation (classes, methods)
 * SQL structures are fully documented (tables, columns)
 * code validation: XHTML, CSS, SVG (see icons in the page footer)
