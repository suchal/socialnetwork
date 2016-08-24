@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" action="/profile/edit">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="form-group {{ $errors->has('fullname') ? "has-error" : " " }}" >
		<label for='fullname' class="control-label">Full Name:</label>
		<input type="text" class="form-control" name="fullname" value="{{ $fullname??"" }}">
		@if ($errors->has('fullname'))
		<span class="help-block">
			<strong>{{ $errors->first('fullname') }}</strong>
		</span>
		@endif
	</div>
	<div class="form-group">
		<label class="control-label">Date of Birth</label>
		<select name="date">
			<option value="">Date</option>
			@for ($i = 1; $i <= 31; $i++)
			<option @if($date==$i) {{ 'selected' }} @endif value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
		<select name="month">
			<option value="">month</option>
			@for ($i = 1; $i <= 12; $i++)
			<option @if($month==$i) {{ 'selected' }} @endif value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
		<select name="year">
			<option value="">Year</option>
			@for ($i = 1900; $i <= 2016; $i++)
			<option @if($year==$i) {{ 'selected' }} @endif value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
		@if ( $errors->has('date') || $errors->has('month') || $errors->has('year') )
		<span class="help-block">
			<strong>Please enter a valid birthdate.</strong>
		</span>
		@endif
	</div>
	<input type="submit" name="submit" class="btn btn-primary" value="Update!">
	</form>
</div>
@stop