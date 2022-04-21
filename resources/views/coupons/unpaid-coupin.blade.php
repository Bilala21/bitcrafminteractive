@extends('layouts.main_layout')
@section('content')
<div class="home-main">
  <div class="row">
    <div class="coll-2">
      <form action="{{ route('search-coupon') }}" method="GET" class="search__form mb-3">
        <input type="text" placeholder="Search Coupon.." class="search__input" name="searchText" id="query" value=""
          autocorrect="off" class="search-box-home-page" autocapitalize="off" autocomplete="off"
          data-autocomplete="search">
        <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
      </form>
      <div class="check__boxes">
        <a href="{{route('discounted')}}" class="check__box">
          <input type="checkbox" name="" id="">
          <span>discounted</span>
        </a>
        <a href="{{route('unpaid-free')}}" class="check__box">
          <input type="checkbox" name="" id="">
          <span>free</span>
        </a>
        <a href="{{route('paid-coupon')}}" class="check__box">
          <input type="checkbox" name="" id="">
          <span>price</span>
        </a>
      </div>
    </div>
    <div id="wrapper">
      <div class="main__content">
          <h1 class="mb-5">Free Coupons</h1>
          <div id="hide_content">
              @if ($couponsData)
                  @foreach ($couponsData as $coupon)
                  <div class="d-flex mb-4">
                    <span class="img-span position-relative" data-id="{{ $coupon->id }}">
                        <img src="{{asset('images/star-2.png')}}" alt="" srcset=""
                            class="star_img-1">
                        <img src="{{asset('images/star-1.png')}}" alt="" srcset=""
                            class="star_img2">
                    </span>
                    <span class="me-2 result-date">
                        @php
                            echo date('d', strtotime($coupon->created_at));
                        @endphp
                    </span>
                    <span class="me-2 result-date">
                        @php
                            echo date('M', strtotime($coupon->created_at));
                        @endphp
                    </span>

                    <span class="me-2"><a href="{{ $coupon->link }}"
                            class="result-title">{{ $coupon->website_name }}</a></span>
                    <span class="me-2 result-date">{{ strtoupper($coupon->coupon_code) }}</span>
                    <span class="me-2 result-date">( {{ $coupon->produtType->name }} )</span>
                    <span class="me-2">{{ $coupon->website_name }}</span>
                    <span class="me-2 nearby">(
                      @if ($coupon->actual_price and $coupon->discounte_price)
                          <del class="actpr">${{ $coupon->actual_price }}
                          </del>,
                          <span class="dispri">${{ $coupon->discounte_price }}</span> )
                      @endif
                      @if ($coupon->actual_price !=0 and $coupon->discounte_price == 0)
                          <span class="dispri">${{ $coupon->actual_price }}</span> )
                      @endif
                      @if ($coupon->actual_price ==0 and $coupon->discounte_price == 0)
                          <span class="text-success"> free )</span>
                      @endif
                  </span>
                </div>
                  @endforeach
              @endif
          </div>

          {{-- ajax data --}}

          <div id="ajax_data">

          </div>

      </div>
  </div>
  </div>
</div>
</div>
<script>
  $(function(){
  $('#keywords').tablesorter(); 
});
</script>

@endsection