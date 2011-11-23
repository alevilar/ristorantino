<?php
print_r(mb_detect_encoding("áéíóúÁlejandro"));

echo "<br>";

echo date('Y-m-d H:i:s', strtotime('now'));

echo "<br>";

echo date('Y-m-d', strtotime('now -1'));