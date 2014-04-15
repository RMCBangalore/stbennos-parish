Alive Parish - software to manage tomorrow's parish
===================================================

Alive Parish was developed to be a one-stop place to manage parish data, plus
provide survey data to help Pastors better plan programmes to renew the Church.
The development has been sponsored by the [Redemptorist Media Center,
Bangalore](http://rmcbangalore.com).

Alive Parish is a web based software built on the Yii framework on PHP and
using a database. It therefore requires a Web server with PHP support and a
DBMS along with the Yii framework to run.

Prerequisites
-------------

Recommended Software:
DBMS: MySQL 5.1+
Web Server with PHP: Apache 2.22+ with mod\_php (PHP version 5.4.3)
Yii framework version 1.1.13
Windows users note: WAMP is a quick way to install Apache, MySQL and PHP
On Mac OS/X, XAMPP can be installed. Let us know if you try this

Installation
------------

1. Copy the parish folder under the DocumentRoot
2. In the parent folder of DocumentRoot, create a folder named yii.
   Download and place the yii framework folder yii-1.1.13.e9e4a0 under this.
	The directory structure should be like:
	(parent of DocumentRoot)
	+-- Document Root
	| +-- parish
	+-- yii
	+-- yii-1.1.13.e9e4a0
	+-- framework 
3. In your Apache configuration, ensure that `AllowOverride All` is set for 
	the parish folder
4. Create a database and grant all privileges to a user
	CREATE DATABASE parish;
	GRANT ALL PRIVILEGES ON parish.\* TO parish\_user@localhost IDENTIFIED BY 'secret';
	FLUSH PRIVILEGES;
5. Point your browser to http://localhost/parish - it should redirect you to
	the online installer. Follow the instruction steps and complete the
	installation.

Bugs
----

Please report any issues to issues@stbennos.com . Kindly mention the issue with a
full text of any error message you may have encountered or a screenshot and also,
how you got the error and information needed to reproduce the issue.

Licence
-------

Please read the file `COPYING` included with this software.

Authors:
--------

- [Terence Monteiro](terencemo@cpan.org)
