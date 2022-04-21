{{-- @extends('custom-auth.main') --}}
@extends('user.app')
@section('content')

<div class="container">
    <h1>Add Coupon</h1>
    <form action="{{ route('addCoupon') }}" method="POST" class="add__new___coupon">
        @csrf
        <label for="name">Name</label>
        <input type="text" class="search__input" id="name" name="name" class="search__input" placeholder="Enter Coupon name..">
        @error('name')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <label for="coupon">Coupon code</label>
        <input type="text" class="search__input" id="coupon_code" name="coupon_code" placeholder="Enter Coupon ..">
        @error('coupon_code')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror

        <label for="link">Website Link</label>
        <input type="text" class="search__input" id="link" name="link" placeholder="Enter website link..">
        @error('link')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <label for="name">Actual price</label>
        <input type="number" class="search__input" id="acprice" name="acprice" placeholder="Enter actual price..">
        @error('acprice')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <label for="name">Discounted price</label>
        <input type="number" class="search__input" id="disprice" name="disprice" placeholder="Enter discounted price..">
        @error('disprice')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror

        <label for="product_type">Product Type</label>
        <select id="product_type" name="product_type" class="search__input mb-3">
            <option value="" selected>Choose</option>
            @foreach ($productType as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('product_type')
            <p class="alert alert-danger">{{ $message }}</p>
        @enderror

        <input type="submit" value="Submit" >
    </form>
</div>
@endsection