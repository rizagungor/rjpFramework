#!/bin/bash

localfolder=$1
giturl=$2
gitbranch=$3
gituser=$4
commit=$5

cd $localfolder
git checkout -b $gitbranch
git checkout $gitbranch
git config --global user.email $gituser
git remote add origin $giturl
git config --global user.name $gitbranch
git add .
git commit -am "$commit"
git push -u origin $gitbranch
git status

## sh C:\wamp\www\framework\push.sh "C:\wamp\www\bursatoptantekstil" "https://github.com/rizagungor/bursatoptantekstil" "riza" "rizagungor@gmail.com" "Deneme commit"