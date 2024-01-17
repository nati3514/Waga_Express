
@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Transaction') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Deposit') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#payment">
                    {{ __('Deposit') }}
                </button>

                <!-- Modal -->
                <div class="modal fade" id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="text-center fs-7 mx-auto" id="staticBackdropLabel">{{ __('Payment') }}</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('deposit_balance')}}" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                              
                                <div class="mb-2">
                                    <label for="bank_name"> <span class="text-danger">*</span>{{ __('Bank') }}</label>
                                    <input name="bank_name" type="text" class="form-control" placeholder="{{ __('Bank') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="deposit_amount"> <span class="text-danger">*</span>
                                        {{ __('Deposit Amount') }}</label>
                                    <input name="deposit_amount" type="number" class="form-control" placeholder="{{ __('Deposit Amount') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="date"> <span class="text-danger">*</span> {{ __('Date') }}</label>
                                    <input name="date" type="date" class="form-control" placeholder="{{ __('Date') }}"">
                                </div>
                                <div class="mb-2">
                                    <label for="reference_number"> <span class="text-danger">*</span>
                                        {{ __('Reference Number') }}</label>
                                    <input name="reference_number" type="text" class="form-control" placeholder="{{ __('Ref.Number') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="receipt"> <span class="text-danger">*</span>
                                        {{ __('Upload Receipt') }}</label>
                                    <input name="receipt" type="file" class="form-control" placeholder="{{ __('Upload Receipt') }}">
                                </div>
                            </div>
                            <div class="text-center mt-2 mb-2">
                                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit"
                                    class="btn btn-primary text-center">{{ __('Confirm Payment') }}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable ">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Branch') }}</th>
                                        <th scope="col">{{ __('Bank') }}</th>
                                        <th scope="col">{{ __('Amount') }}</th>
                                        <th scope="col">{{ __('Reference Number') }}</th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        {{-- <th scope="col">{{ __('Image') }}</th> --}}
                                        {{-- <th scope="col">{{ __('Action') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->branch_name }}</td>
                                            <td>{{ $data->bank_name }}</td>
                                            <td>{{ $data->deposit_amount }}</td>
                                            <td>{{ $data->reference_num }}</td>
                                            <td>{{ $data->date }}</td>
                                            {{-- <td><img src="{{ asset('images/' . $data->image ) }}" alt="image" width="50px" height="50px"></td> --}}
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

    {{-- @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#addnew{{ $test->item_id }}').modal('show');
            });
        </script>
    @endif --}}
@endsection