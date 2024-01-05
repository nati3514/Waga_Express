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
        <section class="section">
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="" class="text-capitalize">
                                @csrf
            
                                <div class="row d-flex justify-content-evenly mb-3">
                                    @role('admin')
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="select_user" class="col-form-label">{{ __('Users:') }}</label>
                                        <select name="select_user" id="" class="form-select ">
                                            <option value="">All User</option>
                                            @foreach ($data2 as $user_data)
                                                <option value="{{ $user_data->id }}" 
                                                    {{ Request::get('select_user') == $user_data->id  ? 'selected' : '' }}>
                                                    {{ $user_data->first_name }} 
                                                    {{ $user_data->last_name }}</option>
                                            @endforeach
                                        </select>
            
                                        @error('first_name')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    @endrole
                                    @role('cashier')
                                     <div class="col-12 col-md-3  mb-3">
                                         <label for="user" class=" col-form-label">{{ __('User:') }}</label>
                                         <input name="user" type="hidden" value="{{ $data2->id }}"/>
                                         <input name="" readonly value="{{ $data2->first_name }} {{ $data2->last_name }}"
                                             class="form-control" >
            
                                     </div>
                                     @endrole
                                    <div class="col-12 col-md-3  mb-3">
                                        <label for="from" class=" col-form-label">{{ __('From:') }}</label>
                                        <input name="from" value="{{ Request::get('from') ?? date('Y-m-d') }}"
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
                                        <input name="to" value="{{ Request::get('to') ?? date('Y-m-d') }}"
                                            class="form-control  @error('to') is-invalid @enderror" type="date"
                                            placeholder="">
                                        @error('to')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
            
                                    </div>
                                    <div class="col-12 col-md-1 mt-4">
                                        <button class="btn btn-sm btn-primary">{{ __('View Report') }}</button>
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
                            <table class="table datatable" id="transactionTable">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th scope="col">{{ __('Date') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Package Price') }}</th>
                                        <th scope="col">{{ __('Ded_amount') }}</th>
                                        <th scope="col">{{ __('Commission') }}</th>
                                        <th scope="col">{{ __('Closing Balance') }}</th>
                                        <th scope="col">{{ __('Transaction Done By') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $totalPrice = 0; // Initialize the total sum variable
                                      $totalDed_amount = 0;
                                      $totalcommission = 0;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->status == 'collected')
                                                    Collected
                                                @elseif($item->status == 'received')
                                                    Received
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->price) }}ETB</td>
                                            <td>-{{ number_format($item->Ded_amount) }}ETB</td>
                                            <td>+{{ number_format($item->commission) }}ETB</td>
                                            <td>{{ number_format($item->current_balance, 2) }}ETB</td>
                                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                            @php
                                                $totalPrice += $item->price;
                                                $totalDed_amount += $item->Ded_amount;
                                                $totalcommission += $item->commission;
                                                
                                            @endphp
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                
                                <!-- Display total once after all rows -->
                                <tfoot>
                                    <tr>
                                        <th colspan="1"></th>
                                        <th>Total</Td> </th>
                                        <th colspan="1"></th>
                                        <th>{{ number_format($totalPrice) }} ETB</th>
                                        <th>{{ number_format($totalDed_amount) }} ETB</th>
                                        <th>{{ number_format($totalcommission) }} ETB</th>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div
        </section>
    </main>
    <!-- DataTables JS and required libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<script>
     
    $(document).ready(function () {
        // Initialize DataTable with Buttons extension
        var table = $('#transactionTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                
                {
                    extend: 'pdf',
                    text: 'PDF',
                    action: function (e, dt, button, config) {
                        // Custom PDF export function
                        customPdfExport(dt);
                    }
                },
                {
                    text: 'Print',
                    action: function (e, dt, button, config) {
                        // Trigger print with custom function
                        printPageWithTotal();
                    }
                },
            ]
        });
    });

    function extractCellValue(cell) {
    if (cell instanceof jQuery) {
        // If the cell is a jQuery object, extract the text content
        return cell.hasClass('badge') ? cell.text().trim() : cell.text().trim();
    } else {
        // If the cell is not a jQuery object, return its value
        return cell;
    }
}
//     function customExcelExport(table) {
//     console.log('Custom Excel export logic');

//     var data = table.rows().data().toArray();
//     var headers = table.columns().header().toArray().map(header => $(header).text());

//     console.log('Headers:', headers);

//     var csvContent = headers.join(',') + '\n';

//     data.forEach(function (row) {
//         var rowData = row.map(cell => {
//             var cellText = extractCellText(cell.node());
//             console.log('Cell Data:', cellText);
//             return cellText;
//         });
//         csvContent += rowData.join(',') + '\n';
//     });

//     var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
//     saveAs(blob, 'export.csv');
// }

    

function customPdfExport(table) {
    console.log('Custom PDF export logic');

    var data = table.rows().data().toArray();
    var headers = table.columns().header().toArray().map(header => $(header).text());

    var pdfData = [headers].concat(data.map(row => row.map(cell => extractCellValue(cell))));

    

    var docDefinition = {
        content: [
            { text: 'Waga Express', style: 'header' },
            {
                table: {
                    headerRows: 1,
                    body: pdfData,
                    footerRow: 1,
                }
            }, 
            // { text: 'Waga Express', style: 'footer' }, 
        ],
        
    };

    pdfMake.createPdf(docDefinition).getBlob(function (blob) {
        saveAs(blob, 'WagaExpress.pdf');
    });
}



function printPageWithTotal() {
    // Clone the DataTable
    var tableClone = $('#transactionTable').clone();

    // Convert the cloned table to HTML
    var tableHtml = tableClone[0].outerHTML;

    // Open a new window and set its content to the formatted HTML
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Print</title></head><body>');

    // Add the table structure
    printWindow.document.write('<table border="1" style="width:100%;">' + tableHtml + '</table>');

    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Trigger the print function in the new window
    printWindow.print();
}

    </script>

   
@endsection