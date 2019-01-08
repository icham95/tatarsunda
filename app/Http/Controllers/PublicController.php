<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Article;

class PublicController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_bawah = Menu::where('type', '=', 1)->orderBy('name', 'asc')->get();

        $kuliners = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 1);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $tokohs = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 2);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $ai = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 3);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $du = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 4);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $ij = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 5);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $meseum = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 6);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $pariwisata = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 7);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $sdo = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 8);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        $sb = Article::whereHas('article_categories', function($query) {
            $query->where('category_id', '=', 9);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->limit(2)->get();

        return view('welcome', [
            'menu_bawah' => $menu_bawah,
            'tokohs' => $tokohs,
            'kuliners' => $kuliners,
            'ais' => $ai,
            'dus' => $du,
            'ijs' => $ij,
            'meseums' => $meseum,
            'pariwisatas' => $pariwisata,
            'sdos' => $sdo,
            'sbs' => $sb,
        ]);
    }

    public function page($name)
    {
        $menu_bawah = Menu::where('type', '=', 1)->orderBy('name', 'asc')->get();
        $id = 1;
        if ($name == 'kuliner') {
            $id = 1;
        }

        if ($name == 'tokoh') {
            $id = 2;
        }

        if ($name == 'adat-istiadat') {
            $id = 3;
        }

        if ($name == 'direktori-usaha') {
            $id = 4;
        }

        if ($name == 'info-jabar') {
            $id = 5;
        }

        if ($name == 'museum') {
            $id = 6;
        }

        if ($name == 'pariwisata') {
            $id = 7;
        }

        if ($name == 'sanggar-dan-organisasi') {
            $id = 8;
        }

        if ($name == 'seni-budaya') {
            $id = 9;
        }

        $items = Article::whereHas('article_categories', function($query) use ($id) {
            $query->where('category_id', '=', $id);
        })->where('status', '=', 1)->orderBy('created_at', 'desc')->paginate(5);

        return view('page', [
            'category' => $name,
            'menu_bawah' => $menu_bawah,
            'items' => $items,
        ]);
    }

    public function article($id)
    {
        $menu_bawah = Menu::where('type', '=', 1)->orderBy('name', 'asc')->get();
        return view('single', [
            'article' => Article::find($id),
            'menu_bawah' => $menu_bawah
        ]);
    }
}
