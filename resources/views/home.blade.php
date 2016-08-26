@extends('layouts.app')
@section('title')
    {{ $user->username }}'s Wall
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="/pics/{{ $pic??"hello" }}" width="100px" height="100px">
            <h1>{{$user->profile->fullname}}</h1>
            @can('update', $user->profile)
                <a class="btn btn-primary" href="/profile/edit">Edit your profile</a>
            @endcan
        </div>

        <div class="col-md-8">
            @can('update', $user->profile)
            <div class="well">
                <form method="POST" action="/status/store">
                {{csrf_field()}}

                    <fieldset class="form-group">
                        <label for="text">Status</label>
                        <textarea class="form-control" name="text"></textarea>
                    </fieldset>
                    <input type="submit" class="btn btn-primary" name="submit" value="Update your status!"/>
                </form>
            </div>
            @endcan

            @foreach ($statuses as $status)
                <div class="well">
                    @include('status.one')
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
