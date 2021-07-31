@extends('layouts.Layout')

@section('content')
<section class="contact-section" style="background-color: #ffffe6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 contact-info" >
                <h3 class="text-center">EXCHANGE MONEY</h3>
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
                <form class="contact-form" method="POST" action ="{{ route('postExchange') }}">
                    @csrf
                    <select id='select' name="exchangeType" onchange="changeValue()">
                        <option selected disabled>Select the type of exchange</option>
                        <option value="RwfToUSD">Rwf to USD</option>
                        <option value="USDToRwf">USD to Rwf</option>

                    </select>
                    <input id="RwfToUSD" autocomplete="off" name="AmountInRwf" style="display:none" type="text" placeholder="Enter the Amount in Rwf">
                    <input id="USDToRwf" autocomplete="off" name="AmountInUSD" style="display:none" type="text" placeholder="Enter the Amount in USD">
                    <br>
                    <button class="site-btn btn-block">Exchange Money</button>
                </form>
                <br>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    // let select = document.getElementById('select').value;
      // // let optionSelected = select.options[select.selectedIndex];
      // console.log(select);
      function changeValue()
      {
        let select = document.getElementById('select').value;
          if(select == 'RwfToUSD'){
              document.getElementById('RwfToUSD').style.display='block';
              document.getElementById('USDToRwf').style.display='none';
          }
          else {
            document.getElementById('RwfToUSD').style.display='none';
              document.getElementById('USDToRwf').style.display='block';
          }
      }
  </script>
