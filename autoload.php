<?php

/* Does the automatical job of loading all the controllers.
 * 
 * Just include this file where you want to include all the controllers.
 * */
function controllers_autoload($className){
    include 'controllers/'.$className.'.php';
}

spl_autoload_register('controllers_autoload');
