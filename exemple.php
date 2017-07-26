<?php
ini_set("display_errors", "1" );



require('fileCodeInject.php');

$fci = new FileCodeInject('exemple.txt');

echo '<pre>';
print_r($fci->getContent());
echo '</pre>';

$fci->injectCode('NEW','MEGA','after',true,true);

echo '<hr>';


echo '<pre>';
print_r($fci->getContent());
echo '</pre>';