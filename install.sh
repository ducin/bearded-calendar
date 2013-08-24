#!/bin/bash

# init submodules
git submodule init
git submodule update

cd modules/auth
git checkout 3.2/develop

cd ../../system
git checkout 3.2/develop
