<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mendapatkan semua resource
        $news = News::all();

        if ($news) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $news
            ];
            // menampilkan kode data
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data is empty'
            ];
            return response()->json($data, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //menambahkan resource
        // $validateData = $request->validate([
        //     'title' => 'required',
        //     'author' => 'required',
        //     'description' => 'required',
        //     'content' => 'required',
        //     'url' => 'required',
        //     'url_image' => 'required',
        //     'published_at' => 'required',
        //     'category' => 'required',
        // ]);
        // dd(Carbon::now());
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'author' => 'required',
        //     'description' => 'required',
        //     'content' => 'required',
        //     'url' => 'required',
        //     'url_image' => 'required',
        //     'published_at' => 'required',
        //     'category' => 'required'
        // ]);
        $news = News::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'content' => $request->content,
            'url' => $request->url,
            'url_image' => $request->url_image,
            'published_at' => Carbon::now(),
            'category' => $request->category,
        ]);

        // menambahkan pesan dan kode

        // $data = [
        //     'message' => 'Resource is Added Succesfully',
        //     'data' => $news
        // ];

        // return response()->json($data, 201);
        $response = [
            'code' => 200,
            'message' => 'OK!',
            'data' => $news
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menambahkan resouce by detail
        $news = News::find($id);

        if ($news){
            $data = [
                'message' => 'Get Detail Resouce',
                'data' => $news
            ];
            // menampilkan respon kode
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not Found'
            ];
            // menampilkan kode respon
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //mengupdate data
        $news = News::find($id);

        if ($news) {
            $input = [
                'title' => $request->title?? $news->title,
                'author' => $request->author?? $news->author,
                'description' => $request->description?? $news->description,
                'content' => $request->content?? $news->content,
                'url' => $request->url?? $news->url,
                'url_image' => $request->url_image?? $news->url_image,
                'published_at' => $request->published_at?? $news->publised_at,
                'category' => $request->category?? $news->category
            ];

            $news->update($input);
            // menambahkan pesan dan kode json
            $data = [
                'message' => 'Resource is Update Successfully',
                'data' => $news
            ];
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => 'Resource not Found',
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus 1 data
        $news = News::find($id);

        if ($news) {
            $news->delete();

            // menambahkan pesan dan kode json
            $data = [
                'message' => 'Resource is Delete Successfully'
            ];
             return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not Found'
            ];
            return response()->json($data, 404);
        }
    }

    public function search($title) {
        // search by title
        $news = News::where("title",'LIKE', "%{$title}%")->get();
        // $filter_result = DB::table('table_name')

        // ->where('title', 'like', '%'.$title.'%')

        // ->get();

        // dd($filter_result);

        if (count($news)) {
            // menambahkan pesan dan kode json
            $data = [
                'message' => 'Get Searched Resouce',
                'data' => $news
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not Found'
            ];
            return response()->json($data, 404);
        }
    }

    // menapilkan data by kategoru sport
    public function sport()
    {
        $news = News::where("category","sport")->get();

        $data = [
            'message' => 'Get Sport Resource',
            'data' => $news,
        ];

        return response()->json($data, 200);
    }

    public function finance() {
        // menampilkan data dengan kategori finance
        $news = News::where("category","finance")->get();

        // menambahkan pesan dan kode json
        $data = [
            'message' => 'Get Finance Resource',
            'data' => $news
        ];
        return response()->json($data, 200);
    }

    public function automotive() {
        // menampilkan data dengan kategori sport
        $news = News::where("category","finance")->get();

        // menambahkan pesan dan kode json
        $data = [
            'message' => 'Get Automotive Resource',
            'data' => $news
        ];
        return response()->json($data, 200);
    }
}
