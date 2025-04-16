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

use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;
use Exception;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        if ($this->request->getParam("action") === "login")
        {
            return;
        }

        if (!$this->possuiTokenValido())
        {
            throw new UnauthorizedException("Não autorizado.");
        }
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     * @throws Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent("Flash");

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        $GLOBALS["connection"] = ConnectionManager::get("default");
        // Horas até o usuário ser obrigado a logar novamente
        $GLOBALS["limiteToken"] = 24 * 3;
    }

    protected function possuiTokenValido(): bool
    {
        if (empty($this->request->getHeader("Authentication")[0]))
        {
            return false;
        }

        $token = $this->request->getHeader("Authentication")[0];
        $limiteToken = $GLOBALS["limiteToken"];

        $sql = "SELECT 1
                  FROM AUTENTICACAOS
                 WHERE AUTENTICACAO = :token
                   AND TIMESTAMPDIFF(HOUR, CREATED, NOW()) < :limiteToken
                 LIMIT 1";

        $registros = $GLOBALS["connection"]->execute($sql, ["token" => $token, "limiteToken" => $limiteToken])->fetchAll("assoc");
        return !empty($registros);
    }
}
