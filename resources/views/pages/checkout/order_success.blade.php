         
@extends('layout')
@section('content')

	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Cart Page//////////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<nav style="--bs-breadcrumb-divider" aria-label="breadcrumb">
				<ol class="breadcrumb" style="height:55px;text-align: center;vertical-align: middle;">
					<li class="breadcrumb-item" style="padding-top:18px;padding-left:10px"><a style="font-size:25px" href="{{URL::to('/')}}">Trang chủ</a></li>
					
					<li class="breadcrumb-item active" aria-current="page" style="padding-top:18px"><a href="">Đặt hàng thành công</a></li>
				</ol>
				</nav>
			
			</div>
            <div >
            <p style="color:red; font-size:28px">
					Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!!
				</p>
				<button  class="btn btn-outline-primary" href="{{URL::to('/')}}">	<a class="home" href="{{URL::to('/')}}">Quay lại trang chủ</a>	</button>
		
            </div>

		</div>

					


@endsection
    