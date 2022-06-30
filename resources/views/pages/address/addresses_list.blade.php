@extends('layouts.app', ['activePage' => 'address', 'titlePage' => __('Addresses List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div>
                                <h4 class="card-title ">Addresses Table</h4>
                                {{-- @dd($customers) --}}
                                <p class="card-category"> Addresses number : {{ count($addresses) }}</p>
                            </div>

                        </div>
                        <div class="col-md-12"><a type="button" href="{{ route('addresses_list.create') }}"
                                class="btn btn-info">Add new address</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @if (count($addresses) == 0)
                                    <h3>You have no addresses</h3>
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
                                                Latitude
                                            </th>
                                            <th>
                                                Longitude
                                            </th>
                                            <th>
                                                Address
                                            </th>
                                            <th>
                                                Phone
                                            </th>
                                            <th>
                                                Verified
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($addresses as $index => $address)
                                                <tr onclick="window.location='/just/a/link.html'">
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $address->title }}</a>
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $address->latitude }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $address->longitude }}
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ $address->address }} EGP
                                                    </td>
                                                    <td>
                                                        {{ $address->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $address->verified }}
                                                    </td>
                                                    <td>
                                                        <a type="button"
                                                            href="{{ route('addresses_list.show', ['addresses_list' => $address['id']]) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a type="button"
                                                            href="{{ route('addresses_list.edit', ['addresses_list' => $address['id']]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form style="display: inline" method="POST"
                                                            action="{{ route('addresses_list.destroy', ['addresses_list' => $address['id']]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $addresses->links('pagination::bootstrap-4') }}
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
