<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class FornecedorsController extends AppController
{
    public function index()
    {
        $busca = $this->Fornecedors
            ->find()
            ->select([
                'id' => 'Fornecedors.id',
                'nome' => 'Fornecedors.nome',
                'telefone' => 'Fornecedors.telefone',
                'cidade' => 'Fornecedors.cidade',
                'estado' => 'Fornecedors.estado',
                'tipo_servico_nome' => 'Tipo_Servicos.tipo',
                'ativo' => 'Fornecedors.ativo'
            ])
            ->join([
                'table' => 'Tipo_Servicos',
                'type' => 'INNER',
                'conditions' => 'Tipo_Servicos.id = Fornecedors.tipo_servico_id'
            ]);

        try {
            $fornecedores = $busca->toArray();

            return $this->sucesso('Fornecedores listados com sucesso.', $fornecedores);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar os fornecedores: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do fornecedor.');
        }

        $busca = $this->Fornecedors
            ->find()
            ->select([
                'id' => 'Fornecedors.id',
                'cnpj' => 'Fornecedors.cnpj',
                'nome' => 'Fornecedors.nome',
                'telefone' => 'Fornecedors.telefone',
                'email' => 'Fornecedors.email',
                'logradouro' => 'Fornecedors.logradouro',
                'numero' => 'Fornecedors.numero',
                'bairro' => 'Fornecedors.bairro',
                'complemento' => 'Fornecedors.complemento',
                'cidade' => 'Fornecedors.cidade',
                'estado' => 'Fornecedors.estado',
                'cep' => 'Fornecedors.cep',
                'tipo_servico_id' => 'Fornecedors.tipo_servico_id',
                'ativo' => 'Fornecedors.ativo'
            ])
            ->where(["id" => $id]);

        try {
            $fornecedor = $busca->first();

            if (empty($fornecedor)) {
                return $this->erro('Fornecedor com código ' . $id . ' não localizado.');
            }

            return $this->sucesso('Fornecedor localizado.', $fornecedor);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao buscar o fornecedor: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $fornecedor = $this->Fornecedors->newEmptyEntity();
        $fornecedor = $this->Fornecedors->patchEntity($fornecedor, $dados);

        try {
            $fornecedor = $this->Fornecedors->saveOrFail($fornecedor);
            return $this->sucesso('Fornecedor cadastrado com sucesso. Código: ' . $fornecedor['id'] . ".", [
                'id' => $fornecedor['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao cadastrar o fornecedor.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao cadastrar o fornecedor: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe o fornecedor a ser atualizado.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código do fornecedor a ser atualizado.');
        }

        $id = $dados['id'];

        try {
            $fornecedor = $this->Fornecedors->get($id);
            $this->Fornecedors->patchEntity($fornecedor, $dados);
            $this->Fornecedors->saveOrFail($fornecedor);
            return $this->sucesso('Fornecedor atualizado com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um fornecedor com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao atualizar o fornecedor.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao atualizar o fornecedor: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código do fornecedor a ser removido.');
        }

        try {
            $fornecedor = $this->Fornecedors->get($id);
            $this->Fornecedors->deleteOrFail($fornecedor);
            return $this->sucesso('Fornecedor removido com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um fornecedor com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao remover o fornecedor.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir o fornecedor: ' . $e->getMessage());
        }
    }
}
