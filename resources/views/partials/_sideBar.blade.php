@if($guard == 'customer')
    <li  class = "{{ request()->routeIs('menu.wallet*') ? 'active' : '' }}">
        <a href="{{ route('menu.wallet') }}"><span class="fa fa-credit-card mr-3"></span>Wallet</a>
    </li>
    <li class = "{{ request()->routeIs('menu.customerproduct*') ? 'active' : '' }}">
        <a href="{{ route('menu.customerproduct') }}"><span class="fa fa-shopping-cart mr-3"></span>Products</a>
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
    <li class="active">
        <a href="#"><span class="fa fa-credit-card mr-3"></span>Wallet</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-briefcase mr-3"></span>My Products</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-unlock mr-3"></span> Open Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-lock mr-3"></span> Closed Trades</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-file mr-3"></span>Products Analysis</a>
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
