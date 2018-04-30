#!/bin/bash
rsync -avzh --delete --exclude=sync.sh "/home/cemal/Dropbox/Documents/geziyorum/" "root@cemaltaskiran.com:/var/www/html"
