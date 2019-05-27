<?php

if(!function_exists('dd')) {
    function dd($value) {
        print('<pre>');
        print_r($value);
        exit;
    }
}
