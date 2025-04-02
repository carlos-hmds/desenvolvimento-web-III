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

        if (empty($this->request->getHeader("Authentication"))
         || $this->request->getHeader("Authentication")[0] !== $GLOBALS["token"])
        {
            // $this->Flash->error("Você não possui autorização para acessar esse recurso no sistema.");
            throw new UnauthorizedException("Você não possui autorização para acessar esse recurso no sistema.");
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

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        $GLOBALS["connection"] = ConnectionManager::get("default");
        $GLOBALS["token"] = "f8Jf1Eo7S67jjlU2O46OiJ2zzuOrBEWgErlbpAYS7tbYofjuWz";
    }
}
