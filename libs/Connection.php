<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app;


/**
 * Class Connection
 *
 * @package app
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class Connection
{
    /**
     * Database connection0
     *
     * @var \PDO
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    private $_connection;

    /**
     * Connection constructor.
     * Initialize connection
     *
     * @param string $dsn
     * @param string $user
     * @param string $password
     * @param string $database
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function __construct($dsn, $user, $password, $database)
    {
        $this->_connection = new \PDO($dsn, $user, $password, [
            'charset' => 'utf-8',
        ]);
    }

    /**
     * Get connection
     *
     * @return \PDO
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * Get \PDO statement
     *
     * @param string $st             Statement (query string)
     * @param array  $driver_options Driver pdo options for statement
     *
     * @return \PDOStatement
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function getStatement($st, $driver_options = [])
    {
        return $this->_connection->prepare($st, $driver_options);
    }
}