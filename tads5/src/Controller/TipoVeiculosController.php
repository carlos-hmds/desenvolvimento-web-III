<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class TipoVeiculosController extends AppController
{
    public function index()
    {
        $busca = $this->TipoVeiculos
            ->find()
            ->select(['id', 'descricao', 'ativo']);

        try {
            return $this->sucesso('Tipos de veículo listados com sucesso.', $busca->toArray());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar os tipos de veículo: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do tipo de veículo.');
        }

        $busca = $this->TipoVeiculos
            ->find()
            ->select(['id', 'descricao', 'ativo'])
            ->where(['id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Tipo de veículo com código ' . $id . ' não encontrado.');
            }

            return $this->sucesso('Tipo de veículo encontrado.', $resultado);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao consultar o tipo de veículo: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $tipoVeiculo = $this->TipoVeiculos->newEmptyEntity();
        $tipoVeiculo = $this->TipoVeiculos->patchEntity($tipoVeiculo, $dados);

        try {
            $tipoVeiculo = $this->TipoVeiculos->saveOrFail($tipoVeiculo);
            return $this->sucesso('Tipo de veículo incluído com sucesso. Código: ' . $tipoVeiculo['id'] . ".", [
                'id' => $tipoVeiculo['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao incluir o tipo de veículo.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao incluir o tipo de veículo: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe o tipo de veículo a ser alterado.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código do tipo de veículo a ser alterado.');
        }

        $id = $dados['id'];

        try {
            $tipoVeiculo = $this->TipoVeiculos->get($id);
            $this->TipoVeiculos->patchEntity($tipoVeiculo, $dados);
            $this->TipoVeiculos->saveOrFail($tipoVeiculo);
            return $this->sucesso('Tipo de veículo alterado com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um tipo de veículo com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar o tipo de veículo.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar o tipo de veículo: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código do tipo de veículo a ser excluído.');
        }

        try {
            $tipoVeiculo = $this->TipoVeiculos->get($id);
            $this->TipoVeiculos->deleteOrFail($tipoVeiculo);
            return $this->sucesso('Tipo de veículo excluído com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um tipo de veículo com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir o tipo de veículo.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir o tipo de veículo: ' . $e->getMessage());
        }
    }
}
