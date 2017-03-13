@extends('layouts.dashboard')
@section('page_heading','Users')

@section('section')
<div class="col-sm-12">
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-{{{ isset($class) ? $class : 'default' }}}">
			<div class="panel-heading">
			<h3 class="panel-title">&nbsp;
				<div class="panel-control pull-right">
					<a class="panelButton" href="{{ url ('users') }}"><i class="fa fa-refresh"></i></a>
					<a class="panelButton" href="{{ url ('user') }}"><i class="fa fa-plus"></i></a>
					<!--<a class="panelButton"><i class="fa fa-remove"></i></a>-->
				</div>
			</h3>
			
			</div>
		
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Created</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td><a href="{{ url ("user/{$user->id}") }}">{{$user->name}}</a></td>
							<td>{{$user->email}}</td>
							<td>{{$user->created_at}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="panel-footer text-center">
				<?php echo $users->render(); ?>
			</div>
		</div>

	</div>
</div>
</div>
@stop