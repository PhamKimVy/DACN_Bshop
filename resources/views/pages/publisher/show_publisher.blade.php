
@extends('layout')
    @section('content')

	<!--//////////////////////////////////////////////////-->
	<!--///////////////////publisher Page//////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<nav style="--bs-breadcrumb-divider" aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
	
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px">{{$publisher_name->publisher_name}}</li>
           		
				</ol>
				</nav>
			</div>
			<div class="row">
				<div id="main-content" class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="products" >
							@foreach($publisher_by_id as $key => $book)
								<div class="col-lg-4 col-md-4 col-xs-12" style="height:500px">
							
									<div class="product" style="width:230px; margin:10px">
										<div class="image" style="">
											<a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">
												<img src="{{URL::to('public/uploads/book/'.$book->book_image)}}" style="width:300px;height:300px"/>
											</a>
										</div>
										<div class="caption" >
											<div class="name" style="height:50px"><h3><a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">{{$book->book_name}}</a></h3></div>
											<div class="price">{{number_format($book->book_price).' '.'VND'}}</div>
										</div>
										<form method="POST" action="{{URL::to('/save-cart')}}">
											{{csrf_field()}}
											<input type="hidden" name ="bookid_hidden" value="{{$book->book_id}}">
											<input type="hidden" value="{{$book->book_inventory}}" name="inventory" >
											<input type="hidden" name="qty" value="1" />
											
											<?php
											if($book->book_inventory==0){?>
												<div class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" >
												Hết hàng!!!
												</div>
											<?php
											}else{
											?>
											<button type="submit" class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" >
												Thêm giỏ hàng
											</button>
											<?php } ?>	
										</form>
									</div>
								</div>
							@endforeach
							</div>
							{{ $publisher_by_id->links('pagination::bootstrap-4') }}
						</div>
	
					</div>
		
				</div>
				<div id="sidebar" class="col-3" style=" margin-left:45px">
					<div class="widget wid-categories">
						<div class="heading"><h4>Nhà xuất bản</h4></div>
						<div class="content">
							@foreach($publisher as $key => $pub)
							<ul>
								<li><a href="{{URL::to('/nha-xuat-ban/'.$pub->publisher_id)}}">{{$pub->publisher_name}}</a></li>
							</ul>
							@endforeach
						</div>
					</div> 
					<div class="widget wid-categories">
							<div class="heading"><h4>Danh mục sản phẩm</h4></div>
							<div class="content">
								<ul>
									@foreach($category as $key => $cate)
										<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
			
					</div>
				</div>
			</div>	 
		</div>
	</div>
    @endsection
    