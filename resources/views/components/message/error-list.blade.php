@session('errors')
<div class="text-xl font-bold text-red-600">
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endsession
