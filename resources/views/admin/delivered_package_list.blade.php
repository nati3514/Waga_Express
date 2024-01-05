@extends('admin.body.admin_master')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Delivered Package') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize">
                        <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Delivered Package') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table datatable">

                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Package Tag') }}</th>
                                        <th scope="col">{{ __('Sender Name') }}</th>
                                        <th scope="col">{{ __('Receiver Name') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    @if ($item->status == 'delivered')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->package_tag }}</td>
                                            <td>{{ $item->sender_name }}</td>
                                            <td>{{ $item->receiver_name }}</td>
                                            <td>
                                               @if($item->status == 'delivered')
                                                <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                            @endif
                                        </td>
                                            </td>
                                            
                                            
                                            <td>
                                                <a class="badge bg-dark text-light"
                                                   href="{{ route('print', ['id' => $item->id]) }}" 
                                                   target="_blank">
                                                   <i class="fa-sharp fa-solid fa-print"></i> {{ __('Print') }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @if (Session::has('success'))
            <script>
                toastr.success("{{ Session::get('success') }}");
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                toastr.error("{{ Session::get('error') }}");
            </script>
        @endif
    </main>
    @endsection
