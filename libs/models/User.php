<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app\models;


/**
 * Class User
 *
 * @package app\models
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class User extends BaseModel
{
    /**
     * Get table name
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public static function getTable()
    {
        return 'user';
    }

    /**
     * Get primary key name
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public static function getPkName()
    {
        return 'id';
    }

}