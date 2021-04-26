@extends('layouts.app')

@section('content')

<div>
    <p>USama Here</p>
    @foreach($posts as $noti)
        <p>{{$noti->text}}</p>
    @endforeach    
</div>
@endsection
