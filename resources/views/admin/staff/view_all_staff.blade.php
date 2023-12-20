@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Staf List') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Staf List') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            @can('Staff add')
                
            <div class="d-flex justify-content-end">
                <a href="{{ route('staff.create') }}" class="btn btn-primary my-3">{{ __('Add Staff') }}</a>
            </div>
            
            @endcan
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <table class="table datatable ">

                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('First Name ') }}</th>
                                        <th scope="col">{{ __('Last Name') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Role') }}</th>
                                        <th scope="col">{{ __('amount_limit') }}</th>
                                        
                                        {{-- <th scope="col">{{ __('Status') }}</th> --}}
                                        <th scope="col">{{ __('Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->first_name }}</td>
                                            <td>{{ $data->last_name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td class=" border-b border-grey-light">
                                                @foreach ($data->roles as $role)
                                                    <span class="badge bg-secondary text-center">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $data->amount_limit }}</td>

                                            {{-- Status badge --}}
                                            {{-- <td>
                                                @if ($data->status == 'collected')
                                                    <span class="badge bg-success text-white">{{ __('Collected') }}</span>
                                                @elseif($data->status == 'in-transit')
                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                @elseif($data->status == 'deliverd')
                                                    <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                                @endif
                                            </td> --}}

                                            {{-- Action --}}
                                            <td>
                                                @can('Staff edit')
                                                    
                                                <a class="text-primary" href="" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $data->id }}">
                                                    <i class="fa-sharp fa-solid fa-pencil"></i>
                                                </a>
                                                @endcan
                                                @can('Staff delete')
                                                    
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $data->id }}"><i
                                                        class="fa-sharp fa-solid fa-trash text-danger"></i></a>
                                                        @endcan
                                                {{-- 
                                                    <a href="{{ route('products.show', $data->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye text-success"></i></a> --}}
                                            </td>
                                        </tr>

                                        {{-- Edit modal start --}}
<div class="modal fade" id="edit{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    {{ __('Edit Staff') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('staff.update', $data->id) }}"
                                    class="text-capitalize">
                                    @csrf
                                    @method('PATCH')
                                    <h5 class="card-title">{{ __('Staff Information') }}</h5>

                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="first_name" class="col-form-label"><span
                                                    class="text-danger">*</span>{{ __('First Name') }}</label>
                                            <input name="first_name" value="{{ $data->first_name }}"
                                                class="form-control @error('first_name') is-invalid @enderror" type="text"
                                                placeholder="">
                                            @error('first_name')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="last_name" class="col-form-label"><span
                                                    class="text-danger">*</span>{{ __('Last Name') }}</label>
                                            <input name="last_name" value="{{ $data->last_name }}"
                                                class="form-control @error('last_name') is-invalid @enderror" type="text"
                                                placeholder="">
                                            @error('last_name')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="email" class="col-form-label"><span
                                                    class="text-danger">*</span>{{ __('Email') }}</label>
                                            <input name="email" value="{{ $data->email }}"
                                                class="form-control @error('email') is-invalid @enderror" type="text"
                                                placeholder="">
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="amount_limit" class="col-form-label">{{ __('Amount Limit (ETB)') }}</label>
                                            <input name="amount_limit" value="{{ $data->amount_limit }}"
                                                class="form-control @error('amount_limit') is-invalid @enderror" type="number"
                                                placeholder="Enter amount limit">
                                            @error('amount_limit')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="password" class="col-form-label"><span
                                                    class="text-danger">*</span>{{ __('Password') }}</label>
                                            <input name="password"
                                                class="form-control @error('password') is-invalid @enderror" type="text"
                                                placeholder="">
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


                                        {{-- Delete modal start --}}
                                        <div class="modal fade" id="delete{{ $data->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                            {{ __('Modal title') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to Delete?') }}

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('Close') }}</button>

                                                        <form action="{{ route('staff.delete', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"
                                                                type="submit">{{ __('Delete') }}</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Delete modal End --}}
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
                $('#addnew{{ $data->item_id }}').modal('show');
            });
        </script>
    @endif
@endsection