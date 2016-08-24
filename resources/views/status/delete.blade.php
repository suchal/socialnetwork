@extends('layouts.app')

@section('content')
	<div class="container">
		<form method="post" action="/status/{{ $status->id }} ">
			{{ csrf_field() }}
			{{ method_field("delete") }}
		     <div class="alert alert-warning" role="alert">
		         <strong>Warning!</strong> This will permanently delete this status!
		     </div>
		     <input type="submit" name="submit" value="Delete!">;
		</form>
	</div>
@stop