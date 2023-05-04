
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="{{asset('public/backend/css/style1.css')}}" rel="stylesheet" type="text/css" media="all" />

<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

    <title>Admin-Đăng nhập</title>
    <link href="{{asset('public/backend/css/admin.css')}}" rel="stylesheet" type="text/css" media="all" />
   
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

	
</style>
</head>
<body>


    <div class="container" id="container">
        <div class="form-container sign-in-container">    
            <form name="form2" id="ff2" method="post" action="{{URL::to('/admin-dashboard')}}" role="form" class="needs-validation" novalidate>
              <!-- Dòng này để tạo token giá trị ngẫu nhiên=> tăng tính bảo mật -->
              
            <center>
                    <h1 style="font-family: 'Chivo Mono', monospace;">ĐĂNG NHẬP QUẢN TRỊ VIÊN</h1>
                    <img src="{{asset('public/backend/images/logo_xoanen.png')}}" alt="" style="width:250px">
                    <?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                    ?>
                </center>
                <div class="mb-3">
                  {{ csrf_field() }}
                  <input class="text" type="email"  placeholder="Email" name="admin_email" value="" required/>
                  <div  class="invalid-feedback">Vui lòng nhập email</div>
                  <input class="text" type="password"  placeholder="Mật khẩu" name="admin_password"  value=""required/>
                  <div class="invalid-feedback">Vui lòng nhập mật khẩu</div></div>
                <div class="wthree-text">
					      </div>
                <button type="submit" name="dangnhap" >Đăng nhập</button><br>
            </form>
           
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
			<li></li>
			<li></li>
      <li></li>
      <li></li> 
    
	</ul>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
 
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
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
