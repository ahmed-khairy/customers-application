@extends('layouts.app', ['activePage' => 'delivery', 'titlePage' => __('Delivery')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Add new delivery user</h4>
            </div>
            <div class="m-5 align-middle">
                <form method="post" action="{{ route('deliveries_list.store') }}" enctype="multipart/form-data">
                    @csrf
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
                        <label for="name" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Name</h4>
                        </label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Email</h4>
                        </label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Password</h4>
                        </label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Password confirmation</h4>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Phone</h4>
                        </label>
                        <input type="number" name="phone" class="form-control" id="phone"
                            value="{{ old('phone') }}">
                    </div>
                    <div class="mb-3">
                        <label for="available_balance" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Available balance</h4>
                        </label>
                        <input type="number" name="available_balance" class="form-control" id="available_balance"
                            value="{{ old('available_balance') }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">
                            <h4 class="card-title h5 h4-sm">Latitude</h4>
                        </label>
                        <input type="number" name="latitude" class="form-control" id="latitude"
                            value="{{ old('latitude') }}">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Longitude</h4>
                        </label>
                        <input type="number" name="longitude" class="form-control" id="longitude"
                            value="{{ old('longitude') }}">
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">
                            <h4 class="card-title h5 h4-sm">Active</h4>
                        </label>
                        <input type="boolean" name="active" class="form-control" id="active"
                            value="{{ old('active') }}">
                    </div>
                    <div class="mb-3">
                        <label for="busy" class="form-label">
                            <h4 class="card-title h5 h4-sm">Busy</h4>
                        </label>
                        <input type="boolean" name="busy" class="form-control" id="busy"
                            value="{{ old('busy') }}">
                    </div>
                    <div class="mb-3">
                        <label for="map" class="form-label">
                            <h4 class="card-title h5 h4-sm">Map</h4>
                        </label>
                        <input type="text" name="map" class="form-control" id="map"
                            value="{{ old('map') }}">
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Profile image</h4>
                        </label>
                        <input type="file" name="profile_image" class="form-control" id="profile_image">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
