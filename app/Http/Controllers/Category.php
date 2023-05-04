<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class Category extends Controller
{
    
   
    //trang xem sách theo danh mục
    public function show_category_home($category_id){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        $book_by_cate=DB::table('tbl_book')
        ->join('tbl_category','tbl_book.category_id','=','tbl_category.category_id')
        ->join('tbl_publisher','tbl_publisher.publisher_id','=','tbl_book.publisher_id')
        ->where('tbl_book.category_id',$category_id)
        ->where('publisher_status','1')
        ->where('book_status','1')->orderby('book_id','desc')->paginate(9);
        $cate_name=DB::table('tbl_category')->where('category_id',$category_id)->first();
        return view('pages.category.show_category')
        ->with('category',$cate_book)->with('publisher',$pub_book)->with('category_book',$book_by_cate)
        ->with('category_name',$cate_name);
    }
    // admin
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
        }
    public function add_category(){
        $this ->AuthLogin();
        return view('admin.add_category');
    }
    public function all_category(){
        $this ->AuthLogin();
        $all_category = DB::table('tbl_category')->get();
        $manager_category = view('admin.all_category')->with('all_category',$all_category);
        return view('admin_layout')->with('admin.all_category',$manager_category);
    }
    public function save_category(Request $request){
        $this ->AuthLogin();
        $data= array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;
        DB::table('tbl_category')->insert($data);
        Session::put('message','Thêm danh mục thành công!');
        return Redirect::to('add-category');
       
    }

    //      biến $category_id là từ {category_id} của file web
    public function active_category($category_id){
        $this ->AuthLogin();
 // vào csdl, bảng tbl_category, đk: category_id trong bảng = $category_id (id mà user vừa chọn)=> update category_status
       DB::table('tbl_category')->where('category_id',$category_id)->update(['category_status'=>1]);
       Session::put('message','Hiện thị danh mục thành công');
       return Redirect::to('all-category');
    }
    public function unactive_category($category_id){
        $this ->AuthLogin();
       DB::table('tbl_category')->where('category_id',$category_id)->update(['category_status'=>0]);
       Session::put('message','Ẩn danh mục thành công');
       return Redirect::to('all-category');
    }
    public function edit_category(Request $request,$category_id){
        $this ->AuthLogin();
        $edit_category = DB::table('tbl_category')->where('category_id',$category_id)->get();
        return view('admin.edit_category')->with('edit_category',$edit_category);
    }
    public function update_category(Request $request,$category_id){
        $this ->AuthLogin();
        $data= array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
      
        DB::table('tbl_category')->where('category_id',$category_id)->update($data);
        Session::put('message','Sửa danh mục thành công!');
        return Redirect::to('all-category');
    }
    public function delete_category(Request $request,$category_id){
        $this ->AuthLogin();
        DB::table('tbl_category')->where('category_id',$category_id)->delete();
        Session::put('message','Xóa danh mục thành công!');
        return Redirect::to('all-category');
       
       
    }
}
