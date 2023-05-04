@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM Sách
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

                                <form role="form" action="{{URL::to('/save-book')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sách</label>
                                <input type="text"  type="text"   class="form-control" name="book_name" id="exampleInputEmail1" placeholder="Tên Sách" required/>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh Sách</label>
                                    <input type="file" class="form-control" name="book_image" id="exampleInputEmail1" >
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sách</label>
                                    <input type="number" class="form-control" name="book_inventory" id="exampleInputEmail1" placeholder="Số lượng tồn kho" required/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sách</label>
                                    <input type="text" class="form-control" name="book_price" id="exampleInputEmail1" placeholder="Giá Sách" required/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả Sách</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="ckeditor2" name="book_desc" placeholder="Mô tả Sách" required></textarea>
                                   
                                </div>
                                <div class="form-group">
                                    
                                    <label for="exampleInputEmail1">Tên Tác giả</label>
                                    <input type="text" class="form-control" name="book_author"  placeholder="Tác giả" required/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select  name="book_cate" class="form-control input-lg m-bot15">
                                        @foreach($cate_book as $key => $cate)
                                        <option value= "{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuẩt bản</label>
                                    <select  name="publisher_id" class="form-control input-lg m-bot15">
                                        @foreach($pub_book as $key=>$pub_book)
                                        <option value= "{{$pub_book->publisher_id}}">{{$pub_book->publisher_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select  name="book_status" class="form-control input-lg m-bot15">
                                        <option value=1>Hiện</option>
                                        <option value=0>Ẩn</option>
                                        
                                    </select>

                                </div>
                                 

                                <button type="submit" name="add_book"  class="btn btn-info">Thêm Sách</button>
                                <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff"  href="{{URL::to('/all-book')}}">Quay lại</a></button>
						
                               </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@endsection