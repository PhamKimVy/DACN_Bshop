@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
<?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>
<div class="panel panel-default"></div>
<button type="" name="add_book" class="btn btn-info"><a href="{{URL::to('/add-category')}}" style="color:#fff">Thêm danh mục</a> </button>
                      

     
  
    <div class="panel-heading">
     Liệt kê danh mục
    </div>
    
    <div class="table bg bg-dark" >

      <table class="table table-hover ">
        <thead>
          <tr>
          
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
          
            <th >Thao tác</th>
          </tr>
        </thead>

        <tbody>
          @foreach($all_category as $key => $cate_pro)
          <tr>
             <td>{{ $cate_pro->category_name }}</td>
            <td>{!! $cate_pro->category_desc !!}</td>
        
            <td><span class="text-ellipsis">
              <?php 
                if($cate_pro->category_status==0){
              ?>
              <!-- đang up: thì nếu bấm vào sẽ down => active -->
                <a href="{{URL::to('/active-category/'.$cate_pro->category_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-down" style="font-size: 28px; color:red;"></span></a>
              <?php
               } else{
                 ?>
                 
              <!-- đang down: thì nếu bấm vào sẽ down => unactive -->
                 <a href="{{URL::to('/unactive-category/'.$cate_pro->category_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-up" style="font-size: 28px; color:green;"></span></a>
                 <?php }
                 ?>
            </span></td>
      
            <td>
              <a href="{{URL::to('/edit-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
                <i class="fa-styling fa fa-pencil-square-o text-active" style="font-size: 25px"></i>
               </a>
               <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{URL::to('/delete-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
                <i class="fa-styling fa fa-times text-danger text" style="font-size: 25px;">

                </i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>

@endsection