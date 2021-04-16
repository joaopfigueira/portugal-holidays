#!/bin/sh
docker run -it --rm -v $(pwd):/usr/src/holidays holidays ./vendor/bin/phpunit .
