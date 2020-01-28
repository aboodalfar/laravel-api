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
            $data = $request->only($this->model->getModel()->getFillable());
            $hasher = app()->make('hash');
            $data['password'] = $hasher->make($request->input('password')); 
            $user = $this->model->create($data);
            $api_token = sha1($user->id.time());
            $user->update(['api_token' => $api_token]);
            $res['status'] = true;
            $res['message'] = 'Registration success!';
            $res['user'] = $user;
            $res['api_token'] = $api_token;
            return response($res, 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 422);
        }
    }
}