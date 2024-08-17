<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegaraRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'id_kawasan' => 'required|exists:kawasan,id_kawasan', // Memastikan 'id_kawasan' wajib diisi dan ada di tabel 'kawasan'
      'id_direktorat' => 'required|exists:direktorat,id_direktorat', // Memastikan 'id_direktorat' wajib diisi dan ada di tabel 'direktorat'
      'nama_negara' => 'required|string|max:100', // Memastikan 'nama_negara' wajib diisi, berupa string, dan maksimal 100 karakter
      'kode_negara' => 'required|string|max:2', // Memastikan 'kode_negara' wajib diisi, berupa string, maksimal 2 karakter       
    ];
  }


  /**
   * Get custom messages for validator errors.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'id_kawasan.required' => 'ID kawasan wajib diisi.',
      'id_kawasan.exists' => 'ID kawasan tidak valid.',
      'id_direktorat.required' => 'ID direktorat wajib diisi.',
      'id_direktorat.exists' => 'ID direktorat tidak valid.',
      'nama_negara.required' => 'Nama negara wajib diisi.',
      'nama_negara.string' => 'Nama negara harus berupa string.',
      'nama_negara.max' => 'Nama negara maksimal 100 karakter.',
      'kode_negara.required' => 'Kode negara wajib diisi.',
      'kode_negara.string' => 'Kode negara harus berupa string.',
      'kode_negara.max' => 'Kode negara maksimal 2 karakter.',
    ];
  }
}
