<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class Publisher extends Controller
{
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function show_publisher_home($publisher_id){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        
        $pub_by_id=DB::table('tbl_book')
        ->join('tbl_publisher','tbl_book.publisher_id','=','tbl_publisher.publisher_id')
        ->join('tbl_category','tbl_category.category_id','=','tbl_book.category_id')
        ->where('tbl_book.publisher_id',$publisher_id)
        ->where('category_status','1')
        ->where('book_status','1')->orderby('book_id','desc')->paginate(9);
        $pub_name=DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->first();
        return view('pages.publisher.show_publisher')
        ->with('category',$cate_book)->with('publisher',$pub_book)->with('publisher_by_id',$pub_by_id)
        ->with('publisher_name',$pub_name);
    }
    public function add_publisher(){
        return view('admin.add_publisher');
    }
    public function all_publisher(){
        $this ->AuthLogin();
        $all_publisher = DB::table('tbl_publisher')->get();
        $manager_publisher = view('admin.all_publisher')->with('all_publisher',$all_publisher);
        return view('admin_layout')->with('admin.all_publisher',$manager_publisher);
    }
    public function save_publisher(Request $request){
        $this ->AuthLogin();
        $data= array();
        $data['publisher_name'] = $request->publisher_name;
        $data['publisher_desc'] = $request->publisher_desc;
        $data['publisher_status'] = $request->publisher_status;
        DB::table('tbl_publisher')->insert($data);
        Session::put('message','Thêm danh mục thành công!');
        return Redirect::to('add-publisher');
       
    }
    //                                      biến $publisher_id là từ {publisher_id} của file web
    public function active_publisher($publisher_id){
        $this ->AuthLogin();
 // vào csdl, bảng tbl_publisher, đk: publisher_id trong bảng = $publisher_id (id mà user vừa chọn)=> update publisher_status
       DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->update(['publisher_status'=>1]);
       Session::put('message','Hiện thị danh mục thành công');
       return Redirect::to('all-publisher');
    }
    public function unactive_publisher($publisher_id){
        $this ->AuthLogin();
       DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->update(['publisher_status'=>0]);
       Session::put('message','Ẩn danh mục thành công');
       return Redirect::to('all-publisher');
    }
    public function edit_publisher(Request $request,$publisher_id){
        $this ->AuthLogin();
        $edit_publisher = DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->get();
        $manager_publisher = view('admin.edit_publisher')->with('edit_publisher',$edit_publisher);
        return view('admin_layout')->with('admin.edit_publisher',$manager_publisher);

       
    }
    public function update_publisher(Request $request,$publisher_id){
        $this ->AuthLogin();
        $data= array();
        $data['publisher_name'] = $request->publisher_name;
        $data['publisher_desc'] = $request->publisher_desc;
      
        DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->update($data);
        Session::put('message','Sửa danh mục thành công!');
        return Redirect::to('all-publisher');
       
       
    }
    public function delete_publisher(Request $request,$publisher_id){
        $this ->AuthLogin();
        DB::table('tbl_publisher')->where('publisher_id',$publisher_id)->delete();
        Session::put('message','Xóa danh mục thành công!');
        return Redirect::to('all-publisher');
       
       
    }

    
}
