#!/usr/bin/env bash

SRC_DIR=$(git rev-parse --show-toplevel)
cd ${SRC_DIR}

rm -rf vendor/
composer install --no-dev
