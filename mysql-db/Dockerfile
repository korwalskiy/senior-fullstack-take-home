FROM mysql:8

RUN chmod -R go-wx /run/mysqld && chown -R mysql:mysql /usr/share/zoneinfo/

COPY ./migration /docker-entrypoint-initdb.d

CMD mysqld --mysqlx=off --skip-ssl --initialize-insecure=off --user=mysql --default-authentication-plugin=mysql_native_password
