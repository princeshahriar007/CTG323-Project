@extends('admin.partials.adminMaster')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <th colspan="2">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                            <th colspan="2">Action</th>
                            @endif
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <td>
                                    <form class="form-group" method="POST" action="{{ url('/admin/roleChange') }}">
                                        {{ csrf_field() }}
                                        <input class="form-control" type="hidden" name="user_id" value="{{ $user->id }}">
                                        <select name="role" id="">
                                            @foreach($userType as $t)
                                                @if($t == $user->role)
                                                    <option selected value="{{ $user->role }}">{{ $t }}</option>
                                                @else
                                                    <option value="{{ $t }}">{{ $t }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input class="btn btn-dark btn-sm" name="submit" type="submit" value="Update">
                                    </form>
                                </td>
                                <td>
                                    @if($user->verified == 1)
                                        <a class="btn btn-warning btn-sm" href="{{ url('/admin/'.$user->id.'/disable') }}">Disable</a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{ url('/admin/'.$user->id.'/enable') }}">Enable</a>
                                    @endif
                                </td>
                                <td><a class="btn btn-danger btn-sm" href="">Delete</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
        <!-- /.container-fluid -->
@endsection
