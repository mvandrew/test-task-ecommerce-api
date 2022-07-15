#!/bin/sh

docker run --rm -i --tty \
  -u "$(id -u):$(id -g)" \
  --volume $PWD:/var/www/html \
  msav/php-cli:latest "$@"
