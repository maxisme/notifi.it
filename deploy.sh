#!/bin/bash

. ~/.profile

cd $(dirname "$0")

# pull latest from project you have created
git fetch origin
git checkout master
git merge $1

# get latest version from this project
go get -u github.com/maxisme/appserver

# build binary
go build -o /usr/local/bin/appserver main.go

# reload binary
systemctl restart appserver.service
