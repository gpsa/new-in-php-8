<?php
//declare(strict_types=1);
try {
    var_dump(strlen(new stdClass));
}catch (TypeError $ex){
    echo $ex;
}
# PHP 7
// Warning: strlen() expects parameter 1 to be string, object given in /code/src/consistent_type_errors.php on line 4
//NULL

# PHP 8
// TypeError: strlen() expects parameter 1 to be string, object given