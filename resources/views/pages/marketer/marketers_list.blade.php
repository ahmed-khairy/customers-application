@extends('layouts.app', ['activePage' => 'marketer', 'titlePage' => __('Marketers List')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div>
                                <h4 class="card-title ">Marketers Table</h4>
                                {{-- @dd($customers) --}}
                                <p class="card-category"> Marketers number : {{ count($marketers) }}</p>
                            </div>

                        </div>
                        <div class="col-md-12"><a type="button" href="{{ route('marketers_list.create') }}"
                                class="btn btn-info">Add new marketer user</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- @php
                                    $i = 0;
                                @endphp --}}
                                @if (count($marketers) == 0)
                                    <h3>You have no marketers users</h3>
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
                                                Code
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($marketers as $index => $marketer)
                                                <tr onclick="window.location='/just/a/link.html'">
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $marketer->name }}</a>
                                                    </td>
                                                    <td>
                                                        <a href=""> {{ $marketer->email }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $marketer->phone }}
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ $marketer->available_balance }} EGP
                                                    </td>
                                                    <td>
                                                        {{ $marketer->code }}
                                                    </td>
                                                    <td>
                                                        <a type="button"
                                                            href="{{ route('marketers_list.show', ['marketers_list' => $marketer['id']]) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a type="button"
                                                            href="{{ route('marketers_list.edit', ['marketers_list' => $marketer['id']]) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <form style="display: inline" method="POST"
                                                            action="{{ route('marketers_list.destroy', ['marketers_list' => $marketer['id']]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $marketers->links('pagination::bootstrap-4') }}
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
