<?php
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper;

/* @var $error AuthenticationServiceException */
/* @var $username string */
/* @var $view Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */

/* @var $loginForm      Symfony\Component\Form\Form */
/* @var $loginFormView  Symfony\Component\Form\FormView */

$slotsHelper = $view['slots']; /* @var $slotsHelper SlotsHelper */
$routerHelper = $view['router']; /* @var $routerHelper RouterHelper */
$formHelper = $view['form']; /* @var $formHelper FormHelper */

$loginFormView = $loginForm->createView();

$view->extend('::base.html.php');
$formHelper->setTheme($loginFormView, ':Form');

?>

<?php $slotsHelper->start('title') ?>Login<?php $slotsHelper->stop('title') ?>

<?php $slotsHelper->start('header') ?>
    <h1 style="margin: 6px 0 7px;" class="text-center">Lehrerkalender - Login</h1>
<?php $slotsHelper->stop('header') ?>


<?php $slotsHelper->start('content') ?>
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

        <?php
        echo $formHelper->start( $loginFormView );

        echo $formHelper->row( $loginFormView->children['_username'] );
        echo $formHelper->row( $loginFormView->children['_password'] );

        echo $formHelper->row( $loginFormView->children['save'] );

        echo $formHelper->end( $loginFormView );
        ?>
    </div>
<?php $slotsHelper->stop('content') ?>