<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cart;
session_start();
class CartController extends Controller
{
    //thêm giỏ hàng
    public function save_cart(Request $request){
      
        $bookId = $request->bookid_hidden;
        $quantity= $request->qty;   
        $book_info = DB::table('tbl_book')->where('book_id',$bookId)->first();
        $cate_book=DB::table('tbl_category')->orderby('category_id','desc')->get();
        $pub_book=DB::table('tbl_publisher')->orderby('publisher_id','desc')->get();
       
        $data['id'] = $bookId;
        $data['qty'] = $quantity;
        $data['name'] = $book_info->book_name;
        $data['price'] = $book_info->book_price;
        $data['weight'] = $book_info->book_inventory;
        $data['options']['image'] = $book_info->book_image;
        if( $data['qty']> $data['weight']){
            Session::put('message','Vui lòng chọn số lượng không vượt quá tồn kho');  
            return redirect()->back();
        }
        else{

        Cart::add($data);
        Cart::setGlobalTax(0);//cài thuế =0%
        Session::put('messagecart','Thêm sách thành công');  
        return redirect()->back();
        }
    }
    public function show_cart(){
        $cate_book=DB::table('tbl_category')->orderby('category_id','desc')->get();
        $pub_book=DB::table('tbl_publisher')->orderby('publisher_id','desc')->get();
   
        return view('pages.cart.show_cart')->
        with('category',$cate_book)->with('publisher',$pub_book);
    }

    public function delete_cart($rowId){
    Cart::update($rowId,0);
    Session::put('messagecart1','Sách đã được xóa ra khỏi giỏ hàng');  
    return Redirect::to('show-cart');

    }
    public function delete_all_cart(){
        cart::destroy();
        return Redirect::to('show-cart');
    
        }
    public function update_cart_qty(Request $request){
        $rowId = $request->rowId_cart;
        $cart_qty = $request->cart_qty;
        Cart::update($rowId,$cart_qty);
        Session::put('messagecart1','Cập nhật sách thành công!');  
        return Redirect::to('show-cart');

    }
}
