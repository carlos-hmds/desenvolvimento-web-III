<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class VeiculosController extends AppController
{
    public function index()
    {
        $this->request->allowMethod(['get', 'post']);

        $busca = $this->Veiculos
            ->find()
            ->select([
                'id' => 'Veiculos.id',
                'modelo' => 'Veiculos.modelo',
                'ano' => 'Veiculos.ano',
                'placa' => 'Veiculos.placa',
                'ativo' => 'Veiculos.ativo',
                'tipo_veiculo_descricao' => 'Tipo_Veiculos.descricao',
                'fabricante_abreviado' => 'Fabricantes.abreviado',
            ])
            ->join([
                'type' => 'INNER',
                'table' => 'Tipo_Veiculos',
                'conditions' => 'Tipo_Veiculos.id = Veiculos.tipo_veiculo_id'
            ])
            ->join([
                'type' => 'INNER',
                'table' => 'Fabricantes',
                'conditions' => 'Fabricantes.id = Veiculos.fabricante_id'
            ]);

        try {
            $veiculos = $busca->toArray();
            return $this->sucesso('Veículos listados com sucesso.', $veiculos);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar os veículos: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do veículo.');
        }

        $busca = $this->Veiculos
            ->find()
            ->select([
                'id' => 'Veiculos.id',
                'modelo' => 'Veiculos.modelo',
                'ano' => 'Veiculos.ano',
                'placa' => 'Veiculos.placa',
                'ativo' => 'Veiculos.ativo',
                'tipo_veiculo_id' => 'Tipo_Veiculos.id',
                'tipo_veiculo_descricao' => 'Tipo_Veiculos.descricao',
                'fabricante_id' => 'Fabricantes.id',
                'fabricante_abreviado' => 'Fabricantes.abreviado',
            ])
            ->join([
                'type' => 'INNER',
                'table' => 'Tipo_Veiculos',
                'conditions' => 'Tipo_Veiculos.id = Veiculos.tipo_veiculo_id'
            ])
            ->join([
                'type' => 'INNER',
                'table' => 'Fabricantes',
                'conditions' => 'Fabricantes.id = Veiculos.fabricante_id'
            ])
            ->where(['Veiculos.id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Veículo com código ' . $id . ' não encontrado.');
            }

            $veiculo = [
                'id' => $resultado['id'],
                'modelo' => $resultado['modelo'],
                'ano' => $resultado['ano'],
                'placa' => $resultado['placa'],
                'ativo' => $resultado['ativo'],
            ];

            $veiculo['tipo_veiculo'] = [
                'id' => $resultado['tipo_veiculo_id'],
                'descricao' => $resultado['descricao'],
            ];

            $veiculo['fabricante'] = [
                'id' => $resultado['fabricante_id'],
                'abreviado' => $resultado['fabricante_abreviado'],
            ];

            return $this->sucesso('Veículo encontrado.', $veiculo);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao verificar o veículo: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $veiculo = $this->Veiculos->newEmptyEntity();
        $veiculo = $this->Veiculos->patchEntity($veiculo, $dados);

        try {
            $veiculo = $this->Veiculos->saveOrFail($veiculo);
            return $this->sucesso('Frota expandida com sucesso.', [
                'id' => $veiculo['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro(
                'Ocorreram um ou mais erros ao adicionar o veículo à frota.',
                $e->getAttributes()
            );
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao adicionar o veículo à frota: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe o veículo a ser atualizado.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código do veículo a ser atualizado.');
        }

        $id = $dados['id'];

        try {
            $veiculo = $this->Veiculos->get($id);
            $this->Veiculos->patchEntity($veiculo, $dados);
            $this->Veiculos->saveOrFail($veiculo);
            return $this->sucesso('Veículo atualizado com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Veículo de código ' . $id . ' não encontrado.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao atualizar o veículo.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao atualizar o veículo: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código do veículo a ser removido.');
        }

        try {
            $veiculo = $this->Veiculos->get($id);
            $this->Veiculos->deleteOrFail($veiculo);
            return $this->sucesso('Veículo removido com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Veículo de código ' . $id . ' não encontrado.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao remover o veículo.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao remover o veículo: ' . $e->getMessage());
        }
    }
}
