<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    public function index(){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        // lấy sản phẩm theo id gần nhất
        $new_book = DB::table('tbl_book')->join('tbl_category','tbl_category.category_id','=','tbl_book.category_id')
        ->join('tbl_publisher','tbl_publisher.publisher_id','=','tbl_book.publisher_id')->where('category_status','1')->where('publisher_status','1')->where('book_status', '1')->orderBy('tbl_book.book_id', 'desc')->paginate(8);
        return view('pages.home')->with('category',$cate_book)->with('publisher',$pub_book)->with('new_book',$new_book);
    }

    public function tim_kiem(request $request){
        $keywords = $request->keywords_search;
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        $search_book = DB::table('tbl_book')
        ->join('tbl_category','tbl_category.category_id','=','tbl_book.category_id')
        ->join('tbl_publisher','tbl_publisher.publisher_id','=','tbl_book.publisher_id')
        ->where('category_status','1')->where('publisher_status','1')
        ->where('book_status','1')
        ->where('book_name','like','%' .$keywords. '%')
        ->orderby('book_id','desc')->get();
        return view('pages.book.search')
            ->with('category',$cate_book)
            ->with('publisher',$pub_book)
            ->with('search_book',$search_book);
    }
    public function contact(){
        $cate_book=DB::table('tbl_category')->where('category_status','1')->orderby('category_id','desc')->get();// chỉ lấy ra danh mục có trạng thái =1
        $pub_book=DB::table('tbl_publisher')->where('publisher_status','1')->orderby('publisher_id','desc')->get();// chỉ lấy ra NXB có trạng thái =1
        return view('pages.contact')->with('category',$cate_book)->with('publisher',$pub_book);
    
    }
}
