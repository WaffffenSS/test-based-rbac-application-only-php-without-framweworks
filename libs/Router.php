<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app;


/**
 * Class Router
 * Simple router
 *
 * @package app
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class Router
{
    /**
     * Action name in controller
     *
     * @var string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_action;

    /**
     * Controller instance
     *
     * @var \app\Controller
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_controller;

    /**
     * Controller name
     *
     * @var string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_controllerName;

    /**
     * Query params
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_queryParams;

    /**
     * Post params
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_post = [];

    /**
     * Get params
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_get = [];

    /**
     * Controller ID
     *
     * @var null|string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_controllerID = null;

    /**
     * Router constructor.
     * Init base router. Parse all request params
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function __construct()
    {
        $request = explode('?', $_SERVER['REQUEST_URI']);
        $uri = explode("/", trim($request[0], '/'));
        $this->_controllerName = "app\\http\\controllers\\" . ucfirst($uri[0]) . "Controller";
        $this->_controllerID = $uri[0];
        $this->_action = $uri[1];
        $this->parseRoute();

        if (count($uri) > 2) {
            for ($i = 2; $i < count($uri); $i += 2) {
                if (isset($uri[$i])) {
                    if (isset($uri[$i + 1])) {
                        $this->_queryParams[$uri[$i]] = $uri[$i + 1];
                    }
                }
            }
        }
    }

    /**
     * Parse query string variables as query params
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected function parseRoute()
    {
        parse_str($_SERVER['QUERY_STRING'], $this->_queryParams);
    }

    /**
     * Get variable value from $_GET params or return $default value
     *
     * @param string $key Key
     * @param mixed  $default Default value
     *
     * @return mixed|null
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function get($key, $default = null) {
        return isset($this->_get[$key]) ? $this->_get[$key] : $default;
    }

    /**
     * Get variable value from $_POST params or return $default value
     *
     * @param string $key Key
     * @param mixed  $default Default value
     *
     * @return mixed|null
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function post($key, $default = null) {
        return isset($this->_post[$key]) ? $this->_post[$key] : $default;
    }

    /**
     * Get variable value from Query string  params or return $default value
     *
     * @param string $key Key
     * @param mixed  $default Default value
     *
     * @return mixed|null
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function input($key, $default = null) {
        return isset($this->_queryParams[$key]) ? $this->_queryParams[$key] : $default;
    }

    public function getQueryParams() {
        return $this->_queryParams;
    }

    public function getControllerName() {
        return $this->_controllerName;
    }

    public function getActionName() {
        return $this->_action;
    }

    public function getControllerID() {
        return $this->_controllerID;
    }

    public function send() {
        $this->_controller = new $this->_controllerName($this);
        $actionName = 'action'  .ucfirst($this->_action);
        $this->_controller->{$actionName}();
    }
}