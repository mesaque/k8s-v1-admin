#!/bin/bash

/usr/bin/nginx -g "daemon off;" &
/usr/local/sbin/php-fpm --nodaemonize &

while true; do sleep 1d; done