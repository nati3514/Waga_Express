@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Reports') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Reports') }}</li>

                </ol>
            </nav>
        </div>
        <section class="section ">
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="" class="text-capitalize">
                                @csrf

                                <div class="row d-flex justify-content-evenly mb-3">
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="first_name" class="col-form-label">{{ __('Status:') }}</label>
                                        <select name="" id="" class="form-select ">
                                            @foreach (range(1, 5) as $number)
                                                <option value="{{ $number }}">status:{{ $number }}</option>
                                            @endforeach
                                        </select>

                                        @error('first_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="from" class=" col-form-label">{{ __('From:') }}</label>
                                        <input name="from" value="{{ old('from') }}"
                                            class="form-control  @error('from') is-invalid @enderror" type="date"
                                            placeholder="">
                                        @error('from')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="to" class=" col-form-label">{{ __('To:') }}</label>
                                        <input name="to" value="{{ old('to') }}"
                                            class="form-control  @error('to') is-invalid @enderror" type="date"
                                            placeholder="">
                                        @error('to')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="col-12 col-md-1 mt-4">
                                        <button class="btn btn-sm btn-primary">View Report</button>
                                    </div>
                                </div>
                            </form>
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
                                            <th scope="col">{{ __('Date ') }}</th>
                                            <th scope="col">{{ __('Sender ') }}</th>
                                            <th scope="col">{{ __('Recepient ') }}</th>
                                            <th scope="col">{{ __('Amount') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>{{ 1 }}</td>
                                            <td>{{ today() }}</td>
                                            <td>{{ __('Jane Doe') }}</td>
                                            <td>{{ __('Jhon Doe') }}</td>
                                            <td>{{ __('100ETB') }}</td>
                                            <td>{{ __('Received') }}</td>

                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
