#!/bin/bash

POC_DIR="./poc"

usage ()
{
    scripts=""
    for f in $(find ${POC_DIR} -name "*.php");
    do
        scripts="${scripts} $(basename $f)"
    done

    echo " Usage: $0 7|8 script
 Options:
     7 RUN ON PHP 7
     8 RUN ON PHP 8, default
 Available scripts:
 [ ${scripts} ]"

}

test "$1" == "help"
IS_HELP=$?

if [[ $IS_HELP -ne 0 && $# -eq 1 ]]
then
    VERSION=8
    SCRIPT=$1
elif [[ $IS_HELP -ne 0 && $# -eq 2 ]]
then
    VERSION=$1
    SCRIPT=$2
else
    usage
    exit;
fi

# function run_on_docker(){
#
# }

function run_on_docker_compose(){
    docker-compose build "php${VERSION}" > /dev/null
    docker-compose run --rm "php${VERSION}" -d error_reporting=E_ALL -d display_errors=1 ${SCRIPT}
}
# echo $POC_DIR $VERSION $SCRIPT

HAS_DOCKER=$(which docker)
HAS_DOCKER_COMPOSE=$(which docker-compoxse)

if [[ $HAS_DOCKER_COMPOSE -eq 0 ]]
then
    cd ${POC_DIR} && run_on_docker_compose $VERSION $SCRIPT
else
    echo "Docker Compose not found"
    echo "This script is not ready for running on Docker only"
    exit 1
fi

