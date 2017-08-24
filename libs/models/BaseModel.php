<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app\models;

use app\App;


/**
 * Class BaseModel
 * Base entity model
 *
 * @package app\models
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
abstract class BaseModel
{
    /**
     * Model attributes value
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public $attributes = [];

    /**
     * Original attributes
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_originalAttributes = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
        $this->_originalAttributes = $attributes;
    }

    /**
     * Get table
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public abstract static function getTable();

    /**
     * Get primary key name
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public abstract static function getPkName();

    public static function getById($id) {
        $query = "SELECT * FROM `" . static::getTable() . "` WHERE `" . static::getPkName() . "` = {$id}";
        var_dump($query);
        $data = App::getInstance()->connection->getConnection()->exec($query);

        if (!$data) {
            return null;
        }

        return new static($data);
    }

    public function isDirty() {
        return count(array_diff($this->attributes, $this->_originalAttributes)) > 0;
    }

    /**
     * Update model
     *
     * @param bool $sync Sync original attributes
     *
     * @return int
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function update($sync = true) {
        if ($this->isDirty()) {
            $sets = '';

            foreach ($this->attributes as $attribute => $value) {
                $sets .= (strlen($sets) ? "," : '') . "{$attribute} = " . App::getInstance()->connection->quote($value);
            }
            if (App::getInstance()->connection->getConnection()->exec("UPDATE `" . static::getTable() . "` SET {$sets} WHERE `" . static::getPkName() . "` = " . $this->attributes[static::getPkName()])) {
                if ($sync) {
                    $this->_originalAttributes = $this->attributes;
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Delete model
     *
     * @param bool $sync Sync original attributes
     *
     * @return int
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function delete($sync = true) {
        if (App::getInstance()->connection->getConnection()->exec("DEFELE FROM  `" . static::getTable() . "` WHERE `" . static::getPkName() . "` = " . $this->attributes[static::getPkName()])) {
            if ($sync) {
                $this->_originalAttributes = $this->attributes;
            }
        }

        return true;
    }
}