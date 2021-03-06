<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $redirects;
    public function login(Request $request)
    {
        $phoneNo =  $request->input('phoneNo');
        $password =  $request->input('password');
        if (empty($phoneNo) || empty($password)) {
            return back()->withInput()->with('danger', 'please fill all fields');
        }
        if (Auth::attempt(['phone_no' => $phoneNo, 'password' => $password])) {
            return $this->redirects();
        }
        return back()->withInput()->with('danger', 'invalid phone number of password');
    }
    public static function redirects()
    {
        $role = Auth::user()->role;
        if ($role == 'Administrator') {
            return redirect('AdministrationPanel');
        } else {
            return redirect('/');
        }
    }

    public function register(Request $request)
    {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $location = $request->input('location');
        $phoneNo = $request->input('phoneNo');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        if (empty($fname) || empty($lname) || empty($location) || empty($phoneNo) || empty($password) || empty($password_confirmation)) {
            return back()->withInput()->with('danger', 'please fill all fields');
        }
        if (!$this->validatePhoneNumber($phoneNo)) {
            return back()->withInput()->with('danger', 'invalid phone number');
        }
        if (strlen($password) < 8) {
            return back()->withInput()->with('danger', 'password must be at least 8 characters');
        }
        if ($password !== $password_confirmation) {
            return back()->withInput()->with('danger', 'password confirmation does not match');
        }
        $checkPhone = User::where('phone_no', $phoneNo)->exists();
        if ($checkPhone) {
            return back()->withInput()->with('danger', 'the telephone number provided has already been registered');
        }

        //save a patient
        $user = User::create([
            'fname' => $fname,
            'lname' => $lname,
            'phone_no' => $phoneNo,
            'role' => 'user',
            'password' => Hash::make($password)
        ]);
        if ($user) {
            Auth::login($user);

            return redirect('/');
        }
    }
    function validatePhoneNumber($telNo)
    {
        $number = filter_var($telNo, FILTER_SANITIZE_NUMBER_INT);
        if (strlen($number) < 12) {
            return false;
        } else {
            return true;
        }
    }
}
