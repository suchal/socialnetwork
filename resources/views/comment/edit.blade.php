@extends('layouts.app')

@section('content')
	<div class="container">
		
		<div class="row">
			
			<h2>Edit your comment</h2>
		</div> 
		<div class="row">
			<form method="POST" action="/comment/{{ $comment->id }}/">
			{{ csrf_field() }}
			{{ method_field("PATCH") }}
			<div class="form-group {{ $errors->has('body') ? "has-error" : " " }}" >
				<label for='body' class="control-label">Comment:</label>
				<input type="text" class="form-control" name="body" value="{{ old("body") }}">
				@if ($errors->has('body'))
				<span class="help-block">
					<strong>{{ $errors->first('body') }}</strong>
				</span>
				@endif
			</div>

			<input type="submit" name="submit" value="edit your comment" class="btn btn-primary">
			</form>
		</div>

	</div>
@stop