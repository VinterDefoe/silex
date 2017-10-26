<?php

namespace App\Models;

use Doctrine\DBAL\Connection;

/**
 * Class BaseModel
 * @package App\Models
 */
class BaseModel
{
    /**
     * @var  \Doctrine\DBAL\Connection $db
     */
    protected static $db;
    /**
     * @var  \Doctrine\DBAL\Connection $_db
     */
    protected $_db;

    /**
     * BaseModel constructor.
     */
    function __construct()
    {
        $this->_db = BaseModel::getDb();
    }

    /**
     * @return Connection
     */
    public static function getDb()
    {
        return self::$db;
    }

    /**
     * @param Connection $db
     */
    public static function setDb(Connection $db)
    {
        self::$db = $db;
    }
}