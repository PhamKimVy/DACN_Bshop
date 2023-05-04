

<div class="widget wid-product">
			<div class="heading"><h4>Sách mới nhất</h4></div>
			<div class="content">
				@foreach($new_book as $key => $book )
				<div class="product">
					<a href=""><img src="{{URL::to('public/uploads/book/'.$book->book_image)}}" style="width:80px;height:100px"/></a>
					<div class="wrapper">
						<h5><a href="{{URL::to('/chi-tiet-sach/'.$book->book_id)}}">{{$book->book_name}}</a></h5>
						<div class="price">{{number_format($book->book_price).' '.'VND'}}</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
