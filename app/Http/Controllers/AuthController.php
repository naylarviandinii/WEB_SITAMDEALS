public function showLogin()  { return view('auth.login'); }
public function showRegister() { return view('auth.register'); }

public function login(Request $request) {
    $user = User::where('email', $request->email)->first();
    if (!$user || $user->password !== $request->password) {
        return back()->withErrors(['email' => 'Email atau password salah']);
    }
    session(['user' => $user->toArray()]);
    return match($user->role) {
        'admin'  => redirect('/admin/dashboard'),
        'kasir'  => redirect('/admin/orders'),
        default  => redirect('/'),
    };
}

public function logout() {
    session()->forget('user');
    return redirect('/login');
}

public function register(Request $request) {
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);
    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => $request->password,
        'role'     => 'pembeli',
    ]);
    return redirect('/login')->with('success', 'Registrasi berhasil!');
}