# Weather app

## Setup

Clone the repo
```shell
git clone git@github.com:gaborjonas/weather-app.git &&
cd weather-app
```

Install the composer libraries
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Copy the .env
```shell
cp .env.example .env && vendor/bin/sail up -d
```

Start the containers
```shell
vendor/bin/sail up -d
```

Generate the app key
```shell
vendor/bin/sail artisan key:generate
```

Set the OpenWeather API key in the .env
```
OPEN_WEATHER_API_KEY=
```

Build the front-end assets
```shell
vendor/bin/sail npm build
```

Run the migration to create the database table
```shell
vendor/bin/sail artisan migrate
```

The app is accessible on
```http request
localhost
```
## Available scripts

Check PHP coding standards
```shell
vendor/bin/sail composer lint
```

Fix PHP code formatting
```shell
vendor/bin/sail composer lint-fix
```

Run php tests
```shell
vendor/bin/sail composer test
```

Check JS/Vue coding standards
```shell
vendor/bin/sail npm lint
```

Fix NPM code formatting
```shell
vendor/bin/sail npm lint-fix
```
