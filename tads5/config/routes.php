<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
 * So you can use `$this` to reference the application class instance
 * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/getUsers', ['controller' => 'Pages', 'action' => 'getUsers']);

        $builder->connect('/addUser', ['controller' => 'Adicionas', 'action' => 'addUser']);
        $builder->connect('/addServico', ['controller' => 'Adicionas', 'action' => 'addServico']);
        $builder->connect('/addFornecedor', ['controller' => 'Adicionas', 'action' => 'addFornecedor']);
        $builder->connect('/addPeca', ['controller' => 'Adicionas', 'action' => 'addPeca']);
        $builder->connect('/addFabricante', ['controller' => 'Adicionas', 'action' => 'addFabricante']);
        $builder->connect('/addTipo', ['controller' => 'Adicionas', 'action' => 'addTipo']);
        $builder->connect('/addVeiculo', ['controller' => 'Adicionas', 'action' => 'addVeiculo']);
        $builder->connect('/addManutencao', ['controller' => 'Adicionas', 'action' => 'addManutencao']);
        $builder->connect('/addManupeca', ['controller' => 'Adicionas', 'action' => 'addManupeca']);

        // Tipos de serviços
        $builder->connect('/tipos-servicos', ['controller' => 'TipoServicos', 'action' => 'index']);
        $builder->connect('/tipos-servicos/view', ['controller' => 'TipoServicos', 'action' => 'view']);
        $builder->connect('/tipos-servicos/add', ['controller' => 'TipoServicos', 'action' => 'add']);
        $builder->connect('/tipos-servicos/edit', ['controller' => 'TipoServicos', 'action' => 'edit']);
        $builder->connect('/tipos-servicos/delete', ['controller' => 'TipoServicos', 'action' => 'delete']);

        // Peças
        $builder->connect('/pecas', ['controller' => 'Pecas', 'action' => 'index']);
        $builder->connect('/pecas/view', ['controller' => 'Pecas', 'action' => 'view']);
        $builder->connect('/pecas/add', ['controller' => 'Pecas', 'action' => 'add']);
        $builder->connect('/pecas/edit', ['controller' => 'Pecas', 'action' => 'edit']);
        $builder->connect('/pecas/delete', ['controller' => 'Pecas', 'action' => 'delete']);

        // Categorias de peças
        $builder->connect('/pecas/categorias', ['controller' => 'CategoriaPecas', 'action' => 'index']);
        $builder->connect('/pecas/categorias/view', ['controller' => 'CategoriaPecas', 'action' => 'view']);
        $builder->connect('/pecas/categorias/add', ['controller' => 'CategoriaPecas', 'action' => 'add']);
        $builder->connect('/pecas/categorias/edit', ['controller' => 'CategoriaPecas', 'action' => 'edit']);
        $builder->connect('/pecas/categorias/delete', ['controller' => 'CategoriaPecas', 'action' => 'delete']);

        // Marcas de peças
        $builder->connect('/pecas/marcas', ['controller' => 'MarcaPecas', 'action' => 'index']);
        $builder->connect('/pecas/marcas/view', ['controller' => 'MarcaPecas', 'action' => 'view']);
        $builder->connect('/pecas/marcas/add', ['controller' => 'MarcaPecas', 'action' => 'add']);
        $builder->connect('/pecas/marcas/edit', ['controller' => 'MarcaPecas', 'action' => 'edit']);
        $builder->connect('/pecas/marcas/delete', ['controller' => 'MarcaPecas', 'action' => 'delete']);

        // Usuários
        $builder->connect('/users', ['controller' => 'Users', 'action' => 'index']);
        $builder->connect('/users/view', ['controller' => 'Users', 'action' => 'view']);
        $builder->connect('/users/add', ['controller' => 'Users', 'action' => 'add']);
        $builder->connect('/users/edit', ['controller' => 'Users', 'action' => 'edit']);
        $builder->connect('/users/delete', ['controller' => 'Users', 'action' => 'delete']);

        // Manutenções
        $builder->connect('/manutencoes', ['controller' => 'Manutencaos', 'action' => 'index']);
        $builder->connect('/manutencoes/view', ['controller' => 'Manutencaos', 'action' => 'view']);
        $builder->connect('/manutencoes/add', ['controller' => 'Manutencaos', 'action' => 'add']);
        $builder->connect('/manutencoes/edit', ['controller' => 'Manutencaos', 'action' => 'edit']);
        $builder->connect('/manutencoes/delete', ['controller' => 'Manutencaos', 'action' => 'delete']);

        // Visualizações
        $builder->connect('/viewManutencao', ['controller' => 'Visualizacaos', 'action' => 'viewManutencao']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * It is NOT recommended to use fallback routes after your initial prototyping phase!
         * See https://book.cakephp.org/5/en/development/routing.html#fallbacks-method for more information
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
