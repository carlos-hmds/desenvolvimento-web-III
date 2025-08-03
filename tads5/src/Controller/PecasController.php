<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class PecasController extends AppController
{
    public function index()
    {
        $busca = $this->Pecas
            ->find()
            ->select([
                'id' => 'Pecas.id',
                'nome' => 'Pecas.nome',
                'categoria_nome' => 'Categoria_Pecas.nome',
                'marca_nome' => 'Marca_Pecas.nome',
                'valor' => 'Pecas.valor',
                'garantia' => 'Pecas.garantia',
                'nota_fiscal' => 'Pecas.nota_fiscal',
                'ativo' => 'Pecas.ativo',
                'fornecedor_nome' => 'Fornecedors.nome',
            ])
            ->join([
                'table' => 'Categoria_Pecas',
                'type' => 'INNER',
                'conditions' => 'Categoria_Pecas.id = Pecas.categoria_peca_id',
            ])
            ->join([
                'table' => 'Marca_Pecas',
                'type' => 'INNER',
                'conditions' => 'Marca_Pecas.id = Pecas.marca_peca_id',
            ])
            ->join([
                'table' => 'Fornecedors',
                'type' => 'INNER',
                'conditions' => 'Fornecedors.id = Pecas.fornecedor_id',
            ]);

        try {
            $pecas = $busca->toArray();
            return $this->sucesso('Peças listadas com sucesso.', $pecas);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar as peças: ' . $e->getMessage());
        }
    }

    public function view()
    {
        if (!$this->request->is('post')) {
            return $this->erro('Requisição inválida.');
        }

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código da peça.');
        }

        $busca = $this->Pecas
            ->find()
            ->select([
                'id' => 'Pecas.id',
                'nome' => 'Pecas.nome',
                'categoria_peca_id' => 'Pecas.categoria_peca_id',
                'marca_peca_id' => 'Pecas.marca_peca_id',
                'valor' => 'Pecas.valor',
                'garantia' => 'Pecas.garantia',
                'nota_fiscal' => 'Pecas.nota_fiscal',
                'fornecedor_id' => 'Pecas.fornecedor_id',
                'ativo' => 'Pecas.ativo',
            ])
            ->join([
                'table' => 'Categoria_Pecas',
                'type' => 'INNER',
                'conditions' => 'Categoria_Pecas.id = Pecas.categoria_peca_id',
            ])
            ->join([
                'table' => 'Marca_Pecas',
                'type' => 'INNER',
                'conditions' => 'Marca_Pecas.id = Pecas.marca_peca_id',
            ])
            ->join([
                'table' => 'Fornecedors',
                'type' => 'INNER',
                'conditions' => 'Fornecedors.id = Pecas.fornecedor_id',
            ])
            ->where(['Pecas.id' => $id]);

        try {
            $peca = $busca->first();

            if (empty($peca)) {
                return $this->erro('Peça com código ' . $id . ' não encontrada.');
            }

            return $this->sucesso('Peça encontrada.', $peca);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao conferir a peça: ' . $e->getMessage());
        }
    }

    public function add()
    {
        if (!$this->request->is('post')) {
            return $this->erro('Requisição inválida.');
        }

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $peca = $this->Pecas->newEmptyEntity();
        $peca = $this->Pecas->patchEntity($peca, $dados);

        try {
            $peca = $this->Pecas->saveOrFail($peca);
            return $this->sucesso('Peça adicionada com sucesso.', [
                'id' => $peca['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao adicionar a peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao adicionar a peça: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        if (!$this->request->is('post')) {
            return $this->erro('Requisição inválida.');
        }

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe a peça a ser alterada.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código da peça a ser alterada.');
        }

        $id = $dados['id'];

        try {
            $peca = $this->Pecas->get($id);
            $this->Pecas->patchEntity($peca, $dados);
            $this->Pecas->saveOrFail($peca);
            return $this->sucesso('Peça alterada com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrada uma peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar a peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar a peça: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código da peça a ser removida.');
        }

        try {
            $peca = $this->Pecas->get($id);
            $this->Pecas->deleteOrFail($peca);
            return $this->sucesso('Peça removida com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrada uma peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao remover a peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao remover a peça: ' . $e->getMessage());
        }
    }
}
