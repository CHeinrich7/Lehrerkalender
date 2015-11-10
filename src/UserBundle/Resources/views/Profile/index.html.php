<?php
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use UserBundle\Entity\Role;
use Symfony\Component\HttpKernel\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper;
/* @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */
/* @var $error          AuthenticationServiceException */
/* @var $username       string */
/* @var $authChecker    AuthorizationChecker */
/* @var $actionsHelper  ActionsHelper */
/* @var $slotsHelper    SlotsHelper */
/* @var $routerHelper   RouterHelper */

$slotsHelper    = $view['slots'];
$routerHelper   = $view['router'];
$actionsHelper  = $view['actions'];
$authChecker    = $view['security'];

?>

<?php $view->extend('BackendBundle:Default:base.html.php') ?>

<?php $slotsHelper->start('title') ?>UserArea<?php $slotsHelper->stop('title') ?>

<?php $slotsHelper->start('headerTitle') ?>UserArea<?php $slotsHelper->stop('headerTitle') ?>

<?php $slotsHelper->start('headerMenu') ?>
    <li><a href="#">Dienste</a></li>
    <li><a href="#">Infos</a></li>
    <li><a href="#">Forum</a></li>
    <li><a href="#">Hile</a></li>
<?php if($authChecker->isGranted(Role::ROLE_CHARGER)): ?>
    <li class="divider"></li>
    <li><a href="#">Gruppen</a></li>
    <li><a href="#">Veranstalgungen</a></li>
    <li><a href="#">User</a></li>
<?php endif; ?>
<?php $slotsHelper->stop('header') ?>