@extends('layouts.app')
@section('content')
  <div class="payment">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h3>
            Sponsorizza il tuo appartamento e mettilo in risalto!!
          </h3>
          <p></p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <form class="mt-3" method="post" id="payment-form" action="{{ url('/checkout') }}">
              @csrf
              <section>
                <input type="hidden" name="apart_id" value="{{$apartament->id}}">
                <label for="amount">
                    <div class="input-wrapper amount-wrapper">
                      <ul>
                        @foreach ($sponsortypes as $sponsort)
                        <li>
                          <input class="radio" type="radio" id="amount" name="amount"min="1" placeholder="Amount" value="{{ $sponsort->price }}">
                          Sponsorizzazione versione: {{ $sponsort->description }},
                          della durata di {{$sponsort->time_length}} ore,
                          e al costo di {{$sponsort->price}}€.

                        <input type="hidden" name="sponsort_id" value="{{$sponsort->id}}">
                        </li>
                        @endforeach
                      </ul>
                    </div>
                </label>
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
              </section>

              <input id="nonce" name="payment_method_nonce" type="hidden" />

              <button class="button mt-5" type="submit"><span>Test Transaction</span></button>
            </form>
          </div>
        </div>
      </div>

    </div>
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
