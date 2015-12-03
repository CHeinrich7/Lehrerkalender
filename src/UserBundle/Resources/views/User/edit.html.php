<?php
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    ToolboxBundle\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 * @var $formHelper     Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper
 *
 * @var $userForm       Symfony\Component\Form\Form
 * @var $userFormView   Symfony\Component\Form\FormView
 *
 * @var $newUser        boolean
 */

$slotsHelper    = $view['slots'];
$routerHelper   = $view['router'];
$formHelper     = $view['form'];

$userFormView   = $userForm->createView();

$isAdmin        = $app->getSecurity()->isGranted(\UserBundle\Entity\Role::ROLE_ADMIN);

$view->extend('::loggedIn.html.php');
$formHelper->setTheme($userFormView, ':Form');

?>

<?php $slotsHelper->start('title'); ?>
User <?php if($newUser): ?>anlegen<?php else: ?>editieren<?php endif; ?>
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content') ?>
<?php
echo $formHelper->start( $userFormView );

echo $formHelper->row( $userFormView->children['_token'] );
echo $formHelper->row( $userFormView->children['username'] );

if($isAdmin) {
    echo $formHelper->row( $userFormView->children['role'] );
}

if(!isset($newUser) || $newUser == false) {
    echo $formHelper->row( $userFormView->children['password'] );
}

echo $formHelper->row( $userFormView->children['plainPassword'] );

echo $formHelper->row( $userFormView->children['save'] );

echo $formHelper->end( $userFormView );
?>
<?php $slotsHelper->stop() ?>