<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        return match($routeName){
            'auth.login' => $this->getLoginRules(),
            'auth.register' => $this->getRegisterRules(),
            'employee.store' => $this->getEmployeeSaveRules(),
            'employee.update' => $this->getEmployeeUpdateRules(),
            default => [],
        };
    }

    public function getLoginRules(){
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function getRegisterRules(){
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8']
        ];
    }

    public function getEmployeeSaveRules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'department_id' => ['required', 'exists:departments,id']
        ];
    }

    public function getEmployeeUpdateRules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ];
    }
}
