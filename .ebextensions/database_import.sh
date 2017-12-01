#!/bin/sh
for sqlfile in database/*.sql; do

	/usr/bin/mysql \
	-u $RDS_USERNAME \
	-p$RDS_PASSWORD \
	-h $RDS_HOSTNAME \
	$RDS_DB_NAME < $sqlfile
done