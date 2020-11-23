@extends('layouts.app')

@section('content')
    <style>
        #ball {
            background: var(--primary);
            width: 100px;
            height: 100px;
            border-radius: 75%;
            margin-left: auto;
            margin-right: auto
        }
    </style>
    <div id="ball"></div>
@endsection

