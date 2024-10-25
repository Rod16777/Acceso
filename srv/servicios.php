<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SERVICIO.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(),  from: SERVICIOS,  orderBy: SER_NOMBRE);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[SER_ID]);
  $id = htmlentities($encodeId);
  $nombre = htmlentities($modelo[SER_NOMBRE]);
  $descripcion = htmlentities($modelo[SER_DESCRIPCION]);
  $tipo = htmlentities($modelo[SER_TIPO]);
  $render .=
   "
   <dl>
      <td> <a href='modifica.html?id=$id'>$nombre</a> </td
      <dd>
      <strong>Descripcion: </strong> $descripcion         
      </dd>
      <dd>
      <strong>Tipo: </strong> $tipo         
      </dd>
    </dl>         
    ";
 }

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});
