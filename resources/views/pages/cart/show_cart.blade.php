	<?php 
             $messagecart1 = Session::get('messagecart1');
			 if($messagecart1){//nếu tồn tại message thì in thông báo ra
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
	<!--///////////////////Cart Page//////////////////////-->
	<!--//////////////////////////////////////////////////-->


			<?php
				$content= Cart::content();
			?>	

				
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
					
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px"><a href="">Giỏ hàng</a></li>
				</ol>
				</nav>
			
			</div>
			<div>

			<?php
				if( Cart::count() ==0)
			 {?>
				<p style="color:red; font-size:28px">
					Không có sách nào trong giỏ hàng! Vui lòng chọn thêm sản phẩm!!
				</p>;
				<button  class="btn btn-outline-primary" href="{{URL::to('/')}}">	<a class="home" href="{{URL::to('/')}}">Về trang chủ</a>	</button>
			 <?php
			 }
			else
			{?>
				<p  style="color: red; font-size: 20px;">Có {{ Cart::count()}} sách trong giỏ hàng</p>
			</div>
			<!-- code  -->
			@foreach ($content as $v_content)
			<div id="main-content" class="col-md-12" style="min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">
				<div class="product" style=" display: flex; flex-wrap: wrap; align-items: center;flex-direction: row;">
							
					<div class="col-md-3">
					
						<div class="image" style="">
								
							<img src="{{URL::to('public/uploads/book/'.$v_content->options->image)}}" style="width:200px;height:200px" />
									
						</div>
					</div>
					<div class="col-md-6" style="">
						<div class="caption">
							<div class="name" style="font-size:19px; "><b><a style="font-size:26px" href="{{URL::to('/chi-tiet-sach/'.$v_content->id)}}">{{$v_content->name}}</a></b></div>
						
							<div style="font-size:19px; padding-bottom:18px" class="price">Giá: {{number_format($v_content->price).' '.'VND'}}<span></span></div>
							<form method="POST" action="{{URL::to('/update-cart-qty')}}">
								{{csrf_field()}}    
								<label style="font-size:19px; ">Số lượng:
								<input style="width:50px;float: right; margin-top: -5px;margin-left: 4px" min="1" type="number" class=""name ="cart_qty" value="{{$v_content->qty}}" max="{{$v_content->weight}}">
								<input type="hidden" name ="rowId_cart" value="{{$v_content->rowId}}">				
							
								</label> 
								<div style="font-size:19px; margin-top:18px;padding-bottom:18px">Số lượng sách còn lại: {{$v_content->weight}} <span style="color:red"></span>  </div>
								<label style="color:red;font-size:21px;padding-bottom:18px">Thành tiền:
									<?php 
									$total_item = $v_content->price * $v_content->qty;
									echo number_format($total_item,0,',','.').' '.'VND';
									?>  
								</label> 
								<div >
									<button type="submit" name="update-cart-qty" class="btn btn-outline-success" >Cập nhật sách này</button>
									<button class="btn btn-outline-secondary" > <a class="dele" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}">Xóa sách này  <i class="fa fa-times"></i></a></button>
								</div>
							</form>
						</div>
					</div>
							
				</div>
			</div>
@endforeach
					<button type="button" class="btn btn-outline-danger" style="background-color:" ><a class="dele" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}">Xóa hết giỏ hàng</a></button>
					<button  class="btn btn-outline-primary" href="{{URL::to('/')}}">	<a class="home" href="{{URL::to('/')}}">Chọn thêm sách</a>	</button>
		
					<div class="pricedetails">
						<div class="col-md-4 col-md-offset-8" >
							<table style="margin-right:31px;width: max-content;" >
								<h6>Price Details</h6>
								<tr>
									<td style="font-size:20px">Số lượng sách</td>
									<td style="font-size: 20px;padding:3px"> {{ Cart::count()}} </td>
								</tr>
								<tr style="font-size:20px">
									<td style="font-size:20px">Tổng tiền sách</td>
									<td style="font-size:20px">{{Cart::priceTotal().' '.'VND'}} </td>
								</tr>
								<tr>
									<td style="font-size:20px">Phí vận chuyển</td>
									<td style="font-size: 20px;padding:3px"> free</td>
							
								</tr>
								
								<tr style="border-top: 1px solid #333">
									<td><h5>Tổng cộng</h5></td>
									<td style="font-size:20px">{{Cart::total().' '.'VND'}} </td>
								</tr>
							</table>
							<?php 
							// nếu không có sản phẩm nào có số lượng vượt quá hàng tồn kho
							if($v_content->qty<=$v_content->weight){
									$customer_id = Session::get('customer_id');
									if($customer_id!=NULL){//nếu có customer_id hiện nút đặt hàng 

								?>
										<center><a href="{{URL::to('/show-checkout')}}" class="btn btn-1">Đặt hàng</a></center>
										
								<?php
									}
						
									else{
								?>
										<center><a href="{{URL::to('/login')}}" class="btn btn-1">Đăng nhập để hàng</a></center>
								<?php
									}
								}
								
							    ?>
							
							<!-- <input type="submit" name="dathang" value="Đặt hàng" class="btn btn-1" />	 -->
						</div>
					</div>
				
				</div>	
			</div>
			<?php
			}
			?>
		</div> 
		
	</div>	


@endsection
    