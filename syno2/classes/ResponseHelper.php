<?php

class ResponseHelper {

    static $mimeType = array(
        'bmp' => array('image/bmp', 'image/x-windows-bmp'),
        'exe' => 'application/octet-stream',
        'js' => array('application/javascript', 'text/javascript'),
        'pdf' => 'application/pdf',
        'json' => 'application/json',
        'xml' => array('application/xml', 'text/xml'),
        'swf' => 'application/x-shockwave-flash',
        'zip' => 'application/zip',
        
        'mp3' => 'audio/mpeg',
        'wma' => 'audio/x-ms-wma',
        'wav' => 'audio/x-wav',
        
        'gif' => 'image/gif',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'tiff' => 'image/tiff',
        
        'svg' => 'image/svg+xml',
        'woff' => 'application/font-woff',
        'eot' => 'application/vnd.ms-fontobject',
        'ttf' => 'application/x-font-ttf',
        'otf' => 'application/x-font-opentype',
        
        'css' => 'text/css',
        'csv' => 'text/csv',
        'html' => 'text/html',
        'htm' => 'text/html',
        
        'mpeg' => 'video/mpeg',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
    );
    
    static function sendResponse($content,$type = 'json') {
        $mime = self::$mimeType[$type];
        if(is_array($mime)) {
            $mime = $mime[0];
        }
        header('Content-Type: ' . $mime);
        echo $content;
        exit();
    }
    static function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

}
