@extends('layouts.app')

@section('content')    

@if (isset($departments) == True)    
    @foreach($departments as $dept)        
        <div class='container'>
            <div class='row'>
                <div class='col-lg-4' style="font-size: 18px;">
                    <a href="{{ $dept->route }}"><i class="{{ $dept->icon }}" aria-hidden="true" title="{{ $dept->name }}"></i> {{ $dept->name }}</a>
                </div>
            </div>
        </div>
        <br>        
    @endforeach
@endif

@endsection
