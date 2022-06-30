@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Customers List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div>
                                <h4 class="card-title ">Customers Table</h4>
                                {{-- @dd($customers) --}}
                                <p class="card-category"> Customers number : {{ count($customers) }}</p>
                            </div>

                        </div>
                        <div class="col-md-12"><a type="button" href="{{ route('customers_list.create') }}"
                                class="btn btn-info">Add new customer</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @if (count($customers) == 0)
                                    <h3>You have no Customers</h3>
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
                                                Available balance
                                            </th>
                                            <th>
                                                Country
                                            </th>
                                            <th>
                                                Code
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $index => $customer)
                                                <tr onclick="window.location='/just/a/link.html'">
                                                    <td>
                                                        {{ $index + 1 }} 
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $customer->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $customer->email }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $customer->phone }}
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ $customer->available_balance }} EGP
                                                    </td>
                                                    <td>
                                                        {{ $customer->country_code }}
                                                    </td>
                                                    <td>
                                                        {{ $customer->marketer_code }}
                                                    </td>
                                                    <td>
                                                        <a type="button"
                                                            href="{{ route('customers_list.show', ['customers_list' => $customer['id']]) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a type="button"
                                                            href="{{ route('customers_list.edit', ['customers_list' => $customer['id']]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form style="display: inline" method="POST"
                                                            action="{{ route('customers_list.destroy', ['customers_list' => $customer['id']]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $customers->links('pagination::bootstrap-4') }}
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
