<?php

/**
 * Description of TemplateHelper
 *
 * @author sadik
 */
class TemplateHelper {

    public static function loadView($viewName, $vars = null) {
        $file = '';
        if (file_exists(VIEWS . $viewName)) {
            $file = VIEWS . $viewName;
        } else if (file_exists(VIEWS . $viewName . '.html')) {
            $file = VIEWS . $viewName . '.html';
        } else if (file_exists(VIEWS . $viewName . '.htm')) {
            $file = VIEWS . $viewName . '.htm';
        } else if (file_exists(VIEWS . $viewName . '.php')) {
            $file = VIEWS . $viewName . '.php';
        }
        if (!empty($file)) {
            if (is_array($vars)) {
                extract($vars);
            }
            include_once $file;
            return true;
        }
        return false;
    }

    public static function loadSubView($view, $subView, $vars = null) {
        return self::loadView($view . '/' . $subView, $vars);
    }

    public static function loadModal($modal, $modal_title = '', $modal_content = '', $modal_id = 'myModal') {
        return self::loadView($modal, [
                    'modal_title' => $modal_title,
                    'modal_content' => $modal_content,
                    'modal_id' => $modal_id
        ]);
    }
    
    

}
