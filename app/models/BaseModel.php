<?php

namespace App\Models;

use Silex\Application;

/**
 * Class BaseModel
 * @package App\Models
 */
class BaseModel
{
    protected static $db;
    protected $_db;

    function __construct()
    {
        $this->_db = BaseModel::getDb();
    }

    public static function getDb()
    {
        return self::$db;
    }

    public static function setDb($db)
    {
        self::$db = $db;
    }
}