@extends('layouts.admin.master')

@section('title')Edit Profile
{{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Update Profile</h3>
        @endslot
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Update Profile</li>
    @endcomponent

    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12">
                    <form class="card" action="{{route('user.update',$user->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Update Profile</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                                    <i class="fe fe-chevron-up"></i>
                                </a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove">
                                    <i class="fe fe-x"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name" name="first_name" value="{{$user->first_name}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input class="form-control" type="text" placeholder="Last Name" name="last_name" value="{{$user->last_name}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile Number</label>
                                        <input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" value="{{$user->mobile_number}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control" type="text" placeholder="Username" name="user_name" value="{{$user->user_name}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input class="form-control" type="email" placeholder="Email" name="email" value="{{$user->email}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <div class="form-group m-t-5 m-checkbox-inline mb-0 custom-radio-ml">
                                            <div class="radio radio-primary">
                                                <input id="radioinline1" type="radio" name="role" value="admin" @if($user->role == 'admin') checked @endif>
                                                <label class="mb-0" for="radioinline1">Admin</label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline2" type="radio" name="role" value="supervisor" @if($user->role == 'supervisor') checked @endif>
                                                <label class="mb-0" for="radioinline2">Supervisor</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Product</label>
                                        <select class="js-example-basic-multiple col-sm-12" name="product_id[]" id="multiple_product_id" multiple="multiple" required>
                                            @foreach($products as $product)
                                                @php
                                                    $is_check = in_array($product->id, $productIds);
                                                @endphp
                                                <option value="{{$product->id}}" @if($is_check) selected @endif >{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a class="btn btn-light" type="button" href="{{route('user.index')}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    @endpush

@endsection
