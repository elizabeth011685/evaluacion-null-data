<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
            'nombre' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s+[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+){1,5}(?<!\s)$/', 'max:255'],
            'email' => ['required','string','unique:empleados', 'email:rfc,dns', 'max:50'],
            'puesto' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date_format:d/m/Y'],
            'domicilio' => ['required', 'string','max:500'],
            'domicilio_url' => ['required','string', 'max:150'],
            'domicilio_coordenadas' => ['required','regex:/^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)))([,]\s?)+(\-?([0-9]{1,2}(\.\d+)?|1[0-7][0-9](\.\d+)?|180))$/'],
            'skills.data' => ['required','array'],
            'skills.data.*.skill' => ['required','string','max:250'],
            'skills.data.*.evaluacion' => ['required','integer','min:1','max:5']
        ];
    }
    ///^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)))([,]\s?)+(\-?([0-9]{1,2}(\.\d+)?|1[0-7][0-9](\.\d+)?|180))$/

    public function attributes()
    {
        $attributes =  [
            'nombre' => 'nombre del empleado',
            'email' => 'email del empleado',
            'puesto' => 'puesto del empleado',
            'fecha_nacimiento' => 'fecha_nacimiento del empleado',
            'domicilio' => 'domicilio del empleado',
            'domicilio_url' => 'url del domicilio del empleado',
            'domicilio_coordenadas' => 'coordenadas del domicilio del empleado',
            'skills' => 'skill para el empleado',
            'skills.data' => 'skill para el empleado',
        ];

        if($this->get('skills') && key_exists("data", $this->get('skills')))
        {
            foreach ($this->get('skills')["data"] as $key => $value) {
                $attributes['skills.data.'.$key.'.evaluacion'] = "La evaluación del skill #".($key + 1)." del empleado";
                $attributes['skills.data.'.$key.'.skill'] = "La descripción del skill #".($key + 1)." del empleado";
            }
        }

        return $attributes;
    }

    public function messages()
    {
        $messages = [
            'nombre.required' => "El :attribute es obligatorio",
            'nombre.regex' => "El :attribute sólo debe contener letras y tener al menos un apellido",
            'email.required' => "El :attribute es obligatorio",
            'email.email' => "El :attribute debe tener un formato válido",
            'email.unique' => "El :attribute ingresado corresponde a otro empleado registrado previamente",
            'puesto.required' => "El :attribute es obligatorio",
            'fecha_nacimiento.required' => "La :attribute es obligatoria",
            'fecha_nacimiento.date_format' => "La :attribute debe tener un formato de dd/mm/YYYY",
            'domicilio.required' => "El :attribute es obligatorio",
            'domicilio_url.required' => "La :attribute es obligatorio",
            'domicilio_url.regex' => "La :attribute debe tener un formato válido",
            'domicilio_coordenadas.required' => "Las :attribute son obligatorias",
            'domicilio_coordenadas.regex' => "Las :attribute debe tener un formato válido",
            'skills.data.required' => "Debe indicar al menos un :attribute",
        ];

        if($this->get('skills') && key_exists("data", $this->get('skills')))
        {
            foreach ($this->get('skills')["data"] as $key => $value) {
                $messages['skills.data.'.$key.'.skill.required'] = ":attribute es obligatoria";
                $messages['skills.data.'.$key.'.evaluacion.max'] = ":attribute debe ser máximo de 5";
                $messages['skills.data.'.$key.'.evaluacion.min'] = ":attribute debe ser mínimo de 1";
                $messages['skills.data.'.$key.'.evaluacion.required'] = ":attribute es obligatoria";
                $messages['skills.data.'.$key.'.evaluacion.integer'] = ":attribute debe ser un número entero";
            }
        }

        return $messages;

    }
}
