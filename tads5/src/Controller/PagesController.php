<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\View\Exception\MissingTemplateException;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isEmpty;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/5/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // $this->Authentication->allowUnauthenticated(['login']);
    }

    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function getUsers()
    {
        $consulta = $this->Users->find();

        if ($this->request->is("post") && !empty($this->request->getData("id")[0])) {
            $id = $this->request->getData("id")[0];
            $consulta = $consulta->where(["id" => $id]);
            $response = $consulta->first();
        }
        else {
            $consulta = $consulta->orderBy(["nome" => "asc"]);
            $response = $consulta->all();
        }

        return $this->sucesso('', $response);
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

    public function login()
    {
        $this->loadComponent('Authentication.Authentication');
        $this->logout();
        $result = $this->Authentication->getResult();

        if (!$result || !$result->isValid()) {
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

            return $this->sucesso('Login realizado com sucesso.', [
                'hash' => $autenticacao['autenticacao']
            ]);
        }
        catch (PersistenceFailedException $e) {
            return $this->erro('Ocorreram um ou mais erros ao realizar o login: ', $e->getAttributes());
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
    }
}
