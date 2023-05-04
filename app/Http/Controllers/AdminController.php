<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;

use App\Http\Requests;
// use App\Http\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class AdminController extends Controller
{
    
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
        }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this ->AuthLogin();
        return view('admin.dashboard');
    }
  
    public function check_login(Request $REQUEST){
        $admin_email=$REQUEST->admin_email;
        $admin_password=md5($REQUEST->admin_password);
        $result=DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
        session::put('admin_name',$result->admin_name);
        session::put('admin_id',$result->admin_id);
        return Redirect::to('/dashboard');
        }
        else{
            session::put('message','Thông tin đăng nhập không đúng! Vui lòng nhập lại!!!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this ->AuthLogin();
        session::put('admin_name',null);
        session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    // qly khách hàng
        // liệt kê-khách hàng
        public function customer(){
            $this->AuthLogin();
            $all_customer = DB::table('tbl_customer')->orderby('customer_id','desc')->get();
            return view('admin.all_customer')->with('all_customer', $all_customer);
        }
        
    //xem đơn hàng thuộc khách hàng
    public function customer_order($customer_id){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')->where('tbl_order.customer_id','=',$customer_id)
        ->orderby('tbl_order.order_id','desc')->get();
        return view('admin.manage_order')->with('all_order', $all_order);  
    }

}
