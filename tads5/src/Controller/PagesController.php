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
    private \Cake\ORM\Table $Users;
    private \Cake\ORM\Table $Autenticacaos;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // $this->Authentication->allowUnauthenticated(['login']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->Users = $this->fetchTable("Users");
        $this->Autenticacaos = $this->fetchTable("Autenticacaos");
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
        $response = null;
        $statusCode = 200;

        if ($this->request->is("post") && !empty($this->request->getData("id")[0])) {
            $sql = "SELECT *
                      FROM USERS
                     WHERE ID = :id";

            $id = $this->request->getData("id")[0];
            $filtro = ["id" => $id];
        }
        else {
            $sql = "SELECT *
                      FROM USERS
                     ORDER BY NOME ASC";
            $filtro = [];
        }

        $response = $GLOBALS["connection"]->execute($sql, $filtro)->fetchAll("assoc");

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function addUser()
    {
        $response = null;
        $statusCode = 200;

        if ($this->request->is("post"))
        {
            $user = $this->Users->newEmptyEntity();
            $dados = $this->request->getData();

            $user = $this->Users->patchEntity($user, $dados);

            try
            {
                $this->Users->saveOrFail($user);
                $response = "Usuário adicionado com sucesso.";
            }
            catch (PersistenceFailedException $e)
            {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

            /*
            $salvar = $this->Users->save($user);
            if ($salvar)
            {
                $response = "Usuário adicionado com sucesso.";
            }
            */
        }
        else
        {
            $statusCode = 400;
            $response = "Parâmetros de requisição inválidos: faltam os dados do usuário.";
        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '+')
            ->withStatus($statusCode)
            ->withType('aplication/json')
            ->withStringBody(json_encode($response));
    }

    public function login()
    {
        $response = null;
        $statusCode = 200;
        $this->loadComponent("Authentication.Authentication");

        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $autenticacao = $this->Autenticacaos->newEmptyEntity();

            // Gerar hash combinando a senha do usuário com a data atual
            $hash = $this->request->getData("password") . date("YmdHis");
            $hash = hash("sha256", $hash);
            // $hash = password_hash($this->request->getData("password"), PASSWORD_DEFAULT);
            $autenticacao["autenticacao"] = $hash;
            $user_id = $result->getData()["id"];
            $autenticacao["user_id"] = $user_id;
            $autenticacao["expiracao"] = date("Y-m-d", strtotime("+4 days"));

            try {
                $sql = "DELETE FROM AUTENTICACAOS
                         WHERE USER_ID = :user_id";

                $GLOBALS["connection"]->execute($sql, ["user_id" => $user_id]);

                $this->Autenticacaos->saveOrFail($autenticacao);
                $response["mensagem"] = "Login realizado com sucesso";
                $response["hash"] = $autenticacao["autenticacao"];
            }
            catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }
        }
        else {
            $statusCode = 400;
            $response = "Ocorreu um erro ao realizar o login.";
        }

        return $this->response
            ->withHeader("Access-Control-Allow-Origin", "+")
            ->withStatus($statusCode)
            ->withType("aplication/json")
            ->withStringBody(json_encode($response));

        //$target = $this->Authentication->getLoginRedirect() ?? '/home';
        //return $this->redirect($target);

        /*
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username or password');
        }
        */
    }

    public function logout()
    {
        $this->Authentication->logout();
        //return $this->redirect(['controller' => 'Pages', 'action' => 'login']);
    }
}
