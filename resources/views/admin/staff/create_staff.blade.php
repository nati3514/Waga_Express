@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Add Staff ') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __(' Add Staff') }}</li>
                </ol>
            </nav>
        </div>
        <section class="section ">
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.store') }}" class="text-capitalize">
                                @csrf
                                <h5 class="card-title">{{ 'New  Staff' }}</h5>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="first_name" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ 'First Name' }}</label>
                                        <input name="first_name" value="{{ old('first_name') }}"
                                            class="form-control  @error('first_name') is-invalid @enderror" type="text"
                                            placeholder="">
                                        @error('first_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="last_name" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ 'Last Name' }}</label>
                                        <input name="last_name" value="{{ old('last_name') }}"
                                            class="form-control  @error('last_name') is-invalid @enderror" type="text"
                                            placeholder="">
                                        @error('last_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="branch_list" class="col-form-label">{{ __('Branch') }}</label>

                                    <div class="autocomplete-dropdown">
                                        <select name="branch_list" id="branch_list"
                                            class="border custom-select @error('branch_list') is-invalid @enderror">
                                            {{-- <option selected disabled value="">{{ __('Select Branch') }}
                                            </option> --}}
                                            @foreach (range(1, 5) as $number)
                                                <option value="{{ $number }}">Demo Branch{{ $number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('branch_list')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="staff_email" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ 'Email' }}</label>
                                        <input name="staff_email" value="{{ old('staff_email') }}"
                                            class="form-control  @error('staff_email') is-invalid @enderror" type="text"
                                            placeholder="">
                                        @error('staff_email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="staff_password" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ 'Password' }}</label>
                                        <input name="staff_password" value="{{ old('staff_password') }}"
                                            class="form-control  @error('staff_password') is-invalid @enderror"
                                            type="text" placeholder="">
                                        @error('staff_password')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
