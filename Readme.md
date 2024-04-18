# Bienvenue dans mon projet

### to run the project
Clone repo
Launch apache and mysql servers

- composer update
- php bin/console d:database:create
- php bin/console make:migration
- php bin/console d:mi:m
- Symfony console doctrine:fixtures:load
- Symfony serve


### Must have 
 + Symfony: latest version
 + Php: latest version
 + Database: Mysql


### lors de l'exécution du projet, par défaut il y aura:
 + compte admin : psuedo : Admin001/mdp : admin
 + 5 comptes réguliers avec Pseudo aléatoire et tous ont le meme mdp : 'notadmin' .
 + 6 véhicules.



### Featueres:
+ Créé/editer/supprimer membre.
+ Créé/supprimer commande.
+ Créé/editer/supprimer vehicule.
+ Login / Signup/
+ validation des forms.
+ Recherche par filtres.
+ Gestion des vehicules, membres et commande.
+ Logout.
+ Autres..