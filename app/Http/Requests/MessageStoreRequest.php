<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
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
            'withId'=> ['integer', 'exists:users,id'],
            'message'=> ['string', 'max:500'],
        ];
    }

    public function getParticipant()
    {
        return $this->withId;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
