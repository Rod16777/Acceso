<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaDescripcion.php";
require_once __DIR__ . "/../lib/php/validaTipo.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SERVICIO.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $descripcion = recuperaTexto("descripcion");
 $tipo = recuperaTexto("tipo");

 $nombre = validaNombre($nombre);
 $descripcion = validaDescripcion($descripcion);
 $tipo = validaTipo($tipo);

 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: SERVICIOS, values: [SER_NOMBRE => $nombre, SER_DESCRIPCION => $descripcion, SER_TIPO => $tipo]);
 
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/servicio.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "descripcion" => ["value" => $descripcion],
  "tipo" => ["value" => $tipo],
 ]);
});
