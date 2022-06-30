@extends('layouts.app', ['activePage' => 'marketer', 'titlePage' => __('Marketer')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($marketer)
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{ $marketer->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <div class="card flex-row">
                                            <div class="card-body">
                                                <h4 class="card-title h5 h4-sm">Email</h4>
                                                <p class="card-text">{{ $marketer->email }}</p>
                                                <h4 class="card-title h5 h4-sm">Phone</h4>
                                                <p class="card-text">{{ $marketer->phone }}</p>
                                                <h4 class="card-title h5 h4-sm">Available balance</h4>
                                                <p class="card-text">{{ $marketer->available_balance }}</p>
                                                <h4 class="card-title h5 h4-sm">Code</h4>
                                                <p class="card-text">{{ $marketer->code }}</p>
                                            </div>
                                            <div class="card-body">
                                                @if ($marketer->profile_image)
                                                    <img class="card-img-sm-right example-card-img-responsive"
                                                        style="max-height: 20rem;"
                                                        src="{{ asset('/mark_images/' . $marketer->profile_image) }}"
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
                                No marketer user selected
                            </h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
