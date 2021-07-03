<div class="d-flex align-items-center">
    <span class="badge badge-primary">{{ $cart->amount() }}</span>
    <a class="nav-link" href="{{ route('checkout') }}">
        <i class="fa fa-shopping-cart" style="font-size: 25px;"></i>
    </a>
</div>
