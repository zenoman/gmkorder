<?php
namespace App\Http\Controllers\Auth;
use App\pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class PenggunaLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'pengguna';
    protected $redirectTo = '/';

    //===============================================================
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //===============================================================
    public function showLoginForm()
    {
        return view('auth.penggunaLogin');
    }

    //===============================================================
    public function guard()
    {
        return auth()->guard('pengguna');
    }

    //===============================================================
    public function showRegisterPage()
    {
        return view('auth.penggunaregister');
    }

    //===============================================================
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telp'=>'required',
            'email' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username'=>'required'
        ]);
        pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp'=>$request->telp,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('pengguna-login')->with('successmsg','Registrasi sukses silahkan login menggunakan akun baru anda');
    }

    //===============================================================
    public function login(Request $request)
    {
        if (auth()->guard('pengguna')->attempt(['username' => $request->username, 'password' => $request->password ])) {
            return redirect('/');
        }
        return back()->withErrors(['username' => 'Username or password are wrong.']);
    }
}