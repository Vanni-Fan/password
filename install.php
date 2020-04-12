<?php
$tips = 'Please enter a 6-9 digit password:';

if(is_null($argv[1])){
    $key = random_int(10000000,99999999);
    $key = getInput("$tips default [{$key}]:", $key);
}else{
    $key = $argv[1];
    if(!preg_match('/^\d{6,9}$/', $key)){
        $key = getInput($tips, $default);
    }
}

$var = chr(random_int(97,122));
$str = str_replace(['__VAR__','__KEY__'],[$var, $key],file_get_contents('./hp/Password.zep.tmp'));

file_put_contents('./hp/Password.zep',$str);

function getInput($tips, $default){
    echo $tips;
    $f = fopen('php://stdin','r');
    $s = trim(fgets($f)) ?: $default;
    fclose($f);
    if(preg_match('/^\d{6,9}$/', $s)){
        return $s;
    }else{
        return getInput($tips, $default);
    }
}

echo "\nYour input is [$key], please remember this password!\n";
system('zephir build');
