
<?php $temp = "{{Route::currentRouteName()}}";
 echo $temp;
?>
<div id="nav">
            <div class="container-fluid">
                <div id="logo" class="pull-left">
                    <a href="index.html"><img src="{{asset('img/logo.png')}}" alt="Logo" /></a>
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="{{Route::currentRouteName()=='index'?'menu-active':''}}"><a href="{{route('index');}}">Home</a></li>
                        <li class="{{Route::currentRouteName()=='products'?'menu-active':''}}"><a href=" {{ route('products'); }} ">Products</a></li>
                        <li class="{{Route::currentRouteName()=='about'?'menu-active':''}}"><a href=" {{ route('about'); }} ">About</a></li>
                        <li><a href="">Reviews</a></li>
                        <li class="{{Route::currentRouteName()=='cart'?'menu-active':''}}"><a href=" {{ route('cart'); }} ">Cart</a></li>
                    </ul>
                </nav>
            </div>
        </div>
