<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>

</head>
<body>

<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand" style="width: 280px; height: 100px; margin-bottom: 0px;">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        <img src="{{asset('public/backend/images/bookshop_xoanen.png')}}" alt="B-Shop" style="width:70%;margin-bottom:5px">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix" >
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="width:100px;height:30px;">
               <center>
                <span class="username" style="font-size:20px;color:blue" >  <?php
                      $name= Session::get('admin_name');
                      if($name){//nếu tồn tại message thì in thông báo ra
                        echo $name;
                        
                      }
                      
                    ?></span>
                <b class="caret"></b></center>
            </a>
            <ul class="dropdown-menu extended logout" style="    top: 30px;">
   
				<?php
                      $name= Session::get('admin_name');
                      if($name){
                        ?>
						<li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                	<?php
                      }else{
						?>
						<li><a href="{{URL::to('/admin')}}"><i class="fa fa-key"></i> Đăng nhập</a></li>
                	<?php
					  }
                      
                    ?>
              </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside style="width:280px">
    <div id="sidebar" class="nav-collapse"style="width:280px">
        <!-- sidebar menu start-->
        <div class="leftside-navigation" >
            <ul class="sidebar-menu" id="nav-accordion">
                <li style="    margin-top: 10px;">
                    <a href="{{URL::TO('/dashboard')}}" style="padding-left: 3px;">
                        <i class="fa fa-dashboard"></i>
                        <span style="font-size: 20px">Tổng quát</span>
                    </a>
                </li>
                <li  >
                    <a  href="{{URL::to('/all-customer')}}"style="padding-left: 3px;">
                        <i class="fa fa-book"></i>
                        <span style="font-size: 20px">Quản lý khách hàng</span>
                    </a>
                </li>
        
                <li>
                    <a href="{{URL::to('/manage-order')}}"style="padding-left: 3px;">
                        <i class="fa fa-book"></i>
                        <span style="font-size: 18px">Quản lý đơn đặt hàng</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/all-category')}}"style="padding-left: 3px;">
                        <i class="fa fa-bars"></i>
                        <span style="font-size: 18px">Quản lý danh mục sản phẩm</span>
                    </a>
              
                </li>
				<li class="sub-menu">
                    <a href="{{URL::to('/all-publisher')}}"style="padding-left: 3px;">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span style="font-size: 18px">Quản lý nhà xuất bản</span>
                    </a>
             
                </li>
             
				<li class="sub-menu">
                    <a href="{{URL::to('/all-book')}}"style="padding-left: 3px;"   >
                        <i class="fa fa-book"></i>
                        <span style="font-size: 18px">Quản lý sách</span>
                    </a>
                </li>
                
                
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content" style="margin-left: 280px;">
	<section class="wrapper" style="">
	@yield('admin_content')
    </section>
 <!-- footer -->
 <div class="footer" style="bottom:80px; margin-top: 300px;">
			
			  <center><p style="height:70px;">Trang dành cho quản trị viên B-Shop </p></center>
		
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
 
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->

    <!-- ckeditor -->
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditora1');
        CKEDITOR.replace('ckeditora2');
        CKEDITOR.replace('ckeditora3');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('ckeditor4');
        
    </script>
<!-- /ckeditor -->

</body>
</html>
