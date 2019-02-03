<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

use PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            return redirect(route('index-user') . '?sort=desc');
        }

        $users = new User();

        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        } else {
            $key = '';
        }

        if ($key == 'confirmation') {
            $users = $users->where([
                'active' => 0
            ]);
        }

        if ($key == 'active') {
            $users = $users->where([
                'active' => 1
            ]);
        }

        $users = $users->orderBy('created_at', $sort)->simplePaginate(5);

        return view('signed.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            abort(404);
        }

        $hide_header = true;
        $articles = Article::where('created_by', '=', $id)->simplePaginate(5);
        return view('profile', ['user' => $user, 'articles' => $articles, 'hide_header' => $hide_header]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('signed.user.edit', ['user' => $user]);
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
            'email' => 'required|unique:users'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        return redirect()->route('profile-user', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmation_yes($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $user->active = 1;
        $user->update();

        return redirect()->route('index-user');
    }

    public function confirmation_no($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $user->active = 0;
        $user->update();

        return redirect()->route('index-user');
    }

    public function onesignal_id(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $user = $request->user();
        $user->onesignal_id = $request->id;
        $user->update();

        return response()->json([
            'status' => 'ok',
        ]);

    }

    public function pdf($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        PDF::SetAutoPageBreak(TRUE);
        PDF::SetTitle($user->name);
        PDF::AddPage();

        $html = '<h1 style="text-align:center;">TATAR SUNDA <br></h1>';
        $html .= '
            <div style="text-align:center;">
                <img src="' . public_path() . '/uploads/images/' . $user->detail->avatar . '" width="150" height="150" alt="">
            </div>
        ';
        $html .= '<br> <table align="center" >';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Nama</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->name) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Email</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->email) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">No. Induk</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->no_induk) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Tempat</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->location) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Tanggal Lahir</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->date_of_birth) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $gender = '';
        if ($user->detail->gender == 1) {
            $gender = 'Pria';
        } else {
            $gender = 'Wanita';
        }
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Jenis Kelamin</td>
            <td width="10">:</td>
            <td> ' . ucfirst($gender) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Agama</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->religion->name) . ' </td>
        </tr>';
        $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Alamat</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->the_village) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Kecamatan</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->sub_district) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Provinsi/Kota/Kab</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->pkb) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Kode Pos</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->zip_code) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Pekerjaan</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->job) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Lulusan</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->graduates) . ' </td>
        </tr>';
         $html .= '<tr><td></td></tr>';
        $html .= '<tr>
            <td width="160"></td>
            <td width="100" align="left">Kontak</td>
            <td width="10">:</td>
            <td> ' . ucfirst($user->detail->contact) . ' </td>
        </tr>';
        $html .= '</table>';

        PDF::WriteHTML($html);
        PDF::Output($user->name . '.pdf');
    }
}
