#!/bin/bash
# Get the version of the current project
echo -n "Type your env filename: "; read ENV_FILE
clear
VERSION=$(gitversion | grep 'NuGetVersionV2' | sed 's/^.*: //' | tr -d '"' | tr -d ',' | tr -d '\n')
sed "s/APP_VERSION=.*/APP_VERSION=${VERSION}/" $ENV_FILE > $ENV_FILE.tmp
mv $ENV_FILE.tmp $ENV_FILE
echo "Update version to ${VERSION}"
