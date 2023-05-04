
@extends('layout')
@section('content')
<div id="page-content" class="single-page">
<h2 class="title text-center" style="padding-top:10px ">CHI TIẾT ĐƠN HÀNG</h2>
	<div class="container">
        @foreach($view_history_order as $pro)
			<div id="main-content" class="col-md-12" style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">
				<div class="product" style=" display: flex; flex-wrap: wrap; align-items: center;flex-direction: row;">	
					<div class="col-md-3">
                        <div class="image" style="">
                            <img src="{{URL::to('public/uploads/book/'.$pro->book_image)}}" style="width:200px;height:200px" />
						</div>
					</div>
					<div class="col-md-6" style="">
						<div class="caption">
							<div class="name" style="font-size:19px; "><h5 style="font-size:22px">{{$pro->book_name}}</h5></div>
				            <div style="font-size:19px; padding-bottom:18px" >Giá: {{number_format($pro->book_price).' '.'VND'}}<span></span></div>
                            <div style="font-size:19px; padding-bottom:18px">Số lượng: {{$pro->book_sales_quantity}}</div>
                        </div>
				    </div>
                </div>
		    </div>
        @endforeach
    <?php 
    $customer_id = Session::get('customer_id');
    $customer_name = Session::get('customer_name');
    if($customer_id!=NULL){
    ?>
    <button type="" name="" class="btn btn-outline-primary" ><a href="{{URL::to('/show-history/'.$customer_id)}}" style="color:black">Trở lại</a></button>
    <?php } ?>	
    </div> 
</div>	
@endsection
