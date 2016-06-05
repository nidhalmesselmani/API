<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use \Slim\Slim AS Slim;
require './vendor/autoload.php';
require  'database.php';




$app = new \Slim\Slim();
$app->add(new \CorsSlim\CorsSlim());

$app->db = function(){
  return new Capsule;
};
require '/routes/users/profiles.php';