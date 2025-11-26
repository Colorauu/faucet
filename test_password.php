<?php
$senhaPura = "admin";
$hash = '$2y$10$Uv27eLJXEx5sybh.wHpUpO2vswztOMh7mDBT6RyZE3mHfp5xP/VXm';

if (password_verify($senhaPura, $hash)) {
    echo "OK - SENHA CONFERE!";
} else {
    echo "ERRO - SENHA NÃO CONFERE!";
}
