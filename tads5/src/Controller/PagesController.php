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
use Cake\View\Exception\MissingTemplateException;

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

    public function initialize(): void
    {
        parent::initialize();
        $this->Users = $this->fetchTable("Users");
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
    public function findUser()
    {
        $response = null;
        $statusCode = 200;
        $id = 1;

        $sql = "SELECT *
                  FROM USERS
                 ORDER BY NOME ASC";
        debug($sql);

        $sql = "SELECT *
                  FROM USERS
                 WHERE ID = :id
                 ORDER BY NOME ASC";
        debug($sql);
        exit;

        $response = $GLOBALS["connection"]->execute($sql, ["id" => $id])->fetchAll("assoc");

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function listUsers()
    {
        $response = null;
        $statusCode = 200;

        $sql = "SELECT *
                  FROM USERS
                 ORDER BY NOME ASC";

        $response = $GLOBALS["connection"]->execute($sql)->fetchAll("assoc");

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
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // debug($user);
            // debug($this->request->getData());

            if ($this->Users->save($user))
            {
                $response = "Usuário adicionado com sucesso.";
            }
        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '+')
            ->withStatus($statusCode)
            ->withType('aplication/json')
            ->withStringBody(json_encode($response));
    }
}
