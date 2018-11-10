<?php

namespace RequisicaoHttp\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use RequisicaoHttp\Model\Requisicao as RequisicaoModel;

class Requisicao
{
    private $clienteHttp;
    private $model;

    public function __construct()
    {
        $this->clienteHttp = new Client();
        $this->model = new RequisicaoModel();
    }

    private function preparaRequisicao(string $verboHttp, array $novasOpcoes, array $corpoRequisicao)
    {
        $opcoes = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        if (!empty($novasOpcoes)) {
            $opcoes = array_merge($opcoes, $novasOpcoes);
        }

        $body = json_encode($body);

        return new Request($verboHttp, $url, $opcoes, $body);
    }

    public function envia(string $verboHttp, string $url, array $opcoes = [], array $body = []):RequisicaoModel
    {
        try {
            \Log::info("[HEROES][REQUISICAO] Vamos começar a requisição no Hyoga na URL: " . self::URL_PRODUCAO);
            $request = $this->preparaRequisicao($verboHttp, $url, $opcoes, $body);

            \Log::info("[HEROES][REQUISICAO] Montada a Request");
            $respostaHttp = $this->clienteHttp->send($request);

            \Log::info("[HEROES][REQUISICAO] Request enviada");
            $respostaHttpStatus = (string) $respostaHttp->getStatusCode();

            \Log::info("[HEROES][REQUISICAO] A resposta foi: " . $respostaHttp->getBody().PHP_EOL);
            \Log::info("[HEROES][REQUISICAO] O Status HTTP da resposta foi: " . $respostaHttpStatus.PHP_EOL);

            $this->model->setStatus = $respostaHttp->getStatusCode();
            $this->model->setCorpo = json_decode($respostaHttp->getBody(true), true);

            return $this->model;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $respostaHttp = json_decode($e->getResponse()->getBody(true), true);

            $message = "[HEROES][REQUISICAO] Houve um erro na hora de fazer a requisição. A exception foi: ";
            $message =  PHP_EOL . print_r($respostaHttp) . PHP_EOL;
            $message .= PHP_EOL . "No arquivo ".$e->getFile().";";
            $message .= PHP_EOL . "Na linha ".$e->getLine().".";
            $message .= PHP_EOL . "Hora: ".\Carbon\Carbon::now()->format('d/m/y H:i:s');
            \Log::critical($message);

            $this->model->setStatus = $e->getResponse()->getStatusCode();
            $this->model->setCorpo = json_decode($e->getResponse()->getBody(true), true);

            return $this->model;
        } catch (Exception $e) {
            $message = "[HEROES][REQUISICAO] Houve um erro na hora de fazer a requisição. A exception foi: ";
            $message .= PHP_EOL . "'".$e->getMessage()."'";
            $message .= PHP_EOL . "No arquivo ".$e->getFile().";";
            $message .= PHP_EOL . "Na linha ".$e->getLine().".";
            $message .= PHP_EOL . "Hora: ".\Carbon\Carbon::now()->format('d/m/y H:i:s');
            \Log::critical($message);

            return $e;
        }
    }
}
