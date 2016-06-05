<?php 


$app->get('/users/:username', function($username) use ($app){
echo  $username;
});