@extends('layouts.app')
@section('content')
  <div class="content">
    <form method="post" id="payment-form" action="{{ url('/checkout') }}">
      @csrf
      <section>
        <input type="text" name="apart_id" value="{{$apartament->id}}">
          <label for="amount">
              <span class="input-label">Amount</span>
              <div class="input-wrapper amount-wrapper">
                @foreach ($sponsortypes as $sponsort)
                  <input type="radio" id="amount" name="amount"min="1" placeholder="Amount" value="{{$sponsort->price}}"> {{$sponsort->description}} ({{$sponsort->price}})
                  <input type="text" name="sponsort_id" value="{{$sponsort->id}}">
                @endforeach
              </div>
          </label>

          <div class="bt-drop-in-wrapper">
              <div id="bt-dropin"></div>
          </div>
      </section>

      <input id="nonce" name="payment_method_nonce" type="hidden" />

      <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
</div>


<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
  var form = document.querySelector('#payment-form');
  var client_token = "{{ $token }}";

  braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
    paypal: {
      flow: 'vault'
    }
  }, function (createErr, instance) {
    if (createErr) {
      console.log('Create Error', createErr);
      return;
    }
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      instance.requestPaymentMethod(function (err, payload) {
        if (err) {
          console.log('Request Payment Method Error', err);
          return;
        }

        // Add the nonce to the form and submit
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
      });
    });
  });
</script>
@endsection
