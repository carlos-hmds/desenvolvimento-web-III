<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;
use PDOException;

class PecasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $busca = $this->Pecas
            ->find()
            ->select([
                'id' => 'Pecas.id',
                'nome' => 'Pecas.nome',
                'valor' => 'Pecas.valor',
                'garantia' => 'Pecas.garantia',
                'notaFiscal' => 'Pecas.notaFiscal',
                'ativo' => 'Pecas.ativo',
                'fornecedor_id' => 'Pecas.fornecedor_id',
                'fornecedor_nome' => 'Fornecedors.nome',
            ])
            ->join([
                'table' => 'Fornecedors',
                'type' => 'INNER',
                'conditions' => 'Fornecedors.id = Pecas.fornecedor_id',
            ]);

        try {
            $resultado = $busca->toArray();
            $pecas = [];

            for ($i = 0; $i < sizeof($resultado); $i++) {
                $registro = $resultado[$i];

                $peca = [
                    'id' => $registro['id'],
                    'nome' => $registro['nome'],
                    'valor' => $registro['valor'],
                    'garantia' => $registro['garantia'],
                    'notaFiscal' => $registro['notaFiscal'],
                    'ativo' => $registro['ativo'],
                ];

                $peca['fornecedor'] = [
                    'id' => $registro['fornecedor_id'],
                    'nome' => $registro['fornecedor_nome'],
                ];

                $pecas[$i] = $peca;
            }

            return $this->sucesso('Peças listadas com sucesso.', $pecas);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar as peças: ' . $e->getMessage());
        }
    }

    /**
     * View method
     *
     * @param string|null $id Peca id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        if (!$this->request->is('post')) {
            return $this->erro('Requisição inválida.');
        }

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código da manutenção.');
        }

        $busca = $this->Pecas
            ->find()
            ->select([
                'id' => 'Pecas.id',
                'nome' => 'Pecas.nome',
                'valor' => 'Pecas.valor',
                'garantia' => 'Pecas.garantia',
                'notaFiscal' => 'Pecas.notaFiscal',
                'ativo' => 'Pecas.ativo',
                'fornecedor_id' => 'Pecas.fornecedor_id',
                'fornecedor_nome' => 'Fornecedors.nome',
            ])
            ->join([
                'table' => 'Fornecedors',
                'type' => 'INNER',
                'conditions' => 'Fornecedors.id = Pecas.fornecedor_id',
            ])
            ->where(['Pecas.id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Peça com código ' . $id . ' não encontrada.');
            }

            $peca = [
                'id' => $resultado['id'],
                'nome' => $resultado['nome'],
                'valor' => $resultado['valor'],
                'garantia' => $resultado['garantia'],
                'notaFiscal' => $resultado['notaFiscal'],
                'ativo' => $resultado['ativo'],
            ];

            $peca['fornecedor'] = [
                'id' => $resultado['fornecedor_id'],
                'nome' => $resultado['fornecedor_nome'],
            ];

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
            return $this->erro('Informe a manutenção a ser corrigida.');
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
        if (!$this->request->is('post')) {
            return $this->erro('Requisição inválida.');
        }

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
