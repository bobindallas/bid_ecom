@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('users.edit', $user) }}
@stop

@section('content')
<div class="container">
		<div class="card">
		<div class="card-body">
	<form method='POST' action="{{route('users.update', $user->id)}}">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="code">User Name</label>
			<input type="text" name="name" value="{{$user->name}}" class='form-control' placeholder='User Name'>
		</div>
		<div class="form-group">
			<label for="name">Email</label>
			<input type="text" name="email" value="{{$user->email}}" class='form-control' placeholder='Email'>
		</div>
		<div class="form-group">
			<label for="name">Change Password</label>
			<input type="text" name="password" value="" class='form-control' placeholder='New Password'>
		</div>
		<div class="form-group">
			<label for="name">Verify Password</label>
			<input type="text" name="password1" value="" class='form-control' placeholder='Re-enter Password'>
		</div>
		@include('inc.user_roles_form')
		@include('inc.user_perms_form')
		<input type="submit" value="Submit" class="btn btn-primary">
	</form>
	</div>
	</div>
</div>
@endsection
