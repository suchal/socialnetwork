@extends('layouts.app')

@section('content')
	<div class="container">
		
		<div class="row">
			
			<h2>Edit your status</h2>
		</div> 
		<div class="row">
			<form method="POST" action="/status/{{ $status->id }}/">
			{{ csrf_field() }}
			{{ method_field("PATCH") }}
			</div>
				<div class="form-group {{ $errors->has('text') ? "has-error" : " " }}" >
					<label for='text' class="control-label">Status:</label>
					<textarea class="form-control" name="text">{{ $status->text }}</textarea>
					@if ($errors->has('text'))
					<span class="help-block">
						<strong>{{ $errors->first('text') }}</strong>
					</span>
					@endif
				</div>
			<input type="submit" name="submit" value="Update your status" class="btn btn-primary">
			</form>
		</div>

	</div>
@stop