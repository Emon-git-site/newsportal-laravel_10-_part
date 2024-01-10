@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">District</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">District </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Districs Table</h3>
                    <button class="btn btn-primary btn-sm" id="new_district" style="float: right" data-toggle="modal"
                        data-target="#add_district_modal" onclick="division_list()">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="districtTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>District Name Bangla</th>
                                <th>District Name English</th>
                                <th>Division</th>
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
    {{--  new district added modal --}}
    <div class="modal fade" id="add_district_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New District</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="english" class="form-label">District Name English</label>
                            <input type="text" class="form-control @error('district_en') is-invalid @enderror"
                                id="english" name="district_en" required>
                            @error('district_en')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label  @error('district_bn') is-invalid @enderror">District
                                Name Bangla</label>
                            <input type="text" class="form-control" id="bangla" name="district_bn" required>
                            @error('district_bn')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="bangla" class="form-label">Division Name </label>
                                <select class="form-control" name="selectedDivision"
                                    id="selectedDivision_divsion_modal"></select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new district added modal --}}


    {{-- update district modal --}}
    <div class="modal fade" id="district_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update District</h4>
                    <div id="district_update_message"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="district_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="english" class="form-label">District Name English</label>
                            <input type="text" class="form-control " id="english_update" name="district_en" required>

                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">District Name Bangla</label>
                            <input type="text" class="form-control " id="bangla_update" name="district_bn" required>

                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Division Name </label>
                            <select class="form-control" name="selectedDivision_update"
                                id="selectedDivision_update"></select>
                        </div>

                        <button type="submit" id="update_district" class="btn btn-success btn-block">UPDATE</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! update district   modal --}}
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            cache: false
        });


        // data table pdf, copy, csv
        $(function() {
            $("#districtTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#districtTable_wrapper .col-md-6:eq(0)');
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
                @if (session('new_district_insert_success'))
                    toastr.success('{{ session('new_district_insert_success') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('district_delete_success'))
                    toastr.error('{{ session('district_delete_success') }}');
                @endif
            });

        });

        // district delete alert message
        function districtDeleteAlert(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
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

        // !end update, add, delete message


        // Initialize DataTable
        var dataTable = $("#districtTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        // Function to fetch data from the district table
        function fetchdistricts() {
            $.ajax({
                type: "GET",
                url: "/district/districtDataShow",
                dataType: "json",
                cache: false,
                success: function(response) {
                    if (response.districts) {
                        // Clear existing rows from DataTable
                        dataTable.clear();

                        // Loop through the districts and add rows to DataTable
                        $.each(response.districts, function(index, district) {
                            dataTable.row.add([
                                district.district_bn,
                                district.district_en,
                                district.get_division.division_en,
                                '<button class="btn btn-primary btn-sm"  onclick="fetchdistrict(' +
                                district.id + ')">Update</button>' +
                                '<a href="index/' + district.id +
                                '" class="btn btn-danger btn-sm" onclick="districtDeleteAlert(event)">Delete</a>'
                            ]);
                        });

                        // Redraw DataTable to reflect changes
                        dataTable.draw();
                    }
                }
            });
        }



        fetchdistricts(); // Call the fetchdistrict function when the document is ready

        //    show the udate modal with data 
        function fetchdistrict(id) {
            var districtId = id;
            $.ajax({
                type: "GET",
                url: "/district/districtDataSho/" + districtId,
                dataType: "json",
                cache: false,
                success: function(response) {
                    let selectedDivison = response.districts.get_division.division_en;
                    $('input[name="id"]').val(response.districts.id);
                    $('input[name="district_bn"]').val(response.districts.district_bn);
                    $('input[name="district_en"]').val(response.districts.district_en);

                    // Get Division data and make select list with the Division data
                    $.ajax({
                        type: "GET",
                        url: "/division/divisionDataShow",
                        dataType: "json",
                        cache: false,
                        success: function(divisionResponse) {
                            let selectElement = $('#selectedDivision_update');
                            // Clear existing options before appending new ones
                            selectElement.empty();
                            $.each(divisionResponse.divisions, function(index,
                            division) {
                                let option = $('<option>');
                                option.val(division.id);
                                option.text(division.division_en);
                                console.log(selectedDivison);
                                console.log(division.division_en);
                                if (division.division_en === selectedDivison) {
                                    option.attr('selected', 'selected');
                                }
                                selectElement.append(option);
                            });
                        }
                    });

                    // Show the modal after setting values
                    $('#district_update_modal').modal('show');
                }
            });
        }
        //    show the division list in add new modal  
        function division_list() {
            $.ajax({
                type: "GET",
                url: "/division/divisionDataShow",
                dataType: "json",
                cache: false,
                success: function(divisionResponse) {
                    let selectElement = $('#selectedDivision_divsion_modal');
                    selectElement.empty();
                    $.each(divisionResponse.divisions, function(index, division) {
                        let option = $('<option>');
                        option.val(division.id);
                        option.text(division.division_en);
                        selectElement.append(option);
                    });
                }
            });
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // update district   modal data 
        $(document).on('click', '#update_district', function(e) {
            e.preventDefault();
            let district_id = $('#district_id').val();
            let districtData = {
                'district_bn': $('#bangla_update').val(),
                'district_en': $('#english_update').val(),
                'division_id': $('#selectedDivision_update').val()
            };

            $.ajax({
                type: "PUT",
                url: "/district/districtDataSho/" + district_id,
                dataType: "json",
                data: districtData,
                success: function(response) {
                    $('input[name="district_bn"]').val(response.district_bn);
                    $('input[name="district_en"]').val(response.district_en);

                    $('#district_update_modal').modal('hide');
                    // Display toastr message

                    if (response.status == 200) {
                        toastr.success(response.District_update);
                    }

                    fetchdistricts();
                }
            });

        });
    </script>
@endsection
