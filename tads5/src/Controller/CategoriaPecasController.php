<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class CategoriaPecasController extends AppController
{
    public function index()
    {
        $busca = $this->CategoriaPecas
            ->find()
            ->select(['id', 'nome', 'ativo']);

        try {
            return $this->sucesso('Categorias de peça listadas com sucesso.', $busca->toArray());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar as categorias de peça: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código da categoria.');
        }

        $busca = $this->CategoriaPecas
            ->find()
            ->select(['id', 'nome', 'ativo'])
            ->where(['id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Categoria de peça com código ' . $id . ' não encontrada.');
            }

            return $this->sucesso('Categoria de peça encontrada.', $resultado);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao buscar a categoria de peça: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $categoriaPeca = $this->CategoriaPecas->newEmptyEntity();
        $categoriaPeca = $this->CategoriaPecas->patchEntity($categoriaPeca, $dados);

        try {
            $categoriaPeca = $this->CategoriaPecas->saveOrFail($categoriaPeca);
            return $this->sucesso('Categoria de peça criada com sucesso. Código: ' . $categoriaPeca['id'] . ".", [
                'id' => $categoriaPeca['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao criar a categoria de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao criar a categoria de peça: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe a categoria de peça a ser alterada.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código da categoria de peça a ser alterada.');
        }

        $id = $dados['id'];

        try {
            $categoriaPeca = $this->CategoriaPecas->get($id);
            $this->CategoriaPecas->patchEntity($categoriaPeca, $dados);
            $this->CategoriaPecas->saveOrFail($categoriaPeca);
            return $this->sucesso('Categoria de peça alterada com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrada uma categoria de peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar a categoria de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar a categoria de peça: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código da categoria de peça a ser excluída.');
        }

        try {
            $categoriaPeca = $this->CategoriaPecas->get($id);
            $this->CategoriaPecas->deleteOrFail($categoriaPeca);
            return $this->sucesso('Categoria de peça excluída com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado uma categoria de peça com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir a categoria de peça.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir a categoria de peça: ' . $e->getMessage());
        }
    }
}
