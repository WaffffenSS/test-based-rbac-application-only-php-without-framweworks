<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app;


/**
 * Class App
 *
 * @package app
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class App
{
    public $_config;

    /**
     * Database connection
     *
     * @var \app\Connection
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public $connection;

    /**
     * Application router
     *
     * @var \app\Router
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public $router;

    /**
     * @var null|\app\App
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected static $instance = null;

    public function __construct($config)
    {
        $this->_config = $config;
        $this->initConnection();
    }

    /**
     * Init database connection
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected function initConnection() {
        $this->connection = new Connection($this->_config['db']['dsn'], $this->_config['db']['user'], $this->_config['db']['password'], $this->_config['db']['database']);
    }

    public static function getInstance($config = null) {
        if (!$config) {
            return static::$instance;
        }

        return static::$instance = new static($config);
    }

    public function getConfig($key = null) {
        if ($key) {
            return isset($this->_config[$key]) ? $this->_config[$key] : null;
        }

        return $this->_config;
    }

    /**
     * Run application
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function run() {
        $this->router = new Router();
        $this->router->send();
    }
}