@extends('layouts.main_layout')
@section('content')
    <div class="container">
        @isset($couponsData)
            @if ($couponsData)
                @foreach ($couponsData as $item)
                    <div class="form-group">
                        <label for=""></label>
                        <input type="text" name="" id="" class="form-control" value="{{$item->name}}">
                    </div>
                @endforeach
            @endif
        @endisset
    </div>
@endsection
