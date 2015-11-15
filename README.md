# Symfony Projekt einrichten


## Benötigte Software
* XAMPP oder PHP und MySQL nativ

* SmartGit oder Git nativ


## 1. Projekt aufsetzen

### bestehendes Projekt
1. Projekt mit **Git (Shell)** oder **SmartGit** auschecken
	- **Git (Shell)** `git checkout -b origin/<branchname> <branchname>`
	- **SmartGit** `Repository -> Clone -> Remote Git ...`

2. mit der **Shell** ins **ProjektVerzeichnis** wechseln

3. Commant ausführen: `php composer.phar install`


### neues Projekt
> http://symfony.com/doc/current/book/installation.html


## Projekt konfiguration
### MySQL User anlegen
Damit Symfony2 mit MySQL kommunizieren kann, muss ein User angelegt werden der folgende Rechte auf **seine** Datenbank hat
#### Rechte
* Daten
	* ALLE
* Struktur
	* ALLE
* Administration
	* KEINE


### parameters.yml (Beispiel)
Die Parameters wird beim `php composer.phar install` autogeneriert und muss wie mit folgenden Beispielwerten angepasst werden:
> database_host: localhost  
> database_port: 3306  
> database_name: lehrercalendar  
> database_user: webuser  
> database_password: abc  

## Serverkonfiguration
Ein Server kann per **XAMPP (Apache) Serverkonfiguration** oder per **Symfony nativ** laufen
### Apache (Beispiel)
Hier wird eine Serverkonfiguration für den Host **osp.xam** angelegt  
> #### C:\xampp\apache\conf\extra\httpd-vhosts.conf  
>>&lt;VirtualHost *:80&gt;  
    ServerAdmin webmaster@osp.xam  
    DocumentRoot &quot;C:/xampp/htdocs/osp/web&quot;  
    ServerName osp.xam  
    ServerAlias www.osp.xam  
    ErrorLog &quot;logs/osp.xam-error.log&quot;  
    CustomLog &quot;logs/osp.xam-access.log&quot; common  
&lt;/VirtualHost&gt;  

### Symfony (nativ)
Hier muss nichts konfiguriert werden **(-:**  
einfach folgendes (im ProjektVerzeichnis) ausführen  
**Commant (Shell)** `php app/console server:run`