<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- import bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<title>B-Shop</title>

</head>
<body>
  <?php
      $messagecart = Session::get('messagecart');
      if($messagecart){//nếu tồn tại message thì in thông báo ra
        
        ?><div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong style=" font-size: 20px">Thêm sách thành công!<span style="font-size:15px">
      Sách đã được thêm vào giỏ hàng.
    </span></strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><?php
        Session::put('messagecart',null);//Cho thông báo chỉ hiện 1 lần
      }
   ?>
    <!-- Topbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ">
	    <div class="container">
	      <a href="{{URL::to('/')}}" style="left:2px;font-size:30px;color:white">B-Shop</a>
          <?php 
              $customer_id = Session::get('customer_id');
              $customer_name = Session::get('customer_name');
              if($customer_id!=NULL){
          ?>
          <div class="btn-group"  >
          
            <button type="button" style="background-color:#fff;color:blue" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            {{$customer_name}}
            </button>
            <div class="dropdown-menu" style="top:46px;right:5px;background-color:#F2F4B1;width:1px">
              <a class="dropdown-item" href="{{URL::to('/show-history/'.$customer_id)}}">Lịch sử mua hàng</a>
              <a class="dropdown-item" href="{{URL::to('/logout-checkout')}}">Đăng Xuất</a>
            </div>
          </div>
          <?php
            }else{
          ?>
          <div class="btn-group">
            <button type="button" class="btn btn-primary-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
              Tài khoản
            </button>
            <div class="dropdown-menu" style="top:46px;right:5px;background-color:#F2F4B1;width:1px">
              <a class="dropdown-item" href="{{URL::to('/login')}}">Đăng nhập</a>
              <a class="dropdown-item" href="{{URL::to('/signup')}}">Đăng ký</a>
            </div>
          </div>
          <?php
            }
          ?>
        
	    </div>
	  </nav>
  <!-- Header css2 -->
  <header class="container" style="padding:5px">
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li><center><img src="{{asset('public/backend/images/book_xoanen.png')}}" alt="" style="width:100px"></center></li>
      <li><center><img src="{{asset('public/backend/images/book_xoanen.png')}}" alt="" style="width:100px"></center></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li> 
      <li></li>
		</ul> 
       <img src="{{asset('public/backend/images/logo_xoanen.png')}}"  style="height:200px" alt="">
   
</center>
		<div class="col-md-3" style="float: right;margin-top:70px">

			<div id="cart"><a class="btn  btn-1" href="{{URL::to('/show-cart')}}">
        <span class="fa fa-shopping-cart " ></span> Giỏ hàng ({{ Cart::count() }})</a>
      </div>
      
		</div>
</header>

    <!-- end Header css2 -->


<!-- Navigation -->

<div id = "wrapper" style="margin-top:40px">
  <div id = "header">
    <nav class = "container">
      <ul id = "main-menu">
        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
        <li><a href="">Danh mục </a>
          <ul class="sub-menu">
            @foreach($category as $key => $cate)
            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
            @endforeach
          </ul>
        </li>
        <li><a href="">Nhà xuất bản</a>
          <ul class="sub-menu">
            @foreach($publisher as $key => $pub)
            <li><a href="{{URL::to('/nha-xuat-ban/'.$pub->publisher_id)}}">{{$pub->publisher_name}}</a></li>
            @endforeach
          </ul>
        </li>
        
        <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>

        <div class="" style="margin-top:12px; left: 150px">
          <form class="form-search"style="width:500px"action="{{URL::to('/tim-kiem')}}" method="POST">  
            {{csrf_field()}}
            <input type="text"  name="keywords_search"  class="input-medium search-query" required>  
              <button type="submit" name="tk" class="btn" style="background:#002F4F;top:12px; right: 10px">
                <span class="fa fa-search" style="color:#fff;"></span>
              </button>  
          </form>
        </div>


                      
      </ul>
    </nav>
  </div>
  </div> 
<!-- endnavigation -->


    <div class="container-fluid py-5">
        @yield('content')
    </div>

<div class=" text-center" style="font-size:20px; margin-top:30px">
          <?php
      
              $message = Session::get('message');
              if($message){//nếu tồn tại message thì in thông báo ra
                echo'<span style="color:red">'. $message.'</span>';
                Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
              }
              
            ?>
    </div>
    <!-- Footer Start -->
    <!-- <footer class="ftco-footer bg-dark ftco-section"> -->
    <footer class="ftco-footer bg-dark" style="height:180px">
 
          <div class="col-md-12 text-center" style="padding:25px">
            <a href="#" class=""  style="left:2px;font-size:30px;color:white">B-Shop</a>
            <p style="left:2px;font-size:15px;color:white;padding-top:8px">Nhà sách online với rất nhiều đầu sách hấp dẫn cho bạn đọc lựa chọn.</p>
            <a href="#" class="" style="left:2px;font-size:22x;color:white">Phạm Kim Vy <i class="fa fa-heart" aria-hidden="true"></i> 030236200224</a>
          </div>
  
    </footer>
    <!-- Footer End -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>



<!-- check form -->
  <script>(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
    </script>
</body>

</html>
