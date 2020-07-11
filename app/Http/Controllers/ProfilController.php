<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profil;
use Validator;
use Image;
use Storage;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('profil.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'tempat_lahir' => ['nullable', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'boolean'],
            'akun_github' => ['nullable', 'max:255'],
            'user_img' => ['sometimes', 'image'],
        ]);

        //error handler message
        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        //name
        $user_updated = User::findOrFail($id);
        $user_updated->name = $request->name;
        $user_updated->update();

        //considering update or create new profil
        if ($user_updated->profil === null) {
            $profil = new Profil([
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'akun_github' => $request->akun_github,
                'user_id' => $user_updated->id,
                'user_img' => $this->handleUserImg($request, $user_updated, true)
            ]);
            $user_updated->profil()->save($profil);
        } else {
            $user_updated->profil->update([
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'akun_github' => $request->akun_github,
                'user_img' => $this->handleUserImg($request, $user_updated, false)
            ]);
        }

        return back()->withToastSuccess('Profil Telah Diupdate!');
    }

    public function handleUserImg($request, $user_updated, $isFirstTimeCreate)
    {
        $filename = '';

        if ($request->hasFile('user_img')) {
            $image = $request->file('user_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->save($location);

            if ($isFirstTimeCreate) {
                return $filename;
            } else {
                $oldFIleName = $user_updated->profil->user_img;
                Storage::delete($oldFIleName);
                return $filename;
            }
        }
    }
}
