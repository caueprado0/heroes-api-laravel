<?php

namespace Heroes\Http\Requests\Favorito;

use Illuminate\Foundation\Http\FormRequest;
use Heroes\Personagens\Service\ListarPersonagens;

class Create extends FormRequest
{
    public function __construct(ListarPersonagens $listarPersonagens)
    {
        $this->listarPersonagens = $listarPersonagens;
    }

    public function authorize()
    {
        return true;
    }

    public function validationData()
    {
        $data = $this->all();
        $personagemId = $this->listarPersonagens->find($this->route('personagemId'));

        if (isset($personagemId['results'][0]['id'])) {
            \Log::info("[HEROES][CREATE-FAVORITO][REQUEST] Foi encontrado o ID {$this->route('personagemId')}");
            $data['personagemId'] = $personagemId['results'][0]['id'];
        } else {
            \Log::info("[HEROES][CREATE-FAVORITO][REQUEST] NÃO foi encontrado o ID {$this->route('personagemId')}");
            $data['personagemId'] = null;
        }

        $this->getInputSource()->replace($data);

        return $data;
    }

    public function rules()
    {
        return [
            'personagemId' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'personagemId.required' => 'Não foi encontrado ID informado na API da Marvel'
        ];
    }
}
