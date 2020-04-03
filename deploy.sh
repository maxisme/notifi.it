#!/bin/bash

PROJECT="notifi"

. ~/.profile

cd $(dirname "$0")

# pull latest from project you have created
git fetch origin
git checkout master
if git merge $1; then

    # build binary
    go build -o /usr/local/bin/$PROJECT .

    # reload binary
    systemctl restart $PROJECT.service
else
    echo "problem merging"
    exit 1
fi
