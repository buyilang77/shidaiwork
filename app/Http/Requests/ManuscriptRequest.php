<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManuscriptRequest extends FormRequest
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
            'media_id'     => 'required|integer',
            'title'        => 'required|string',
            'content'      => 'string|nullable',
            'article_link' => 'url|nullable',
            'customer'     => 'string|nullable',
            'file_list'    => 'array|nullable',
            'remark'       => 'string|nullable',
            'source'       => 'string|nullable',
            'member_id'    => 'integer|nullable',
            'channel_id'   => 'integer|nullable',
            'is_review'    => 'boolean',
            'thumbnail'    => 'string|nullable',
            'status'       => 'integer|nullable',
        ];
    }
}
