<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class FabricantesController extends AppController
{
    public function index()
    {
        $busca = $this->Fabricantes
            ->find()
            ->select(['id', 'nome', 'abreviado', 'ativo']);

        try {
            return $this->sucesso('Fabricantes listadas com sucesso.', $busca->toArray());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar as fabricantes: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código da fabricante.');
        }

        $busca = $this->Fabricantes
            ->find()
            ->select(['id', 'nome', 'abreviado', 'ativo'])
            ->where(['id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Fabricante com código ' . $id . ' não encontrada.');
            }

            return $this->sucesso('Fabricante encontrada.', $resultado);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao buscar a fabricante: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $fabricante = $this->Fabricantes->newEmptyEntity();
        $fabricante = $this->Fabricantes->patchEntity($fabricante, $dados);

        try {
            $fabricante = $this->Fabricantes->saveOrFail($fabricante);
            return $this->sucesso('Fabricante criada com sucesso. Código: ' . $fabricante['id'] . ".", [
                'id' => $fabricante['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao criar a fabricante.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao criar a fabricante: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe a fabricante a ser alterada.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código da fabricante a ser alterada.');
        }

        $id = $dados['id'];

        try {
            $fabricante = $this->Fabricantes->get($id);
            $this->Fabricantes->patchEntity($fabricante, $dados);
            $this->Fabricantes->saveOrFail($fabricante);
            return $this->sucesso('Fabricante alterada com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrada uma fabricante com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar a fabricante.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar a fabricante: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código da fabricante a ser excluída.');
        }

        try {
            $fabricante = $this->Fabricantes->get($id);
            $this->Fabricantes->deleteOrFail($fabricante);
            return $this->sucesso('Fabricante excluída com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado uma fabricante com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir a fabricante.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir a fabricante: ' . $e->getMessage());
        }
    }
}
