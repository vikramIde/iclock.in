<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PaymentRequest extends Request
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
        $rules = array(
            
                       'invoiceid'=>'required',
                       'comment'=>'required'
                       );

        foreach($this->request->get('recieved_amount') as $key => $val)
                      {
                        $rules['recieved_amount.'.$key] = "required|regex:/^\d*(\.\d{1,4})?$/";
                      }
        foreach($this->request->get('ref_no') as $key => $val)
                      {
                        $rules['ref_no.'.$key] = "required";
                      }
        foreach($this->request->get('date') as $key => $val)
                      {
                        $rules['date.'.$key] = "required";
                      }


        return $rules;


    }

    public function messages()
      {
        $messages = [];

        foreach($this->request->get('recieved_amount') as $key => $val)
                      {
                        $messages['recieved_amount.'.$key.'.max'] = 'The field labeled "Amount'.$key.'" must be a Number';
                      }
        foreach($this->request->get('ref_no') as $key => $val)
                      {
                        $rules['ref_no.'.$key] = 'The field labeled "Refrence Number'.$key.'" must be a added for every payment';
                      }
        foreach($this->request->get('date') as $key => $val)
                      {
                        $rules['date.'.$key] = 'The field labeled "Payment Date'.$key.'" must be a added for every payment';
                      }

        return $messages;

      }
}
