<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
   public function index(): Response
   {
      $admins = User::query()
         ->where('is_admin', true)
         ->orderBy('name')
         ->get([
            'id',
            'name',
            'email',
            'created_at',
         ]);

      return Inertia::render('Admin/Admins/Index', [
         'admins' => $admins,
      ]);
   }

   public function create(): Response
   {
      return Inertia::render('Admin/Admins/Create');
   }

   public function store(Request $request): RedirectResponse
   {
      $validated = $request->validate([
      'name' => ['required', 'string', 'min:2', 'max:100'],
      'email' => ['required', 'email', 'max:255', 'unique:users,email'],
      'password' => [
         'required',
         'confirmed',
         Password::min(8),
      ],
      ], [
         'name.required' => 'Введіть ім’я адміністратора.',
         'name.string' => 'Ім’я адміністратора має бути текстом.',
         'name.min' => 'Ім’я адміністратора має містити щонайменше 2 символи.',
         'name.max' => 'Ім’я адміністратора не може містити більше 100 символів.',

         'email.required' => 'Введіть email.',
         'email.email' => 'Введіть коректну адресу електронної пошти.',
         'email.max' => 'Email не може містити більше 255 символів.',
         'email.unique' => 'Цей email вже використовується.',

         'password.required' => 'Введіть пароль.',
         'password.confirmed' => 'Паролі не збігаються.',
         'password.min' => 'Пароль має містити щонайменше 8 символів.',
      ]);

      $admin = User::create([
         'name' => $validated['name'],
         'email' => $validated['email'],
         'password' => $validated['password'],
      ]);

      $admin->is_admin = true;
      $admin->save();

      return redirect()
         ->route('admin.admins.index')
         ->with('success', 'Адміністратора успішно додано.');
   }

   public function edit(User $user): Response
   {
      abort_unless($user->is_admin, 404);

      return Inertia::render('Admin/Admins/Edit', [
         'admin' => $user->only([
            'id',
            'name',
            'email',
         ]),
      ]);
   }

   public function update(Request $request, User $user): RedirectResponse
   {
      abort_unless($user->is_admin, 404);

      $validated = $request->validate([
      'name' => ['required', 'string', 'min:2', 'max:100'],
      'email' => [
         'required',
         'email',
         'max:255',
         'unique:users,email,' . $user->id,
      ],
      'password' => [
         'nullable',
         'confirmed',
         Password::min(8),
      ],
      ], [
         'name.required' => 'Введіть ім’я адміністратора.',
         'name.string' => 'Ім’я адміністратора має бути текстом.',
         'name.min' => 'Ім’я адміністратора має містити щонайменше 2 символи.',
         'name.max' => 'Ім’я адміністратора не може містити більше 100 символів.',

         'email.required' => 'Введіть email.',
         'email.email' => 'Введіть коректну адресу електронної пошти.',
         'email.max' => 'Email не може містити більше 255 символів.',
         'email.unique' => 'Цей email вже використовується.',

         'password.confirmed' => 'Паролі не збігаються.',
         'password.min' => 'Пароль має містити щонайменше 8 символів.',
      ]);

      $user->name = $validated['name'];
      $user->email = $validated['email'];

      if (! empty($validated['password'])) {
         $user->password = $validated['password'];
      }

      $user->save();

      return redirect()
         ->route('admin.admins.index')
         ->with('success', 'Дані адміністратора оновлено.');
   }

   public function destroy(User $user): RedirectResponse
   {
      abort_unless($user->is_admin, 404);

      if ($user->id === Auth::id()) {
         return back()->with(
            'error',
            'Не можна видалити власний обліковий запис.'
         );
      }

      $adminsCount = User::query()
         ->where('is_admin', true)
         ->count();

      if ($adminsCount <= 1) {
         return back()->with(
            'error',
            'Не можна видалити останнього адміністратора.'
         );
      }

      $user->delete();

      return back()->with(
         'success',
         'Адміністратора успішно видалено.'
      );
   }
}