@extends('layouts.app')
@section('title')
	{{ $status->user->username }}'s status
@stop
@section('content')
	<div class="container">
        <div class="well">
        	@include('status.one')
        </div>
	</div>
@stop