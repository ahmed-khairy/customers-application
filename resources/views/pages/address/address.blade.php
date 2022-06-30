@extends('layouts.app', ['activePage' => 'address', 'titlePage' => __('Address')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($address)
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{ $address->title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <div class="card flex-row">
                                            <div class="card-body">
                                                <h4 class="card-title h5 h4-sm">Customer</h4>
                                                <p class="card-text">{{ $address->customer->name }}</p>
                                                <h4 class="card-title h5 h4-sm">Title</h4>
                                                <p class="card-text">{{ $address->title }}</p>
                                                <h4 class="card-title h5 h4-sm">Latitude</h4>
                                                <p class="card-text">{{ $address->latitude }}</p>
                                                <h4 class="card-title h5 h4-sm">Longitude</h4>
                                                <p class="card-text">{{ $address->longitude }}</p>
                                                <h4 class="card-title h5 h4-sm">address</h4>
                                                <p class="card-text">{{ $address->address }}</p>
                                                <h4 class="card-title h5 h4-sm">phone</h4>
                                                <p class="card-text">{{ $address->phone }}</p>
                                                <h4 class="card-title h5 h4-sm">Verified</h4>
                                                <p class="card-text">{{ $address->verified }}</p>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        @else
                            <h3>
                                No address selected
                            </h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
