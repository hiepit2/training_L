@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
@if(session('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
</div>
@elseif(session('error'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
</div>
@endif