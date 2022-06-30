@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Customer')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit customer {{ $customer->name }}</h4>
            </div>
            <div class="m-5 align-middle">
                <form method="post" action="{{ url('customers_list/' . $customer->id) }}"
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
                            value="{{ $customer->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Email</h4>
                        </label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ $customer->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Phone</h4>
                        </label>
                        <input type="number" name="phone" class="form-control" id="phone"
                            value="{{ $customer->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="available_balance" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Available balance</h4>
                        </label>
                        <input type="number" name="available_balance" class="form-control" id="available_balance"
                            value="{{ $customer->available_balance }}">
                    </div>
                    <div class="mb-3">
                        <label for="country_code" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Country code</h4>
                        </label>
                        <input type="number" name="country_code" class="form-control" id="country_code"
                            value="{{ $customer->country_code }}">
                    </div>
                    <div class="mb-3">
                        <label for="marketer_code" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Marketer code</h4>
                        </label>
                        <input type="number" name="marketer_code" class="form-control" id="marketer_code"
                            value="{{ $customer->marketer_code }}">
                    </div>
                    <div class="card-body">
                        @if ($customer->profile_image)
                            <img class="card-img-sm-right example-card-img-responsive" style="max-height: 20rem;"
                                src="{{ asset('/cust_images/' . $customer->profile_image) }}" alt="Image" />
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
