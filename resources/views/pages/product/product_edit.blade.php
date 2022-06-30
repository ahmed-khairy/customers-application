@extends('layouts.app', ['activePage' => 'product', 'titlePage' => __('Product')])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Edit product {{ $product->title }}</h4>
            </div>
            <div class="m-5 align-middle">
                <form method="post" action="{{ url('products_list/' . $product->id) }}"
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
                            value="{{ $product->customer_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Title</h4>
                        </label>
                        <input type="text" name="title" class="form-control" id="title"
                            value="{{ $product->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Description</h4>
                        </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"> {{ $product->description }}
                                </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Cost</h4>
                        </label>
                        <input type="number" name="cost" class="form-control" id="cost"
                            value="{{ $product->cost }}">
                    </div>
                    <div class="mb-3">
                        <label for="wholeSaleCost" class="form-label">
                            <h4 class="card-title h5 h4-sm"> wholeSaleCost</h4>
                        </label>
                        <input type="number" name="wholeSaleCost" class="form-control" id="wholeSaleCost"
                            value="{{ $product->wholeSaleCost }}">
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Height</h4>
                        </label>
                        <input type="number" name="height" class="form-control" id="height"
                            value="{{ $product->height }}">
                    </div>
                    <div class="mb-3">
                        <label for="width" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Width</h4>
                        </label>
                        <input type="number" name="width" class="form-control" id="width"
                            value="{{ $product->width }}">
                    </div>
                    <div class="mb-3">
                        <label for="length" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Length</h4>
                        </label>
                        <input type="number" name="length" class="form-control" id="length"
                            value="{{ $product->length }}">
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">
                            <h4 class="card-title h5 h4-sm"> Weight</h4>
                        </label>
                        <input type="number" name="weight" class="form-control" id="weight"
                            value="{{ $product->weight }}">
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            @if ($product->images)
                                @foreach (json_decode($product->images) as $item)
                                    <img class="card-img-sm-right example-card-img-responsive"
                                        style="max-height: 20rem;" src="{{ asset('/prod_images/' . $item) }}"
                                        alt="Image" />
                                @endforeach
                            @else
                                <img class="card-img-sm-right example-card-img-responsive"
                                    style="max-height: 20rem;" src="{{ asset('/images/no_image.jpeg') }}"
                                    alt="Image" />
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">
                                <h4 class="card-title h5 h4-sm"> Profile image</h4>
                            </label>
                            <input type="file" id="file-input" name="images[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".btn-success").click(function() {
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });

        });
    </script>
@endsection
