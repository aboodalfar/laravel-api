<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Address;
use App\Http\Requests\AddEditAddressRequest;
class AddressController extends Controller
{
    
    protected $model;
     public function __construct(Address $address)
   {
       $this->model = new \App\Repositories\Repository($address);
   }
    

    public function getAddress()
    {
        $res = $this->model->getModel()->paginate(10);
        return response($res); 
    }
    public function getAddressByStatus(Request $request)
    {
        $status = $request->get('status');
        if($status  == 'deleted'){
            $res = $this->model->getModel()::onlyTrashed()->paginate(10);
        }else{
            $res = $this->model->getModel()::withoutTrashed()->paginate(10);
        }
        return response($res); 
    }
    
    
    public function addEditAddress(AddEditAddressRequest $request)
    {
        
        
      
    }
    
    
    
}