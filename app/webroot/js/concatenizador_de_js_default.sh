#!/bin/sh

SCRIPT_NAME=todos_default.js
SCRIPT_MIN_NAME=todos_default.min.js

rm $SCRIPT_NAME
rm $SCRIPT_MIN_NAME


cat jquery/jquery-1.6.4.min.js >> $SCRIPT_NAME
cat jquery/jquery.mobile-1.0.min.js >> $SCRIPT_NAME
chmod 755 $SCRIPT_NAME

SourceFiles=$SCRIPT_NAME

# Now call Google Closure Compiler to produce a minified version
curl -d output_info=compiled_code -d output_format=text -d compilation_level=SIMPLE_OPTIMIZATIONS --data-urlencode js_code@$SCRIPT_NAME "http://closure-compiler.appspot.com/compile" >> $SCRIPT_MIN_NAME
