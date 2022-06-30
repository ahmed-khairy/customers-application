@extends('layouts.app', ['activePage' => 'delivery', 'titlePage' => __('Deliveires List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div>
                                <h4 class="card-title ">Deliveires Table</h4>
                                {{-- @dd($customers) --}}
                                <p class="card-category"> Deliveires number : {{ count($deliveries) }}</p>
                            </div>

                        </div>
                        <div class="col-md-12"><a type="button" href="{{ route('deliveries_list.create') }}"
                                class="btn btn-info">Add new delivery user</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @if (count($deliveries) == 0)
                                    <h3>You have no deliveries users</h3>
                                @else
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Phone
                                            </th>
                                            <th>
                                                Balance
                                            </th>
                                            <th>
                                                Lat.
                                            </th>
                                            <th>
                                                Lon.
                                            </th>
                                            <th>
                                                Active
                                            </th>
                                            <th>
                                                Busy
                                            </th>
                                            <th>
                                                Map
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($deliveries as $index => $delivery)
                                                <tr onclick="window.location='/just/a/link.html'">
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $delivery->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $delivery->email }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $delivery->phone }}
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ $delivery->available_balance }} EGP
                                                    </td>
                                                    <td>
                                                        {{ $delivery->latitude }}
                                                    </td>
                                                    <td>
                                                        {{ $delivery->longitude }}
                                                    </td>
                                                    <td>
                                                        {{ $delivery->active }}
                                                    </td>
                                                    <td>
                                                        {{ $delivery->busy }}
                                                    </td>
                                                    <td>
                                                        {{ $delivery->map }}
                                                    </td>
                                                    <td>
                                                        <a type="button"
                                                            href="{{ route('deliveries_list.show', ['deliveries_list' => $delivery['id']]) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a type="button"
                                                            href="{{ route('deliveries_list.edit', ['deliveries_list' => $delivery['id']]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form style="display: inline" method="POST"
                                                            action="{{ route('deliveries_list.destroy', ['deliveries_list' => $delivery['id']]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $deliveries->links('pagination::bootstrap-4') }}
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
