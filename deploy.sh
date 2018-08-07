#!/bin/bash

git reset --hard HEAD
git checkout .
git fetch -vp
git pull

rm -rf src/Orm/*

composer install
vendor/bin/xervice da:ge
vendor/bin/xervice pr:co:ge
vendor/bin/xervice pr:mo:bu
vendor/bin/xervice pr:mi

npm install
npm run build


composer -o dump-autoload