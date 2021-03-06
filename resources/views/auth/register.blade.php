@extends('layouts.Layout')

@section('content')
<section class="contact-section" style="background-color: #ffffe6;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 contact-info" >
                <h3 class="text-center">REGISTRATION FORM</h3>
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
                <form class="contact-form" method="POST" action ={{ route('register') }}>
                    @csrf
                    <input type="text" autocomplete="off" name="fname" value="{{ old('fname') }}" placeholder="First Name">
                    <input type="text" autocomplete="off" name="lname" value="{{ old('lname') }}" placeholder="Last Name">
                    <input type="text" autocomplete="off" name="phoneNo" value="{{ old('phoneNo') }}" placeholder="Phone number">
                    <input type="text" autocomplete="off" name="location" value="{{ old('location') }}" placeholder="Location">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="password_confirmation" placeholder="Repeat Password">
                    <br>
                    <button class="site-btn btn-block">REGISTER</button>
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
          if(select == 'Pharmacist'){
              document.getElementById('Code').style.display='block';
          }
          else {
              document.getElementById('Code').style.display='none';
          }
      }
  </script>
