@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Package</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Edit Package</li>
                </ol>
            </nav>
        </div>

        <section class="section ">
            <div class="row">
                <div class="col col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.edit', $package->id) }}"
                                class="text-capitalize">
                                @csrf
                                <h5 class="card-title">{{ __('Sender Information') }}</h5>
                                <div class="row mb-3">

                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="sender_name" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ __('Sender Name') }}</label>
                                        <input name="sender_name" value="{{ $customer->sender_name }}"
                                            class="form-control  @error('sender_name') is-invalid @enderror" type="text"
                                            placeholder="Isac Newton">
                                        @error('sender_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6  mb-3 ">
                                        <label for="sender_phone" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ __('Sender Phone') }}</label>
                                        <div class=" input-group">
                                            <span class="input-group-text" id="basic-addon1">+251</span>
                                            <input name="sender_phone" value="{{ $customer->sender_phone }}"
                                                class="form-control   @error('sender_phone') is-invalid @enderror"
                                                type="number" id="sender_phone" aria-label="sender_phone"
                                                aria-describedby="basic-addon1" placeholder="911******   ">
                                        </div>
                                        @error('sender_phone')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="from_branch" class="col-form-label">{{ __('From-Branch') }}</label>
                                        <select name="from_branch" id="from_branch"
                                            class="form-select input-lg dynamic @error('from_branch') is-invalid @enderror">

                                            <option selected disabled value="">{{ __('Select Branch') }}
                                            </option>
                                            @foreach ($package as $branch)
                                                {{-- <option value="{{ $branch->id }}">{{ $branch->branch_name }}
                                                </option> --}}
                                            @endforeach
                                        </select>
                                        @error('from_branch')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12   mb-3">
                                        <label for="sender_city" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ __('Sender City') }}</label>
                                        <textarea name="sender_city" class="form-control   @error('sender_city') is-invalid @enderror" id="sender_city"
                                            placeholder="Address">{{ $customer->sender_city }}</textarea>
                                        @error('sender_city')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                {{-- /////////////////// --}}

                <div class="col col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Receivers Information') }}</h5>
                            <div class="row mb-3">

                                <div class="col-12 col-md-6  mb-3">
                                    <label for="receiver_name" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Receiver Name') }}</label>
                                    <input name="receiver_name" value="{{ $customer->receiver_name }}"
                                        class="form-control  @error('receiver_name') is-invalid @enderror" type="text"
                                        placeholder="Isac Newton"> @error('receiver_name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="col-12 col-md-6  mb-3">
                                    <label for="price" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('Receiver Phone') }}</label>
                                    <input name="receiver_phone"value="{{ old('receiver_phone') }}"
                                        class="form-control   @error('receiver_phone') is-invalid @enderror" type="number"
                                        id="receiver_phone" placeholder="911******">
                                    @error('receiver_phone')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div> --}}

                                <div class="col-12 col-md-6  mb-3 ">
                                    <label for="receiver_phone" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Reciver Phone') }}</label>
                                    <div class=" input-group">
                                        <span class="input-group-text" id="basic-addon1">+251</span>
                                        <input name="receiver_phone" value="{{ $customer->receiver_phone }}"
                                            class="form-control   @error('receiver_phone') is-invalid @enderror"
                                            type="number" id="receiver_phone" aria-label="phone"
                                            aria-describedby="basic-addon1" placeholder="911******   ">
                                    </div>
                                    @error('receiver_phone')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6  mb-3">
                                    <label for="to_branch" class="col-form-label">{{ __('To-Branch') }}</label>
                                    <select name="to_branch" id="to_branch"
                                        class="form-select input-lg dynamic @error('to_branch') is-invalid @enderror">

                                        <option selected disabled value="">{{ __('Select Branch') }}
                                        </option>
                                        @foreach ($package as $branch)
                                            {{-- <option value="{{ $branch->id }}">{{ $branch->branch_name }}
                                            </option> --}}
                                        @endforeach
                                    </select>
                                    @error('to_branch')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12   mb-3">
                                    <label for="receiver_city" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Receiver City') }}</label>
                                    <textarea name="receiver_city" class="form-control   @error('receiver_city') is-invalid @enderror" id="receiver_city"
                                        placeholder="Address">{{ $customer->receiver_city }}</textarea>
                                    @error('receiver_city')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Shipment Detail --}}
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('Package Detail') }}</h5>
                            <div class="row mb-3">

                                <div class="col-md-2  mb-3">
                                    <label for="price" class=" col-form-label">
                                        {{ __('p Tag') }}</label>
                                    <input name="package_tag" disabled value="{{ $package->package_tag }}"
                                        type="text" class="form-control   @error('package_tag') is-invalid @enderror"
                                        type="number" id="price" placeholder="">
                                    @error('package_tag')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class=" col-md-2  mb-3">
                                    <label for="package_type" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('Package Type') }}</label>
                                    <input name="package_type" value="{{ $package->package_type }}"
                                        class="form-control   @error('package_type') is-invalid @enderror" type="text"
                                        id="price" placeholder="">
                                    @error('package_type')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class=" col-md-2  mb-3">
                                    <label for="price" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('Weight') }}</label>
                                    <input name="weight" value="{{ $package->weight }}"
                                        class="form-control   @error('weight') is-invalid @enderror" type="number"
                                        id="price" placeholder="">
                                    @error('weight')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2  mb-3">
                                    <label for="status" class="col-form-label"><span
                                            class="text-danger">*</span>{{ __('Status') }}</label>
                                    <select name="status" id="status"
                                        class="form-select  @error('status') is-invalid @enderror">
                                        <option value="" disabled selected>{{ __('--Select--') }}</option>
                                        <option value="collected" {{ old('status') == 'collected' ? 'selected' : '' }}>
                                            {{ __('Collected') }}
                                        </option>
                                        <option value="in-transit" {{ old('status') == 'in-transit' ? 'selected' : '' }}>
                                            {{ __('In-Transit') }}
                                        </option>
                                        <option value="deliverd" {{ old('status') == 'deliverd' ? 'selected' : '' }}>
                                            {{ __('Deliverd') }}
                                        </option>

                                    </select> @error('status')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class=" col-md-2  mb-3">
                                    <label for="price" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('price') }}</label>
                                    <input name="price" class="form-control @error('price') is-invalid @enderror "
                                        type="number" id="price" placeholder="Price">
                                    {{-- @error('price')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror --}}
                                </div>

                                {{-- <div class=" col-md-3  mb-3">
                                    <label for="price" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('Delivery Charge') }}</label>
                                    <input name="price" value="{{ old('price') }}"
                                        class="form-control   @error('price') is-invalid @enderror" type="number"
                                        id="price" placeholder="">
                                    @error('price')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div> --}}

                                {{-- <div class="col-12 mb-3">
                                    <label for="description" class=" col-form-label"><span
                                            class="text-danger">*</span>{{ __('Product Description') }}</label>
                                    <textarea name="sender_address" class="form-control   @error('description') is-invalid @enderror" id=""
                                        placeholder="Address"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        {{-- <button class="btn btn-primary" type="submit">Save</button> --}}
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>

            </div>

        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (Session::has('success'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "closeButton": true,
                "positionClass": "toast-top-right",
                "background-color": "#3498db",
                "color": "#ffffff",
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
@endsection
