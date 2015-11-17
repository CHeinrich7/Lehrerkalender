<?php
/**
 * User: Daniel
 * Date: 16.11.2015
 * Time: 11:18
 */

/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::base.html.php');
?>

<?php $slotsHelper->start('header-js'); ?>
    <script src="/js/moment.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script src="/js/chosen.js"></script>
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header-css'); ?>
    <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="/css/chosen.css" rel="stylesheet">
    <link href="/css/chosen-bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/override-bootstrap.css" rel="stylesheet">
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header'); ?>
    <div class="col-xs-6">
        <a href="<?php echo $routerHelper->generate('education_calendar_overview'); ?>"><h1 class="text-center">Kalender</h1></a>
    </div>
    <div class="col-xs-6">
        <a href="<?php echo $routerHelper->generate('education_calendar_select_class'); ?>"><h1 class="text-center">Benotung</h1></a>
    </div>
<?php $slotsHelper->stop(); ?>