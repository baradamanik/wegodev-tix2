<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $q = $request->input('q');

        $active = 'Movies';

        $movies = $movies->when($q, function($query) use ($q) {
                    return $query->where('name', 'like', '%' .$q. '%')
                                 ->orwhere('email', 'like', '%' .$q. '%');
                })
        
        ->paginate(10);
        return view('dashboard/Movie/list', [
            'movies' => $movies,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Movies';
        return view('dashboard/Movie/form', [
            'active' => $active
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:App\Models\Movie,title',
            'description'   => 'required',
            'thumbnail'     => 'required|image'
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.movies.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $movie = new Movie(); // Tambahkan ini untuk membuat objek Movie
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/movie', $image, $filename);
    
            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->thumbnail = $filename; // Ganti dengan nama file yang baru diupload
            $movie->save();
    
            return redirect()->route('dashboard.movies');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
        $active = 'Movies';
        return view('dashboard/Movie/form', [
            'active' => $active,
            'movie'  =>$movie,
            'button' =>'Update',
            'url'    =>'dashboard.movies.update'   
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:App\Models\Movie,title,'.$movie->id,
            'description'   => 'required',
            'thumbnail'     => 'image'
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.movies.update', $movie->id)
                ->withErrors($validator)
                ->withInput();
        } else {
           //  $movie = new Movie(); // Tambahkan ini untuk membuat objek Movie
                if($request->hasFile('thumbnail')){  
                    $image = $request->file('thumbnail');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                        Storage::disk('local')->putFileAs('public/movie', $image, $filename);
                    $movie->thumbnail = $filename; // Ganti dengan nama file yang baru diupload
                }
            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->save();
    
            return redirect()->route('dashboard.movies');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
