@extends('layouts.Layout')

@section('content')
<section class="contact-section" style="background-color: #ffffe6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 contact-info" >
                <h3 class="text-center">SEND MONEY WHEREVER YOU ARE USING OLTRANZ</h3>
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


                  <form class="contact-form" id="oltranz-form" action="{{ route('oltranzTransfer') }}" method="POST">
                    @csrf
                    <input  autocomplete="off" name="receiverNumber"  type="text" placeholder="Enter receiver number(format 25078..)">
                    <input  autocomplete="off" name="receiverNames"  type="text" placeholder="Enter receiver Names">
                    <input  autocomplete="off" name="receiverLocation"  type="text" placeholder="Enter receiver Location">
                    <input  autocomplete="off" name="amount"  type="text" placeholder="Enter amount">
                    <input  autocomplete="off" name="description"  type="text" placeholder="Enter description">
                    <button class="site-btn btn-block">SEND MONEY</button>
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
