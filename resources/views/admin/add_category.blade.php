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
                                <form role="form" action="{{URL::to('/save-category')}}" method="post" class="needs-validation">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" placeholder="Tên danh mục" required/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="ckeditor1" name="category_desc" placeholder="Mô tả danh mục" required></textarea>
                                    <!-- <div class="invalid-feedback">Vui lòng nhập mô t danh mục</div></div> -->
                               
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select  name="category_status" class="form-control input-lg m-bot15">
                                        <option value=0>Ẩn</option>
                                        <option value=1>Hiện</option>
                                    </select>

                                </div>
                                  <!-- <button type="" class="btn btn-info" > <a href="{{URL::to('/dashboard')}}"> Hủy</a></button> -->
                         
                           

                                <button type="submit" name="add_category"  class="btn btn-info">Thêm danh mục</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff" href="{{URL::to('/all-category')}}">Quay lại</a></button>
						
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
   
@endsection