<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $adverts = Advert::with('user')->paginate(5);
        return view('pages.advert.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {

            $advert = new Advert;
            $method = 'post';
            $value = "Create";
            return view('pages.advert.edit', compact('method', 'value', 'advert'));
        } else return redirect()->route('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'title' => ['required', 'min:10'],
            'description' => ['required', 'min:25', 'max:2500',],
            'image_patch' => ['required', 'max:2500', 'mimes:jpg,jpeg,png']

        ]);
        $imageName = time() . '-' . $request->title . '.' . $request->image_patch->extension();
        $request->image_patch->move(storage_path('app/images'), $imageName);

        $data['user_id'] = Auth::id();
        $data['image_patch'] = 'images/' . $imageName;
        $advert = Advert::create($data);

        return redirect()->route('show', $advert->id)
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $advert = Advert::find($id);
        return view('pages.advert.showOne', compact('advert'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        if ($this->authorize('update', $advert)) {

            $method = 'PUT';
            $value = "Edit";
            return view('.pages.advert.edit', compact('advert', 'method', 'value'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert)
    {
        if ($this->authorize('update', $advert)) {
            $data = $request->validate([
                'title' => ['required', 'min:10'],
                'description' => ['required', 'min:25', 'max:2500'],

            ]);

            $data['user_id'] = Auth::id();
            $advert->update($data);

            return redirect()->route('show', $advert->id)
                ->with('success', 'Advert updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */


    public function destroy(Advert $advert)
    {
        if ($this->authorize('delete', $advert)) {
            $advert->delete();
            return redirect()->route('index', Auth::id())
                ->with('success', 'Product deleted successfully.');
        }
    }

    public function searchByUser($id)
    {
        $adverts = Advert::with('user')->where('user_id', $id)->paginate(5);
        return view('pages.advert.index', compact('adverts'));

    }
}
