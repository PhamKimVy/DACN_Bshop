@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     LIỆT KÊ KHÁCH HÀNG
    </div>
    
    <div class="table-responsive">
    <?php
                      $message = Session::get('message');
                      if($message){//nếu tồn tại message thì in thông báo ra
                        echo'<span style="color:red">'. $message.'</span>';
                        Session::put('message',null);//Cho thông báo chỉ hiện 1 lần
                      }
                      
                    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
          
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>

        <tbody>
          @foreach($all_customer as $key => $cus)
          <tr>
             <td>{{ $cus->customer_name }}</td>
             <td>{{ $cus->customer_email }}</td>
             <td>{{ $cus->customer_phone }}</td>
             <td>{{ $cus->customer_address }}</td>
             <td style="text-align: center">
                <a href="{{URL::to('/customer-order/'.$cus->customer_id)}}" class="active" style="font-size: 1.3rem" ui-toggle-class="">
                    <i class="fa fa-eye text-success text-active" style="color: blue"></i></a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>

@endsection