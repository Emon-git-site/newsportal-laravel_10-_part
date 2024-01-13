@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Division</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Division </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Division Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_division_modal">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="divisionTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Division Name Bangla</th>
                                <th>Division Name English</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    {{--  new division added modal --}}
    <div class="modal fade" id="add_division_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Division</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('division.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="english" class="form-label">Division Name English</label>
                            <input type="text" class="form-control" id="english" name="add_modal_division_en" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Division Name Bangla</label>
                            <input type="text" class="form-control" id="bangla" name="add_modal_division_bn" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new division added modal --}}


    {{-- update division modal --}}
    <div class="modal fade" id="division_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Division</h4>
                    <div id="division_update_message"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="division_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="english" class="form-label">Division Name English</label>
                            <input type="text" class="form-control" id="english_update" name="division_en" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Division Name Bangla</label>
                            <input type="text" class="form-control" id="bangla_update" name="division_bn" required>
                        </div>

                        <button type="submit" id="update_division" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        {{--! update division modal --}}

@endsection

@section('script')
    <script>

        // data table pdf, copy, csv
        $(function() {
            $("#divisionTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#divisionTable_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // toaster success message function
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // this is show success insert message
            $(function() {
                @if (session('new_division_insert_success'))
                    toastr.success('{{ session('new_division_insert_success') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('division_delete_success'))
                    toastr.error('{{ session('division_delete_success') }}');
                @endif
            });

        });

        // division delete alert message
        function divisionDeleteAlert(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to Delete this post",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;

                    }
                });
        }


    // Initialize divisionTable
    var divisionTable = $("#divisionTable").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    // Function to fetch data from the division table
    function fetchdivision() {
        $.ajax({
            type: "GET",
            url: "/division/divisionDataShow",
            dataType: "json",
            success: function(response) {
                if (response.divisions) {
                    // Clear existing rows from divisionTable
                    divisionTable.clear();

                    // Loop through the divisions and add rows to divisionTable
                    $.each(response.divisions, function(index, division) {
                        divisionTable.row.add([
                            division.division_bn,
                            division.division_en,
                            '<button class="btn btn-primary btn-sm"  onclick="divisionDatashow(' + division.id + ')">Update</button>' +
                            '<a href="index/' + division.id + '" class="btn btn-danger btn-sm" onclick="divisionDeleteAlert(event)">Delete</a>' 
                        ]);
                    });

                    // Redraw divisionTable to reflect changes
                    divisionTable.draw();
                }
            }
        });
    }

    fetchdivision(); // Call the fetchdivision function when the document is ready





function divisionDatashow(id) {
    var divisionId = id;

    $('#division_update_modal').modal('show');

    // Fetch division  data into update modal using AJAX
    $.ajax({
        type: "GET",
        url: "/division/divisionDataSho/" + divisionId,
        dataType: "json",
        success: function (response) {
            // Set values after the modal is fully shown
            $('#division_update_modal').on('shown.bs.modal', function () {
                $('input[name="id"]').val(response.divisions.id);
                $('input[name="division_bn"]').val(response.divisions.division_bn);
                $('input[name="division_en"]').val(response.divisions.division_en);
            });
        }
    });
}

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

// update division modal data
$(document).on('click', '#update_division',function(e){
    e.preventDefault();
    let division_id = $('#division_id').val();
    let divisionData = {
    'division_bn': $('#bangla_update').val(),
    'division_en': $('#english_update').val()
};


$.ajax({
    type: "PUT",
    url: "/division/divisionDataSho/" + division_id,
    dataType: "json",
    data: divisionData,
   success: function (response) {
            console.log(response);
                $('input[name="division_bn"]').val(response.division_bn);
                $('input[name="division_en"]').val(response.division_en);

                $('#division_update_modal').modal('hide');
                fetchdivision();       

              // Display toastr message

              if(response.status == 200){
                  toastr.success(response.division_update);
              }


            }
});

});
    </script>
@endsection