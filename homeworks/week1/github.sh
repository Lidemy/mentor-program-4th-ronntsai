#!/bin/bash

# name
curl -s https://api.github.com/users/$1 | grep name -w | cut -d : -f 2| sed 's/",//g'| sed 's/ "//g'
# bio
curl -s https://api.github.com/users/$1 | grep bio | cut -d : -f 2| sed 's/",//g'| sed 's/ "//g'
# location
curl -s https://api.github.com/users/$1 | grep location | cut -d : -f 2| sed 's/",//g'| sed 's/ "//g'
# blog
curl -s https://api.github.com/users/$1 | grep blog | sed 's/",//g'| sed 's/ "blog"://g' | sed 's/  "//g'