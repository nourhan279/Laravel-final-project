<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Reg_Users;

class RegController extends Controller
{
    
    public function create()
    {
        $lang = session('locale', 'en'); // get locale from session, default to 'en'

        if ($lang === 'ar') {
            return view('Arabic_form'); // Arabic form view
        } else {
            return view('English_form'); // English form view
        }
    }
   
    // //validations
 
    public function store(Request $request)
    {
        $lang = session('locale', 'en');
        $messages_en = [
            'full_name.required' => 'Full name is required.',
            'full_name.regex' => 'Full name must not contain numbers.',
            'user_name.required' => 'Username is required.',
            'password_confirmation.required' => 'Please confirm your password.',
            'phone.required' => 'Phone number is required.',
            'country.required' => 'Country is required.',
            'city.required' => 'City is required.',
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
            'user_name.unique' => 'This username is already taken.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered ,Choose another',
            'phone.regex' => 'Phone must be digits and may start with +.',
            'whatsapp.required' => 'WhatsApp number is required.',
            'whatsapp.regex' => 'WhatsApp must be digits and can start with +.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least 1 number and 1 special character.',
            'password_confirmation.same' => 'Passwords donot match.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be a jpeg, png, or jpg.',
            'image.max' => 'Image size must not exceed 2MB.',

        ];

            $messages_ar = [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.regex' => 'يجب ألا يحتوي الاسم الكامل على أرقام.',
            'user_name.required' => 'اسم المستخدم مطلوب.',
            'user_name.unique' => 'هذا الاسم مستخدم بالفعل.',
            'country.required' => 'الدولة مطلوبة.',
            'city.required' => 'المدينة مطلوبة.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحًا.',
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقًا.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'يجب أن يكون رقم الهاتف أرقامًا وقد يبدأ بـ +.',
            'whatsapp.required' => 'رقم الواتساب مطلوب.',
            'whatsapp.regex' => 'يجب أن يكون رقم الواتساب أرقامًا وقد يبدأ بـ +.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل وحرف خاص.',
            'password_confirmation.required' => 'يرجى تأكيد كلمة المرور.',
            'password_confirmation.same' => 'كلمتا المرور غير متطابقتين.',
            'image.image' => 'يجب أن يكون الملف المرفوع صورة.',
            'image.mimes' => 'يجب أن تكون الصورة من نوع jpeg، png، أو jpg.',
            'image.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميجابايت.',

        ];

        $messages = ($lang == 'ar') ? $messages_ar : $messages_en;

        
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'regex:/^[^\d]+$/'],
            'user_name' => 'required|string|unique:laravel_users,user_name',
            'country' => 'required|string',
            'city' => 'required|string',
            'email' => 'required|email|unique:laravel_users,email',
            'phone' => ['required', 'regex:/^\+?\d+$/'],
            'whatsapp' => ['required', 'regex:/^\+?\d+$/'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*\d)(?=.*[!@#$%^&*?]).+$/'],
            'password_confirmation' => 'required|same:password',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ], $messages);

           // Handle image upload if present
        $imagePath = null;
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('uploads', 'public');
        }


        // Encrypt password and save user (example)
        Reg_Users::create([
            'full_name' => $validated['full_name'],
            'user_name' => $validated['user_name'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'],
            'password' => Hash::make($validated['password']),
            'user_image' => $imagePath,

        ]);

        $successMsg = ($lang == 'ar') ? 'تم التسجيل بنجاح!' : 'User registered successfully!';
        return redirect()->back()->with('success', $successMsg);
    }
    public function show(Reg_Users $reg_Users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reg_Users $reg_Users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reg_Users $reg_Users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reg_Users $reg_Users)
    {
        //
    }
}
