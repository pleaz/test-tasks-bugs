## Test App

The test app is a simple app that allows you to create, read, update, and delete tasks and bugs. For running the app, you need to run the following commands:

install the sail package:
```bash
composer require laravel/sail --dev
```

publish the environment file:
```bash
cp .env.example .env
```

add the following variables to the .env file if default ports are already in use:

```bash 
APP_PORT=...
FORWARD_DB_PORT=...
```

for running the app, you need to run the following command:
```bash
vendor/bin/sail up -d
```

for populating the database with the necessary data, you need to run the following command:

```bash
vendor/bin/sail artisan migrate:fresh --seed
