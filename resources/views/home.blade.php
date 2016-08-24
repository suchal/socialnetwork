@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>{{$user->profile->fullname}}</h1>
            @if($canEdit)
                <a class="btn btn-primary" href="/profile/edit">Edit your profile</a>
            @endif
        </div>
        <div class="col-md-8">
        @if ( $canEdit )
            {{-- expr --}}
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
        @endif

            @foreach ($statuses as $status)
                <div class="well">
                    @include('status.one')
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
