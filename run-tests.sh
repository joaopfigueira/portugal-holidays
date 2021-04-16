#!/bin/sh
docker run -it --rm -v $(pwd):/usr/src/holidays holidays php -dzend_extension=xdebug.so ./vendor/bin/phpunit --configuration phpunit.xml --coverage-clover phpunit.coverage.xml --log-junit phpunit.report.xml
