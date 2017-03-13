@extends ('layouts.dashboard')
@section('page_heading','User')

@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="/user{{$user->id ? '/'.$user->id : ''}}" method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label>Name *</label>
                <input type="text" class="form-control" value="{{$user->name}}" placeholder="Name" name="name">
                <label class="control-label" for="inputError">{{ $errors->first('name') }}</label>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                <label>Email *</label>
                <input type="email" class="form-control" value="{{$user->email}}" placeholder="Email" name="email">
                <label class="control-label" for="inputError">{{ $errors->first('email') }}</label>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                <label>Passwprd *</label>
                <input type="password" class="form-control" value="" placeholder="Password" name="password">
                <label class="control-label" for="inputError">{{ $errors->first('password') }}</label>
            </div>
            <div class="form-group">
                <label>Created</label>
                <p class="form-control-static">{{$user->created_at}}</p>
            </div>
            @if (isset($message))
            <div class="alert alert-success " role="alert">
                <i class="fa fa-info"></i> {{$message}}
            </div>
            @endif
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="reset" class="btn btn-default"><a href="{{ url ("user/{$user->id}/delete") }}">Delete</a></button>
            <button type="button" class="btn btn-default"><a href="{{ url ('users') }}">List</a></button>
        </form>
    </div>
</div>
</div>
@stop