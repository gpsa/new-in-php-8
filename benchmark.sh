#!/usr/bin/env bash

FIND=${1:-test*.php}
cat /dev/null > result.csv && chmod 777 result.csv

for TEST_SCRIPT in $(find benchmark -maxdepth 1 -name $FIND)
do
    echo "BENCHMARKING ${TEST_SCRIPT}"
    for image in "php:5.6-cli-alpine" "php:7.1-cli-alpine" "php:7.2-cli-alpine" "php:7.3-cli-alpine" "akondas/php:8.0-cli-alpine" "keinos/php8-jit";
    do
    echo "### RUNNING ON ${image}"
    docker run -it --rm \
        -v $(pwd)/${TEST_SCRIPT}:/app/test.php \
        -v $(pwd)/result.csv:/app/result.csv \
        -e CONTAINER_IMAGE=$image \
        $image \
        php -d error_reporting=E_ALL -d display_errors=1 /app/test.php
    done
done