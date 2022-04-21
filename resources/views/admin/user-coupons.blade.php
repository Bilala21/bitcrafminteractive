@extends('admin.app')
 @section('content')
 <div class="row">
    <div class="table-div">
          <h1>Coupon Details</h1>
      <table id="table" class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Coupon</th>
            <th>Website Name</th>
            <th>Product Type</th>
            <th>Action</th>
          </tr>
        </thead>
        
        <tbody>

          @forelse($coupons as $coupon)
            <tr>
              <td><a class="admin-detail-button" href="{{ $coupon->link }}">{{ $coupon->name }}</a></td>
              <td>{{ $coupon->coupon }}</td>
              <td><a class="admin-detail-button" href="{{ $coupon->link }}">{{ $coupon->website_name }}</a></td>
              <td>{{ $product[$coupon->product_type] }}</td>
              <td><a class="delete-btn-admin" href="{{ route('delete-coupon', ['id' => $coupon->id]) }}">Delete</a></td>
              
            </tr>
          @empty
          <tr>
            <td colspan="1">No coupon found</td>
          </tr>
          @endforelse
        </tbody>
      </table>
          
    </div>
  </div>
 @endsection