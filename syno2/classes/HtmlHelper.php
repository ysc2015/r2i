<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlHelper
 *
 * @author sadik
 */
class HtmlHelper {
    static function makeOptions($array,$value,$text) {
        $options = '';
        foreach($array as $element) {
            $options .= '<option value="' . $element[$value] . '">' . $element[$text] . '</option>';
        }
        return $options;
    }
}
