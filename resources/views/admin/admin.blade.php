@extends('admin.app')
 @section('content')
 <div class="row">
    <div class="table-div">
          <h1>Users Details</h1>
      <table id="table" class="table">
        <thead>
          <tr>
            <th>User</th>
            <th>Coupons</th>
            {{-- <th>Status</th> --}}
            <th>Action</th>
          </tr>
        </thead>
        
        <tbody>

          @forelse($users as $user)
            <tr>
              <td><a class="admin-detail-button" href="{{ route('user-coupons', ['id' => $user->id]) }}">{{ $user->email }}</a></td>
              <td>{{ $user->coupons_count }}</td>
              {{-- <td>{{ $user->disabled }}</td> --}}
              <td>
                @if($user->disabled == 1)
                  <a class="admin-a-link Enable-btn" href="{{ route('enable-user', ['id' => $user->id]) }}">Enable</a>
                @else
                <a class="admin-a-link Disable-btn" href="{{ route('disable-user', ['id' => $user->id]) }}">Disable</a>
                @endif
              </td>
            </tr>
          @empty
          <tr>
            <td colspan="4">No user found</td></tr>
          @endforelse
        </tbody>
      </table>
          
    </div>
  </div>
 @endsection