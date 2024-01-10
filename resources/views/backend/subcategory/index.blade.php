@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SubCategory</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">SubCategory </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">subCategories Table</h3>
                    <button class="btn btn-primary btn-sm" id="new_subcategory" style="float: right" data-toggle="modal"
                        data-target="#add_subcategory_modal" onclick="catgory_list()">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="subcategoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SubCategory Name Bangla</th>
                                <th>SubCategory Name English</th>
                                <th>Category</th>
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
    {{--  new subCategory added modal --}}
    <div class="modal fade" id="add_subcategory_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New SubCategory</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="english" class="form-label">SubCategory Name English</label>
                            <input type="text" class="form-control @error('subcategory_en') is-invalid @enderror"
                                id="english" name="subcategory_en" required>
                            @error('subcategory_en')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bangla"
                                class="form-label  @error('subcategory_bn') is-invalid @enderror">SubCategory
                                Name Bangla</label>
                            <input type="text" class="form-control" id="bangla" name="subcategory_bn" required>
                            @error('subcategory_bn')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="bangla" class="form-label">Category Name </label>
                                <select class="form-control" name="selectedCategory"
                                    id="selectedCategory_cat_modal"></select>
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
    {{-- ! new category added modal --}}


    {{-- update category modal --}}
    <div class="modal fade" id="subcategory_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update SubCategory</h4>
                    <div id="subcategory_update_message"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="subcategory_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="english" class="form-label">SubCategory Name English</label>
                            <input type="text" class="form-control " id="english_update" name="subcategory_en" required>

                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">SubCategory Name Bangla</label>
                            <input type="text" class="form-control " id="bangla_update" name="subcategory_bn" required>

                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Category Name </label>
                            <select class="form-control" name="selectedCategory" id="selectedCategory"></select>
                        </div>

                        <button type="submit" id="update_subcategory" class="btn btn-success btn-block">UPDATE</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! update Subcategory modal --}}
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            cache: false
        });


        // data table pdf, copy, csv
        $(function() {
            $("#subcategoryTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#subcategoryTable_wrapper .col-md-6:eq(0)');
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
                @if (session('new_subcategory_insert_success'))
                    toastr.success('{{ session('new_subcategory_insert_success') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('subcategory_delete_success'))
                    toastr.error('{{ session('subcategory_delete_success ') }}');
                @endif
            });

        });

        // subcategory delete alert message
        function subcategoryDeleteAlert(ev) {
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

        // !end update, add, delete message


        // Initialize DataTable
        var dataTable = $("#subcategoryTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        // Function to fetch data from the Subcategory table
        function fetchsubCategory() {
            $.ajax({
                type: "GET",
                url: "/subcategory/subcategoryDataShow",
                dataType: "json",
                cache: false,
                success: function(response) {
                    if (response.subcategories) {
                        // Clear existing rows from DataTable
                        dataTable.clear();

                        // Loop through the categories and add rows to DataTable
                        $.each(response.subcategories, function(index, subcategory) {
                            dataTable.row.add([
                                subcategory.subcategory_bn,
                                subcategory.subcategory_en,
                                subcategory.get_category.category_en,
                                '<button class="btn btn-primary btn-sm"  onclick="fetchSubCategory(' +
                                subcategory.id + ')">Update</button>' +
                                '<a href="index/' + subcategory.id +
                                '" class="btn btn-danger btn-sm" onclick="subcategoryDeleteAlert(event)">Delete</a>'
                            ]);
                        });

                        // Redraw DataTable to reflect changes
                        dataTable.draw();
                    }
                }
            });
        }



        fetchsubCategory(); // Call the fetchsubCategory function when the document is ready

        //    show the udate modal with data 
        function fetchSubCategory(id) {
            var subcategoryId = id;
            $.ajax({
                type: "GET",
                url: "/subcategory/subcategoryDataSho/" + subcategoryId,
                dataType: "json",
                cache: false,
                success: function(response) {
                    let selectedCategory = response.subcategories.get_category.category_en;
                        $('input[name="id"]').val(response.subcategories.id);
                        $('input[name="subcategory_bn"]').val(response.subcategories.subcategory_bn);
                        $('input[name="subcategory_en"]').val(response.subcategories.subcategory_en);

                        // Get category data and make select list with the category data
                        $.ajax({
                            type: "GET",
                            url: "/category/categoryDataShow",
                            dataType: "json",
                            cache: false,
                            success: function(categoryResponse) {
                                let selectElement = $('#selectedCategory');
                                console.log(selectedCategory);
                                // Clear existing options before appending new ones
                                selectElement.empty();
                                $.each(categoryResponse.categories, function(index,
                                    category) {
                                    let option = $('<option>');
                                    option.val(category.id);
                                    option.text(category.category_en);
                                    if (category.category_en === selectedCategory) {
                                        option.attr('selected', 'selected');
                                    }
                                    selectElement.append(option);
                                });
                            }
                        });

                    // Show the modal after setting values
                    $('#subcategory_update_modal').modal('show');
                }
            });
        }
        //    show the category list in add new modal  
        function catgory_list() {
                $.ajax({
                    type: "GET",
                    url: "/category/categoryDataShow",
                    dataType: "json",
                    cache: false,
                    success: function(SubcategoryResponse) {
                        let selectElement = $('#selectedCategory_cat_modal');
                        selectElement.empty(); 
                        $.each(SubcategoryResponse.categories, function(index, category) {
                            let option = $('<option>');
                            option.val(category.id);
                            option.text(category.category_en);
                            selectElement.append(
                            option); 
                        });
                    }
                });
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // update subcategory modal data 
        $(document).on('click', '#update_subcategory', function(e) {
            e.preventDefault();
            let subcategory_id = $('#subcategory_id').val();
            let subcategoryData = {
                'subcategory_bn': $('#bangla_update').val(),
                'subcategory_en': $('#english_update').val(),
                'category_id': $('#selectedCategory').val()
            };

            $.ajax({
                type: "PUT",
                url: "/subcategory/subcategoryDataSho/" + subcategory_id,
                dataType: "json",
                data: subcategoryData,
                success: function(response) {
                    console.log(response);
                    $('input[name="subcategory_bn"]').val(response.subcategory_bn);
                    $('input[name="subcategory_en"]').val(response.subcategory_en);

                    $('#subcategory_update_modal').modal('hide');
                    // Display toastr message

                    if (response.status == 200) {
                        toastr.success(response.subcategory_update);
                    }

                    fetchsubCategory();
                }
            });

        });
    </script>
@endsection
