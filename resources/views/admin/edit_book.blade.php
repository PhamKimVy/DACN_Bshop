@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            SỬA Sách 
                        </header>
                        <div class="panel-body">
                            @foreach($edit_book as $key => $edit_value)
                            <div class="position-center">
                            <?php
                                $message = Session::get('message');
                                if($message){//nếu tồn tại message thì in thông báo ra
                                    echo'<span style="color:red">'. $message.'</span>';
                                    Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                                }
                                
                            ?>
                                <!-- <form role="form" action="" method="post"> -->
                                <form role="form" action="{{URL::to('/update-book/'.$edit_value->book_id)}}" method="post">
                                    {{ csrf_field() }}
                                

                                <!--  code cop từ add-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sách</label>
                                    <input type="text" class="form-control" name="book_name" id="exampleInputEmail1" value="{{$edit_value->book_name}}">
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh Sách</label>
                                     <input type="file" class="form-control" name="book_image" id="exampleInputEmail1" >
                                     <img src="{{asset('public/uploads/book/'.$edit_value->book_image)}}" height="100" width="100">
                                   
                                    
          
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn kho</label>
                                    <input type="text" class="form-control" name="book_inventory" id="exampleInputEmail1" value="{{$edit_value->book_inventory}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sách</label>
                                    <input type="text" class="form-control" name="book_price" id="exampleInputEmail1" value="{{$edit_value->book_price}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Sách</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="ckeditora2" name="book_desc" >{{$edit_value->book_desc}}</textarea>
                                    <!-- <div class="invalid-feedback">Vui lòng nhập mô t Sách</div></div> -->
                                </div>
                                <div class="form-group">
                                   
                                    <label for="exampleInputEmail1">Tác giả</label>
                                    <input type="text" class="form-control" name="book_author" id="exampleInputEmail1" placeholder="Tác giả" value="{{$edit_value->book_author}}">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select  name="book_cate" class="form-control input-lg m-bot15">
                                        @foreach($cate_book as $key => $cate)
                                        @if($cate->category_id==$edit_value->category_id)
                                        <option selected value= "{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @else
                                        <option value= "{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                       
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuẩt bản</label>
                                  
                                    <select  name="publisher_id" class="form-control input-lg m-bot15">
                                        @foreach($pub_book as $key=>$pub_book)
                                        @if($pub_book->publisher_id==$edit_value->publisher_id)
                                        <option selected value= "{{$pub_book->publisher_id}}">{{$pub_book->publisher_name}}</option>
                                       @else
                                        <option value= "{{$pub_book->publisher_id}}">{{$pub_book->publisher_name}}</option>
                                       @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select  name="book_status" class="form-control input-lg m-bot15">
                                        @if($edit_value->book_status==0)
                                        <option value=0>Ẩn</option>
                                        <option value=1>Hiện</option>
                                        @else
                                        <option value=1>Hiện</option>
                                        <option value=0>Ẩn</option>
                                        @endif
                                    </select>

                                </div>
                                <button type="submit" name="update_book"  class="btn btn-info">Cập nhật Sách</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff"  href="{{URL::to('/all-book')}}">Quay lại</a></button>
						    
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
            
        </div>
       
@endsection