Alive Parish - software to manage tomorrow's parish
===================================================

This software is written in PHP and based on the Yii framework. It is
developed by the [Redemptorist Media Center, Bangalore](http://rmcbangalore.com).

Prerequisites
-------------

MySQL server with permission to create a database and assign a role

Apache or other Web Server that can run PHP applications

Installation
------------

1.  Copy the parish folder under the `DocumentRoot`

2.  In your Apache configuration, ensure that `AllowOverride All` is set
    for the parish folder

3.  Create a database and grant all privileges to a user

        CREATE DATABASE parish;
        GRANT ALL PRIVILEGES ON parish.* TO parish_user@localhost IDENTIFIED BY 'secret';
        FLUSH PRIVILEGES;

4.  Point your browser to http://localhost/parish and complete the installation

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

- [Terence Monteiro](terence@rmcbangalore.com)
