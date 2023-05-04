
    
@extends('admin_layout')
@section('admin_content')


	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Book Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
            	@foreach($all_book as $key => $book_value)
			
					
				<center>
				<div class="name" style="margin:20px"><h2 >{{ $book_value->book_name}}</h2></div>
						
				<img src="{{asset('public/uploads/book/'.$book_value->book_image)}}" style="width:300px;height:300px" />

				<div class="info" style="margin:20px">
					<h4>Tác giả: {!! $book_value->book_author !!}</h4>
				</div>
				<div class="price" style="color:red">
					<h4>Giá: {{number_format($book_value->book_price).' '.'VND'}}</h4>
				</div>
								
						
				</center>	
				
				<div class="product-desc" style="margin:10px; width:80%;padding-left:150px;vertical-align: middle">
					
					<div class="tab-content">
						<h3>Nội dung sách</h3>
						<p style="vertical-align: middle;"> {!! $book_value->book_desc !!}</p>
						
						
					</div>
				</div>
					@endforeach
						
				
			</div>
			
		</div>
		
	</div>	

	
	<!-- IMG-thumb -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	

  
@endsection
    