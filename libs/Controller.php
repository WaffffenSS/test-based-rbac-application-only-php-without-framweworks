<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app;


/**
 * Class Controller
 * You must extend from this class for all controllers for correctly work or define render method otherwise
 *
 * @package app
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class Controller
{
    /**
     * Router instance
     *
     * @var null|\app\Router
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_router = null;

    /**
     * Layout name
     *
     * @var string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_layout = 'main';

    /**
     * View path (only full)
     *
     * @var null|string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_viewPath = null;

    /**
     * Layout data (for using in layout template)
     *
     * @var array
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected $_layoutData = [];

    /**
     * Controller constructor.
     *
     * @param \app\Router $router Router
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function __construct($router)
    {
        $this->_viewPath = $this->_viewPath ?: __DIR__ . '/http/views';
        $this->_router = $router;
    }

    /**
     * Render view
     *
     * @param string $view   View name
     * @param array  $params Parse in view params
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function render($view, $params = [])
    {
        $this->_layoutData['content'] = $this->getViewContent("{$this->_viewPath}/" . $this->_router->getControllerID() . "/{$view}.php", $params);
        return $this->getViewContent("{$this->_viewPath}/layouts/{$this->_layout}.php", $this->_layoutData);
    }

    /**
     * Render raw view (without controller context)
     *
     * @param string $view   View name
     * @param array  $params Parse in view params
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function renderRaw($view, $params = [])
    {
        return $this->getViewContent("{$view}.php", $params);
    }

    public function renderJSON($data)
    {
        header('Content-Type: application/json');

        echo json_encode($data);
        exit;
    }

    /**
     * Render view content
     *
     * @param string $viewPath Fully view path
     * @param array  $params   View params
     *
     * @return string
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    protected function getViewContent($viewPath, $params)
    {
        ob_start();

        extract($params);

        require $viewPath;

        $content = ob_get_contents();
        ob_clean();

        return $content;
    }
}