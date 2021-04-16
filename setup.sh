#!/bin/sh
docker build -t holidays . && \
docker run -it --rm -v $(pwd):/usr/src/holidays holidays composer install
