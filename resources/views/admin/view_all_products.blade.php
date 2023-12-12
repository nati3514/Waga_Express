@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('Package List') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item text-capitalize">{{ __('Package List') }}</li>

                </ol>
            </nav>
        </div>

        <section class="section">

            <div class="d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary my-3">{{__('Add Package') }}</a>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table datatable ">

                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('#') }}</th>
                                        <th scope="col">{{ __('Package Tag') }}</th>
                                        <th scope="col">{{ __('Sender Name') }}</th>
                                        <th scope="col">{{ __('Receiver Name') }}</th>
                                        {{-- <th scope="col">{{ __('Sender Phone') }}</th>
                                        <th scope="col">{{ __('Receiver Phone') }}</th> --}}
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->package_tag }}</td>
                                            <td>{{ $data->sender_name }}</td>
                                            <td>{{ $data->receiver_name }}</td>
                                            <td>
                                                @if ($data->status == 'collected')
                                                <span class="badge bg-warning text-white">{{ __('Collected') }}</span>
                                                @elseif($data->status == 'in-transit')
                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                @elseif($data->status == 'delivered')
                                                    <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                                @endif
                                            </td>
                                            
                                            {{-- <td>{{ $data->sender_phone }}</td>
                                            <td>{{ $data->receiver_phone }}</td> --}}
                                            {{-- <td>
                                                @if ($data->status == 'collected')
                                                    <span class="badge bg-success text-white">{{ __('Collected') }}</span>
                                                @elseif($data->status == 'in-transit')
                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                @elseif($data->status == 'deliverd')
                                                    <span class="badge bg-success text-white">{{ __('Delivered') }}</span>
                                                @endif
                                            </td> --}}

                                            <td>

                                                <a class="text-primary" href="" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $data->id }}">
                                                    <i class="fa-sharp fa-solid fa-pencil"></i>
                                                </a>
{{-- 
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $data->id }}"><i
                                                        class="fa-sharp fa-solid fa-trash text-danger"></i></a> --}}

                                                <a href="{{ route('products.show', $data->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye text-success"></i></a>
                                                
                                                    <a class="badge bg-dark text-light"
                                                         href="{{ route('print', ['id' => $data->id]) }}" 
                                                                 target="_blank">
                                                       <i class="fa-sharp fa-solid fa-print"></i> {{ __('Print') }}
                                                    </a>

                                                </a>

                                                    
                                                    
                                            </td>
                                        </tr>

                                             {{-- Edit modal start --}}
                                             <div class="modal fade" id="edit{{ $data->id }}" data-bs-backdrop="static"
                                              data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                              aria-hidden="true">
                                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                              {{ __('Edit Page') }}
                                                          </h1>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                              aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body" id="edit_modal">
                                                          <div class="row">
                                                              <div class="col col-md-6">
                                                                  <div class="card">
                                                                      <div class="card-body">
                                                                          <form method="POST" action="{{route('update_customer',$data->id)}}"
                                                                              class="text-capitalize">
                                                                              @csrf
                                                                              @method('PATCH')
                                                                              <h5 class="card-title">
                                                                                  {{ __('Sender Information') }}</h5>
                                                                              <div class="row mb-3">

                                                                                  <div class="col-12 col-md-6  mb-3">
                                                                                      <label for="sender_name"
                                                                                          class=" col-form-label"><span
                                                                                              class="text-danger">*</span>{{ __('Sender Name') }}</label>
                                                                                      <input name="sender_name"
                                                                                          value="{{ $data->sender_name }}"
                                                                                          class="form-control  @error('sender_name') is-invalid @enderror"
                                                                                          type="text"
                                                                                          placeholder="Isac Newton" />
                                                                                      @error('sender_name')
                                                                                          <span class="invalid-feedback">
                                                                                              {{ $message }}
                                                                                          </span>
                                                                                      @enderror
                                                                                  </div>

                                                                                  <div class="col-12 col-md-6  mb-3 ">
                                                                                      <label for="sender_phone"
                                                                                          class=" col-form-label"><span
                                                                                              class="text-danger">*</span>{{ __('Sender Phone') }}</label>
                                                                                      <div class=" input-group">
                                                                                          <span class="input-group-text"
                                                                                              id="basic-addon1">+251</span>
                                                                                          <input name="sender_phone"
                                                                                              value="{{ $data->sender_phone }}"
                                                                                              class="form-control   @error('sender_phone') is-invalid @enderror"
                                                                                              type="number" id="sender_phone"
                                                                                              aria-label="sender_phone"
                                                                                              aria-describedby="basic-addon1"
                                                                                              placeholder="911******   ">
                                                                                      </div>
                                                                                      @error('sender_phone')
                                                                                          <span class="invalid-feedback">
                                                                                              {{ $message }}
                                                                                          </span>
                                                                                      @enderror
                                                                                  </div>
                                                                                  <div class="col-12 col-md-6  mb-3">
                                                                                      <label for="from_branch"
                                                                                         class="col-form-label">{{__('From-Branch' )}}</label>
                                                                                     <input type="hidden"
                                                                                         name="from_branch"
                                                                                         value="{{ $data->id }}">
                                                                                     <input type="text"
                                                                                         value="{{ $data->sender_branch }}"
                                                                                         readonly
                                                                                         class="form-control   @error('from_branch') is-invalid @enderror"
                                                                                         type="phone" id="from_branch">
                                                                                      @error('from_branch')
                                                                                          <span class="invalid-feedback">
                                                                                              {{ $message }}
                                                                                          </span>
                                                                                      @enderror
                                                                                  </div>
                                                                                  <div class="col-12 mb-3">
                                                                                      <label for="sender_city"
                                                                                          class=" col-form-label"><span
                                                                                              class="text-danger">*</span>{{ __('Sender City') }}</label>
                                                                                              <textarea name="sender_city" readonly class="form-control @error('sender_city') is-invalid @enderror"
                                                                                              id="sender_city" placeholder="Address">{{ $data->sender_city }}</textarea>
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
                                                                          <h5 class="card-title">
                                                                              {{ __('Receivers Information') }}</h5>
                                                                          <div class="row mb-3">
                                                                              <div class="col-12 col-md-6  mb-3">
                                                                                  <label for="receiver_name"
                                                                                      class=" col-form-label"><span
                                                                                          class="text-danger">*</span>{{ __('Receiver Name') }}</label>
                                                                                  <input name="receiver_name" value="{{ $data->receiver_name }}"
                                                                                      class="form-control  @error('receiver_name') is-invalid @enderror"
                                                                                      type="text"
                                                                                      placeholder="Isac Newton">
                                                                                  @error('receiver_name')
                                                                                      <span class="invalid-feedback">
                                                                                          {{ $message }}
                                                                                      </span>
                                                                                  @enderror
                                                                              </div>

                                                                              <div class="col-12 col-md-6  mb-3 ">
                                                                                  <label for="receiver_phone"
                                                                                      class=" col-form-label"><span
                                                                                          class="text-danger">*</span>{{ __('Receiver Phone') }}</label>
                                                                                  <div class=" input-group">
                                                                                      <span class="input-group-text"
                                                                                          id="basic-addon1">+251</span>
                                                                                      <input name="receiver_phone"
                                                                                      value="{{ $data->receiver_phone }}"
                                                                                          class="form-control   @error('receiver_phone') is-invalid @enderror"
                                                                                          type="number" id="receiver_phone"
                                                                                          aria-label="phone"
                                                                                          aria-describedby="basic-addon1"
                                                                                          placeholder="911******   ">
                                                                                  </div>
                                                                                  @error('receiver_phone')
                                                                                      <span class="invalid-feedback">
                                                                                          {{ $message }}
                                                                                      </span>
                                                                                  @enderror
                                                                              </div>

                                                                              
                                                                              <div class="col-12 mb-3">
                                                                                <label for="receiver_city" class="col-form-label">
                                                                                    <span class="text-danger">*</span>{{ __('Receiver City') }}
                                                                                </label>
                                                                                <textarea name="receiver_city" class="form-control @error('receiver_city') is-invalid @enderror"
                                                                                    id="receiver_city" placeholder="Address" readonly>{{ $data->receiver_city}}</textarea>
                                                                                @error('receiver_city')
                                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            

                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                             <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">{{ 'Close' }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ 'Update' }}
                                                                </button>
                                                              </div>
                                                            </form>
                                
                                                            {{-- Form ends here becareful when submiting data  savebutton  not  inside form   --}}

                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Edit modal end --}}

                                        

                                        {{-- Delete modal start --}}
                                        {{-- <div class="modal fade" id="delete{{ $data->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Page
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

                                                            <form action="{{ route('delete_customer', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"
                                                                type="submit">{{ __('Delete') }}</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
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
    @if ($errors->any())
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
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
