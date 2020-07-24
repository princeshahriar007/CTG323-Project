@extends('admin.partials.adminMaster')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update Media</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-3">
                <img src="{{asset('image/'.$image->image)}}" width="100%">
                <form class="form-group" action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="prev_image" value="{{ $image->id }}">
                    <input class="form-control-file" type="file" name="image"><br>
                    <input class="btn btn-success" type="submit" name="submit" value="Confirm">
                </form>
            </div>
        </div>
    </div>

@endsection

