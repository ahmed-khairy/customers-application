@extends('layouts.app', ['activePage' => 'product', 'titlePage' => __('Product')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($product)
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{ $product->title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <div class="card flex-row">
                                            <div class="card-body">
                                                <h4 class="card-title h5 h4-sm">Customer</h4>
                                                <p class="card-text">{{ $product->customer->name }}</p>
                                                <h4 class="card-title h5 h4-sm">Title</h4>
                                                <p class="card-text">{{ $product->title }}</p>
                                                <h4 class="card-title h5 h4-sm">Description</h4>
                                                <p class="card-text">{{ $product->description }}</p>
                                                <h4 class="card-title h5 h4-sm">Cost</h4>
                                                <p class="card-text">{{ $product->cost }}</p>
                                                <h4 class="card-title h5 h4-sm">Whole Sale Cost</h4>
                                                <p class="card-text">{{ $product->wholeSaleCost }}</p>
                                                <h4 class="card-title h5 h4-sm">Height</h4>
                                                <p class="card-text">{{ $product->height }}</p>
                                                <h4 class="card-title h5 h4-sm">Width</h4>
                                                <p class="card-text">{{ $product->width }}</p>
                                                <h4 class="card-title h5 h4-sm">length</h4>
                                                <p class="card-text">{{ $product->length }}</p>
                                                <h4 class="card-title h5 h4-sm">weight</h4>
                                                <p class="card-text">{{ $product->weight }}</p>
                                            </div>
                                            
                                        </div>
                                        
                                    </table>
                                    <div class="card-body">
                                        @if ($product->images)
                                            @foreach (json_decode($product->images) as $item)
                                                <img class="card-img-sm-right example-card-img-responsive"
                                                    style="max-height: 20rem;"
                                                    src="{{ asset('/prod_images/' . $item) }}"
                                                    alt="Image" />
                                            @endforeach
                                        @else
                                            <img class="card-img-sm-right example-card-img-responsive"
                                                style="max-height: 20rem;"
                                                src="{{ asset('/images/no_image.jpeg') }}"
                                                alt="Image" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <h3>
                                No product selected
                            </h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
