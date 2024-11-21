<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Teacher; // Pastikan model Teacher sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all(); // Mengambil semua data guru
        return view('backend.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:20|unique:teachers',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed', // Validasi untuk password
        ]);

        // Buat pengguna baru
        $user = new User();
        $user->name = $request->name; // Nama sama dengan guru
        $user->email = $request->email; // Email sama dengan guru
        $user->password = bcrypt($request->password); // Enkripsi password
        $user->role = 'guru'; // Set role sebagai guru
        $user->save();

        // Buat data guru
        $teacher = new Teacher();
        $teacher->nip = $request->nip;
        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->user_id = $user->id; // Hubungkan dengan user yang baru dibuat

        // Upload photo if exists
        if ($request->hasFile('photo')) {
            $teacher->photo = $request->file('photo')->store('photos', 'public');
        }

        $teacher->save();

        return redirect()->route('panel.teacher.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('backend.teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('backend.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan guru berdasarkan ID
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user; // Ambil pengguna yang terkait

        // Validasi data yang diterima
        $request->validate([
            'nip' => 'required|string|max:20|unique:teachers,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers')->ignore($teacher->id), // Mengabaikan validasi unik untuk email yang sama
                Rule::unique('users')->ignore($user->id), // Mengabaikan validasi unik untuk email pengguna yang sama
            ],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:8|confirmed', // Validasi password
        ]);

        // Hapus foto lama jika ada dan upload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            // Upload foto baru
            $teacher->photo = $request->file('photo')->store('photos', 'public');
        }

        // Update data guru
        $teacher->nip = $request->nip;
        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email; // Update email guru

        // Update email pengguna yang terkait
        $user->email = $request->email; // Update email pengguna

        // Jika password baru diisi, update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Enkripsi password baru
        }

        // Simpan perubahan pada pengguna dan guru
        $user->save(); // Simpan perubahan pada pengguna
        $teacher->save(); // Simpan perubahan pada guru

        return redirect()->route('panel.teacher.index')->with('success', 'Guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Hapus foto jika ada
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        // Hapus pengguna yang terkait
        $user = $teacher->user; // Ambil pengguna yang terkait
        if ($user) {
            $user->delete(); // Hapus pengguna
        }

        // Hapus guru
        $teacher->delete();

        return redirect()->route('panel.teacher.index')->with('success', 'Guru dan akun pengguna berhasil dihapus.');
    }
}
