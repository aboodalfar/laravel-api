<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Address;
use App\Http\Requests\{AddEditAddressRequest,RemoveAddressRequest};
use \App\Transformers\AddressTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class AddressController extends Controller
{
    
    protected $model;
    
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @var AddressTransformer
     */
    private $AddressTransformer;
    
     public function __construct(Address $address, Manager $fractal,AddressTransformer $AddressTransformer)
   {
       $this->model = new \App\Repositories\Repository($address);
        $this->fractal = $fractal;
        $this->AddressTransformer = $AddressTransformer;
   }
    

    public function getAddress()
    {
        $address = $this->model->getModel()->paginate(10);
        $res = new Collection($address, $this->AddressTransformer);
        $res->setPaginator(new \League\Fractal\Pagination\IlluminatePaginatorAdapter($address));
        $res = $this->fractal->createData($res); // Transform data
        return response($res->toArray()); 
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
        $data = $request->only($this->model->getModel()->getFillable());
        try{
            $model = $this->model->updateOrCreate($data);
            $res['status'] = true;
            $res['model'] = $model;
            return response($res);
         }
        catch (\Exception $ex){
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 422);
        }
        return response($status);   
    }
    
    public function removeAddress(RemoveAddressRequest $request){
        $status = $this->model->delete($request->get('uuid'));
        return response(['status'=>$status == true]);
    }
    
    
    
}