@extends('layouts.app', ['activePage' => 'address', 'titlePage' => __('Address')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit address {{ $address->title }}</h4>
            </div>
            <div class="m-5 align-middle">
                <form method="post" action="{{ url('addresses_list/' . $address->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        {{-- <img src="images/{{ Session::get('profile_image') }}"> --}}
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Customer ID</h4>
                        </label>
                        <input type="number" name="customer_id" class="form-control" id="customer_id"
                            value="{{ $address->customer_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Title</h4>
                        </label>
                        <input type="text" name="title" class="form-control" id="title"
                            value="{{ $address->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Latitude</h4>
                        </label>
                        <input type="number" name="latitude" class="form-control" id="latitude"
                            value="{{ $address->latitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Longitude</h4>
                        </label>
                        <input type="number" name="longitude" class="form-control" id="longitude"
                            value="{{ $address->longitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Address</h4>
                        </label>
                        <input type="text" name="address" class="form-control" id="address"
                            value="{{ $address->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Phone</h4>
                        </label>
                        <input type="number" name="phone" class="form-control" id="phone"
                            value="{{ $address->phone }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
