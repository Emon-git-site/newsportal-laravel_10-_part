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
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Title Bangla</label>
                                            <input type="text" class="form-control" id="title_bn" name="title_bn"
                                                placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">Title English</label>
                                            <input type="text" class="form-control" id="title_en" name="title_en"
                                                placeholder="Enter English title">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_bn">Category</label>
                                            <select name="category_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title_en">SubCategory</label>
                                            <select name="subcategory_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
     
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="division">Division</label>
                                            <select name="divison_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->division_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="district">District</label>
                                            <select name="subcategory_id" id="" class="form-control">
                                                <option selected="" disabled="">Choose One</option>
     
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="tags_bn">Tag Bangla</label>
                                            <input type="text" class="form-control" id="tags_bn" name="tags_bn"
                                                placeholder="Enter Bangla Title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tags_en">Tag English</label>
                                            <input type="text" class="form-control" id="tags_en" name="tags_en"
                                                placeholder="Enter English title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="details_bangla">Details Bangla</label>
                                        <textarea class="summernote">
                                          </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="details_english">Details English</label>
                                        <textarea class="summernote">
                                           </textarea>
                                    </div>

                                    <hr>
                                    <h4 class="text-cener">Extra Option</h4>
                                

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
