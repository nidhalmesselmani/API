<?php
namespace REST\models;
use Illuminate\Database\Eloquent\Model as Eloquent;


class User extends Eloquent{
public function getFullNameOrUsername(){
    if(empty($this->first_name)||empty($this->last_name)){
        return $this->username;


    }
    return "{$this->first_name} {$this->last_name}";
}
}