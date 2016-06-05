<?php
use  REST\models\User;


$app->get('/users', function() use ($app){
//$user = User::where('username',$username)->first();

    //echo json_encode($user->getFullNameOrUsername());
try {
    $user = User::get();
    echo $user->toJson();
}catch (Exception $e){
    $app->status(400);
    echo  json_encode(array('status'=>'error','message'=>$e->getMessage()));
}
});
$app->get('/users/:id',function($id) use($app){
   try {
       $user = User::where('id', $id)->get();
       echo $user->toJson();
   }catch (Exception $e){
       $app->status(400);
       echo  json_encode(array('status'=>'error','message'=>$e->getMessage()));
   }
});
/*$app->get('/test',function() use($app){
    $user = new user();
    $user->username = 'nidhal';
    $user->save();
    echo $user->toJson();
});
*/
$app->post('/new', function() use($app){
   try{
   $request = $app->request;
       $data = json_decode($request->getBody());
       $user = new user();

       $user->username = $data->username;
       $user->first_name = $data->first_name;
       $user->last_name = $data->last_name;
       $user->address = $data->address;
 $insert = $user->save();
       if($insert){
           echo json_encode(array('status'=>"success",'message'=>'Insert with success'));
       }else{
throw new Exception('Error in the insert');
       }
   } catch (Exception $e){
   $app->status(400);
       echo json_encode(array('status'=>'error','message'=>$e->getMessage()));
   }
});
$app->put('/update/:id',function($id) use($app){
try {
    $id = (int)$id;

    $request = $app->request;
    $data = json_decode($request->getBody());

    $update = user::where('id', '=', $id)
        ->limit(1)
        ->update(array('username' => $data->username, 'first_name' => $data->first_name, 'last_name' => $data->last_name, 'address' => $data->address));
    if ($update) {
        echo json_encode(array('status' => 'success', 'message' => 'update success'));

    } else {
  throw new Exception("Error update", 1);
    }
}catch (Exception $e){
        $app->status(400);
    echo json_encode(array('status'=>'error','message'=>$e->getMessage()));
    }
});
$app->delete('/delete/:id',function($id) use($app){
   $id = (int)$id;
    try{
        $delete = user::where('id','=',$id)->delete();
        if($delete){
            echo json_encode(array('status'=>'success','message'=>'delete success'));
        }else {
            throw new Exception("Error delete");
        }
    }catch (Exception $e){
        $app->status(400);
    echo json_encode(array('status'=>'error','message'=>$e->getMessage()));
    }
});