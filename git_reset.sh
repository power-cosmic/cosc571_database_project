#!/bin/bash

gitreset="git reset HEAD --hard"
gitpull="git pull origin master"

eval $gitreset
eval $gitpull
