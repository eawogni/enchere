Pour configurer la base de donn�e, veullez �diter le fichier se trouvant dans :
configBdd/config.php
---------------------------
configuration virtualhost
-----------------------
<VirtualHost *:80>
	ServerName enchere
	DocumentRoot "c:/wamp64/www/vente-enchere/public"
	<Directory  "c:/wamp64/www/vente-enchere/public/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>

NB: le fichier index.php se trouve dans le r�pertire: public/index.php 

--------------------------------------------------------------------------------
Quelques comptes cr�es
---------------------------------
Admin 
------------------------------
	 login : admin 
  Mot de passe : administrateur
-------------------------------



Utilisateur1
------------------------------
	 login : jean55
  Mot de passe : 12345678
------------------------------



Utilisateur2
------------------------------
	 login : marcus145
  Mot de passe : 12345678