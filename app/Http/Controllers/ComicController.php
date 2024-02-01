<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comic;

class ComicController extends Controller

{

    public function validation($data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'description' => 'required',
            'thumb' => 'required|url',
            'price' => 'required|numeric',
            'series' => 'required',
            'sale_date' => 'required|date',
            'type' => 'required',
        ])->validate();
    }

    public function index()
    {
        $comics = Comic::all();
        return view('comics.index', compact('comics'));
    }


    public function show($id)
    {
        $comic = Comic::find($id);
        return view('comics.show', compact('comic'));
    }

    public function create()
    {
        return view("comics.create");
    }




    public function edit(Comic $comic)
    {
        return view('comics.edit', compact('comic'));
    }

    public function update(Request $request, Comic $comic)
    {
        $data = $request->all();
        $dati_validati = $this->validation($data);

        $comic->update($dati_validati);

        return redirect()->route('comics.show', $comic->id);
    }


    public function search(Request $request)
    {
        
    }
    

}
