@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

    @php
    use App\Models\banckend\Subcategory;
    use App\Models\banckend\District;

        $subcats = Subcategory::where('category_id', $post->category_id)->get();
        $sdistricts = District::where('division_id', $post->division_id)->get();
    @endphp
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Post Insert Panel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Post Insert Panel </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Post Update Panel</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Title Bangla</label>
                                            <input type="text" class="form-control" id="title_bn" name="title_bn"
                                                value="{{ $post->title_bn }}" placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">Title English</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en"
                                                value="{{ $post->title_en }}" placeholder="Enter English title">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Category</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" <?php if($category->id==$post->category_id){ echo "selected";} ?> >{{ $category->category_bn }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">SubCategory</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($subcats as $subcat)
                                                <option value="{{ $subcat->id }}" <?php if($subcat->id==$post->subcategory_id){ echo "selected";} ?> >{{ $subcat->subcategory_bn }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="division">Division</label>
                                            <select name="division_id" id="division_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" <?php if($division->id==$post->division_id){ echo "selected";} ?>  >{{ $division->division_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="district">District</label>
                                            <select name="district_id" id="district_id" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($sdistricts as $sdistrict)
                                                <option value="{{ $sdistrict->id }}" <?php if($sdistrict->id==$post->district_id){ echo "selected";} ?> >{{ $sdistrict->district_bn }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image"
                                                        name="image" >
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Old Image</label>
                                            <img src="{{ url($post->image) }}" alt="" width="100px" height="100px">
                                            {{-- <input type="hidden" name="oldimage" value="{{ $post->image }}"> --}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="tags_bn">Tag Bangla</label>
                                            <input type="text" class="form-control" id="tags_bn" name="tags_bn"
                                                value="{{ $post->tag_bn }}" placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tags_en">Tag English</label>
                                            <input type="text" class="form-control" id="tags_en" name="tags_en"
                                                value="{{ $post->tag_en }}" placeholder="Enter English title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="details_bangla">Details Bangla</label>
                                        <textarea class="summernote" name="details_bn">
                                            {{ $post->details_bn }}
                                          </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="details_english">Details English</label>
                                        <textarea class="summernote" name="details_en">{{ $post->details_en }}
                                           </textarea>
                                    </div>

                                    <hr>
                                    <h4 class="text-center">Extra Option</h4>

                                    <div class="row">
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="headline"
                                                name="headline" value="1" <?php if($post->headline==1){echo "checked";}?> >
                                            <label class="form-check-label" for="headline">Headline</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="general_big_thumbnail"
                                                name="general_big_thumbnail" value="1" <?php if($post->bigthumbnail==1){echo "checked";}?> >
                                            <label class="form-check-label" for="general_big_thumbnail">General Big
                                                Thumbnail</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input" id="first_section"
                                                name="first_section" value="1" <?php if($post->first_section==1){echo "checked";}?> >
                                            <label class="form-check-label" for="first_section">FirstSection</label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input type="checkbox" class="form-check-input"
                                                id="first_section_big_thumbnail" name="first_section_big_thumbnail"
                                                value="1" <?php if($post->first_section_thumbnail==1){echo "checked";}?> >
                                            <label class="form-check-label" for="first_section_big_thumbnail">FirstSection
                                                Big Thumbnail</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
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

            // toaster success message function
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // this is show success insert message
            $(function() {
                @if (session('post_insert_message'))
                    toastr.success('{{ session('post_insert_message') }}');
                @endif
            });
            // this is show success update message
            $(function() {
                @if (session('post_updated_message'))
                    toastr.success('{{ session('post_updated_message') }}');
                @endif
            });

            // Display the selected file name in the label
            $('.custom-file-input').on('change', function() {
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
                                    $('#subcategory_id').append('<option value="' +
                                        value.id + '">' + value.subcategory_bn +
                                        '</option>');
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
                                    $('#district_id').append('<option value="' + value
                                        .id + '">' + value.district_bn + '</option>'
                                        );
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
