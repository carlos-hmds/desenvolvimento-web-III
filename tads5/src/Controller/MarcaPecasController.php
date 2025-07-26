<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class MarcaPecasController extends AppController
{
    public function index()
    {
        $busca = $this->MarcaPecas
            ->find()
            ->select(['id', 'nome', 'ativo']);

        try {
            return $this->sucesso('Marcas de peça listadas com sucesso.', $busca->toArray());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar as marcas de peça: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código da marca.');
        }

        $busca = $this->MarcaPecas
            ->find()
            ->select(['id', 'nome', 'ativo'])
            ->where(['id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Marca de peça com código ' . $id . ' não encontrada.');
            }

            return $this->sucesso('Marca de peça encontrada.', $resultado);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao buscar a marca de peça: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $marcaPeca = $this->MarcaPecas->newEmptyEntity();
        $marcaPeca = $this->MarcaPecas->patchEntity($marcaPeca, $dados);

        try {
            $marcaPeca = $this->MarcaPecas->saveOrFail($marcaPeca);
            return $this->sucesso('Marca de peça criada com sucesso. Código: ' . $marcaPeca['id'] . ".", [
                'id' => $marcaPeca['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao criar a marca de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao criar a marca de peça: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe a marca de peça a ser alterada.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código da marca de peça a ser alterada.');
        }

        $id = $dados['id'];

        try {
            $marcaPeca = $this->MarcaPecas->get($id);
            $this->MarcaPecas->patchEntity($marcaPeca, $dados);
            $this->MarcaPecas->saveOrFail($marcaPeca);
            return $this->sucesso('Marca de peça alterada com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrada uma marca de peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar a marca de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar a marca de peça: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código da marca de peça a ser excluída.');
        }

        try {
            $marcaPeca = $this->MarcaPecas->get($id);
            $this->MarcaPecas->deleteOrFail($marcaPeca);
            return $this->sucesso('Marca de peça excluída com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado uma marca de peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir a marca de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir a marca de peça: ' . $e->getMessage());
        }
    }
}
