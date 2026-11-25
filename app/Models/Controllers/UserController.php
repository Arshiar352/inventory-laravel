<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        $birthDateCarbon = Carbon::parse($user->birth_date);

        $birthDate = $birthDateCarbon
            ->toJalali()
            ->format('Y/m/d');

        $age = (int) $birthDateCarbon->diffInYears(now());

        return view('profile', compact('user', 'birthDate', 'age'));
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'birth_date' => 'required|jdate:Y/m/d',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['birth_date'] = Verta::parse(
            $validated['birth_date']
        )->toCarbon()->format('Y-m-d');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $validated['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profile-pictures', 'public');
        }

        $user->update($validated);

        return redirect()
            ->route('profile')
            ->with('success', 'پروفایل با موفقیت ویرایش شد.');
    }
}
