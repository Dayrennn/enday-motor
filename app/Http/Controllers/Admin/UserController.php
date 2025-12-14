
    <?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function index(Request $request)
        {
            // inisiasi
            $query = User::query();

            if ($request->filled('search')) { //memastikan search input ada dan memiliki nilai, bukan null atau string kosong
                $search = $request->input('search');
                $query->where('name', 'like', '%' . $search . '%');
            }

            $users = $query->paginate(5);

            return view('admin.user', compact('users'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|max:255|unique:users',
                'phone'     => 'required|string|max:20',
                'role'      => 'required|string|in:admin,owner,pegawai,kasir,pelanggan',
                'password'  => 'required|string|confirmed|min:6',
            ]);

            User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'role'      => $request->role,
                'password'  => Hash::make($request->password),
            ]);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
        }

        public function update(Request $request, User $user)
        {
            $request->validate([
                'name'     => 'required|string|max:255|unique:users,name,' . $user->id,
                'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone'    => 'required|string|max:20',
                'role'     => 'required|string|in:admin,owner,pegawai,kasir,pelanggan',
                'password' => 'nullable|string|confirmed|min:6',
            ]);

            $data = $request->only(['name', 'email', 'phone', 'role']);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
        }

        public function destroy(User $user)
        {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        }
    }
