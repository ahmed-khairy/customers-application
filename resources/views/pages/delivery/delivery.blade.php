@extends('layouts.app', ['activePage' => 'delivery', 'titlePage' => __('Delivery')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($delivery)
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{ $delivery->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <div class="card flex-row">
                                            <div class="card-body">
                                                <h4 class="card-title h5 h4-sm">Email</h4>
                                                <p class="card-text">{{ $delivery->email }}</p>
                                                <h4 class="card-title h5 h4-sm">Phone</h4>
                                                <p class="card-text">{{ $delivery->phone }}</p>
                                                <h4 class="card-title h5 h4-sm">Available balance</h4>
                                                <p class="card-text">{{ $delivery->available_balance }}</p>
                                                <h4 class="card-title h5 h4-sm">Latitude</h4>
                                                <p class="card-text">{{ $delivery->latitude }}</p>
                                                <h4 class="card-title h5 h4-sm">Longitude</h4>
                                                <p class="card-text">{{ $delivery->longitude }}</p>
                                                <h4 class="card-title h5 h4-sm">Active</h4>
                                                <p class="card-text">{{ $delivery->active }}</p>
                                                <h4 class="card-title h5 h4-sm">Busy</h4>
                                                <p class="card-text">{{ $delivery->busy }}</p>
                                                <h4 class="card-title h5 h4-sm">Map</h4>
                                                <p class="card-text">{{ $delivery->map }}</p>
                                            </div>
                                            <div class="card-body">
                                                @if ($delivery->profile_image)
                                                    <img class="card-img-sm-right example-card-img-responsive"
                                                        style="max-height: 20rem;"
                                                        src="{{ asset('/del_images/' . $delivery->profile_image) }}"
                                                        alt="Image" />
                                                @else
                                                <img class="card-img-sm-right example-card-img-responsive"
                                                        style="max-height: 20rem;"
                                                        src="{{ asset('/images/no_image.jpeg') }}"
                                                        alt="Image" />
                                                @endif
                                            </div>
                                        </div>

                                    </table>
                                </div>
                            </div>
                        @else
                            <h3>
                                No delivery user selected
                            </h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
