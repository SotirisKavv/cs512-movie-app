ARG MYSQL_V=""
FROM mysql:${MYSQL_V:-latest}

COPY ./sql_script/ /docker-entrypoint-initdb.d/
