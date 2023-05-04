<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class Book extends Controller
{
     public function show_book($book_id){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();
        $book_show = DB::table('tbl_book')->where('book_id',$book_id)->where('book_status','1')
        ->join('tbl_category','tbl_category.category_id','=','tbl_book.category_id')
        ->join('tbl_publisher','tbl_publisher.publisher_id','=','tbl_book.publisher_id')->where('category_status','1')->where('publisher_status','1')
        ->get(); 
        foreach($book_show as $key => $value){
            $category_id = $value->category_id;
            $publisher_id = $value->publisher_id;
               
            }
            //gợi ý sách liên quan: có cùng danh mục, nhà xuất bản
        $sachlienquan=DB::table('tbl_book')->join('tbl_publisher','tbl_book.publisher_id','=','tbl_publisher.publisher_id')
        ->where('tbl_book.publisher_id',$publisher_id)->join('tbl_category','tbl_book.category_id','=','tbl_category.category_id')
        ->where('tbl_book.category_id',$category_id)->where('book_status','1')->where('category_status','1')->where('publisher_status','1')->whereNotIn('book_id',[$book_id])->paginate(4);
        return view('pages.book.show_book')->with('category',$cate_book)->with('publisher',$pub_book)
        ->with('book_show',$book_show)->with('sachlienquan',$sachlienquan);
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
    //  qly sách
        // liệt kê-sách
        public function all_book(){
            $this ->AuthLogin();
            $all_book = DB::table('tbl_book')->orderby('tbl_book.book_id','desc')->get();   
            return view('admin.all_book')->with('all_book',$all_book);    
        }
        public function add_book(){
            $this ->AuthLogin();
            $cate_book=DB::table('tbl_category')->orderby('category_id','desc')->get();
            $pub_book=DB::table('tbl_publisher')->orderby('publisher_id','desc')->get();
            return view('admin.add_book')->with('cate_book',$cate_book)->with('pub_book',$pub_book);
        }

        public function qly_chitiet_book($book_id){
            $this ->AuthLogin();
            $show_book =  DB::table('tbl_book')->where('book_id',$book_id)->get();   
            return view('admin.chitietsach')->with('all_book',$show_book);
        }
        public function save_book(Request $request){
            $this ->AuthLogin();
            $data= array();
            $data['book_name'] = $request->book_name;
            $data['book_inventory'] = $request->book_inventory;
            $data['book_price'] = $request->book_price;
            $data['book_desc'] = $request->book_desc;
            $data['book_author'] = $request->book_author;
           
            $data['category_id'] = $request->book_cate;
            $data['publisher_id'] = $request->publisher_id;
            $data['book_status'] = $request->book_status;
    
            $get_image=$request->file('book_image');
            if($get_image){
                $get_name_image=$get_image->getClientOriginalName();
                $name_image=current(explode('.',$get_name_image));
                $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image ->move('public/uploads/book',$new_image);
                $data['book_image']=$new_image;
                DB::table('tbl_book')->insert($data);
                Session::put('message','Thêm Sách thành công!');
                return Redirect::to('add-book');
            }
            $data['book_image']='';
            Session::put('message','Thêm Sách không thành công!');
            return Redirect::to('add-book');
        }
        //    biến $book_id là từ {book_id} của file web
        public function active_book($book_id){
            $this ->AuthLogin();
           DB::table('tbl_book')->where('book_id',$book_id)->update(['book_status'=>1]);
           Session::put('message','Hiện thị Sách thành công');
           return Redirect::to('all-book');
        }
        public function unactive_book($book_id){
            $this ->AuthLogin();
           DB::table('tbl_book')->where('book_id',$book_id)->update(['book_status'=>0]);
           Session::put('message','Ẩn Sách thành công');
           return Redirect::to('all-book');
        }
        public function edit_book(Request $request,$book_id){
            $this ->AuthLogin();
            $cate_book=DB::table('tbl_category')->orderby('category_id','desc')->get();
            $pub_book=DB::table('tbl_publisher')->orderby('publisher_id','desc')->get();
            $edit_book = DB::table('tbl_book')->where('book_id',$book_id)->get();
            return view('admin.edit_book')->with('edit_book',$edit_book)->with('cate_book',$cate_book)->with('pub_book',$pub_book);;
        }
        public function update_book(Request $request,$book_id){
            $this ->AuthLogin();
            $data= array();
            $data['book_name'] = $request->book_name;
            $data['book_price'] = $request->book_price;
            $data['book_inventory'] = $request->book_inventory;
            $data['book_desc'] = $request->book_desc;
            $data['book_author'] = $request->book_author;
           
            $data['category_id'] = $request->book_cate;
            $data['publisher_id'] = $request->publisher_id;
            $data['book_status'] = $request->book_status;
            $get_image = $request->file('book_image');
            if($get_image){
                        $get_name_image = $get_image->getClientOriginalName();
                        $name_image = current(explode('.',$get_name_image));
                        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                        $get_image->move('public/uploads/book',$new_image);
                        $data['book_image'] = $new_image;
                        
            }
                
                DB::table('tbl_book')->where('book_id',$book_id)->update($data);
                Session::put('message','Cập nhật sách thành công');
                return Redirect::to('all-book');
        }
        public function delete_book(Request $request,$book_id){
            $this ->AuthLogin();
            DB::table('tbl_book')->where('book_id',$book_id)->delete();
            Session::put('message','Xóa Sách thành công!');
            return Redirect::to('all-book');
        }



}
