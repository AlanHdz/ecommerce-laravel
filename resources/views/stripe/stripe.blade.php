<form action="{{ route('stripe.checkout') }}"  method="post" id="payment-form">
    @csrf
    <div class="form-row">
      <div>
        <input id="email-element" type="email" class="form-control mb-1" placeholder="janedoe@gmail.com" required name="email">
      </div>
  
      <div id="card-element" style="width: 100%;" require>
        <!-- A Stripe Element will be inserted here. -->
      </div>
      
      <!-- Used to display form errors. -->
      <div id="card-errors" role="alert"></div>
    </div>
  
    <div class="text-right">
      <button class="btn mt-2 btn-outline-primary">Submit Payment</button>
    </div>
</form>