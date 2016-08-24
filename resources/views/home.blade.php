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
                    <h2>{{$status->text}}</h2>
                    <div>
                    @if (count($status->comments)>0)
                        <h5>Comments:</h5>
                    
                    @foreach ($status->comments as $comment)
                        <div class="well">
                            <div class="col-md-4">{{$comment->user->username}}:</div>
                            <div class="col-md-8">{{$comment->body}}</div>
                        </div>
                    @endforeach
                    @endif
                    <div class="row">
                        <form method="POST" action="/comment\store">
                            {{csrf_field()}}
                            <input type="hidden" name="status_id" value="{{$status->id}}">
                            <fieldset class="form-group">
                                <label for="comment">Comment:</label>
                                <input class="form-control" type="text" name="body">
                            </fieldset>
                            <input type="submit" name="submit" class="btn">
                        </form>
                    </div>
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
