 @extends('layouts.Layout')

@section('content')
<section class="contact-section" style="background-color: #ffffe6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 contact-info" >
                <h3 class="text-center">SEND MONEY WHEREVER YOU ARE USING PAYPAL</h3>
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has($msg))
                <div class="text text-{{ $msg }} text-center" id="alert">
                    <b>{{ Session::get($msg) }}</b>
                    <button type="button" class="close text-danger" aria-label="Close"
                    onclick="document.getElementById('alert').style.display='none'">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @endforeach
                <br>
                  <form class="contact-form" id="paypal-form">
                    <input type="text" autocomplete="off"  id="amount" placeholder="enter amount in USD to send">
                    <script
                    src="https://www.paypal.com/sdk/js?client-id=AR04eieDPHws88Lenh_LDFZzZxGssVau6A7DG2WHQcS0kV8E8Ua41uCPNoNHXjjCTg696Oc2tXc1KGP0&disable-funding=credit,card"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
                  </script>
                    <div id="paypal-button-container" style="width: 100%"></div>
                  </form>
                  <br>
                <br>
            </div>
        </div>
    </div>
    <script>
        paypal.Buttons({
            style: {
        layout:  'vertical',
        size:'small',
        shape:   'pill',
        label:   'paypal'
      },
     createOrder: function(data, actions) {
          return actions.order.create({
              redirect_urls:{
                  return_url:'http://localhost:8000/execute-payment'
              },
            purchase_units: [{
              amount: {
                value:document.getElementById('amount').value
              }
            }]
          });
        },
        onApprove: function(data, actions) {
        //    return actions.redirect();
          return actions.order.capture().then(function(details){
              alert('Transaction completed by '+ details.payer.name.given_name);
              return fetch('/paypal/purchase',{
                  methos:'post',
                  headers:{
                      'content-type':'application/json',
                      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                  },
                  body:JSON.stringify({
                      orderID:data.orderID,
                      details:details
                  })
              });
          });
        }
        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
      </script>
@endsection

<script type="text/javascript">
      function changeValue()
      {
        let select = document.getElementById('select').value;
          if(select == 'Paypal'){
              document.getElementById('paypal-form').style.display='block';
              document.getElementById('oltranz-form').style.display='none';
          }
          else {
              document.getElementById('paypal-form').style.display='none';
              document.getElementById('oltranz-form').style.display='block';
          }
      }
  </script>
