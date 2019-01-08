<?php

namespace App\Http\Controllers;

use App\Models\Menu;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('signed.menu.index', ['menus' => Menu::simplePaginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signed.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'type' => 'required'
        ]);

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->type = $request->type;
        $menu->created_by = $request->user()->id;
        $menu->save();

        return redirect()->route('index-menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        if (isset($menu)) {
            return view('signed.menu.edit', ['menu' => $menu]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'link' => 'required',
            'type' => 'required'
        ]);

        $menu = Menu::find($id);
        if(isset($menu)) {
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->type = $request->type;
            $menu->save();
        }

        return redirect()->route('index-menu');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (isset($menu)) {
            $menu->delete();
        }

        return redirect()->route('index-menu');
    }
}
