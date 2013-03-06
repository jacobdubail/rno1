#!/bin/bash

git add . && git commit -am "commiting from subl" && git push origin && ssh root@rno1.com "cd /var/www/vhosts/rno1.com/httpdocs/wp-content/themes/rno1 && git pull"