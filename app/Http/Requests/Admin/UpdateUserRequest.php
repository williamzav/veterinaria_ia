<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name'               => ['required', 'string', 'max:255'],
            'email'              => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'role'               => ['required', 'in:administrador,veterinario'],
            'activo'             => ['nullable', 'boolean'],
            'password'           => ['nullable', 'string', 'min:8', 'confirmed'],
            'especialidad'       => ['nullable', 'string', 'max:255'],
            'cedula_profesional' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'El nombre es obligatorio.',
            'email.required'     => 'El correo es obligatorio.',
            'email.unique'       => 'Este correo ya está registrado por otro usuario.',
            'role.required'      => 'Selecciona un rol.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
