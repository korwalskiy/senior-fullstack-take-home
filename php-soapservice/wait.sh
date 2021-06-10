#!/bin/bash

export $(cat /app/.env | xargs)

while ! nc -z $DB_HOST $DB_PORT; do
    sleep 1
    echo "Waiting for database..."
done

echo "Database is live 😀, importing schema"
mysql --user=$DB_USERNAME --password=$DB_PASSWORD --port=$DB_PORT --host=$DB_HOST $DB_NAME --default-auth=mysql_native_password < /app/config/schema.sql

exec "$@"