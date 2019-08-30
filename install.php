<?php
$var = chr(random_int(97,122));
$key = random_int(10000000,99999999);
$key = getInput("Please enter a 6-9 digit password, default [{$key}]:", $key);
$str = str_replace(['__VAR__','__KEY__'],[$var, $key],file_get_contents('./hp/Password.zep.tmp'));

file_put_contents('./hp/Password.zep',$str);

function getInput($tips, $default){
    echo $tips;
    $f = fopen('php://stdin','r');
    $s = trim(fgets($f));
    fclose($f);
    if(preg_match('/^\d{6,9}$/', $s) || empty($s)){
        echo "Your input is [{$default}], please remember this password!";
        return $s ?: $default;
    }else{
        return getInput($tips, $default);
    }
}
echo "\n";
system('zephir build');