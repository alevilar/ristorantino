# Ristorantino Project 

Skeleton for composer installer

3 steps from console, to install:

1. git clone git@github.com:alevilar/ristorantino.git
2. cd ristorantino
3. composer install


Then you need to:

1. create a database (mysql)
2. copy Config/database.php.default as database.php file and set user and password (cakePHP`s database file)
3. import into that database you have created the sql´s files from Config/Schema:
  - schema_struct.sql (Thi will create the structure)
  - schema_base_data.sql (This will put some basic data into databases, including some examples)

## Requirements
You need composer (https://getcomposer.org) installed, so dependencies are auto-managed.



