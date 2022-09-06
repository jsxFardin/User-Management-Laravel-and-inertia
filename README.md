1. Install composer packages

```
$ composer install
```

2. Install npm packages

```
$ npm i
```

3. Create and setup .env file

```
make a copy of .env.example
$ copy .env.example .env
$ php artisan key:generate
put database credentials in .env file
```

4. Migrate and insert records

```
$ php artisan migrate --seed
```

5. Passport install and setup

```
$ php artisan passport:install
Put these keys and values in .env file
APP_URL=
APP_VERSION=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
PASSPORT_CLIENT_ID=
PASSPORT_CLIENT_SECRET=
MIX_APP_URL=
```

6. Serving application
```
$ php artisan serve
$ npm run hot
```

