
@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Transaction') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Transaction History') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable ">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Package Price') }}</th>
                                        <th scope="col">{{ __('Ded_amount') }}</th>
                                        <th scope="col">{{ __('Commission') }}</th>
                                        <th scope="col">{{ __('Closing Balance') }}</th>
                                        <th scope="col">{{ __('Transaction Done By') }}</th>        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>
                                                @if ($data->status == 'collected')
                                                <span class="badge bg-warning text-white">{{ __('Collected') }}</span>
                                                @elseif($data->status == 'in-transit')
                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                @elseif($data->status == 'delivered')
                                                    <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->price }}ETB</td>
                                            <td>-{{ $data->Ded_amount }}ETB</td>
                                            <td>+{{ $data->commission }}ETB</td>
                                            <td>{{ $data->current_balance }}ETB</td>
                                            <td>{{ $data->user->first_name }} {{ $data->user->last_name }}</td>
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

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#addnew{{ $test->item_id }}').modal('show');
            });
        </script>
    @endif
@endsection