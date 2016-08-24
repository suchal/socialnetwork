<h1>{{ $status->user->username }}</h1> 
            <h2>{{$status->text}}</h2>
            <div class=row>
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