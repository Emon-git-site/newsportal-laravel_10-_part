@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Post Insert Panel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post Insert Panel </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Post Insert Panel</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Title Bangla</label>
                                            <input type="text" class="form-control" id="title_bn" name="title_bn" value="{{ old('title_bn') }}"
                                                placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">Title English</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') }}"
                                                placeholder="Enter English title">
                                        </div >
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Category</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_bn }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">SubCategory</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="division">Division</label>
                                            <select name="division_id" id="division_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->division_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="district">District</label>
                                            <select name="district_id" id="district_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image" required>
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="tags_bn">Tag Bangla</label>
                                            <input type="text" class="form-control" id="tags_bn" name="tags_bn" value="{{ old('tags_bn') }}""
                                                placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tags_en">Tag English</label>
                                            <input type="text" class="form-control" id="tags_en" name="tags_en" value="{{ old('tags_en') }}"
                                                placeholder="Enter English title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="details_bangla">Details Bangla</label>
                                        <textarea class="summernote" name="details_bn" value="{{ old('details_bn') }}">
                                          </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="details_english">Details English</label>
                                        <textarea class="summernote" name="details_en" value="{{ old('details_en') }}">
                                           </textarea>
                                    </div>

                                    <hr>
                                    <h4 class="text-center">Extra Option</h4>

                                    <div class="row">
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="headline"
                                                name="headline" value="1">
                                            <label class="form-check-label" for="headline">Headline</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="general_big_thumbnail"
                                                name="general_big_thumbnail" value="1">
                                            <label class="form-check-label" for="general_big_thumbnail">General Big
                                                Thumbnail</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="first_section"
                                                name="first_section" value="1">
                                            <label class="form-check-label" for="first_section">FirstSection</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input"
                                                id="first_section_big_thumbnail" name="first_section_big_thumbnail"
                                                value="1">
                                            <label class="form-check-label" for="first_section_big_thumbnail">FirstSection
                                                Big Thumbnail</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('script')
    <script>
$(document).ready(function() {

           // Display the selected file name in the label
           $('.custom-file-input').on('change', function(){
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    // get subcategory depend on the category
    $('[name="category_id"]').on('change', function() {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                type: "GET",
                url: "/post/subcategoryDatashow/" + category_id,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        // Clear existing options
                        $('#subcategory_id').empty();

                        // Append new options
                        $.each(response, function(key, value) {
                            $('#subcategory_id').append('<option value="' + value.id + '">' + value.subcategory_bn + '</option>');
                        });
                    }
                },
                error: function() {
                    // Your code here for handling errors
                    alert('Error occurred during the AJAX request.');
                }
            });
        } else {
            // Your code here if category_id is not present
            alert('Category ID is not selected.');
        }
    });

    // get district name depend on the division
    $('[name="division_id"]').on('change', function() {
        var division_id = $(this).val();
        if (division_id) {
            console.log(division_id);

            $.ajax({
                type: "GET",
                url: "/post/districtDatashow/" + division_id,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        console.log(response);
                        // Clear existing options
                        $('#district_id').empty();

                        // Append new options
                        $.each(response, function(key, value) {
                            $('#district_id').append('<option value="' + value.id + '">' + value.district_bn + '</option>');
                        });
                    }
                },
                error: function() {
                    // Your code here for handling errors
                    alert('Error occurred during the AJAX request.');
                }
            });
        } else {
            // Your code here if category_id is not present
            alert('Category ID is not selected.');
        }
    });
});

    </script>
@endsection
