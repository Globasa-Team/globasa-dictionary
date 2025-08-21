<?php
declare(strict_types=1);
namespace WorldlangDict;


/* PHP 8.5 https://php.watch/versions/8.5/array_first-array_last */
function array_first(array $array): mixed {  
  return $array === [] ? null : $array[array_key_first($array)];  
}

/* PHP 8.5 https://php.watch/versions/8.5/array_first-array_last */
function array_last(array $array): mixed {  
  return $array === [] ? null : $array[array_key_last($array)];  
}