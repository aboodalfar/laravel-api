<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Http\Requests\RegisterRequest;
class UserController extends Controller
{
    
    protected $model;
     public function __construct(User $user)
   {
       // set the model
       $this->model = new \App\Repositories\Repository($user);
   }
    public function register(RegisterRequest $request)
    {
    

        try {
//            $hasher = app()->make('hash');
//            $first_name = $request->input('first_name');
//            $last_name = $request->input('last_name');
//            $email = $request->input('email');
//            $cellular_number = $request->input('cellular_number');
//            $password = $hasher->make($request->input('password'));
            
            $data = $request->only($this->model->getModel()->getFillable());
            $hasher = app()->make('hash');
            $data['password'] = $hasher->make($request->input('password'));
            
            $user = $this->model->create($data);

//            $save = User::create([
//                'first_name'=> $first_name,
//                'last_name'=> $last_name,
//                'email'=> $email,
//                'password'=> $password,
//                'cellular_number'=>$cellular_number,
//                'api_token'=> ''
//            ]);
            $res['status'] = true;
            $res['message'] = 'Registration success!';
            $res['user'] = $user;
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 422);
        }
    }

    public function getUser()
    {
        $user = User::find('');
        if ($user) {
              $res['status'] = true;
              $res['message'] = $user;

              return response($res);
        }else{
          $res['status'] = false;
          $res['message'] = 'Cannot find user!';

          return response($res);
        }
    }
}