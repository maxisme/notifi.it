#!/bin/bash
git pull
export $(grep -v '^#' .env | xargs)
docker stack deploy -c stack.yml notifiit
