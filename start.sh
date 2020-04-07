#!/bin/sh
docker-compose restart && 
docker exec -it swoft-srv-myread-gw bash 
