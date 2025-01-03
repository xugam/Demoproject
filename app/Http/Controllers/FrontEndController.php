<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    //
     public function about(){
        return view('about');
     }
     public function cart(Request $request){
         // $request->session()->remove('cart');
         // dd("session removed");
         $cart_items = session()->get('cart');
         $request->session()->has('cart')?$this->calculateTotal($request):1;
          return view('cart');
     }
     public function checkout(){

        return view('checkout');
     }
     public function index(){
         $products = Product::all();
         return view('index',['products'=>$products]);
     }
     public function products(){
        return view('products');
     }
     public function single_product($product_id){
      $product = Product::find($product_id);
        return view('single_product',['product'=>$product]);
     }
     public function add_to_cart(Request $request){
         //dd($request->all());
         $request->session()->put('');

         //if session exists
         if($request->session()->has('cart')){

            $cart = $request->session()->get('cart');
            $product_ids = array_column($cart,'id');

               if(in_array($request->id,$product_ids)){
                  // echo "Already added to cart";
                  return redirect()->back()->withErrors(['message'=>'Product already added to cart']);
               }

               else{
                  $id = $request->id;
               $name = $request->name;
               $image = $request->image;
               $quantity = $request->quantity;
               ($request->sale_price!=null) ? $price=$request->sale_price : $price=$request->price;

               $product_array = array(
                  'id'=> $id,
                  'name' => $name,
                  'quantity' => $quantity,
                  'image' => $image,
                  'price' => $price
               );

               $cart[$request->id] = $product_array;
               
               $request->session()->put('cart',$cart);
               $this->calculateTotal($request);
               return view('cart');
               }
            
         }
         //session doesn't exists
         else{
               $id = $request->id;
               $name = $request->name;
               $image = $request->image;
               $quantity = $request->quantity;
               ($request->sale_price!=null) ? $price=$request->sale_price : $price=$request->price;

               $product_array = array(
                  'id'=> $id,
                  'name' => $name,
                  'quantity' => $quantity,
                  'image' => $image,
                  'price' => $price
               );
               $cart[$request->id] = $product_array;
               $request->session()->put('cart',$cart);
               $this->calculateTotal($request);
               return view('cart');
         }
   }

   public function calculateTotal($request){
      $carts = $request->session()->get('cart');
      $cart_total = 0;
      foreach($carts as $cart_item){
         $cart_total += $cart_item['quantity']*$cart_item['price'];
      }

      $request->session()->put('cart_total',$cart_total);

   }

   public function remove_from_cart(Request $request){
      $cart = $request->session()->get('cart');
      $id_to_delete = $request->id;
      unset($cart[$id_to_delete]);
      $request->session()->put('cart',$cart);
      return redirect()->back()->withErrors(['message'=>'Cart item deleted successfully']);
   }

   public function edit_cart(Request $request){
      $quantity = $request->quantity;
   }
   public function place_order(Request $request){
      // dd($request->all());
 
      $order = new Order();
      $order->name = $request->name;
      $order->email = $request->email;
      $order->city = $request->city;
      $order->address = $request->address;
      $order->phone = $request->phone;
      $order->cost = $request->session()->get('cart_total');
      $order->status = "not paid";
      $order->date = date("y-m-d");
      $order->save();

      $cart = $request->session()->get('cart');

      foreach($cart as $c){
         $orderitem = new OrderItem();
         $orderitem->order_id = $order->id;
         $orderitem->product_id = $c['id'];
         $orderitem->product_name = $c['name'];
         $orderitem->product_price = $c['price'];
         $orderitem->product_image = $c['image'];
         $orderitem->product_quantity = $c['quantity'];
         $orderitem->order_date = date("y-m-d");
         $orderitem->save();
      }

      // order id
      $request->session()->put('order_id',$order->id);
        
      return view('payment');
   }
   
}
