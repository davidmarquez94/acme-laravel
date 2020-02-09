PRUEBAS DE CONOCIMIENTO PHP / LARAVEL

<b>David Felipe Márquez González</b><br />
<b>Teléfono: </b>321 794 9964<br /><br />
Para comenzar clone el proyecto<br />
<b>SSH: </b>git@github.com:davidmarquez94/acme-laravel.git<br />
<b>HTTPS: </b>https://github.com/davidmarquez94/acme-laravel.git<br /><br />
Ahora siga los siguientes pasos:<br />
Entre en la carpeta del proyecto:<br/>
<b>cd acme-laravel</b><br /><br />
Ejecute lo siguiente en el orden descrito:<br /><br />
<b>composer install</b><br />
<b>php artisan key:generate</b><br />
<b>cp .env.example .env (En ese punto debe generar un archivo .env a partir del archivo .env.example)</b><br />
<b>composer dump-autoload</b><br /><br />
<b>php artisan migrate --seed</b><br /><br /><br /><br />
<b>Usuario del sistema: </b>admin@acme.com<br />
<b>Contraseña: </b>pass_acme.123<br /><br /><br />