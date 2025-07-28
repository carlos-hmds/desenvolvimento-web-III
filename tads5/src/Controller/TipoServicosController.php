<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class TipoServicosController extends AppController
{
    public function index()
    {
        $busca = $this->TipoServicos
            ->find()
            ->select(['id', 'tipo', 'ativo']);

        try {
            return $this->sucesso('Tipos de serviço listados com sucesso.', $busca->toArray());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar os tipos de serviço: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod('post');

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do tipo de serviço.');
        }

        $busca = $this->TipoServicos
            ->find()
            ->select(['id', 'tipo', 'ativo'])
            ->where(['id' => $id]);

        try {
            $resultado = $busca->first();

            if (empty($resultado)) {
                return $this->erro('Tipo de serviço com código ' . $id . ' não encontrado.');
            }

            return $this->sucesso('Tipo de serviço encontrado.', $resultado);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao consultar o tipo de serviço: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe os dados necessários.');
        }

        $tipoServico = $this->TipoServicos->newEmptyEntity();
        $tipoServico = $this->TipoServicos->patchEntity($tipoServico, $dados);

        try {
            $tipoServico = $this->TipoServicos->saveOrFail($tipoServico);
            return $this->sucesso('Tipo de serviço incluído com sucesso. Código: ' . $tipoServico['id'] . ".", [
                'id' => $tipoServico['id']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao incluir o tipo de serviço.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao incluir o tipo de serviço: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod('post');

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe o tipo de serviço a ser alterado.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código do tipo de serviço a ser alterado.');
        }

        $id = $dados['id'];

        try {
            $tipoServico = $this->TipoServicos->get($id);
            $this->TipoServicos->patchEntity($tipoServico, $dados);
            $this->TipoServicos->saveOrFail($tipoServico);
            return $this->sucesso('Tipo de serviço alterado com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um tipo de serviço com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao alterar o tipo de serviço.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao alterar o tipo de serviço: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (empty($id)) {
            return $this->erro('Informe o código do tipo de serviço a ser excluído.');
        }

        try {
            $tipoServico = $this->TipoServicos->get($id);
            $this->TipoServicos->deleteOrFail($tipoServico);
            return $this->sucesso('Tipo de serviço excluído com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um tipo de serviço com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir o tipo de serviço.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir o tipo de serviço: ' . $e->getMessage());
        }
    }
}
