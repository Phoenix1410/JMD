Sample Admin Login:
http://localhost/wgi_projects/laravel_11_setup/admin
Email: superadmin@gmail.com
Password: nopass

To migrate database table:

php artisan migrate

To create superadmin user

php artisan db:seed AdminSeeder

To make module(Controller, Model, View, Route) use below command:

php artisan make:module "Menu Name"

To delete module use below command:

php artisan delete:module "Menu Name"