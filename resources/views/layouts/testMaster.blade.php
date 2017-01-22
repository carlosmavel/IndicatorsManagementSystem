@extends('layouts.master')



@section('navbarIcons')
    @if (isset($departments) == True)    
    @foreach($departments as $dept)        
    <a class="navbar-brand" href="{{ url($dept->route) }}">
        <i class="{{ $dept->icon }}" aria-hidden="true" title="{{ $dept->name }}"></i>
    </a>
    @endforeach
    @endif
@endsection