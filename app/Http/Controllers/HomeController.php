<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Good;
use App\Models\Warehouse;
use App\Models\Process;
use App\Models\DeliveryCar;
use App\Models\UploadGood;
use App\Models\GoodsWarehouse;
use App\Models\DistributionsBack;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->roles_name==["owner"]){
            return view('admin/dashboard');
        }elseif(auth()->user()->roles_name==["Drivers"]){
            $process_number = 0 ;
            $auth_id = auth()->user()->id;
            $recievedGood = Good::where('driver_id',$auth_id)->count();
            $warehouseArrivel = Warehouse::where('driver_id',$auth_id)->count();
            $process_number = @Process::where('user_id', $auth_id)->first()->process_number;
            $take_car = DeliveryCar::where(['driver_id'=> $auth_id,'status'=> '0'])->count();
            $has_upload_order = UploadGood::where(['driver_id'=> $auth_id,'open_status'=> '0'])->count();
            $has_upload_good = GoodsWarehouse::where(['driver_id'=> $auth_id,'status'=> '0'])->count();
            $has_non_warehouse_checked_upload_good = DistributionsBack::where(['driver_id'=> auth()->user()->id,'warehouse_check'=> '0'])->count();
            $has_non_finance_checked_upload_good = DistributionsBack::where(['driver_id'=> auth()->user()->id,'financial_check'=> '0'])->count();

            return view('admin/driverapp/dashboard', compact('recievedGood','warehouseArrivel','process_number','take_car','has_upload_order','has_upload_good','has_non_warehouse_checked_upload_good','has_non_finance_checked_upload_good'));
        }elseif(auth()->user()->roles_name==["Logistics"]){
            return view('admin/logisticapp/dashboard');
        }elseif(auth()->user()->roles_name==["Warehouses"]){
            return view('admin/warehouseapp/dashboard');
        }elseif(auth()->user()->roles_name==["Balances"]){
            return view('admin/financialapp/dashboard');
        }
        return view('admin/dashboard');
    }

}
