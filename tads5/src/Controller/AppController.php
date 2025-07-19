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
use Cake\Http\Response;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
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
    protected \Cake\ORM\Table $Users;
    protected \Cake\ORM\Table $Autenticacaos;
    protected \Cake\ORM\Table $Servicos;
    protected \Cake\ORM\Table $Fornecedors;
    protected \Cake\ORM\Table $Pecas;
    protected \Cake\ORM\Table $Fabricantes;
    protected \Cake\ORM\Table $Tipos;
    protected \Cake\ORM\Table $Veiculos;
    protected \Cake\ORM\Table $Manutencaos;
    protected \Cake\ORM\Table $Manupecas;

    protected string $chaveMensagem = 'mensagem';
    protected string $chaveErros = 'erros';
    protected string $chaveRetorno = 'retorno';
    protected array $conteudoResposta;

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $acao = $this->request->getParam('action');

        if ($acao !== 'login' && $acao !== 'addUser' && !$this->possuiTokenValido()) {
            throw new UnauthorizedException('Não autorizado.');
        }

        $this->conteudoResposta = [];
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

        $this->Users = TableRegistry::getTableLocator()->get("Users");
        $this->Autenticacaos = TableRegistry::getTableLocator()->get("Autenticacaos");
        $this->Servicos = TableRegistry::getTableLocator()->get("Servicos");
        $this->Fornecedors = TableRegistry::getTableLocator()->get("Fornecedors");
        $this->Pecas = TableRegistry::getTableLocator()->get("Pecas");
        $this->Fabricantes = TableRegistry::getTableLocator()->get("Fabricantes");
        $this->Tipos = TableRegistry::getTableLocator()->get("Tipos");
        $this->Veiculos = TableRegistry::getTableLocator()->get("Veiculos");
        $this->Manutencaos = TableRegistry::getTableLocator()->get("Manutencaos");
        $this->Manupecas = TableRegistry::getTableLocator()->get("ManuPecas");

        $GLOBALS["connection"] = ConnectionManager::get("default");
    }

    protected function possuiTokenValido(): bool
    {
        if (empty($this->request->getHeader("Authentication")[0])) {
            return false;
        }

        $token = $this->request->getHeader("Authentication")[0];
        $dataAtual = date("Y-m-d");

        $autenticacao = $this->Autenticacaos->find()
            ->select(["id"])
            ->where([
                "AUTENTICACAO" => $token,
                "EXPIRACAO > " => $dataAtual,
            ])
            ->first();

        return !empty($autenticacao);
    }

    protected function enviarEmail($destinatario, $mensagem, $assunto = "TADS5", $copia = null): void
    {
        $mailer = new Mailer('default');

        $mailer->setFrom(env('EMAIL_TRANSPORT_USERNAME'))
            ->setTo($destinatario)
            ->setEmailFormat('html');

        $mailer->setSubject($assunto);

        if ($copia) {
            $mailer->setCc($copia);
        }

        $mailer->deliver($mensagem);
    }

    protected function gerarResposta($codigo): Response
    {
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', "*")
            ->withStatus($codigo)
            ->withType('application/json')
            ->withStringBody(json_encode($this->conteudoResposta, JSON_UNESCAPED_UNICODE));
    }

    protected function erro($mensagem, $erros = [], $codigo = 400): Response
    {
        $this->conteudoResposta[$this->chaveMensagem] = $mensagem;
        $this->conteudoResposta[$this->chaveErros] = $erros;
        return $this->gerarResposta($codigo);
    }

    protected function sucesso($mensagem, $dados = [], $codigo = 200): Response
    {
        $this->conteudoResposta[$this->chaveMensagem] = $mensagem;
        $this->conteudoResposta[$this->chaveRetorno] = $dados;
        return $this->gerarResposta($codigo);
    }
}
