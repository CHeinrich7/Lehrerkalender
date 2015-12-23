# Symfony Projekt einrichten


## Benötigte Software
* XAMPP oder PHP (nativ) und eine Datenbank (MySQL oder PostgreSQL)

* SmartGit oder Git (nativ)


## 1. Projekt aufsetzen

### bestehendes Projekt (auschecken)
1. Projekt mit **Git (Shell)** oder **SmartGit** auschecken
	- **Git (Shell)** `git checkout -b origin/<branchname> <branchname>`
	- **SmartGit** `Repository -> Clone -> Remote Git ...`

2. mit der **Shell** ins **ProjektVerzeichnis** wechseln

3. Commant ausführen: `php composer.phar install`
> Hinweis: Alle Befehle für Symfony gehen auf die Datei `console` im Projektverzeichnis unter `app/` zu finden.
4. In der Shell können die Daten beim `composer install` für die Datenbankverbindung direkt eingegeben werden, oder man editiert nachher die `app/config/paramters.yml`.

### Aufsetzen eines neuen Projekts 
> http://symfony.com/doc/current/book/installation.html


## Projekt konfiguration 
### Datenbank User anlegen
Damit Symfony2 mit Datenbank kommunizieren kann, muss ein User angelegt werden der folgende Rechte auf **seine** Datenbank hat
#### Rechte
**HINWEISE:**  
> Die Datenbank kann manuell oder per Shell angelegt werden  
    über die Shell kann mit dem Befehl `php app/console doctrine:schema:create` die Datenbank angelegt werden. Dafür würde der User ebenfalls Rechte zum Anlegen einer Datenbank benötigen.

* Daten
	* ALLE
* Struktur
	* ALLE
* Administration
	* KEINE  
* Befehle für die Datenbank
    * Erstellen der Datenkbank `php app/console doctrine:schema:create`
    * Updaten der Datenbank `php app/console doctrine:schema:update --force`
    * Droppen der Datenbank `php app/console doctrine:schema:drop --force`
    * Laden von Fixturen `php app/console doctrine:fixtures:load`

### parameters.yml (Beispiel)
Die `app/config/paramters.yml` wird beim `php composer.phar install` autogeneriert und muss wie mit folgenden Beispielwerten angepasst werden (wenn nicht in Punkt 1.4 gemacht):
> database_host: localhost  
> database_port: 3306  
> database_name: lehrercalendar  
> database_user: webuser  
> database_password: abc  

## Laden von Fixturen
Bestimmte Daten müssen automatisch in die Datenbank geladen werden. Dazu gehören ein erster User (Superadmin) und Rollen für das Rechtesystem.
### Rollen
Die zu ladenden Rollen sind zu finden unter `/src/UserBundle/DataFixtures/ORM/roles.json`
### User
Die Login Daten für den Superuser müssen extra angelegt werden und sollten wie folgt aussehen:
> {  
>   "0": "INSERT INTO userrole (id, role) VALUES (1, \"ROLE_SUPER_ADMIN\")",  
>   "1": "INSERT INTO user (id, username, salt, password, is_superuser, is_active, is_deletable, created_at, modified_at, deleted_at, role_id, created_by_id, modified_by_id, deleted_by_id) VALUES (1, \"admin\", \"23xxx95fxxx1afe560axxx78xxxffxxx\", \"F+exxxPR+jxxx84VFDgQExxxuKGvGaxxx0ngtYMxxxR9I6xxxAS1BxxxcD42xUONbUZxxxO8wuJFxxxONixxx==\", 1, 1, 0, \"0000-00-00 00:00:00\", \"0000-00-00 00:00:00\", null, 1, 1, 1, null)"  
> }  

Dabei ist zu beachten:
* Die erste Zeile  `"0": "INSE...` darf nicht verändert werden!
* Die zweite Zeile `"1": "INSE...` deckt alle Pflichtfelder ab.
* Die Datei heißt `sql.json` und liegt ebenso unter `/src/UserBundle/DataFixtures/ORM/`

## Serverkonfiguration
Ein Server kann per **XAMPP (Apache) Serverkonfiguration** oder per **Symfony nativ** laufen
### Apache (Beispiel)
Hier wird eine Serverkonfiguration für den Host **osp.xam** angelegt  
> #### C:\xampp\apache\conf\extra\httpd-vhosts.conf  

> e.g.  
> [project name] = myProject  
> [server name] = myProject.xam  
  
>>&lt;VirtualHost *:80&gt;  
    ServerAdmin webmaster@[server name]  
    DocumentRoot &quot;C:/xampp/htdocs/[project name]/web&quot;  
    ServerName [server name]    
    ServerAlias www.[server name]  
    ErrorLog &quot;logs/[server name]-error.log&quot;  
    CustomLog &quot;logs/[server name]-access.log&quot; common  
&lt;/VirtualHost&gt;  

### Symfony (nativ)
Hier muss nichts konfiguriert werden **(-:**  
einfach folgendes (im ProjektVerzeichnis) ausführen  
**Commant (Shell)** `php app/console server:run`