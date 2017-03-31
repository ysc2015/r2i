<?php

class FileHelper {

    static $files = [];
    
    static function findAll($baseDir) {
        $repertoire = dir($baseDir);
        while ($file = $repertoire->read()) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $repertoire->path . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                self::$files[self::getFileExtension($file)][] = $filePath;
                continue;
            }
            if (is_dir($filePath)) {
                self::findAll($filePath);
            }
        }
        return true;
    }
    
    static function findAllFileWithExtension($extension,$baseDir) {
        $repertoire = dir($baseDir);
        while ($file = $repertoire->read()) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $repertoire->path . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath) && self::getFileExtension($file) == $extension) {
                self::$files[$extension][] = $filePath;
                continue;
            }
            if (is_dir($filePath)) {
                self::findAllFileWithExtension($extension, $filePath);
            }
        }
        return true;
    }

    static function findFile($fileName, $dir) {
        $repertoire = dir($dir);
        while ($file = $repertoire->read()) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $repertoire->path . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath) && $file == $fileName) {
                return $filePath;
            }
            if (is_dir($filePath)) {
                $found = self::findFile($fileName, $filePath);
                if ($found != false) {
                    return $found;
                }
            }
        }
        return false;
    }

    static function read($file) {
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        return false;
    }

    static function write($file, $content) {
        file_put_contents($file, $content);
    }

    static function getFileExtension($file) {
        $ext = substr($file, strrpos($file, '.') + 1);
        return $ext;
    }

    static function getFileName($filePath) {
        $index = strrpos($filePath, DIRECTORY_SEPARATOR);
        if ($index > -1) {
            return substr($filePath, $index + 1);
        }
        return $filePath;
    }

}
