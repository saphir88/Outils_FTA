# Outils_FTA
Projet client French Tech Alsace (Développement des outils "Communautés Startups" et "Gestion d'événements")

##Après le clonage il faut :

- composer install
- npm install

##ckeditor création d'évenement commande :

- php bin/console ckeditor:install
- php bin/console assets:install 

##fosUserBundle création de l'admin :

- php bin/console fos:user:create PSEUDO EMAIL PASSWORD 
- php bin/console fos:user:promote PSEUDO ROLE_ADMIN 

## BDD commande :

- php bin/console doctrine:database:create 
- php bin/console doctrine:schema:update --force

## parameter.yml :

  parameters:
      database_host: 127.0.0.1  
      database_port: null  
      database_name: BDDname  
      database_user: BDDuser  
      database_password: BDDpass  
      mailer_transport: gmail  
      mailer_host: 127.0.0.1  
      mailer_user: admin@  
      mailer_password: pass  
      secret: ThisTokenIsNotSoSecretChangeIt  


## Webpack commande :

./node_modules/.bin/encore dev --watch  

## Server:run :

- php bin/console server:run

