# artichaut-backend


### Pré-requis
- PHP version >= 8
```
$ sudo apt install openssl php8.2 php8.2-fpm php8.2-cli php8.2-common php8.2-bcmath php8.2-curl php8.2-mbstring php8.2-mysql php8.2-xml php8.2-zip
```
- Docker desktop (pour l'installation locale)


### Installation locale

1. Cloner le répertoire git sur la machine locale
```
$ git clone git@github.com:cnmichel/artichaut-backend.git
```
- Vérifier que le répertoire appartient à apache
```
$ sudo chown www-data:www-data /var/www/artichaut-backend/ -R
```
2. Installer les dépendences du projet avec composer
```
$ cd artichaut-backend
$ composer install
```
3. Démarrer les conteneurs Docker avec Laravel Sail
```
$ ./vendor/bin/sail up
```
- *Créer un alias pour la commande sail et l'ajouter dans le fichier .bashrc*
```
$ alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
4. Générer le fichier .env pour les paramètres du projet et récuperer les valeurs depuis slack ou autre
```
$ cp .env.example .env
```

### Installation sur le serveur distant
1. Cloner le répertoire git sur la machine distante
```
$ cd /var/www
$ git clone git@github.com:cnmichel/artichaut-backend.git
```
2. Installer les dépendences du projet avec composer
```
$ cd artichaut-backend
$ composer install
```
3. Générer le fichier .env pour les paramètres du projet et récuperer les valeurs depuis slack ou autre
```
$ cp .env.example .env
```
```
APP_NAME=Artichaut
APP_ENV=production
APP_DEBUG=false
APP_URL=https://artichauthotel.fr
APP_TIMEZONE='Europe/Paris'

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=artichaut
DB_USERNAME=''
DB_PASSWORD=''
```
4. Générer la clé du projet Laravel
```
$ php artisan key:generate
```
5. Mettre en cache la config et linker le dossier storage public
```
$ php artisan config:cache
$ php artisan storage:link
```
6. Créer le fichier de config de l'hôte virtuel (vhost) et le configurer
```
$ sudo nano /etc/apache2/sites-available/artichauthotel.conf
```
```
<VirtualHost *:80>
    ServerName artichauthotel.fr
    ServerAlias www.artichauthotel.fr
    DocumentRoot /var/www/artichaut-frontend/dist
    <Directory /var/www/artichaut-frontend>
        FallbackResource /index.html
        AllowOverride All
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

<VirtualHost *:80>
    ServerName api.artichauthotel.fr
    DocumentRoot /var/www/artichaut-backend/public
    <Directory /var/www/artichaut-backend>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Allow from all
        Require all granted
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
7. Ajouter le fichier vhost crée et redémarrer apache
```
$ sudo a2ensite artichauthotel.conf
$ sudo systemctl restart apache2
```
