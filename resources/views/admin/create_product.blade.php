
@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Package</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Add Package</li>
                </ol>
            </nav>
        </div>
        <section class="section ">
            <div class="row">
                <div class="col col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.store') }}" class="text-capitalize">
                                @csrf
                                <h5 class="card-title">{{ 'Sender Information' }}</h5>
                                <div class="row mb-3">

                                    <div class="container search_select_box">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="sender_customers" class="col-form-label">{{ ('Search Phone_No') }}</label>
                                            <select data-live-search="true" id="sender_customers" class="border custom-select @error('customers') is-invalid @enderror">
                                                <option selected disabled value="">{{ ('Search Phone Number') }}</option>
                                                @foreach ($customers_phone_no as $customer)
                                                    <option value="{{ $customer->id }}" data-name="{{ $customer->name }}" data-phone="{{ $customer->phone }}">{{ $customer->phone }}</option>
                                                @endforeach
                                            </select>
                                            @error('customers')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="sender_name" class="col-form-label"><span class="text-danger">*</span>{{ 'Sender Name' }}</label>
                                        <input name="sender_name" id="sender_name" value="{{ old('sender_name') }}" class="form-control @error('sender_name') is-invalid @enderror" type="text" placeholder="Isac Newton">
                                        @error('sender_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    

                                    <!-- Your input for sender phone -->
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="sender_phone" class="col-form-label"><span class="text-danger">*</span>{{ 'Sender Phone' }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">+251</span>
                                            <input name="sender_phone" value="{{ old('sender_phone') }}"
                                                class="form-control @error('sender_phone') is-invalid @enderror"
                                                type="text" id="sender_phone" aria-label="sender_phone"
                                                aria-describedby="basic-addon1" placeholder="911******">
                                        </div>
                                        @error('sender_phone')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="from_branch" class="col-form-label">{{ 'From-Branch' }}</label>
                                        <input type="hidden" name="from_branch" id="fromBranch" value="{{ $firstBranch->id }}">
                                        <input type="text" value="{{ $firstBranch->branch_name }}" readonly
                                            class="form-control   @error('from_branch') is-invalid @enderror" type="phone"
                                            id="from_branch">
                                        @error('from_branch')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12   mb-3">

                                        <label for="sender_city" class=" col-form-label"><span
                                                class="text-danger">*</span>{{ 'Sender City' }}</label>
                                            <textarea name="sender_city" readonly class="form-control   @error('sender_city') is-invalid @enderror" id="sender_city"
                                            placeholder="Address">{{$firstBranch->city}}</textarea>
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
                            <h5 class="card-title">{{ 'Receivers Information' }}</h5>
                            <div class="row mb-3">
                                
                                <!-- Receiver's Dropdown -->
<div class="container search_select_box">
    <div class="col-12 col-md-6 mb-3">
        <label for="receiver_customers" class="col-form-label">{{ ('Search Phone_No') }}</label>
        <select data-live-search="true" id="receiver_customers" class="border custom-select @error('customers') is-invalid @enderror">
            <option selected disabled value="">{{ ('Search Phone Number') }}</option>
            @foreach ($customers_phone_no as $customer)
                <option value="{{ $customer->id }}" data-name="{{ $customer->name }}" data-phone="{{ $customer->phone }}">{{ $customer->phone }}</option>
            @endforeach
        </select>
        @error('customers')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

<!-- Receiver's Name Input -->
<div class="col-12 col-md-6 mb-3">
    <label for="receiver_name" class="col-form-label"><span class="text-danger">*</span>{{ 'Receiver Name' }}</label>
    <input name="receiver_name" id="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror" type="text" placeholder="Isac Newton">
    @error('receiver_name')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>

<!-- Receiver's Phone Input -->
<div class="col-12 col-md-6 mb-3">
    <label for="receiver_phone" class="col-form-label"><span class="text-danger">*</span>{{ 'Receiver Phone' }}</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">+251</span>
        <input name="receiver_phone" value="{{ old('receiver_phone') }}" class="form-control @error('receiver_phone') is-invalid @enderror" type="number" id="receiver_phone" aria-label="phone" aria-describedby="basic-addon1" placeholder="911******">
    </div>
    @error('receiver_phone')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>

                                
                                <div class="container search_select_box">
                                    <!-- Include the provided HTML code for the select dropdown with search -->
                                    <div class="col-12 col-md-6 mb-3 ">
                                        <label for="to_branch" class="col-form-label">{{ ('To-Branch') }}</label>
                                        {{-- <input type="text" id="branch_search" class="form-control" placeholder="Search Branch"> --}}
                                        <input type="hidden" name="to_branch" id="to_branch_hidden" value="">
                                        <select   data-live-search="true" id="to_branch" class="border custom-select @error('to_branch') is-invalid @enderror">
                                            <option selected disabled value="">{{ ('Select Branch') }}</option>
                                            @foreach ($receiversBranch as $branch)
                                                <option value="{{ $branch->id }}" data-city="{{ $branch->city }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('to_branch')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label for="receiver_city" class="col-form-label"><span class="text-danger">*</span>{{ 'Receiver City' }}</label>
                                    <textarea name="receiver_city" class="form-control @error('receiver_city') is-invalid @enderror" id="receiver_city" placeholder="Address" readonly></textarea>
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
                                <div class="col-md-2 mb-3">
                                    <label for="package_tag" class="col-form-label">{{ __('Package Tag') }}</label>
                                    <input name="package_tag" type="text" class="form-control @error('package_tag') is-invalid @enderror" id="package_tag" placeholder="{{ __('Enter Package Tag') }}" autofocus>
                                    @error('package_tag')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class=" col-md-2  mb-3">
                                    <label for=""
                                        class=" col-form-label">{{ __('Package Type') }}</label>
                                    <select name="package_type" id="package_type"
                                        class="form-select  @error('package_type') is-invalid @enderror">
                                        <option value="" selected disabled>{{ __('--Select--') }}</option>
                                        <option value="breakable" >
                                            {{ __('fragile') }}
                                        </option>
                                        <option value="unbreakable">
                                            {{ __('Unfragile') }}</option>
                                    </select>
                                    @error('package_type')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class=" col-md-2  mb-3">
                                    <label for="weight" class="col-form-label"> <span class="text-danger">*</span>
                                        {{ __('weight') }}</label>
                                        <select name="weight" id="weight"
                                        class="form-select input-lg dynamic weight_list @error('weight') is-invalid @enderror">
                                       
                                        <option selected disabled value="">{{ __('Select Weight') }}
                                        </option>
                                        @foreach ($weight as $weight_list)
                                            <option value="{{ $weight_list->id }}">{{ $weight_list->weight }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('weight')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                 <div class=" col-md-2  mb-3">
                                    <label for="price" class=" col-form-label"> <span class="text-danger">*</span>
                                        {{ __('price') }}</label>
                                    <input name="price" value="" readonly
                                        class="form-control   " type="number"
                                        id="price" placeholder="">
                                    @error('price')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3" style="display: none;">
                                    <label for="status" class="col-form-label">{{ __('Status') }}</label>
                                    <input name="status" type="text" value="collected" readonly
                                           class="form-control @error('status') is-invalid @enderror" type="phone" id="status">
                                    @error('status')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        {{-- <button class="btn btn-primary" type="submit">Save</button> --}}
                        <input type="hidden" name="firstBranch" value="{{ json_encode($firstBranch) }}">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>

            </div>

        </section>
    </main>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var branchSelect = document.getElementById('to_branch');
            var branchSearchInput = document.getElementById('branch_search');
            var originalOptions = Array.from(branchSelect.getElementsByTagName('option'));
    
            branchSearchInput.addEventListener('input', function() {
                var filter = branchSearchInput.value.toLowerCase();
    
                // Clear the options
                branchSelect.innerHTML = '';
    
                // Filter and append options based on the first character
                originalOptions.forEach(function(originalOption) {
                    var branchName = originalOption.textContent.toLowerCase();
                    if (branchName.indexOf(filter) === 0) {
                        branchSelect.appendChild(originalOption.cloneNode(true));
                    }
                });
            });
    
            // Handle selection of an option
            branchSelect.addEventListener('change', function() {
                var selectedOption = branchSelect.options[branchSelect.selectedIndex];
    
                // Log or send data to the server as needed
                console.log('Selected option ID:', selectedOption.value);
                console.log('Selected option name:', selectedOption.textContent);
            });
        });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Function to update the receiver_city textarea when a branch is selected
        $('#to_branch').change(function () {
            // Get the selected branch value
            var selectedBranchId = $(this).val();

            // Find the corresponding branch in the $receiversBranch array
            var selectedBranch = {!! json_encode($receiversBranch) !!}.find(function (branch) {
                return branch.id == selectedBranchId;
            });

            // Update the receiver_city textarea with the city value
            $('#receiver_city').val(selectedBranch ? selectedBranch.city : '');
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function () {
        // Function to update the receiver_city textarea when a branch is selected
        $('#to_branch').change(function () {
            // Get the selected branch value
            var selectedBranchId = $(this).val();

            // Find the corresponding branch in the $receiversBranch array
            var selectedBranch = {!! json_encode($receiversBranch) !!}.find(function (branch) {
                return branch.id == selectedBranchId;
            });

            // Update the receiver_city textarea with the city value
            $('#receiver_city').val(selectedBranch ? selectedBranch.city : '');

            // Update the combined_city textarea with the sender_city and receiver_city values
            var senderCity = $('#sender_city').val();
            var receiverCity = $('#receiver_city').val();
            $('#combined_city').val(senderCity + ' - ' + receiverCity);
        });
    });
</script> --}}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var price;
        $(document).on('change', '#to_branch', function(){  
        var fromId = $('#fromBranch').val();
        var toId = $(this).val();
        var tobranch = document.getElementById('to_branch_hidden');
        tobranch.value = toId;
        console.log(fromId);
        console.log(toId)
        $.ajax({
            type: 'get',
            url:'/fetchPrice',
            data: {
            fromId: fromId,
            toId: toId
        },
            success:function(data){
                console.log(data);
                price = data.price;

                  
        }
        })
    });
    $(document).on('change','.weight_list',function () {
        var weight_id=$(this).val();

        console.log(weight_id);

        $.ajax({
            type:'get',
            url:'/fetchRate',
            data:{'id':weight_id},
            dataType:'json',
            success:function(data){
                var rate = data.rate;
     
                var total = price * rate;
        
                var price_field = document.getElementById('price');
              
                price_field.value = total;
            },
            error:function(){

            }
        });


    });

});
</script>

<script>
    $(document).ready(function(){
        // Initialize Bootstrap Select
        $('#to_branch').selectpicker();

        // Optional: If you want to perform an action when the value changes
        $('#to_branch').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            // Access the selected value using $(this).val()
            console.log('Selected value:', $(this).val());
        });

        // Optional: If you want to capture the form submission
        $('form').submit(function(event) {
            // Access the selected value using $('#to_branch').val()
            console.log('Selected value to be sent in the request:', $('#to_branch').val());
            
            // You can also prevent the form submission if needed
            // event.preventDefault();
        });
    });
</script>


<script>
    // Add an event listener to the to_branch dropdown
    document.getElementById('to_branch').addEventListener('change', function() {
        // Get the selected option
        var selectedOption = this.options[this.selectedIndex];
        
        // Update the receiver_city textarea with the city from the selected option
        document.getElementById('receiver_city').value = selectedOption.getAttribute('data-city');
    });
    
</script>

<!-- Script for Sender and Receiver -->
<script>
    $(document).ready(function () {
        // Initialize Bootstrap Select for sender_customers
        $('#sender_customers').selectpicker();

        // Initialize Bootstrap Select for receiver_customers
        $('#receiver_customers').selectpicker();

        // Optional: If you want to perform an action when the value changes for sender_customers
        $('#sender_customers').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            handleDropdownChange('sender');
        });

        // Optional: If you want to perform an action when the value changes for receiver_customers
        $('#receiver_customers').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            handleDropdownChange('receiver');
        });

        // Optional: If you want to capture the form submission
        $('form').submit(function (event) {
            console.log('Selected value to be sent in the request for sender_customers:', $('#sender_customers').val());
            console.log('Selected value to be sent in the request for receiver_customers:', $('#receiver_customers').val());
            // You can also prevent the form submission if needed
            // event.preventDefault();
        });
    });

    function handleDropdownChange(type) {
        var selectedOption;
        if (type === 'sender') {
            selectedOption = $('#sender_customers option:selected');
        } else if (type === 'receiver') {
            selectedOption = $('#receiver_customers option:selected');
        }

        // Update the corresponding input fields with the data from the selected option
        $('#' + type + '_name').val(selectedOption.data('name'));
        $('#' + type + '_phone').val(selectedOption.data('phone'));
    }
</script>








      
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
    <script>
        // Add this script to display Toastr notification for sender_phone validation error
        @if ($errors->has('sender_phone'))
            toastr.error("{{ $errors->first('sender_phone') }}");
        @endif

        // Toastr notification for receiver_phone validation error
     @if ($errors->has('receiver_phone'))
         toastr.error("{{ $errors->first('receiver_phone') }}");
     @endif
     // Toastr notification for package_tag validation error
    @if ($errors->has('package_tag'))
        toastr.error("{{ $errors->first('package_tag') }}");
    @endif
    </script>
     
@endsection
