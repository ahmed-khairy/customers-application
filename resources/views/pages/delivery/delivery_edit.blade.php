@extends('layouts.app', ['activePage' => 'delivery', 'titlePage' => __('Delivery')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit delivery user {{ $delivery->name }}</h4>
            </div>
            <div class="m-5 align-middle">
                <form method="post" action="{{ url('deliveries_list/' . $delivery->id) }}"
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
                        <label for="name" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Name</h4>
                        </label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $delivery->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Email</h4>
                        </label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ $delivery->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Phone</h4>
                        </label>
                        <input type="number" name="phone" class="form-control" id="phone"
                            value="{{ $delivery->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="available_balance" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Available balance</h4>
                        </label>
                        <input type="number" name="available_balance" class="form-control" id="available_balance"
                            value="{{ $delivery->available_balance }}">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Latitude</h4>
                        </label>
                        <input type="number" name="latitude" class="form-control" id="latitude"
                            value="{{ $delivery->latitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Longitude</h4>
                        </label>
                        <input type="number" name="longitude" class="form-control" id="longitude"
                            value="{{ $delivery->longitude }}">
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Active</h4>
                        </label>
                        <input type="boolean" name="active" class="form-control" id="active"
                            value="{{ $delivery->active }}">
                    </div>
                    <div class="mb-3">
                        <label for="busy" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Busy</h4>
                        </label>
                        <input type="boolean" name="busy" class="form-control" id="busy"
                            value="{{ $delivery->busy }}">
                    </div>
                    <div class="mb-3">
                        <label for="map" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Map</h4>
                        </label>
                        <input type="map" name="map" class="form-control" id="map"
                            value="{{ $delivery->map }}">
                    </div>
                    <div class="card-body">
                        @if ($delivery->profile_image)
                            <img class="card-img-sm-right example-card-img-responsive" style="max-height: 20rem;"
                                src="{{ asset('/del_images/' . $delivery->profile_image) }}" alt="Image" />
                        @else
                            <img class="card-img-sm-right example-card-img-responsive" style="max-height: 20rem;"
                                src="{{ asset('/images/no_image.jpeg') }}" alt="Image" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Profile image</h4>
                        </label>
                        <input type="file" name="profile_image" class="form-control" id="profile_image">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
