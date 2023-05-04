
    @extends('layout')
    @section('content')
	<div id="page-content" class="home-page" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
						<!-- Carousel -->
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner"style="height:500px">
							<div class="carousel-item active"style="height:500px">
								<img src="{{asset('public/frontend/img/carousel1.png')}}" class="d-block w-100" style="height:500px" alt="..." >
							
							</div>
							<div class="carousel-item"style="height:500px">
								<img src="{{asset('public/frontend/img/carousel2.png')}}"style="height:500px" class="d-block w-100" alt="...">
							
							</div>
							<div class="carousel-item"style="height:500px">
								<img src="{{asset('public/frontend/img/1.png')}}"style="height:500px" class="d-block w-100" alt="...">
							
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row new_book" style="margin-left: 40px">
			<div class="col-lg-12">
				<div class="heading">
					<h2>Sách mới nhất</h2>
				</div>
				<div class="products">
					<div class="row">
					@foreach($new_book as $book)
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom:55px">
							<form method="POST" action="{{URL::to('/save-cart')}}">
							{{csrf_field()}}
								<div class="image">
									<a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">
										<img src="{{URL::to('public/uploads/book/'.$book->book_image)}}" style="width:300px;height:300px" />
									</a>
								</div>
								<div class="caption">
									<div class="name" style="height:100px;">
										<h3>
										<a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">{{$book->book_name}}</a>
										</h3>
									</div>
									<div class="price">{{number_format($book->book_price).' '.'VND'}}</div>
								</div>
								<div>
									<input type="hidden" name="bookid_hidden" value="{{$book->book_id}}">
									<input type="hidden" value="{{$book->book_inventory}}" name="inventory">
									<input type="hidden" name="qty" value="1" />
									<button type="submit" class="btn btn-1 add-to-cart" style="font-size:15px;background-color:#DF7857" name="add-to-cart">Thêm giỏ hàng</button>
								</div>
							</form>
						</div>
					@endforeach
					</div>
				</div>
			
			{{ $new_book->links('pagination::bootstrap-4') }}
			</div>
		</div>
	</div>
    @endsection
