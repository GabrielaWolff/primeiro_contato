#!/bin/sh

docker-compose down;
sudo chown -R $USER:$USER .mysql;
docker-compose up -d --build;
