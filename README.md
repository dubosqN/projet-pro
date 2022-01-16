# Projet-pro

Projet pro B3 Dev

# ⚠️ Avant toute chose, ne pas oublier de créer des branches pour faire des modifications, et d'ensuite faire des merge request pour l'aspect DevOps du projet ⚠️

## Initialisation du projet (Symfony 5.2)

<br/>Version php : 7.4
<br/>Version apache : 2.4
<br/>Version MySql : 5.7
<br/>Version MariaDb : 10.6
<br/>Créer une base de donnée (nom : projet-pro)
##Ajout du .env
Pour que le projet puisse être initialisé (Pour le back), il faut ajouter un fichier de config à la racine du projet 
nommé ".env.local" avec le contenu suivant : 
```
APP_ENV=dev
APP_SECRET=e916fa931a17a6cbd5e372cb67b2476c
DATABASE_URL="mysql://root:@127.0.0.1:3306/projet-pro?serverVersion=5.7"
```

##Quand le projet est clone :
```
composer install

npm install

php bin/console make:migration
php bin/console d:m:m

npm run build (À chaque modif de scss, car on utilise webpack pour compiler le Sass)

symfony serve (Pour utiliser le cli de symfony ou alors vous pouvez utiliser wamp)
```