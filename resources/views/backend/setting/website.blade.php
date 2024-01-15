@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Important Website</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Important Website </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if (count($errors) > 0)
            <div class="p-1">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-danger fade show" role="alert">{{ $error }} <button
                            type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>
                @endforeach
            </div>
        @endif
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Important Website</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_category_modal">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="categoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Website Name</th>
                                <th>Website Link</th>
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
    {{--  new webiste added modal --}}
    <div class="modal fade" id="add_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert Important Website</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setting.website.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="website_name" class="form-label">Website Name</label>
                            <input type="text" class="form-control" id="website_name" name="website_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="website_link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" id="website_link" name="website_link"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new website added modal --}}


    {{-- update website modal --}}
    <div class="modal fade" id="website_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Website</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="website_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="website_name" class="form-label">Website Name</label>
                            <input type="text" class="form-control" id="website_name_update" name="website_name_update"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="website_link" class="form-label">Website Link</label>
                            <input type="text" class="form-control" id="website_link_update" name="website_link_update"
                                required>
                        </div>

                        <button type="submit" id="update_category" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! update website modal --}}
@endsection

@section('script')
    <script>
        // data table pdf, copy, csv
        $(function() {
            $("#categoryTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#categoryTable_wrapper .col-md-6:eq(0)');
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
                @if (session('new_website_insert_message'))
                    toastr.success('{{ session('new_website_insert_message') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('website_delete_message'))
                    toastr.error('{{ session('website_delete_message') }}');
                @endif
            });

        });

        // website delete alert message
        function websiteDeleteAlert(ev) {
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


        // Initialize categoryTable
        var websiteTable = $("#categoryTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
        console.log("sdf");

        // Function to fetch data from the category table
        function fetchwebsite() {
            $.ajax({
                type: "GET",
                url: "/website/websiteDataShow",
                dataType: "json",
                success: function(response) {
                    if (response) {
                        // Clear existing rows from categoryTable
                        websiteTable.clear();

                        // Loop through the categories and add rows to categoryTable
                        $.each(response.websites, function(index, website) {
                            websiteTable.row.add([
                                website.website_name,
                                website.website_link,
                                '<button class="btn btn-primary btn-sm"  onclick="websiteDataShow(' + website.id + ')">Update</button>' +
                                '<a href="website/delete/' + website.id + '" class="btn btn-danger btn-sm" onclick="websiteDeleteAlert(event)">Delete</a>' 
                            ]);
                        });

                        // Redraw categoryTable to reflect changes
                        websiteTable.draw();
                    }
                }
            });
        }

        fetchwebsite(); // Call the fetchCategory function when the document is ready





        function websiteDataShow(id) {
            var websiteId = id;

            $('#website_update_modal').modal('show');

            // Fetch category  data into update modal using AJAX
            $.ajax({
                type: "GET",
                url: "/website/websiteDataSho/" + websiteId,
                dataType: "json",
                success: function(response) {
                    console.log(response.website);
                    // Set values after the modal is fully shown
                    $('#website_update_modal').on('shown.bs.modal', function() {
                        $('input[name="id"]').val(response.website.id);
                        $('input[name="website_name_update"]').val(response.website.website_name);
                        $('input[name="website_link_update"]').val(response.website.website_link);
                    });
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // update category modal data
        $(document).on('click', '#update_category', function(e) {
            e.preventDefault();
            let website_id = $('#website_id').val();
            let categoryData = {
                'website_name': $('#website_name_update').val(),
                'website_link': $('#website_link_update').val()
            };


            $.ajax({
                type: "PUT",
                url: "/website/update/" + website_id,
                dataType: "json",
                data: categoryData,
                success: function(response) {
                    console.log(response);
                    $('input[name="website_name_update"]').val(response.website_name);
                    $('input[name="website_link_update"]').val(response.website_link);

                    $('#website_update_modal').modal('hide');
                    fetchwebsite();

                    // Display toastr message

                    if (response.status == 200) {
                        toastr.success(response.website_update);
                    }


                }
            });

        });
    </script>
@endsection
