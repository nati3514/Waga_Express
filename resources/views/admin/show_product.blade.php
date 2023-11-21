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
        <section class="section ">
            <h1>
                show deatil of Single Product
            </h1>

        </section>
    </main>
