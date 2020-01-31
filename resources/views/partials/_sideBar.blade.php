@if($guard == 'customer')
    <li  class = "{{ request()->routeIs('menu.wallet*') ? 'active' : '' }}">
        <a href="{{ route('menu.wallet') }}"><span class="fa fa-credit-card mr-3"></span>Wallet</a>
    </li>
    <li class = "{{ request()->routeIs('menu.customerproduct*') ? 'active' : '' }}">
        <a href="{{ route('menu.customerproduct') }}"><span class="fa fa-shopping-bag mr-3"></span>Products</a>
    </li>
    {{-- style="color:white !important;" --}}
    <li class = "{{ request()->routeIs('menu.cart*') ? 'active' : '' }}">
        <a href="{{ route('menu.cart') }}"><span class="fa fa-shopping-cart mr-3"></span>Cart   <span @if ($cartCount > 0)class="bg-blue"
            style="border-radius:45%;color:white;padding:2px 10px;"@endif>@if ($cartCount > 0){{$cartCount}}@endif</span></a>
    </li>
    <li>
        <a href="#"><span class="fa fa-unlock mr-3"></span> Open Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-lock mr-3"></span> Closed Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-heart mr-3"></span>Saved Items</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-user mr-3"></span>My Profile</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-question-circle mr-3"></span> FAQ </a>
    </li>
    <li>
        <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contact Us</a>
    </li>
@endif
@if($guard == 'vendor')
    <li class = "{{ request()->routeIs('menu.wallet*') ? 'active' : '' }}">
        <a href="{{ route('menu.wallet') }}"><span class="fa fa-credit-card mr-3"></span>Wallet</a>
    </li>
    <li class = "{{ request()->routeIs('menu.vendorproduct*') ? 'active' : '' }}">
        <a href="{{ route('menu.vendorproduct') }}"><span class="fa fa-briefcase mr-3"></span>My Products</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-unlock mr-3"></span> Open Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-lock mr-3"></span> Closed Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-chart-line mr-3"></span>Products Analysis</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-user mr-3"></span>Businesss Profile</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-question-circle mr-3"></span> FAQ </a>
    </li>
    <li>
        <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contact Us</a>
    </li>
@endif
