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
<button type="" name="add_book" class="btn btn-info"><a href="{{URL::to('/add-publisher')}}" style="color:#fff">Thêm Nhà xuất bản</a> </button>

     
    <div class="panel-heading">
     Liệt kê nhà xuất bản
    </div>
   
    <div class="table">

      <table class="table table-hover">
        <thead>
          <tr>
      
            <th>Tên nhà xuất bản</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
          
            <th >Thao tác</th>
          </tr>
        </thead>

        <tbody>
          @foreach($all_publisher as $key => $pub)
          <tr>
            <td>{{ $pub->publisher_name }}</td>
            <td>{!! $pub->publisher_desc !!}</td>
        
            <td><span class="text-ellipsis">
              <?php 
                if($pub->publisher_status==0){
              ?>
              <!-- đang up: thì nếu bấm vào sẽ down => active -->
                <a href="{{URL::to('/active-publisher/'.$pub->publisher_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-down" style="font-size: 28px; color:red;"></span></a>
              <?php
               } else{
                 ?>
                 
              <!-- đang down: thì nếu bấm vào sẽ down => unactive -->
                 <a href="{{URL::to('/unactive-publisher/'.$pub->publisher_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-up" style="font-size: 28px; color:green;"></span></a>
                 <?php }
                 ?>
            </span></td>
      
            <td>
              <a href="{{URL::to('/edit-publisher/'.$pub->publisher_id)}}" class="active" ui-toggle-class="">
                <i class="fa-styling fa fa-pencil-square-o text-active" style="font-size: 25px"></i>
               </a>
               <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{URL::to('/delete-publisher/'.$pub->publisher_id)}}" class="active" ui-toggle-class="">
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