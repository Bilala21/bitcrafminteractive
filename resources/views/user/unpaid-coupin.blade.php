@extends('layouts.main_layout')
@section('content')
    <div class="home-main">
        <div class="row">
            <div class="coll-2">
                <form action="{{ route('search-user-coupons', [auth()->user()->id]) }}" method="GET"
                    class="search__form mb-3">
                    <input type="text" placeholder="Search Coupon.." class="search__input" name="searchText" id="query"
                        value="" autocorrect="off" autocapitalize="none" autocomplete="off" data-autocomplete="search">
                    <button type="submit" class="button-search user_ser"><i class="fa fa-search "></i></button>
                </form>
                <div class="add-new-coupon mb-3">
                    <a href="{{ route('addNewCoupon') }}">Add Coupon</a>
                </div>
                <div class="add-new-coupon favourite mb-3">
                    <a href="{{ route('show-favourite-coupon') }}">Favourite</a>
                </div>
                <div class="check__boxes">
                    <a href="{{ route('discounted-coupons') }}" class="check__box">
                        <input type="checkbox" name="" id="">
                        <span>discounted</span>
                    </a>
                    <a href="{{ route('paid-coupons') }}" class="check__box">
                        <input type="checkbox" name="" id="">
                        <span>price</span>
                    </a>
                    <a href="{{ route('unpaid-coupons') }}" class="check__box">
                        <input type="checkbox" name="" id="">
                        <span>free</span>
                    </a>
                </div>
                {{-- <div class="check__boxes">
                    <div class="check__box">
                        <input type="checkbox" name="" id="discounted">
                        <span>discounted</span>
                    </div>
                    <div class="check__box">
                        <input type="checkbox" name="" id="free">
                        <span>free</span>
                    </div>
                    <div class="check__box">
                        <input type="checkbox" name="" id="price">
                        <span>price</span>
                    </div>
                </div> --}}
            </div>
            <div id="wrapper">
                <div class="main__content">
                    <h1 class="mb-5">All Coupons</h1>
                    <div id="hide_content">
                        @isset($couponsData)
                            @if ($couponsData)
                                @foreach ($couponsData as $coupon)
                                    <div class="d-flex mb-4">
                                        <span class="img-span position-relative" data-id="{{ $coupon->id }}">
                                            <img src="{{ asset('images/star-2.png') }}" alt="" srcset=""
                                                class="star_img-1">
                                            <img src="{{ asset('images/star-1.png') }}" alt="" srcset=""
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
                                        <span class="me-2 text-success">( free )</span>
                                    </div>
                                @endforeach
                            @else
                            <h4>No result found for this user.</h4>
                            @endif
                        @endisset
                    </div>

                    {{-- ajax data --}}

                    <div id="ajax_data">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#keywords').tablesorter();
        });
    </script>

@endsection
