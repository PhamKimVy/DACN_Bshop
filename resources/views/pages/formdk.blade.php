

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

    <title>B-Shop</title>
    <link href="{{asset('public/frontend/css/form.css')}}" rel="stylesheet" type="text/css" media="all" />

<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

	
</style>
</head>
<body>

<div class="main-w3layouts wrapper">
<?php
             
             $message= Session::get('message');
             if($message){//nếu tồn tại message thì in thông báo ra
               ?><div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong style=" font-size: 20px">{{$message}}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php
                Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
              }
             ?>
             <!-- form đăng ký -->
    <div class="container" id="container">
      <div class="form-container form1-container">
            <!-- đăng ký -->
        <form method="POST" action="{{URL::to('/add-customer')}}" role="form" class="needs-validation" novalidate>
          {{csrf_field()}}              
          <div class="mb-3">
            <h2>TẠO TÀI KHOẢN</h2>
            <div class="form-group">
              <input class="text" type="text" placeholder="Họ và tên" name="customer_name" value="" required/>
              <div class="invalid-feedback">Vui lòng nhập Họ và tên</div>
            </div>
            <div class="form-group">
              <input class="text email" type="email" placeholder="Email" name="customer_email" value="" required/>
              <div class="invalid-feedback">Vui lòng nhập email</div>
                <!-- kiểm tra trùng mail -->
                <?php
                  $message = Session::get('message');
                  if($message){//nếu tồn tại message thì in thông báo ra
                    echo'<span style="color:red">'. $message.'</span>';
                    Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                  }
                ?>
            </div>
            <div class="form-group">
                <input class="text" type="text" placeholder="Số điện thoại" name="customer_phone"  value=""required/>
                <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
            </div>
            
            <div class="form-group">
                <input class="text" type="text" placeholder="Địa chỉ" name="customer_address"  value="" required/>
                <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
             </div>
            <div class="form-group">
                <input class="text" type="password" placeholder="Mật khẩu" name="customer_password"  value=""required/>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                
            </div>
            <div class="form-group">
                <input class="text w3lpass"  type="password" placeholder="Mật khẩu nhập lại" name="customer_repassword" value="" required/>
                <div class="invalid-feedback">Vui lòng nhập lại mật khẩu</div>
            </div>
          </div>
		      <button type="submit" name="dangky" ><a style="color:black"class="btn ghost" >Đăng ký</a></button>
		    </form>
      </div>
   
      <div class="form-container form2-container">
        <form  method="POST" action="{{URL::to('/login-customer')}}" role="form" class="needs-validation" novalidate>
            {{csrf_field()}}             
            <h2>ĐĂNG NHẬP</h2>	
            <div class="mb-3">
              <input class="text" type="email"  placeholder="Email" name="email_account" value="" required/>
              <div class="invalid-feedback">Vui lòng nhập email</div>
              <input class="text" type="password"  placeholder="Mật khẩu" name="password_account"  value=""required/>
              <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
              <button type="submit" name="dangnhap" ><a style="color:black"class="btn ghost" >Đăng nhập</a></button>
          </div>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <div class="bubbles">
              <img  src="{{asset('public/backend/images/logo_xoanen.png')}}"alt="B-Shop" style="width:50%;">
            </div>
            <p>Bạn chưa có tài khoản?</p>
            <button class="ghost" id="form2btn"><a style="color:black"class="btn ghost" >Đăng ký</a></button><br>
            <button class="ghost" id="home" ><a style="color:black"class="btn ghost" href="{{URL::to('/')}}">Home</a></button>
          </div>
          <div class="overlay-panel overlay-right">
            <div class="bubbles">
              <img  src="{{asset('public/backend/images/logo_xoanen.png')}}"alt="B-Shop" style="width:50%;">
            </div>
            <p>Bạn đã có tài khoản?</p>
            <button class="ghost" id="form1btn"><a style="color:black"class="btn ghost" >Đăng nhập</a></button><br>
            <button class="ghost" id="home" ><a style="color:black"class="btn ghost" href="{{URL::to('/')}}">Home</a></button>
          </div>
        </div>
      </div>
    </div>
    <ul class="colorlib-bubbles">
			
      <li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li><center><img src="logo2.png" alt=""></center></li>
			<li></li>
      <li>

      </li>
      <li></li> 
      <img src="" alt="">
    
		</ul>
</div>
<script href="{{asset('public/backend/js/jqueryform-validator.js')}}"></script>

    <script>
        const form1btnButton = document.getElementById('form1btn');
        const form2btnButton = document.getElementById('form2btn');
        const container = document.getElementById('container');
        form2btnButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
        form1btnButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });
    </script>

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

