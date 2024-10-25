<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaDescripcion.php";
require_once __DIR__ . "/../lib/php/validaTipo.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SERVICIO.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");
 $descripcion = recuperaTexto("descripcion");
 $tipo = recuperaTexto("tipo");
 

 $nombre = validaNombre($nombre);
 $descripcion = validaDescripcion("descripcion");
 $tipo = validaTipo("tipo");

 update(
  pdo: Bd::pdo(),
  table: SERVICIOS,
  set: [SER_NOMBRE => $nombre, SER_DESCRIPCION => $descripcion, SER_TIPO => $tipo],
  where: [SER_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "descripcion" => ["value" => $descripcion],
  "tipo" => ["value" => $tipo],
 ]);
});
