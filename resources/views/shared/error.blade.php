@if(count($errors) > 0)
    <div class="alert alert-danger">
    <button class="close" data-close="alert"></button>
        @foreach($errors->all() as $err)
	        {{$err}}<br>
        @endforeach
    </div>
@endif