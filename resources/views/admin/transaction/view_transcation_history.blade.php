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
                            <table class="table datatable" id="transactionTable">
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
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->status == 'collected')
                                                    <span class="badge bg-warning text-white">{{ __('Collected') }}</span>
                                                @elseif($item->status == 'in-transit')
                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                @elseif($item->status == 'received')
                                                    <span class="badge bg-success text-white">{{ __('Received') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->price) }}ETB</td>
                                            <td>-{{ number_format($item->Ded_amount) }}ETB</td>
                                            <td>+{{ number_format($item->commission) }}ETB</td>
                                            <td>{{ number_format($item->current_balance, 2) }}ETB</td>
                                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div
        </section>
    </main>

    <!-- DataTables JS and Buttons Extension -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with buttons
            var table = $('#transactionTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        function printPage() {
            window.print();
        }
    </script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- Toastr Notifications -->
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

    <!-- Show modal on error -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#addnew{{ $test->item_id }}').modal('show');
            });
        </script>
    @endif
@endsection


