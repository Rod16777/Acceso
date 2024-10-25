<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS SERVICIOS (
      SER_ID INTEGER,
      SER_NOMBRE TEXT NOT NULL,
      SER_DESCRIPCION TEXT NOT NULL,
      SER_TIPO TEXT NOT NULL,
      CONSTRAINT SER_PK
       PRIMARY KEY(SER_ID),
      CONSTRAINT SER_NOM_UNQ
       UNIQUE(SER_NOMBRE),
      CONSTRAINT SER_NOM_NV
       CHECK(LENGTH(SER_NOMBRE) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
