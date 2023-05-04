@extends('admin_layout')
@section('admin_content')


<div class="table-agile-info">
<?php
    // message này là để hiện thông báo: thay đổi trạng thái ẩn hiện
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>  
  <div class="panel panel-default"></div>
    
  <button type="" name="add_book" class="btn btn-info"><a href="{{URL::to('/add-book')}}" style="color:#fff">Thêm Sách</a> </button>
  
  <div class="panel-heading">
     Liệt kê Sách
    </div>
  
    <div class="table">
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th style="text-align: center;vertical-align: middle;padding-left:25px">Tên Sách</th>
            <th style="text-align: center;vertical-align: middle;width:30px;padding:0px">Hình ảnh</th>
            <th style="text-align: center;vertical-align: middle;width:15px;padding:0px">Tồn kho</th>
            <th style="text-align: center;vertical-align: middle;width:15px;padding:0px">Giá</th>
          
            <th style="text-align: center;vertical-align: middle;width:13px">Trạng thái</th>
          
            <th style="width:30px;"> Thao tác</th>
          </tr>
        </thead>

        <tbody>
          @foreach($all_book as $key => $book_value)
          <tr>
             <td style="width: 200px;vertical-align: middle;">
            <a href ="" style="color:black">{{ $book_value->book_name }}</a></td>
            
            <td style="text-align: center;vertical-align: middle;"><img src="public/uploads/book/{{ $book_value->book_image }}" height="100" width="100"></td>
            <td style="text-align: center;vertical-align: middle;">{{ $book_value->book_inventory }}</td>
            <td style="text-align: center;vertical-align: middle;">{{ $book_value->book_price }}</td>
    
            <td style="text-align: center;vertical-align: middle;"><span class="text-ellipsis">
              <?php 
                if($book_value->book_status==0){//đang ẩn
              ?>
              <!-- đang up: thì nếu bấm vào sẽ down => active -->
                <a href="{{URL::to('/active-book/'.$book_value->book_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-down" style="font-size: 28px; color:red;text-align: center;vertical-align: middle"></span></a>
              <?php
               } else{
                 ?>
                 
              <!-- đang down: thì nếu bấm vào sẽ down => unactive -->
                 <a href="{{URL::to('/unactive-book/'.$book_value->book_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-up" style="font-size: 28px; color:green;text-align: center;vertical-align: middle"></span></a>
                 <?php }
                 ?>
              </span>
            </td>
      
            <td style="width:15px;padding:0px;text-align: center;vertical-align: middle">
              <a href="{{URL::to('/quan-ly-chi-tiet-sach/'.$book_value->book_id)}}" class="active" ui-toggle-class="">
                  <i class="fa-styling fa fa-eye text-active" style="font-size: 25px"></i>
              </a><br>  
              <a href="{{URL::to('/edit-book/'.$book_value->book_id)}}" class="active" ui-toggle-class="">
                  <i class="fa-styling fa fa-pencil-square-o text-active" style="font-size: 25px"></i>
              </a><br>
              <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{URL::to('/delete-book/'.$book_value->book_id)}}" class="active" ui-toggle-class="">
                <i class="fa-styling fa fa-times text-danger text" style="font-size: 25px;"></i>
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