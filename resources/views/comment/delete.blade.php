@extends('layouts.app')
@section('title')
	delete comment
@stop
@section('content')
	<div class="container">
		<form method="post" action="/comment/{{ $comment->id }} ">
			{{ csrf_field() }}
			{{ method_field("delete") }}
		     <div class="alert alert-warning" role="alert">
		         <strong>Warning!</strong> This will permanently delete this comment!
		     </div>
		     <input type="submit" name="submit" value="Delete!">;
		</form>
	</div>
@stop