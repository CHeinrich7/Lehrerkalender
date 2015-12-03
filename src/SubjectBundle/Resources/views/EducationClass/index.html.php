<?php
/**
 * @var $view            Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $app             Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $routerHelper    Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 * @var $slotsHelper     ToolboxBundle\Helper\SlotsHelper
 *
 * @var $educationClasses   SubjectBundle\Entity\EducationClassEntity[]
 */

$routerHelper = $view['router'];
$slotsHelper = $view['slots'];

$view->extend('::loggedIn.html.php');

$isAdmin = $app->getSecurity()->isGranted(\UserBundle\Entity\Role::ROLE_ADMIN);
?>

<?php $slotsHelper->start('title'); ?>Klassen bearbeiten<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>
<?php $slotsHelper->stop(); ?>
