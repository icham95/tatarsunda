<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleCategory;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sort = 'desc';
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            return redirect(route('index-article') . '?sort=desc');
        }

        $articles = new Article();
        $user = auth()->user();

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        } else {
            $key = '';
        }

        if ($key == '') {
            $articles = $articles->where([
                'created_by' => $user->id,
            ]);
        }

        if ($key == 'draft') {
            $articles = $articles->where([
                'status' => 5,
                'created_by' => $user->id
            ]);
        }

        if ($key == 'send') {
            $articles = $articles->where([
                'status' => 4,
                'created_by' => $user->id
            ]);
        }

        if ($key == 'rejected') {
            $articles = $articles->where([
                'status' => 3,
                'created_by' => $user->id
            ]);
        }

        if ($key == 'published') {
            $articles = $articles->where([
                'status' => 1,
                'created_by' => $user->id
            ]);
        }

        if ($key == 'confirmation') {
            if (auth()->user()->role != 1) {
                abort(404);
            }
            $articles = $articles->where([
                'status' => 4,
            ]);
        }

        if ($key == 'not_approved') {
            if (auth()->user()->role != 1) {
                abort(404);
            }
            $articles = $articles->where([
                'status' => 3,
            ]);
        }

        if ($key == 'publish') {
            if (auth()->user()->role != 1) {
                abort(404);
            }
            $articles = $articles->where([
                'status' => 1,
            ]);
        }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $articles = $articles->where('title', 'like', '%' . $search . '%');
        }



        $articles = $articles->orderBy('created_at', $sort)
                        ->simplePaginate(5);

        return view('signed.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signed.article.create', [
            'categories' => Category::get()
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
        if (isset($_POST['send']) || isset($_POST['draft'])) {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
            ]);

            $status = 0;
            if (isset($_POST['send'])) {
                $status = 4;
            }
            if (isset($_POST['draft'])) {
                $status = 5;
            }

            $article = new Article;
            $article->title = $request->title;
            $article->content = $request->content;
            $article->status = $status;
            $article->created_by = $request->user()->id;
            $article->save();

            if (isset($request->categories)){
                foreach ($request->categories as $key => $value) {
                    $articleCategory = ArticleCategory::create([
                        'article_id' => $article->id,
                        'category_id' => $value
                    ]);
                }
            }
        }

        return redirect()->route('index-article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('signed.article.show', ['article' => Article::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if (isset($article)) {
            return view('signed.article.edit', [
            'categories' => Category::get(),
            'article' => $article
        ]);
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
            'title' => 'required',
            'content' => 'required',
        ]);

        $article = Article::find($id);

        if(isset($article)) {
            $article->title = $request->title;
            $article->content = $request->content;
            $article->update();
        }

        if (isset($request->categories)){
            ArticleCategory::where('article_id', '=', $article->id)->delete();
            foreach ($request->categories as $key => $value) {
                $articleCategory = ArticleCategory::create([
                    'article_id' => $article->id,
                    'category_id' => $value
                ]);
            }
        }

        return redirect()->route('index-article');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (isset($article)) {
            $article->delete();
        }

        return redirect()->route('index-article');
    }

    public function storeImage(Request $request)
    {
        $user = auth()->user();
        $file = $request->file;
        $extension = $file->getClientOriginalExtension();
        $filename = md5($user->id . time()) . '.' . $extension;
        $path = public_path() . '/uploads/images';
        $upload = $file->move($path, $filename);

        return json_encode(['location' => $filename]);
    }

    public function publish($id)
    {
        if (auth()->user()->role != 1) {
            abort(404);
        }

        $article = Article::find($id);
        $article->status = 1;
        $article->update();

        return redirect(route('index-article') . '?sort=desc&key=confirmation');
    }

    public function reject($id)
    {
        if (auth()->user()->role != 1) {
            abort(404);
        }

        $article = Article::find($id);
        $article->status = 3;
        $article->update();

        return redirect(route('index-article') . '?sort=desc&key=confirmation');
    }

    public function confirm($id)
    {
        $article = Article::find($id);
        $article->status = 4;
        $article->update();

        if (auth()->user()->role == 1) {
            return redirect(route('index-article'));
        } else {
            return redirect(route('index-article') . '?sort=desc&key=rejected');
        }
    }
}
