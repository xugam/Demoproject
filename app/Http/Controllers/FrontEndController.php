<?php

namespace App\Http\Controllers;
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
         $this->calculateTotal($request);
         $cart_total = session()->get('cart_total');
         
          return view('cart',['cart_items'=>$cart_items],['cart_total'=>$cart_total]);
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
               $cart_items = session()->get('cart');
               $this->calculateTotal($request);
               $cart_total = session()->get('cart_total');
               return view('cart',['cart_items'=>$cart_items],['cart_total'=>$cart_total]);
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
               $cart_items = session()->get('cart');
               $this->calculateTotal($request);
               $cart_total = session()->get('cart_total');
               return view('cart',['cart_items'=>$cart_items],['cart_total'=>$cart_total]);
         }
   }

   public function calculateTotal($request){
      $cart_items = $request()->session()->get('cart');
      $cart_total = 0;
      foreach($cart_items as $cart_item){
         $cart_total += $cart_item['quantity']*$cart_item['price'];
      }
      
      $request->session()->put('cart_total',$cart_total);

   }
}
