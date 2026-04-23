<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya user yang sudah login yang diizinkan membuat tiket
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->title ? trim($this->title) : null,
            'description' => $this->description ? trim($this->description) : null,
            'priority' => $this->priority ?? 'medium',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'min:20',
            ],
            'priority' => [
                'required',
                'in:low,medium,high',
            ],
            'category' => [
                'nullable',
                'strzing',
                'max:100',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul tiket wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.min' => 'Judul minimal :min karakter.',
            'title.max' => 'Judul maksimal :max karakter.',
            
            'description.required' => 'Deskripsi tiket wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.min' => 'Deskripsi minimal :min karakter agar permasalahan jelas.',
            
            'priority.required' => 'Silakan pilih prioritas tiket.',
            'priority.in' => 'Prioritas yang dipilih tidak valid. Pilih: Low, Medium, atau High.',
            
            'category.string' => 'Kategori harus berupa teks.',
            'category.max' => 'Kategori maksimal :max karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'judul tiket',
            'description' => 'deskripsi',
            'priority' => 'prioritas',
            'category' => 'kategori',
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'description' => strip_tags($this->description),
        ]);
    }
}