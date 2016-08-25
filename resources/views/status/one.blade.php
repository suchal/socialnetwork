<div class="clearfix">
    <div class="col-md-5">
        <h4>{{ $status->user->username }}</h4>
    </div>
    @can('update', $status)
    <div class="col-md-2 col-md-offset-4">
        <a href="/status/{{ $status->id }}/edit">Edit</a>
        |
        <a href="/status/{{ $status->id }}/delete">X</a>
    </div>
    @endcan
</div>
    <h2>{{$status->text}}</h2>
@if (count($status->comments)>0)
<h5>Comments:</h5>

@foreach ($status->comments as $comment)
<div class="well clearfix">
        <div class="col-md-6">{{$comment->user->username}}:</div>

        <div class="col-md-2 col-md-offset-4">
            @can('update', $comment)
            <a href="/comment/{{ $comment->id }}/edit">Edit</a>
            @endcan
            @can('delete',$comment)
            <a href="/comment/{{ $comment->id }}/delete">X</a>
            @endcan
        </div>
    <div class="col-md-12">{{$comment->body}}</div>

</div>
@endforeach
@endif

<div class="row">
    <form method="POST" action="/comment\store">
        {{csrf_field()}}
        <input type="hidden" name="status_id" value="{{$status->id}}">
        <div class="form-group">
            <label for="comment">Comment:</label>
            <input class="form-control" type="text" name="body">
        </div>
        <input type="submit" name="submit" class="btn">
    </form>
</div>
