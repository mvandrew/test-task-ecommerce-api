#!/bin/sh

docker run --rm -i --tty \
  -u "$(id -u):$(id -g)" \
  --volume $PWD:/app \
  composer "$@"
