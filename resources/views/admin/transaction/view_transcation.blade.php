
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
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span> {{ __('Product') }}</label>
                                    <select name="" id="" class="form-select">
                                        <option value="" selected disabled>{{ __('Select Product') }}</option>
                                        <option value="">option 1</option>
                                        <option value="">option 1</option>
                                        <option value="">option 1</option>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span>{{ __('Bank') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Bank') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span>
                                        {{ __('Deposit Amount') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Deposit Amount') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span> {{ __('Date') }}</label>
                                    <input type="date" class="form-control" placeholder="{{ __('Date') }}"">
                                </div>
                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span>
                                        {{ __('Reference Number') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Ref.Number') }}">
                                </div>
                                <div class="mb-2">
                                    <label for="product"> <span class="text-danger">*</span>
                                        {{ __('Upload Receipt') }}</label>
                                    <input type="file" class="form-control" placeholder="{{ __('Upload Receipt') }}">
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                <button type="button"
                                    class="btn btn-primary text-center">{{ __('Confirm Payment') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-danger">Sample info used from users Table edit data in controller before
                                use</h4>
                            <table class="table datatable ">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th scope="col">{{ __('Product Name') }}</th>
                                        <th scope="col">{{ __('Amount') }}</th>
                                        <th scope="col">{{ __('Bank') }}</th>
                                        <th scope="col">{{ __('Reference Number') }}</th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->email_verified_at }}</td>
                                            <td>{{ $data->email_verified_at }}</td>
                                            <td>{{ $data->email_verified_at }}</td>
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