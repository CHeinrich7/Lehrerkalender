<?php
/**
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 * @var $formHelper     Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 *
 * @var $username       string
 * @var $loginForm      Symfony\Component\Form\Form
 * @var $loginFormView  Symfony\Component\Form\FormView
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$loginFormView = $loginForm->createView();

$view->extend('::base.html.php');
$formHelper->setTheme($loginFormView, ':Form');

?>

<?php $slotsHelper->start('title'); ?>Login<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header'); ?>
    <h1 class="text-center">Lehrerkalender - Login</h1>
<?php $slotsHelper->stop(); ?>


<?php $slotsHelper->start('content'); ?>
    <div class="container">
        <?php if($error): ?>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <div class="alert alert-danger">
                        <?php echo $error->getMessage(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($username !== false): ?>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <div class="alert alert-info">
                        <p>Danke, dass du dich ausgeloggt hast.<br /><br />Vielleicht sehen wir uns bald mal wieder, <b><?php echo $username; ?></b></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $formHelper->form( $loginFormView ); ?>
    </div>
<?php $slotsHelper->stop(); ?>