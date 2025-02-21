<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'comment_text' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // Return the first validation error
                'status_code' => 422,
            ], 200)
        );
    }
}
