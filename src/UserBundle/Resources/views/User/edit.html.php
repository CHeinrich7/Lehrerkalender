<?php
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper;

/* @var $view Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */
/* @var $formHelper     FormHelper  */
/* @var $userForm      Symfony\Component\Form\Form */
/* @var $userFormView  Symfony\Component\Form\FormView */


$slotsHelper = $view['slots']; /* @var $slotsHelper SlotsHelper */
$routerHelper = $view['router']; /* @var $routerHelper RouterHelper */
$formHelper = $view['form'];

$userFormView = $userForm->createView();

$view->extend('::loggedIn.html.php');
$formHelper->setTheme($userFormView, ':Form');

?>

<?php $slotsHelper->start('content') ?>
<?php
echo $formHelper->start( $userFormView );

echo $formHelper->row( $userFormView->children['username'] );
echo $formHelper->row( $userFormView->children['password'] );

if(!isset($newUser) || $newUser == false) {
    echo $formHelper->row( $userFormView->children['plainPassword'] );
}

echo $formHelper->row( $userFormView->children['save'] );

echo $formHelper->end( $userFormView );
?>
<?php $slotsHelper->stop('content') ?>