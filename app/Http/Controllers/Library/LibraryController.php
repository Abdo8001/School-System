<?php

namespace App\Http\Controllers\Library;
use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;
use  App\Interface\Library\LibraryRepositoryInterface;

class LibraryController extends Controller
{

    protected $library;

    public function __construct(LibraryRepositoryInterface $library){

        return $this->library=$library;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->library->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->library->create();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title_ar'=>'required|max:255',
            'title_en'=>'required|max:255',
            'Classroom_id'=>'required',
            'section_id'=>'required',
            'file_name'=>'required',

        ]);
        return $this->library->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->library->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
        $request->validate([
            'title_ar'=>'required|max:255',
            'title_en'=>'required|max:255',
            'Classroom_id'=>'required',
            'section_id'=>'required',

        ]);
        return $this->library->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request )
    {
        return $this->library->destroy($request);

    }
    public function downloadFile($file){

        return $this->library->download($file);
    }
}
