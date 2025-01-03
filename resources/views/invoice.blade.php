@extends('Layouts.master');
@section('content')
   
    @php
        $order_id = Session::get('order_id');
        $totalAmount = Session::get('cart_total');
        $order = App\Models\Order::find($order_id);
    @endphp
    <h1>Order Id: {{ $order_id }}</h1>
    @foreach($order->orderItems as $product)
       

        <div class="product-single">
                            <div class="product-img">
                            <h2> {{$product['product_name']}}</h2>

                                <img src="{{asset('img/'.$product['product_image'])}}" alt="Product Image">
                            </div>
                            <div class="product-content">
                                <p>{{$product['product_description']}}</p>
                               
                                <h3>Rs. {{$product['product_price']}}</h3>
                            
                                <!-- <a class="btn" href="#">Buy Now</a> -->
                                
                            </div>
                        </div>
    @endforeach


    @endsection