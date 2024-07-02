<?php

namespace Reelz222z\Cryptoexchange\Model;

use PDO;
use PDOException;

class Database
{
    private static $db;

    public static function getDB()
    {
        if (self::$db === null) {
            $dsn = 'sqlite:' . __DIR__ . '/../../crypto_exchange.sqlite';
            try {
                self::$db = new PDO($dsn);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        return self::$db;
    }
}
