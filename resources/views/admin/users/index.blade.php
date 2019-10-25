@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'users')

	@section('content_header')
		{{ Breadcrumbs::render('users.index') }}
	@stop

	@section('content')
	<div class="container">
		<div class="card">
		<div class="card-body">
	@can('create_users')
	 <div style="float:right;padding-right:20px;"><a href="{{ route('users.create') }}" title="Add New User"><i class="fa fa-plus-circle fa-2x"></i></a></div><br /><br/>
	@endcan
			@if (count($users))
		<table id="users" class="table table-hover table-responsive-sm table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at->toFormattedDateString() }}</td>
					<td>
					@can('view_users')
				{{-- <a href="{{ route('users.show', ['user' => $user->id]) }}" title="View User Details"><i class="fa fa-info-circle fa-2x"></i></a>&nbsp;&nbsp; --}}
					@endcan
					@can('edit_users')
					<a href="{{ route('users.edit', ['user' => $user->id]) }}" title="Edit User Details"><i class="fa fa-pencil-square fa-2x"></i></a>
					@endcan
					@can('delete_users')
					<form method="post" id="F1" name="F1" action="{{ route('users.destroy', ['user' => $user->id]) }}" style="display:inline;">@csrf @method('DELETE')<a onclick="if(confirm('Really delete this user?')) { this.parentNode.submit(); }" title="Delete this User"><i class="fa fa-trash fa-2x" style="color:red;"></i></a></form>
					@endcan
				</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</tfoot>
		</table>
		@else
			<center>No Records Found...</center>
		@endif
		</div>
		</div>
		<form method="post" name="F1" id="F1" action="{{ route('users.destroy', ['user' => $user->id]) }}" style="display:none;">@csrf @method('DELETE')</form>
	</div>
		@stop

		@section('css')
		@stop

		@section('js')
		<script>
		$('#users').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
        'columnDefs' : [{
          'targets' : [-1],
          'orderable' : false
         }]
		});
		</script>
		@stop

@push('css')
@push('js')
