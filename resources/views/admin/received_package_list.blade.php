@extends('admin.body.admin_master')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Receive Package') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize">
                        <a href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Receive Package') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('receive.package') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="package_tag" class="form-label">{{ __('Package Tag') }}</label>
                                    <input
                                        type="text"
                                        name="package_tag"
                                        class="form-control"
                                        id="package_tag"
                                        autofocus
                                    >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                                    @if ($item->status == 'received')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->package_tag }}</td>
                                            <td>{{ $item->sender_name }}</td>
                                            <td>{{ $item->receiver_name }}</td>
                                            <td>
                                                @if($item->status == 'received')
                                                    <span class="badge bg-success text-white">{{ __('Received') }}</span>
                                                @elseif($data->status == 'delivered')
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
                                            <td>
                                                <div class="dropdown ">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-id="{{ $item->id }}">
                                                    </button>
                                                    
                                                    <ul class="dropdown-menu text-center">
                                                        <li>
                                                            @if ($item->status == 'received')
                                                                <a href="#" class="btn btn-success btn-sm tooltip-test update-status" data-status="delivered" title="Mark as Delivered">
                                                                    {{ __('Delivered') }}
                                                                </a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
    
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
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let updateStatusButtons = document.querySelectorAll('.update-status');
        
                updateStatusButtons.forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
        
                        let packageId = button.closest('.dropdown').querySelector('.dropdown-toggle').getAttribute('data-id');
                        let newStatus = button.getAttribute('data-status');
        
                        updatePackageStatus(packageId, newStatus);
                    });
                });
        
                function updatePackageStatus(packageId, newStatus) {
                    $.ajax({
                        url: '{{ route('update-package-status') }}', // Assuming the route name is 'update-package-status'
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: packageId,
                            status: newStatus
                        },
                        success: function (data) {
                            console.log('Package status updated successfully');
                            // Handle success (you may want to refresh the page or update the UI)
                        },
                        error: function (error) {
                            console.error('Error updating package status');
                            // Handle error
                        }
                    });
                }
            });
        </script>
        
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
