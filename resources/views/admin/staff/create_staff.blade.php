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
                            <form method="POST" action="{{ route('staff.store') }}" class="text-capitalize">
                                @csrf
                                <h5 class="card-title">{{ 'New  Staff' }}</h5>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="first_name" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('First Name') }}</label>
                                        <input name="first_name" value="{{ old('first_name') }}"
                                            class="form-control  @error('first_name') is-invalid @enderror" type="text"
                                            placeholder="">
                                        @error('first_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="last_name" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Last Name') }}</label>
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
                                <div class="col-12 col-md-3  mb-3">
                                    <label for="from_branch" class="col-form-label">{{ 'From-Branch' }}</label>
                                    <input type="hidden" name="from_branch" id="fromBranch"
                                        value="{{ $branch->id }}">
                                    <input type="text" value="{{ $branch->branch_name }}" readonly
                                        class="form-control   @error('from_branch') is-invalid @enderror" type="phone"
                                        id="from_branch">
                                    @error('from_branch')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="email" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Email') }}</label>
                                        <input name="email" value="{{ old('staff_email') }}"
                                            class="form-control  @error('email') is-invalid @enderror" type="text"
                                            placeholder="">
                                        @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="password" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Password') }}</label>
                                        <input name="password" value="{{ old('staff_password') }}"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            type="text" placeholder="">
                                        @error('password')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
