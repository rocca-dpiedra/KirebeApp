<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

//Comentario Darío ***********************************************************
/**
 * En este archivo: Layout → Default, se definen los datos que se mostraran en todas las pantallas 
 * (Vistas) que tendrá el usuario
 */

$Kirebe = 'Gestión Proyectos - Kirebe'; //Se cambia el título
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $Kirebe ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    <?= $this->Html->css(['navbar', 'style']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/projects/list') ?>"><span>KIREBE </span>Project</a>
        </div>
            <div class="top-nav-links">
                <?php if($logedIn) :?>
                        <?php if($current_user['role'] !== 'usuario'): ?>
                            <div class="nav-element">
                                <?= $this->HTML->link(__('Usuarios'), ['controller' => 'Users', 'action' => 'index'] ) ?> 
                            </div>
                        <?php endif; ?>
                        <div class="nav-element">
                            <?= $this->HTML->link(__('Proyectos'), ['controller' => 'Projects', 'action' => 'index'] ) ?> 
                        </div>
                    <?php if($current_user['role'] !== 'usuario'): ?>
                        <div class="nav-element">
                                <?= $this->HTML->link(__('Reportes'), ['controller' => 'Timelogs', 'action' => 'repindex'] ) ?>
                            </div>
                        <?php endif; ?>
                        <div class="nav-element">
                            <?= $this->HTML->link(__('Mi Perfil'), ['controller' => 'users', 'action' => 'miPerfil'] ) ?> 
                        </div>
                        <div class="nav-element">
                            <?= $this->HTML->link(__('Salir'), ['controller' => 'Users', 'action' => 'logout'] ) ?> 
                        </div>
            <?php endif; ?>
        </div>
        <div class="time">
            <?php echo $this->Form->label('Hora Actual:'); ?>
            <div id="time">

            </div>  
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>


    <footer>
    </footer>

    <?= $this->Html->script(['time', 'contador', 'ocultar']) ?>
</body>
</html>


