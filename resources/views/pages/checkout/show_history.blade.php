@extends('layout')
@section('content')
<section id="">
    <div class="container-fluid" style="background-color:#fff">
        <h2 class="title text-center" style="padding-top:10px ">Lịch sử mua hàng</h2>

        <div class="table-responsive  cart_info">
         
            <table class="table table-hover table-condensed" >
                <thead>
                    <tr class="cart_menu">
                        <td >Tên người nhận hàng</td>
                        <td >Địa chỉ nhận hàng</td>
                        <td >Số điện thoại nhận hàng</td>
                        <td class="description">Tổng tiền</td>
                        <td class="price">Tình trạng</td>
                        <td></td>   
                    </tr>
                </thead>
                <tbody>
                     @foreach($history_order as $h_order)
                    <tr>
                        <td>{{$h_order->order_name}}</td>
                        <td>{{$h_order->order_address}}</td>
                        <td>{{$h_order->order_phone}}</td>
                        <td>{{$h_order->order_total .' VND'}}</td>
                        <td>{{$h_order->order_status}}</td>
                        <td>
                            <a href="{{URL::to('/view-history-order/'.$h_order->order_id)}}" class="active" style="font-size: 1.3rem" ui-toggle->
                                <i class="fa fa-eye" style="color:#fc4f13"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
