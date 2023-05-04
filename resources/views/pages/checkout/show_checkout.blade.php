<?php 
             $messagecart1 = Session::get('messagecart1');
		
             if($messagecart1){//nếu tồn tại message thì in thông báo ra
              //  echo'<span style="color:red">'. $message.'</span>';
               ?><div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong style=" font-size: 20px">{{$messagecart1 }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div><?php
               Session::put('messagecart1',null);//Cho thông báo chỉ hiện 1 lần
             }
?>
             
@extends('layout')
@section('content')

	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Checkout Page//////////////////////-->
	<!--//////////////////////////////////////////////////-->


	<?php
				$content= Cart::content();
				
				?>	

				
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<nav style="--bs-breadcrumb-divider"aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px"><a href="">Đặt hàng</a></li>
				</ol>
				</nav>
			
			</div>
            <!-- code sửa nè -->
            

            <h3 style="margin:15px">THÔNG TIN ĐƠN HÀNG</h3>
            <div class="card" >
                <div class="card-header" > <h6>Thông tin đơn hàng ({{ Cart::count()}})</h6></div>
                <div class="card-body">
                    <table class="table table-hover">
                        
                        <tr style="font-size: 20px">
                            <td style="width: 350px"><strong>Sách</strong> </td>
                            <td style="text-align: center;vertical-align: middle;"><strong>Số lượng</strong></td>
                            <td><strong>Giá</strong></td>
                            <td><strong>Tổng</strong></td>
                        </tr>
                        
                        @foreach ($content as $v_content)
                        <tr style="font-size: 18px">
                            <td>{{$v_content->name}}</td>
                            <td style="text-align: center;vertical-align: middle;">{{$v_content->qty}}</td>
                            <td>{{number_format($v_content->price,0,',','.').' '.'VND'}}</td>
                            
                            <td><?php 
                                $total_item = $v_content->price * $v_content->qty;
                                echo number_format($total_item,0,',','.').' '.'VND';
                                ?> 
                            </td>
                        </tr>
                        @endforeach
                    
                        <tr style="font-size:20px">
                            <td style="font-size:20px"><strong>Tổng tiền sách</strong> </td>
                            <td></td>
                            <td></td>
                            <td style="font-size:18px">{{Cart::priceTotal().' '.'VND'}} </td>
                        </tr>
                        <tr>
                            <td style="font-size:20px"><strong>Phí vận chuyển</strong></td>
                            <td></td>
                            <td></td>
                            <td style="font-size: 18px"> free</td>
                        </tr>
                        <tr>
                            <td style="font-size:20px"><strong>Thuế</strong></td>
                            <td></td>
                            <td></td>
                            <td style="font-size: 18px">{{Cart::tax().' '.'VND'}} </td>
                        </tr>
                        <tr>
                            <td><h5>Tổng cộng</h5></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:20px;color:red"><strong>{{Cart::total().' '.'VND'}}</strong> </td>
                        </tr>
                    </table>
            </div>
            </div>
            <h3 style="margin:15px">THÔNG TIN NHẬN HÀNG</h3>
            <div class="card">
                <div class="card-header"><h6>Thông tin khách hàng </h6></div>
                <div class="card-body">
                <form action="{{URL::to('/save-checkout-customer')}}" method="post" class="needs-validation" novalidate>
                    {{csrf_field()}}   
                    <?php 
				    $customer_email = Session::get('customer_email');
                    $customer_name = Session::get('customer_name');
                    $customer_phone = Session::get('customer_phone');
                    $customer_address = Session::get('customer_address');
                    
								?>
                    <p><b>Họ và tên người nhận: </b>  </p>
                    <input type="text"  class="form-control" value="{{$customer_name}}" name="order_name"  required >
                    <div  class="invalid-feedback">Vui lòng nhập họ và tên người nhận</div>
                  
                    <p><b>Số điện thoại: </b></p><input type="text"  class="form-control" value="{{$customer_phone}}" name="order_phone"  required ><div  class="invalid-feedback">Vui lòng nhập Số điện thoại</div>
                    <!-- <p><b>Địa chỉ nhận hàng: </b></p><input type="text"  class="form-control" value="{{$customer_phone}}" name="order_phone"  required ><div  class="invalid-feedback">Vui lòng nhập Số điện thoại</div> -->
                    <p><b>Địa chỉ nhận hàng: </b></p><input type="text"  class="form-control" placeholder="Địa chỉ nhận hàng" value="{{$customer_address}}" name="order_address"  required ><div  class="invalid-feedback">Vui lòng nhập Địa chỉ nhận hàng</div>

                </div>
            </div>
             <button  class="btn btn-outline-primary" href="{{URL::to('/show-cart')}}">	<a class="home" href="{{URL::to('/')}}">Quay lại giỏ hàng</a>	</button>
            <button type="submit" name="order-place" class="btn btn-outline-success"  style="margin: 10px">Hoàn tất đặt hàng</button>
        </form>		
      
    </div>
    </div>




@endsection
    