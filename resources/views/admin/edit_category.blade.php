@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            SỬA DANH MỤC SẢN PHẨM
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category as $key => $edit_value)
                            <div class="position-center">
                            <?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>
                                
                                <form role="form" action="{{URL::to('/update-category/'.$edit_value->category_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" value="{{$edit_value->category_name}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="1" class="form-control" id="ckeditor3" name="category_desc" >{{$edit_value->category_name}}</textarea>
                                </div>
                                <button type="submit" name="update_category"  class="btn btn-info">Cập nhật danh mục</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff" href="{{URL::to('/all-category')}}">Quay lại</a></button>    
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
            
        </div>
       
@endsection