<?php

namespace App\Http\Requests;

use App\Services\FeedService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    private FeedService $feedService;

    public function __construct(FeedService $feedService, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->feedService = $feedService;
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'url' => 'required|string'
        ];
    }

    public function withValidator(Validator $validator) {
        $validator->after(function ($validator) {
            $url = $validator->getData()['url'];
            if (!$url || !$this->feedService->validateUrl($url))
                $validator->errors()->add('url', 'Entered url is not a valid RSS');
        });
    }
}
