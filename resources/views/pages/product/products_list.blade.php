@extends('layouts.app', ['activePage' => 'product', 'titlePage' => __('Products List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div>
                                <h4 class="card-title ">Products Table</h4>
                                {{-- @dd($customers) --}}
                                <p class="card-category"> Products number : {{ count($products) }}</p>
                            </div>

                        </div>
                        <div class="col-md-12"><a type="button" href="{{ route('products_list.create') }}"
                                class="btn btn-info">Add new product</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @if (count($products) == 0)
                                    <h3>You have no products</h3>
                                @else
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Description
                                            </th>
                                            <th>
                                                Cost
                                            </th>
                                            <th>
                                                Whole Sale Cost
                                            </th>
                                            <th>
                                                Height
                                            </th>
                                            <th>
                                                Width
                                            </th>
                                            <th>
                                                Length
                                            </th>
                                            <th>
                                                Weight
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $index => $product)
                                                <tr onclick="window.location='/just/a/link.html'">
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $product->title }}</a>
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $product->description }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $product->cost }}
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ $product->wholeSaleCost }} EGP
                                                    </td>
                                                    <td>
                                                        {{ $product->height }}
                                                    </td>
                                                    <td>
                                                        {{ $product->width }}
                                                    </td>
                                                    <td>
                                                        {{ $product->length }}
                                                    </td>
                                                    <td>
                                                        {{ $product->weight }}
                                                    </td>
                                                    <td>
                                                        <a type="button"
                                                            href="{{ route('products_list.show', ['products_list' => $product['id']]) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a type="button"
                                                            href="{{ route('products_list.edit', ['products_list' => $product['id']]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form style="display: inline" method="POST"
                                                            action="{{ route('products_list.destroy', ['products_list' => $product['id']]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $products->links('pagination::bootstrap-4') }}
                                        </tbody>
                                @endif

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
