<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class profileController extends Controller
{

    public function index($encryptedId)
    {
        $id = decrypt($encryptedId);
        $profile = User::findOrFail($id);
        return view('pages.profile.index', compact('profile'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string','unique:users,nip,' . $id],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:users,email,' . $id],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);



        $profile = User::findOrFail($id);
        $dataId = $profile->find($profile->id);
        $data = $request->all();
        if ($request->image) {
            Storage::delete('public/' . $dataId->image);
            $data['image'] = $request->file('image')->store('asset/profile', 'public');
        }

        $dataId->update($data);

        if ($dataId) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data Gagal Diupdate', 'error');
        }
        return back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed', 'string'],
        ]);

        $user = auth()->user();
        $current_password = $request->input('current_password');

        if (password_verify($current_password, $user->password)) {
            $user->update([
                'password' => password_hash($request->input('password'), PASSWORD_DEFAULT)
            ]);

            toast('Password berhasil diupdate', 'success');
        } else {
            toast('Password saat ini tidak sesuai', 'error');
        }

        return redirect()->route('profile.index', encrypt(auth()->user()->id));
    }
}
