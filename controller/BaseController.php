<?php

namespace mvc\controller;

use mvc\core\view\RenderEngine;
use mvc\core\App;

/**
 * Base controller is the basic controller design
 * that we have for all of our Controllers.
 * 
 */
class BaseController
{
    /**
     * This method renders a view by calling the Render Engine methods.
     * 
     * @param view is the name of the view
     * @param params is the list of parameters
     */
    public function render($view, $params = []) 
    {
        return RenderEngine::renderView($view, $params);
    }

    public function redirect(string $path, int $code = 301) 
    {
        return App::$app->response->redirect($path, $code);
    }
}

?>