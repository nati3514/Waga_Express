@extends('admin.body.admin_master')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Product Detail ') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __(' Products Detail') }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <!-- Sender Information -->
                    <div class="col-md-3 sender-info">
                        <h4>Sender Information</h4>
                        <p><strong>Name:</strong> {{ $data->sender_name }}</p>
                        <p><strong>Phone:</strong> +251{{ $data->sender_phone }}</p>
                        <p><strong>Sender city:</strong> {{ $data->sender_city }}</p>
                    </div>

                    <!-- Receiver Information -->
                    <div class="col-md-3 receiver-info text-right">
                        <h4>Receiver Information</h4>
                        <p><strong>Name:</strong> {{ $data->receiver_name }}</p>
                        <p><strong>Phone:</strong> +251{{ $data->receiver_phone }}</p>
                        <p><strong>Receiver city:</strong> {{ $data->receiver_city }}</p>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="row mt-4 package-details">
                    <div class="col-md-12">
                        <h4>Package Details</h4>
                        <p><strong>Package Type:</strong> {{ $data->package_type }}</p>
                        <p><strong>Weight:</strong> {{ $weight->weight }} Kg</p>
                        <p><strong>Price:</strong> {{ $price->price }} ETB</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
