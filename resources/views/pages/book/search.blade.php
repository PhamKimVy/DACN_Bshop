
@extends('layout')
@section('content')
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
				
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px"><a href="">Kết quả tìm kiếm</a></li>
           		
				</ol>
				</nav>
			
			</div>
			<div class="row">
						
				<div class="products">
				@foreach($search_book as $key => $book )
					<div class="col-lg-4 col-md-4 col-xs-12" style="min-height:500px">
						<!-- <div class="product" style="width:300px; margin:5px"> -->
						<div class="product" style="width:250px; margin:10px">
							<div class="image">
								<a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">
									<img src="{{URL::to('public/uploads/book/'.$book->book_image)}}" style="width:300px;height:300px"/>
								</a>
							</div>
							<div class="caption">
								<div class="name" style="height:50px"><h3><a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">{{$book->book_name}}</a></h3></div>
								<div class="price">{{number_format($book->book_price).' '.'VND'}}</div>
							</div>
							<form method="POST" action="{{URL::to('/save-cart')}}">
							{{csrf_field()}}
							<input type="hidden" name ="bookid_hidden" value="{{$book->book_id}}">
							<input type="hidden" value="{{$book->book_inventory}}" name="inventory" >
							<input type="hidden" name="qty" value="1" />
							
								
							<button type="submit" class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" data-id="{{$book->book_id}}"  name="add-to-cart">Thêm giỏ hàng</button>
						
							</form>
						</div>
					</div>
					
				@endforeach
				</div>
			</div>
		
		</div>
	</div>
@endsection
    