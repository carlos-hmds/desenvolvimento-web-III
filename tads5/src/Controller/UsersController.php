<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Exception;

class UsersController extends AppController
{
    public function index()
    {
        $consulta = $this->Users
            ->find()
            ->select([
                'id' => 'Users.id',
                'nome' => 'Users.nome',
                'cpf' => 'Users.cpf',
                'celular' => 'Users.celular',
                'dtNasc' => 'Users.dtNasc',
                'email' => 'Users.email',
                'ativo' => 'Users.ativo',
            ])
            ->orderBy(["Users.nome" => "asc"]);

        try {
            $usuarios = $consulta->all();
            return $this->sucesso('Usuários listados com sucesso.', $usuarios);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao listar os usuários: ' . $e->getMessage());
        }
    }

    public function view()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do usuário a ser buscado.');
        }

        $consulta = $this->Users
            ->find()
            ->select([
                'id' => 'Users.id',
                'nome' => 'Users.nome',
                'cpf' => 'Users.cpf',
                'celular' => 'Users.celular',
                'dtNasc' => 'Users.dtNasc',
                'email' => 'Users.email',
                'ativo' => 'Users.ativo',
            ])
            ->where(['Users.id' => $id]);

        try {
            $usuario = $consulta->first();
            return $this->sucesso('Usuário encontrado.', $usuario);
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao buscar o usuário: ' . $e->getMessage());
        }
    }

    public function add()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Users->newEmptyEntity();
        $dados = $this->request->getData();

        $user = $this->Users->patchEntity($user, $dados);

        try {
            $user = $this->Users->saveOrFail($user);

            $mensagem = "<h1>Eba!</h1><br>Seu usuário do TADS5 foi criado com sucesso.";

            $this->enviarEmail(
                destinatario: $user['email'],
                mensagem: $mensagem,
                assunto: 'Seja bem vindo ao sistema do TADS5!'
            );

            return $this->sucesso('Usuário adicionado com sucesso.', $user);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao criar o usuário.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->erro('Houve um erro ao criar o usuário: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->request->allowMethod(['post']);

        $dados = $this->request->getData();

        if (empty($dados)) {
            return $this->erro('Informe o usuário a ser editado.');
        }

        if (empty($dados['id'])) {
            return $this->erro('Informe o código do usuário a ser editado.');
        }

        $id = $dados['id'];

        try {
            $usuario = $this->Users->get($id);
            $this->Users->patchEntity($usuario, $dados);
            $this->Users->saveOrFail($usuario);
            return $this->sucesso('Usuário editado com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um usuário com código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao editar o usuário.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao editar o usuário: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->request->allowMethod(['post']);

        $id = $this->request->getData('id');

        if (!$id) {
            return $this->erro('Informe o código do usuário a ser excluído.');
        }

        try {
            $peca = $this->Pecas->get($id);
            $this->Pecas->deleteOrFail($peca);
            return $this->sucesso('Usuário excluído com sucesso.');
        }
        catch (RecordNotFoundException) {
            return $this->erro('Não foi encontrado um usuário com o código ' . $id . '.');
        }
        catch (PersistenceFailedException $e) {
            return $this->sucesso('Ocorreram um ou mais erros ao excluir o usuário.', $e->getAttributes());
        }
        catch (Exception $e) {
            return $this->sucesso('Houve um erro ao excluir o usuário: ' . $e->getMessage());
        }
    }

    public function login()
    {
        $this->loadComponent('Authentication.Authentication');
        $this->logout();
        $result = $this->Authentication->getResult();

        if (!$result || !$result->isValid()) {
            debug($result);
            return $this->erro('E-mail ou senha inválidos.');
        }

        $user_id = $result->getData()['id'];

        try {
            $salvar["user_id"] = $user_id;
            $salvar["autenticacao"] = $this->gerarHash();
            $salvar["expiracao"] = $this->obterDataExpiracao();

            $retorno = $this->Autenticacaos->find()
                ->select(["id"])
                ->where(["user_id" => $user_id])
                ->limit(1)
                ->first();

            if ($retorno) {
                $autenticacao_id = $retorno["id"];
                $autenticacao = $this->Autenticacaos->get($autenticacao_id, contain: []);
            }
            else {
                $autenticacao = $this->Autenticacaos->newEmptyEntity();
            }

            $autenticacao = $this->Autenticacaos->patchEntity($autenticacao, $salvar);
            $this->Autenticacaos->saveOrFail($autenticacao);

            return $this->sucesso('Login realizado com sucesso.', ['hash' => $autenticacao['autenticacao']]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao realizar o login: ', $e->getAttributes());
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        //return $this->redirect(['controller' => 'Pages', 'action' => 'login']);
    }

    private function gerarHash(): string
    {
        // $hash = password_hash($this->request->getData("email"), PASSWORD_DEFAULT);
        // Gerar hash combinando a senha do usuário com a data atual
        $hash = $this->request->getData("email") . date("YmdHis");
        return hash("sha256", $hash);
    }

    private function obterDataExpiracao(): string
    {
        return date("Y-m-d", strtotime("+4 days"));
    }

    private function gerarAutenticacao($resultado): EntityInterface
    {
        $autenticacao = $this->Autenticacaos->newEmptyEntity();
        $autenticacao["autenticacao"] = $this->gerarHash();
        $autenticacao["user_id"] = $resultado->getData()["id"];
        $autenticacao["expiracao"] = $this->obterDataExpiracao();

        return $autenticacao;
    }
}
