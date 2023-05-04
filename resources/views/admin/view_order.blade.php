@extends('admin_layout')
@section('admin_content')
<div class="panel-heading">
    Chi tiết đơn hàng
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin khách hàng
      </div>
      <div class="row w3-res-tb">
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên người đặt</th> 
              <th>Địa chỉ Email</th>
              <th>SĐT</th>
              <th>Địa chỉ nhận hàng</th>
       
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>  
                <tr>
                    <td>{{$orderId->customer_name}}</td>
                    <td>{{$orderId->customer_email}}</td>
                    <td>{{$orderId->customer_phone}}</td>
                    <td>{{$orderId->order_address}}</td>
              
                </tr>     
          </tbody>
        </table>
      </div>
      <br>
      <br>
    </div>
  </div>
</div>
<br>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách sản phẩm
      </div>
      <div class="row w3-res-tb">
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Sản phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody> 

          @foreach($orderId_details as $orderId_details)
                <tr>
                    <td><a>{{$orderId_details->book_name}}</a></td>
                    <td>{{number_format($orderId_details->book_price, 0, ',','.')}} VND</td>
                    <td>{{$orderId_details->book_sales_quantity}}</td>
                    <td>{{number_format($orderId_details->book_price*$orderId_details->book_sales_quantity, 0, ',','.')}} VND</td>
                </tr>
            @endforeach
          </tbody>
          
        </table>
        
      </div>
      <td style="font-size:20px">Tổng hóa đơn:</td>
			<td style="font-size: 20px;padding:3px"> {{$orderId_details->order_total}}</td>
      <br>
      <br>
     				
    </div>
   	
  </div>
  <button style="background-color:green" class="btn btn-secondary" > <a style="color:#fff"  href="{{URL::to('/manage-order')}}">Quay lại</i></a></button>
		
@endsection