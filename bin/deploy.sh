#!/usr/bin/env bash

# Based on https://gist.github.com/scribu/1125050

# args
SHORT_HASH=$(git rev-parse --verify --short HEAD)
BRANCH=${1-'trunk'}
MSG=${2-'Deploy '$SHORT_HASH' from git'}

# paths
SRC_DIR=$(git rev-parse --show-toplevel)
DEST_DIR=$SRC_DIR/wordpress.org/$BRANCH

# build first
if [ -f "$SRC_DIR/bin/build.sh" ]; then
	$SRC_DIR/bin/build.sh
fi

# make sure we're deploying from the right dir
if [ ! -d "$SRC_DIR/.git" ]; then
	echo "$SRC_DIR doesn't seem to be a git repository"
	exit
fi

# make sure the destination dir exists
mkdir -p $DEST_DIR
svn add $DEST_DIR 2> /dev/null

# delete everything except .svn dirs
for file in $(find $DEST_DIR/* -not -name "*.svn*" -print)
do
	rm -rf $file
done

# copy everything over from git
rsync --recursive --exclude='*.git*' --exclude /wordpress.org/ $SRC_DIR/* $DEST_DIR

cd $DEST_DIR

# check .svnignore
for file in $(cat "$SRC_DIR/.svnignore" 2> /dev/null)
do
	rm -rf $DEST_DIR/$file
done

# Transform the readme
#if [ -f README.md ]; then
#	mv README.md readme.txt
#	sed -i '' -e 's/^# \(.*\)$/=== \1 ===/' -e 's/ #* ===$/ ===/' -e 's/^## \(.*\)$/== \1 ==/' -e 's/ #* ==$/ ==/' -e 's/^### \(.*\)$/= \1 =/' -e 's/ #* =$/ =/' readme.txt
#fi

# svn addremove
svn stat | awk '/^\?/ {print $2}' | xargs svn add > /dev/null 2>&1
svn stat | awk '/^\!/ {print $2}' | xargs svn rm --force

svn stat

read -r -p "Commit to SVN? (y/n) " should_commit

if [ "$should_commit" = "y" ]; then
	svn ci -m "$MSG"
else
	echo "Commit Aborted!"
fi

# cleanup
if [ -f "$SRC_DIR/bin/after-deploy.sh" ]; then
	$SRC_DIR/bin/after-deploy.sh
fi
