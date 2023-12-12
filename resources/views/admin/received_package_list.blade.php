@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('New Page') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __(' New Page') }}</li>

                </ol>
            </nav>
        </div>
        <section class="section ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable ">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Package tag') }}</th>
                                        <th scope="col">{{ __('Sender Name') }}</th>
                                        <th scope="col">{{ __('Receiver Name') }}</th>
                                        <th scope="col">{{ __('Sender Branch') }}</th>
                                        <th scope="col">{{ __('Receiver Branch') }}</th>
                                        {{-- <th scope="col">{{ __('Sender Phone') }}</th>
                                        <th scope="col">{{ __('Receiver Phone') }}</th> --}}
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->package_tag }}</td>
                                        <td>{{ $data->sender_name }}</td>
                                        <td>{{ $data->receiver_name }}</td>
                                        <td>{{ $data->sender_branch }}</td>
                                        <td>{{ $data->receiver_branch }}</td>
                                        <td>
                                            @if ($data->status == 'collected')
                                                <span class="badge bg-warning text-white">{{ __('Collected') }}</span>
                                            @elseif($data->status == 'in-transit')
                                                <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                            @elseif($data->status == 'delivered')
                                                <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="dropdown ">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                </button>
                                                <ul class="dropdown-menu text-center ">
                                                    <li>
                                                        @if ($data->status == 'collected')
                                                            <a href="{{ route('receive.package', $data->id) }}"
                                                                class="btn btn-success btn-sm tooltip-test"
                                                                title="Allow user to the system">{{ __('Receive') }}</a>
                                                
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                        {{-- <td>
                                            <a class="text-primary" href="" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $data->id }}">
                                                    <i class="fa-sharp fa-solid fa-pencil"></i>
                                                </a>
                                            <a class="text-primary" href="" data-bs-toggle="modal"
                                                data-bs-target="#edit">
                                                <i class="fa-sharp fa-solid fa-pencil"></i>
                                            </a>
                                            <a class="text-primary" href="" data-bs-toggle="modal"
                                                data-bs-target="#edit">
                                                <i class="fa-sharp fa-solid fa-pencil"></i>
                                            </a>
                                            <a class="text-primary" href="" data-bs-toggle="modal"
                                                data-bs-target="#edit">
                                                <i class="fa-sharp fa-solid fa-pencil"></i>
                                            </a>

                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "closeButton": true,
                "positionClass": "toast-top-right",
                "background-color": "#3498db",
                "color": "#ffffff",
            }
            toastr.success(" Success! <br> {{ Session::get('success') }}  ");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error(" Error! <br> {{ Session::get('error') }}  ");
        </script>
    @endif
@endsection