<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher; // Pastikan model Teacher sudah ada

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
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'guru';
        $user->save();

        // Buat data guru
        $teacher = new Teacher();
        $teacher->nip = $request->nip;
        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->user_id = $user->id;

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
        $user = $teacher->user;

        // Validasi data yang diterima
        $request->validate([
            'nip' => 'required|string|max:20|unique:teachers,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers')->ignore($teacher->id),
                Rule::unique('users')->ignore($user->id),
            ],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Hapus foto lama jika ada dan upload foto baru jika ada
        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $teacher->photo = $request->file('photo')->store('photos', 'public');
        }

        // Update data guru
        $teacher->nip = $request->nip;
        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;

        // Update email dan nama pengguna yang terkait
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password baru diisi, update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan pada pengguna dan guru
        $user->save();
        $teacher->save();

        // Debugging: Cek apakah data sudah diperbarui
        Log::info('User  updated:', ['user' => $user]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('panel.teacher.index')->with('success', 'Guru berhasil diperbarui.');
    }

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
        $user = $teacher->user;
        if ($user) {
            $user->delete();
        }

        // Hapus guru
        $teacher->delete();

        return redirect()->route('panel.teacher.index')->with('success', 'Guru dan akun pengguna berhasil dihapus.');
    }
}
