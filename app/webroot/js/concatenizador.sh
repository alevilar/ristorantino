#!/bin/sh

SCRIPT_NAME=todos.js
SCRIPT_MIN_NAME=todos.min.js

rm $SCRIPT_NAME
rm $SCRIPT_MIN_NAME


cat jquery/jquery-1.6.4.min.js >> $SCRIPT_NAME
cat jquery/jquery.tmpl.min.js >> $SCRIPT_NAME
cat knockout-1.2.1.js >> $SCRIPT_NAME
cat knockout.mapping-2.0.min.js >> $SCRIPT_NAME

cat ../../plugins/adition/vendors/js/cake_saver.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/risto.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/adition.package.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/mozo.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/mesa.estados.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/mesa.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/comanda.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/comanda_fabrica.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/adicion.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/producto.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/categoria.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/sabor.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/cliente.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/descuento.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/pago.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/detalle_comanda.class.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/ko_adicion_model.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/adition.events.js >> $SCRIPT_NAME
cat ../../plugins/adition/vendors/js/menu.js >> $SCRIPT_NAME
cat alekeyboard.js >> $SCRIPT_NAME
cat jquery/jquery.mobile-1.0.min.js >> $SCRIPT_NAME
chmod 755 $SCRIPT_NAME



SourceFiles=$SCRIPT_NAME


# Now call Google Closure Compiler to produce a minified version
curl -d output_info=compiled_code -d output_format=text -d compilation_level=SIMPLE_OPTIMIZATIONS --data-urlencode js_code@$SCRIPT_NAME "http://closure-compiler.appspot.com/compile" >> $SCRIPT_MIN_NAME
