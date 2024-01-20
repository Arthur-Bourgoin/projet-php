# Projet php gestion d'un cabinet médical

Application de gestion d'un cabinet médical permettant au secrétariat de saisir les rendez-vous de consultation, de gérer la liste des usagers du centre ainsi que la liste des médecins.

## Accès en ligne
URL : `http://projet-phpr301.alwaysdata.net`  
Login : `user`  
Mot de passe : `password`

## Déploiement en local

### Téléchargement
1. Télécharger le dossier `git clone https://github.com/Arthur-Bourgoin/projet-php.git`.
1. Créer la base de données associée au projet `CREATE DATABASE projetphp`.
1. Exécuter le fichier `script.sql`.
1. Exécuter le fichier `insert.sql`.
1. Modifier le fichier `config/Database.php` pour le faire correspondre à votre configuration.
```php
const SERVER = "?";
const DB = "?";
const LOGIN = "?";
const PWD = "?";
```

### Configuration serveur web
1. Créer un virtual host comme ci dessous où `projet-php` représente le dossier précédemment téléchargé et `public` un dossier normalement déjà présent à l'intérieur.
```apache
<VirtualHost *:80>
    ServerName www.projet-php.local
    DocumentRoot "C:/xampp/htdocs/projet-php/public"
</VirtualHost>
```
2. Modifier le fichier hosts de l'OS `127.0.0.1 www.projet-php.local`.

### Composer
Si le projet ne se lance pas, il peut être nécessaire d'exécuter certaines commandes. Il faut commencer par télécharger **composer**, en ligne de commande ou avec l'exécutable [ici](https://getcomposer.org/download/). Vous pouvez en suivant l'ajouter à la variable d'environnement PATH afin de faciliter la suite. Supprimez le dossier `vendor/` puis exécutez la commande `composer install --no-dev` à la racine du projet.

### Tests automatiques
Pour pouvoir exécuter les différents tests (situés dans le dossier `tests/`), il faut installer **phpunit** et **composer** auparavant (point précédent). Une fois composer installé, exécutez la commande suivante à la racine du projet `composer install`. 
1. Pour vérifier que l'installation s'est bien passée `./vendor/bin/phpunit --version`.
2. Pour exécuter une classe de tests `./vendor/bin/phpunit tests/users/TestAddUser.php`.
3. Pour exécuter une fonction en particulier `./vendor/bin/phpunit --filter testSuccess tests/users/TestAddUser.php`.
4. Plus d'informations [ici](https://phpunit.de/).



## Détails sur le projet

### Page de connexion

Les identifiants de connexions sont respectivement "user" et "password" pour le login et le mot de passe. Aucunes pages de l'application n'est accessible sans être connecté.  

### Liste des usagers
Cette page présente tous les usagers de l'application sous forme de tableau / liste. Il est possible de faire une recherche sur le nom ou le prénom dans l'input en haut à droite, dans ce cas la page affichera tous les usagers dont le nom ou le prénom contient le motif spécifié. Pour ajouter un usager, l'utilisateur est obligé de spécifier tous les champs de la modale ainsi que la photo de profil (en cliquant dessus), il obtiendra un message d'erreur sinon. De même, si le numéro de sécurité sociale n'est pas conforme (15 chiffres) ou si le code postal n'est pas valide (5 chiffres), un message d'erreur sera affiché. Nous nous sommes rendus compte à la fin que les icones ne sont pas forcément très explicites, voici donc à quoi correspondent les champs du haut vers le bas et de gauche à droite : photo de profil, nom, prénom, civilité, numéro de sécurité sociale, date de naissance, lieu de naissance, code postal, ville, adresse et médecin référent (facultatif). C'est le même principe avec la modale de modification (en cliquant sur l'utilisateur) mais cette fois ci la photo de profil n'est pas modifiable.

### Liste des médecins
Les fonctionnalités sont les mêmes que pour la page précédente, un bouton a été ajouté afin de pouvoir avoir accès rapidement aux consultations associées au médecin sélectionné. Comme pour les usagers, la suppression d'un médecin supprime aussi tous ses rendez-vous, il n'y a pas d'archivage.

### Liste des consultations
L'utilisateur a accès à la liste des consultations triées par ordre chronologique, il peut filtrer cette liste afin d'afficher seulement les consultations associées à un médecin ou à un usager particulier. L'ajout et la modification d'un rendez-vous peuvent parfois faire apparaitre un message d'erreur si un chevauchemement s'est produit. Nous gérons ce cas d'erreur grace à cette requête SQL qui sélectionne tous les rendez-vous qui chevauchent le rendez-vous qu'on souhaite ajouter, on vérifie donc que cette requête nous renvoie bien 0 ligne.
```php
$req = "SELECT * FROM Rdv
        WHERE idMedecin = :idDoctor
          AND ( (:dateTime >= dateHeureDebut AND :dateTime < dateHeureDebut + INTERVAL duree MINUTE) 
              OR
              (:dateTime <= dateHeureDebut AND :dateTime + INTERVAL :duration MINUTE > dateHeureDebut) )";
```

### Statistiques
Cette page affiche deux tableaux :
* Un tableau à double entrée affichant la répartition des usagers selon leur sexe et leur âge (moins de 25 ans, entre 25 et 50 ans, plus de 50 ans).
* La durée totale des consultations effectuées par chaque médecin (en nombre d'heures).

Chaque tableau est associé à un graphique qui représente les mêmes données.


