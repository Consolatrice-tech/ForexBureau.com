@extends('layouts.Layout')

@section('content')
<section class="hero-section">
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="/Exchange/img/Money2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-black">

                        <h2>money transfer</h2>
                        <p style="color: black;font-weight:bold">one of the following cashless modes of payment or payment systems</p>

                    </div>
                </div>

            </div>
        </div>
        <div class="hs-item set-bg" data-setbg="/Exchange/img/Money3.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 text-white">

                        <h2>money transfer</h2>
                        <p>Send Money accross the world at a service of high quality,high security and high speed</p>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="slide-num-holder" id="snh-1"></div>
    </div>
</section>
<!-- Hero section end -->



<!-- Features section -->
<!-- Features section end -->


<!-- letest product section -->
<section class="top-letest-product-section">
    <div class="container">
        <div class="section-title">
            <h2>OUR SERVICES</h2>
        </div>
        <div class="product-slider owl-carousel">
            <div class="product-item">
                <div class="pi-pic">
                    <img src="/Exchange/img/Money2.jpg" width="80" height="250"  style="border:0px solid #4d4d4d;
                    box-shadow: 5px 2px 5px 5px grey;
                      border-radius: 2%;"
                      alt="">
                </div>
                <div class="pi-text">
                   <p><b>send money wherever you are in the world</b></p>
                </div>
            </div>
            <div class="product-item">
                <div class="pi-pic">
                    <img src="/Exchange/img/Money4.jpg" width="80" height="250"  style="border:0px solid #4d4d4d;
                    box-shadow: 5px 2px 5px 5px grey;
                      border-radius: 2%;"
                      alt="">
                </div>
                <div class="pi-text">
                   <p><b>we assure the security of your money</b></p>
                </div>
            </div>
            <div class="product-item">
                <div class="pi-pic">
                    <img src="/Exchange/img/Money5.jpg" width="80" height="250"  style="border:0px solid #4d4d4d;
                    box-shadow: 5px 2px 5px 5px grey;
                      border-radius: 2%;"
                      alt="">
                </div>
                <div class="pi-text">
                   <p><b>Our services are quick,secure and flexible</b></p>
                </div>
            </div>
            <div class="product-item">
                <div class="pi-pic">
                    <img src="/Exchange/img/Money6.jpg" width="80" height="250"  style="border:0px solid #4d4d4d;
                    box-shadow: 5px 2px 5px 5px grey;
                      border-radius: 2%;"
                      alt="">
                </div>
                <div class="pi-text">
                   <p><b>Our services are enjoyable</b></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
