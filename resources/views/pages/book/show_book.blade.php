
    
@extends('layout')
@section('content')

	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Book Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container" style="margin-bottom:5px">
			<div class="row">
				<nav style="--bs-breadcrumb-divider" aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
					@foreach($book_show as $key => $book_value)
					<li class="breadcrumb-item " aria-current="page" style="padding-top:18px"><a href="{{URL::to('/danh-muc-san-pham/'.$book_value->category_id)}}">{{ $book_value->category_name}}</a></li>
					<li class="breadcrumb-item " aria-current="page" style="padding-top:18px"><a href="{{URL::to('/nha-xuat-ban/'.$book_value->publisher_id)}}">{{ $book_value->publisher_name}}</a></li>
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px"><a href="">{{ $book_value->book_name}}</a></li>
				</ol>
				</nav>
			
			</div>
<!-- thông báo nếu số lượng khách hàng chọn vượt quá tồn kho -->
			<?php 
             $message= Session::get('message');
		
             if($message){//nếu tồn tại message thì in thông báo ra
     
               ?><div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong style=" font-size: 20px">{{$message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div><?php
               
             }
			?>
			<div class="row">

				<div id="main-content" class="col-md-12" >
					<div class="product" style="padding:110px;padding-top:10px;padding-bottom:30px; display: flex; flex-wrap: wrap; align-items: center;flex-direction: row;">
						<div class="col-md-6">
							<div class="image" style="">
								<img src="{{asset('public/uploads/book/'.$book_value->book_image)}}" style="width:500px;height:600px" />
								
							</div>
						</div>
						<div class="col-md-6" style="padding:50px">
							<div class="caption">
								<div class="name" style="font-size:19px; padding:5px"><h5 style="font-size:32px">{{ $book_value->book_name}}</h5></div>
								<div class="info">
									<ul>
										<li style="font-size:19px; padding:5px">Tác giả: {!! $book_value->book_author !!} </li>
										<li style="font-size:19px; padding:5px">Nhà xuất bản: <a href="{{URL::to('/nha-xuat-ban/'.$book_value->publisher_id)}}">{{ $book_value->publisher_name}}</a> <h3></li>
									</ul>
								</div>
								<div style="font-size:19px; padding:5px" class="price">Giá: {{number_format($book_value->book_price).' '.'VND'}}<span></span></div>
								<form name="form3" method="POST" action="{{URL::to('/save-cart')}}">
								{{csrf_field()}}
									<!-- còn sách -->
								<?php if($book_value->book_inventory!=0){?>
									<label style="font-size:19px; padding:5px">Số lượng:<input style="width:50px;float: right; margin-top: -5px;" min="1" type="number" class=""name ="qty" value="1" ></label> 
									<div style="font-size:19px; padding:5px">
										<?php 
											$message = Session::get('message');
											if($message){//nếu tồn tại message thì in thông báo ra
											echo'<span style="color:red">Vui lòng chọn số lượng phù hợp </span>';
											Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
											}
										?><br>
										Số lượng sách còn lại: <span style="color:red">{{$book_value->book_inventory}}</span>  </div>
										<input type="hidden" name ="bookid_hidden" value="{{$book_value->book_id}}">
									</div>
									<input type="hidden" value="{{$book_value->book_inventory}}" name="inventory" >
									<button type="submit" class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" data-id="{{$book_value->book_id}}"  name="add-to-cart">Thêm giỏ hàng</button>
									<?php 
								// Nếu hết sách
								}else{
									?>
									<div style="font-size:19px; padding:5px">
									Số lượng sách còn lại: <span style="color:red">{{$book_value->book_inventory}}</span>  </div>
									<div class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" name="">Hết hàng !!!</div>
								<?php } ?>
								</form>
								</div>
							</div>
						</div>
					</div>	
					<div class="product-desc">
						<ul class="nav nav-tabs">
							<li class=""  ><b><a href="#description" style="color:black; font-size: 25px" >Mô tả nội dung sách</a></b></li>
						</ul>
						<div class="tab-content">
						<p style="vertical-align: middle;"> {!! $book_value->book_desc !!}</p>
						@endforeach
						</div>
					</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>	


	
 <div class="row" style="margin-left: 40px; margin: top 5px;">
		<div class="col-lg-12">
			<div class="heading"><h2>SÁCH LIÊN QUAN</h2></div>
				<div class="products" >
					@foreach($sachlienquan as $key => $book )
					<div class=""style="margin:9px; width:22%" >
				
						<div class="image"><a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}"><img src="{{URL::to('public/uploads/book/'.$book->book_image)}}" style="width:300px;height:300px"/></a></div>
						<div class="caption" >
							<div class="name" ><h3><a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">{{$book->book_name}}</a></h3></div>
							<div class="price">{{number_format($book->book_price).' '.'VND'}}</div>
						</div>
					</div>
					@endforeach
		
				</div>
					
			</div>
			{{ $sachlienquan->links('pagination::bootstrap-4') }}
		</div>
</div>
	

@endsection
    