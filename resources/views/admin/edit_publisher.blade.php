@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            SỬA DANH MỤC SẢN PHẨM
                        </header>
                        <div class="panel-body">
                            @foreach($edit_publisher as $key => $edit_value)
                            <div class="position-center">
                            <?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>
                                <!-- <form role="form" action="" method="post"> -->
                                <form role="form" action="{{URL::to('/update-publisher/'.$edit_value->publisher_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà xuất bản</label>
                                    <input type="text" class="form-control" name="publisher_name" id="exampleInputEmail1" value="{{$edit_value->publisher_name}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả nhà xuất bản</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="ckeditor3" name="publisher_desc" >{{$edit_value->publisher_name}}</textarea>
                                </div>
                                <button type="submit" name="update_publisher"  class="btn btn-info">Cập nhật nhà xuất bản</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff"  href="{{URL::to('/all-publisher')}}">Quay lại</a></button>    
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
            
        </div>
       
@endsection