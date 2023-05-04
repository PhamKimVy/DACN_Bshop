<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cart;
session_start();
class Checkout extends Controller
{
   

    // đăng ký- đăng nhập-đăng xuất
    public function login(){
        return view('pages.formdn');
    }
    public function signup(){
        return view('pages.formdk');
    }
    public function logout(){
        Session::flush();
        return  redirect('/');
    }
    // lịch sử mua hàng
    public function show_history($customer_id){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        $customer_order = DB::table('tbl_customer')
        ->join('tbl_order','tbl_order.customer_id','=','tbl_customer.customer_id')->where('tbl_customer.customer_id',$customer_id)->select('tbl_order.*')->orderby('tbl_order.order_id','desc')->get();
        return view('pages.checkout.show_history')->with('category',$cate_book)->with('publisher',$pub_book)->with('history_order',$customer_order);
    }
    // Xem chi tiết đơn hàng
    public function show_history_order($order_id){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();
        $orderId_details = DB::table('tbl_order')->where('tbl_order.order_id',$order_id)->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_book','tbl_book.book_id','=','tbl_order_details.book_id')
        ->select('tbl_order.*','tbl_order_details.*','tbl_book.book_image')->get();
        return view('pages.checkout.view_history_order')->with('view_history_order',$orderId_details)->with('category',$cate_book)->with('publisher',$pub_book); 
}
    // Xử lý yêu cầu đăng nhập
    public function login_customer(request $request){
        $email_customer = $request->email_account;
        $password_customer = md5($request->password_account);
        $checkemail = DB::table('tbl_customer')->where('customer_email',$email_customer)->first();//ktra email nè

        if($checkemail){//emai nếu đúng

            $checkpass = DB::table('tbl_customer')->where('customer_email',$email_customer)->where('customer_password',$password_customer)->first();//ktra pass nè
            if($checkpass){//nếu đúng
            session::put('customer_id',$checkpass->customer_id);
            session::put('customer_name',$checkpass->customer_name);
            session::put('customer_phone',$checkpass->customer_phone);
            session::put('customer_email',$checkpass->customer_email);
            session::put('customer_address',$checkpass->customer_address);   
            return Redirect::to('/');
        }
            else{
                //mk sai
                Session::put('message',"Mật khẩu sai. Vui lòng kiểm tra lại!");
                return Redirect::to('/login');
            }
        }else{//email sai
            Session::put('message',"Sai email. Vui lòng kiểm tra lại!");
            return Redirect::to('/login');
        }
    }
    public function add_customer(request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $customer_repassword = md5($request->customer_repassword);
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;
        $result = DB::table('tbl_customer')->where('customer_email',$data['customer_email'])->first();
        // nếu nhập mail đã có trong dtb
        if($result){
            Session::put('message', 'Email đã có người sử dụng. Vui lòng nhập email khác!');
            return Redirect::to('/signup');
        }
        // nhập lại mật khẩu không đúng
        elseif($customer_repassword!=$data['customer_password'])
        {
            Session::put('message', 'Mật khẩu nhập lại hong đúng. Vui lòng kiểm tra lại!');
            return Redirect::to('/signup');
        }
        // 
        else{
            $customer_id = DB::table('tbl_customer')->insert($data);
            Session::put('messageok', 'Đăng ký tài khoản thành công. Mời bạn đăng nhập để có trải nghiệm tốt nhất!');
            return Redirect::to('/login');
        }
    }
    
//    checkout
    public function show_checkout(){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        return view('pages.checkout.show_checkout')->with('category',$cate_book)->with('publisher',$pub_book); 
    }
    public function save_checkout_customer(request $request){
        $data_order = array();
        //insert order
        $data_order['customer_id'] = Session::get('customer_id');
        $data_order['order_name'] = $request->order_name;
        $data_order['order_address'] = $request->order_address;
        $data_order['order_phone'] = $request->order_phone;
        $data_order['order_total'] = Cart::total();
        $data_order['order_status'] = 'Đang chờ duyệt';
        $order_id = DB::table('tbl_order')->insertGetId($data_order);
        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){//lấy lần lượt các sản phẩm đã đặt
            if($v_content){
                $data_order_details = array();
                $data_order_details['order_id'] =  $order_id;
                $data_order_details['book_id'] =  $v_content->id;
                $data_order_details['book_name'] =  $v_content->name;
                $data_order_details['book_price'] =  $v_content->price;
                $data_order_details['book_sales_quantity'] =  $v_content->qty;
                // giảm tồn kho khi khách đặt hàng
                $data_book['book_inventory'] = $v_content->weight - $v_content->qty;
                DB::table('tbl_order_details')->insert($data_order_details);
                DB::table('tbl_book')->where('book_id', $data_order_details['book_id'])->update($data_book);
            }
        }  
        $cate_book = DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();
        $pub_book = DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();
        //huy gio hang khi đặt hàng thành công 
        Cart::destroy();
        return view('pages.checkout.order_success')->with('category',$cate_book)->with('publisher',$pub_book);
    }



    // admin-manager
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
        }
    public function manage_order(){
      
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        return view('admin.manage_order')->with('all_order',$all_order);
    }
// xem chi tiết đơn hàng
    public function view_order($order_id){
        $this->AuthLogin();
        $orderId = DB::table('tbl_order')->where('tbl_order.order_id',$order_id)
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.*')->first();
        $orderId_details = DB::table('tbl_order')->where('tbl_order.order_id',$order_id)
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_order_details.*')->get();
       
        return view('admin.view_order')->with('orderId',$orderId)->with('orderId_details',$orderId_details);

    }

//admin ghi nhận tình trạng đơn hàng
    public function comfim_order($order_id){
        $this->AuthLogin();
        $data['order_status'] = "Đang vận chuyển";
        $order_by_id = DB::table('tbl_order')->where('order_id', $order_id)->update($data);
        Session::put('message','Bạn đã duyệt đơn hàng thành công!');
        return Redirect::to('manage-order');
    }
    // hủy đơn hàng
    public function cancel_order($order_id){
        $this->AuthLogin();
 
        $data['order_status'] = "Đã bị hủy";
 
        $book_oder =  DB::table('tbl_order')->where('tbl_order.order_id',$order_id)
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->join('tbl_book','tbl_order_details.book_id','=','tbl_book.book_id')
        ->select('tbl_book.*','tbl_order_details.*')->get();
        foreach($book_oder as $book){//lấy lần lượt các sản phẩm đã đặt
                // cập nhật lại số lượng vì xóa đơn hàng
                $data_update =array();
                $data_update['book_inventory'] = $book->book_inventory + $book->book_sales_quantity;
                DB::table('tbl_book')->where('book_id', $book->book_id)->update($data_update);
        }
        $order_by_id = DB::table('tbl_order')->where('order_id', $order_id)->update($data);
        Session::put('message','Bạn đã hủy đơn hàng thành công !');
        return Redirect::to('manage-order');
    }
    

}
