@extends('layouts.app')

@section('content')
<div class="position-relative overflow-hidden m-md-3 text-center">
    <div class="col-md-5 p-lg-5 mx-auto my-1">
        <h1 class="display-4 font-weight-normal" style="color: #fb8c00;">WorkShops</h1>
        <p class="lead font-weight-normal">{{ __('Platform to manage, courses, events or consultancies for companies and individuals') }}</p>
        <a class="btn btn-outline-secondary" href="https://github.com/ASanchezT85/workshops">GitHub</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<div class="content">
    <div class="container-fluid">
        <dashborard-component></dashborard-component>
    </div>
</div>
@endsection
