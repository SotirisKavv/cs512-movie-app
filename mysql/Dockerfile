ARGS MYSQL_V=""
FROM mysql:${MYSQL_V:-latest}

ADD initDB.sql /docker-entrypoint-initdb.d
