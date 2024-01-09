@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_category_modal">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="categoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Name Bangla</th>
                                <th>Category Name English</th>
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
    {{--  new category added modal --}}
    <div class="modal fade" id="add_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="english" class="form-label">Category Name English</label>
                            <input type="text" class="form-control" id="english" name="category_en" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Category Name Bangla</label>
                            <input type="text" class="form-control" id="bangla" name="category_bn" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new category added modal --}}


    {{-- update category modal --}}
    <div class="modal fade" id="category_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Category</h4>
                    <div id="category_update_message"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hide" class="form-control" id="category_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="english" class="form-label">Category Name English</label>
                            <input type="text" class="form-control" id="english_update" name="category_en" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Category Name Bangla</label>
                            <input type="text" class="form-control" id="bangla_update" name="category_bn" required>
                        </div>

                        <button type="submit" id="update_category" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        {{--! update category modal --}}

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
                @if (session('new_category_insert_success'))
                    toastr.success('{{ session('new_category_insert_success') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('category_delete_success'))
                    toastr.error('{{ session('category_delete_success') }}');
                @endif
            });

        });

        // category delete alert message
        function categoryDeleteAlert(ev) {
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
    var categoryTable = $("#categoryTable").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
    console.log("sdf");

    // Function to fetch data from the category table
    function fetchCategory() {
        $.ajax({
            type: "GET",
            url: "/category/categoryDataShow",
            dataType: "json",
            success: function(response) {
                if (response.categories) {
                    // Clear existing rows from categoryTable
                    categoryTable.clear();

                    // Loop through the categories and add rows to categoryTable
                    $.each(response.categories, function(index, category) {
                        categoryTable.row.add([
                            category.category_bn,
                            category.category_en,
                            '<button class="btn btn-primary btn-sm"  onclick="categoryDatashow(' + category.id + ')">Update</button>' +
                            '<a href="index/' + category.id + '" class="btn btn-danger btn-sm" onclick="categoryDeleteAlert(event)">Delete</a>' 
                        ]);
                    });

                    // Redraw categoryTable to reflect changes
                    categoryTable.draw();
                }
            }
        });
    }

    fetchCategory(); // Call the fetchCategory function when the document is ready





function categoryDatashow(id) {
    var categoryId = id;

    $('#category_update_modal').modal('show');

    // Fetch category  data into update modal using AJAX
    $.ajax({
        type: "GET",
        url: "/category/categoryDataSho/" + categoryId,
        dataType: "json",
        success: function (response) {
            // Set values after the modal is fully shown
            $('#category_update_modal').on('shown.bs.modal', function () {
                $('input[name="id"]').val(response.categories.id);
                $('input[name="category_bn"]').val(response.categories.category_bn);
                $('input[name="category_en"]').val(response.categories.category_en);
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
$(document).on('click', '#update_category',function(e){
    e.preventDefault();
    let category_id = $('#category_id').val();
    let categoryData = {
    'category_bn': $('#bangla_update').val(),
    'category_en': $('#english_update').val()
};


$.ajax({
    type: "PUT",
    url: "/category/categoryDataSho/" + category_id,
    dataType: "json",
    data: categoryData,
   success: function (response) {
            console.log(response);
                $('input[name="category_bn"]').val(response.category_bn);
                $('input[name="category_en"]').val(response.category_en);

                $('#category_update_modal').modal('hide');
                fetchCategory();       

              // Display toastr message

              if(response.status == 200){
                  toastr.success(response.category_update);
              }


            }
});

});
    </script>
@endsection