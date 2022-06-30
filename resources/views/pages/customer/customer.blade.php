@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Customer')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($customer)
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{ $customer->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <div class="card flex-row">
                                            <div class="card-body"> 
                                                <h4 class="card-title h5 h4-sm">Marketer</h4>
                                                <p class="card-text">{{ $customer->marketer->name }}</p>
                                                <h4 class="card-title h5 h4-sm">Email</h4>
                                                <p class="card-text">{{ $customer->email }}</p>
                                                <h4 class="card-title h5 h4-sm">Phone</h4>
                                                <p class="card-text">{{ $customer->phone }}</p>
                                                <h4 class="card-title h5 h4-sm">Available balance</h4>
                                                <p class="card-text">{{ $customer->available_balance }}</p>
                                                <h4 class="card-title h5 h4-sm">Country</h4>
                                                <p class="card-text">{{ $customer->country_code }}</p>
                                                <h4 class="card-title h5 h4-sm">Marketer Code</h4>
                                                <p class="card-text">{{ $customer->marketer_code }}</p>
                                            </div>
                                            <div class="card-body">
                                                @if ($customer->profile_image)
                                                    <img class="card-img-sm-right example-card-img-responsive"
                                                        style="max-height: 20rem;"
                                                        src="{{ asset('/cust_images/' . $customer->profile_image) }}"
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
                                No customer selected
                            </h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
