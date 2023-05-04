@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM DANH MỤC SẢN PHẨM
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>
                                <!-- <form role="form" action="" method="post"> -->
                                <form role="form" action="{{URL::to('/save-publisher')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà xuất bản</label>
                                    <input type="text" class="form-control" name="publisher_name" id="exampleInputEmail1" placeholder="Tên nhà xuất bản" required/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả nhà xuất bản</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="ckeditor1" name="publisher_desc" placeholder="Mô tả nhà xuất bản" required></textarea>
                                    <!-- <div class="invalid-feedback">Vui lòng nhập mô t nhà xuất bản</div></div> -->
                               
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select  name="publisher_status" class="form-control input-lg m-bot15">
                                        <option value=0>Ẩn</option>
                                        <option value=1>Hiện</option>
                                    </select>

                                </div>
                                  <!-- <button type="" class="btn btn-info" > <a href="{{URL::to('/dashboard')}}"> Hủy</a></button> -->
                         
                           

                                <button type="submit" name="add_publisher"  class="btn btn-info">Thêm nhà xuất bản</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff"  href="{{URL::to('/all-publisher')}}">Quay lại</a></button>
						    </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
       
@endsection