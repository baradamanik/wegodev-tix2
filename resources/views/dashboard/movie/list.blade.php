@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>
                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.movies') }}"> 
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <th>{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                        <td>{{ $movie->name }}</td>
                        <td>{{ $movie->email }}</td>
                        <td>{{ $movie->created_at }}</td>
                        <td>{{ $movie->updated_at }}</td>
                        <td><a href="{{ route('dashboard.movies.edit', ['id' =>$movie->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $movies->links() }}
        </div>
    </div>
@endsection
 