#!/bin/bash

git checkout .
git fetch -vp
git pull

composer install
vendor/bin/xervice da:ge
vendor/bin/xervice pr:co:ge
vendor/bin/xervice pr:mo:bu
vendor/bin/xervice pr:mi

npm install
npm run build