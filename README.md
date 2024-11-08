## Test App

The test app is a simple app that allows you to create, read, update, and delete tasks and bugs. For running the app, you need to run the following commands:

for run the app:

```bash
sail up -d
```

add to .env file if 80 and 3306 ports are already in use:

```bash 
APP_PORT=...
FORWARD_DB_PORT=...
```

run the following command to migrate the database:

```bash
sail artisan migrate:fresh --seed
