#!/bin/bash

cat /opt/app/.env | xargs -L 1 | sed -e 's/^/export /' >> ~/.bashrc

source ~/.bashrc

while ! nc -z $DB_HOST 3306; do
    sleep 1
    echo "Waiting for database..."
done

echo "Database is live 😀, importing schema"
mysql --user=$DB_USERNAME --password=$DB_PASSWORD --host=$DB_HOST $DB_NAME --default-auth=mysql_native_password < /opt/app/config/schema.sql

exec "$@"