#! /bin/sh
echo "Running TX-cli..."
# Pull all files;
# Minimum percentage change to whatever you want
tx pull -a --minimum-perc=60

# Create .mo files from .po files.
# Twisted by WP-Translations.org, created by grappler.
for file in `find . -name "*.po"` ; do msgfmt -o ${file/.po/.mo} $file ; done
echo "That's it."
return