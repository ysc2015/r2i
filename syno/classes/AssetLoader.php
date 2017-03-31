<?php

class AssetLoader {
    static $assets = [
        'ladda' => [
            'js' => [
                'plugins/ladda/spin.min.js',
                'plugins/ladda/ladda.min.js',
                'plugins/ladda/ladda.jquery.min.js'
            ],
            'css' => ['ladda/ladda-themeless.min.css']
        ],
        'font-awsome' => [
            'js' => [],
            'css' => [
                'font-awesome/css/font-awesome.css'
            ],
        ],
        'main' => [
            'js' => [
                'js/functions.js',
                'js/functions.js',
            ],
            'css' => [
                'css/bootstrap.min.css',
            ]
        ] 
    ];
    
    static function getPlugin($pattern, $element, $key,$comment) {
        $tag = '';
        if(!empty($comment)) {
            $tag = sprintf('<!-- %s %s -->',$element,$comment);
        }
        $element = strtolower($element);
        $js = self::$assets[$element][$key];
        
        if(is_array($js)) {
            foreach($js as $script) {
                $tag .= sprintf($pattern,ASSETS . $script);
            }
        } else {
            $tag .= sprintf($pattern,ASSETS . $js);
        }
        return $tag;
    }
    static function getScriptTag($element) {
        $tag = getPlugin('<script src="%s"></script>',$element,'js',$element);
        return $tag;
    }

    static function getStyleTag($element) {
        $tag = getPlugin('<link href="%s" rel="stylesheet">',$element,'css',$element);
        return $tag;
    }

    static function loadPlugin() {
        
    }

}
