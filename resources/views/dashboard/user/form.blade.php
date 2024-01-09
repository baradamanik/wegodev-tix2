@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Users</h3>
                </div>
                <div class="col-4 text-right">
                <button class="btn btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                    <!-- Tambahkan konten di sini sesuai kebutuhan -->
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route('dashboard.users.update', ['id' =>$user->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old($user->email) ?? $user->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary button-spacing ">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>Anda yakin ingin menghapus user {{ $user->name }}</p>
            </div>

            <div class="modal-footer">
                <form action="{{ route('dashboard.users.delete', ['id' =>$user->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
