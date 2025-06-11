<?php
declare(strict_types=1);

namespace App\Controller;

class VisualizacaosController extends AppController
{
    public function viewManutencao()
    {
        $response = null;
        $statusCode = 200;

        if (!$this->request->is('POST')) {
            return $this->gerarResposta(400, 'Requisição inválida.');
        }

        if (empty($this->request->getData())) {
            $manutencaos = $this->fetchTable('Manutencaos');
            $response = $manutencaos
                ->find()
                ->select([
                    'cnpj_fornecedor' => 'Fornecedors.cnpj',
                    'nome_fornecedor' => 'Fornecedors.nome',
                    'telefone_fornecedor' => 'Fornecedors.telefone',
                    'modelo_veiculo' => 'Veiculos.modelo',
                    'placa_veiculo' => 'Veiculos.placa',
                    'nome_abreviado_fabricante' => 'Fabricantes.abreviado',
                    'nota_fiscal' => 'Manutencaos.notaFiscal',
                    'valor_manutencao' => 'Manutencaos.valor',
                    'data_manutencao' => 'Manutencaos.data',
                ])
                ->join([
                    'table' => 'Fornecedors',
                    'type' => 'INNER',
                    'conditions' => 'Fornecedors.id = Manutencaos.fornecedor_id',
                ])
                ->join([
                    'table' => 'Veiculos',
                    'type' => 'INNER',
                    'conditions' => 'Veiculos.id = Manutencaos.veiculo_id',
                ])
                ->join([
                    'table' => 'Fabricantes',
                    'type' => 'INNER',
                    'conditions' => 'Fabricantes.id = Veiculos.fabricante_id',
                ])
                ->toArray();
        } else {
            $id = $this->request->getData('id');
            $response = $this->Manutencaos
                ->find()
                ->where(['id' => $id])
                ->first();

            // Fornecedor: CNPJ, nome e telefone
            // Número da nota, valor e data
            // Veículo: Modelo, placa e nome do fabricante
        }

        return $this->gerarResposta($statusCode, $response);
    }
}
