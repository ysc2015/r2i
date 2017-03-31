<?php

class AssetsHelper {

    static $css = [];
    static $js = [];
    static $img = [];
    static $font = [];

    const CSS_JSON_FILE = 'css.json';
    const JS_JSON_FILE = 'js.json';
    const IMG_JSON_FILE = 'img.json';
    const FONT_JSON_FILE = 'font.json';

    static function loadStyleFile($file) {
        
    }

    static function getStyleTag($cssFile) {
        $ret = FileHelper::read(Configuration::ASSETS . self::CSS_JSON_FILE);
        if ($ret === false) {
            FileHelper::$files = [];
            FileHelper::findAllFileWithExtension('css', Configuration::ASSETS);
            $json = json_encode(FileHelper::$files);
            FileHelper::write(Configuration::ASSETS . self::CSS_JSON_FILE, $json);
        }
    }

    static function findCssFile($filesArray,$cssFile) {
        
        foreach ($filesArray as $file) {
            $fileName = FileHelper::getFileName($file);
            if ($fileName == $cssFile) {
                return Configuration::getRootFolder() . $file;
            }
        }
    }

}
