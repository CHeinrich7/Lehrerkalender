<?php
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper;

/* @var $view Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */
/* @var $formHelper     FormHelper  */
/* @var $profileForm      Symfony\Component\Form\Form */
/* @var $profileFormView  Symfony\Component\Form\FormView */


$slotsHelper = $view['slots']; /* @var $slotsHelper SlotsHelper */
$routerHelper = $view['router']; /* @var $routerHelper RouterHelper */
$formHelper = $view['form'];

$profileFormView = $profileForm->createView();

$view->extend('::base.html.php');
$formHelper->setTheme($profileFormView, ':Form');

?>

<?php $slotsHelper->start('content') ?>
    <div class="container">
        <?php
        echo $formHelper->start( $profileFormView );

        echo $formHelper->row( $profileFormView->children['firstname'] );
        echo $formHelper->row( $profileFormView->children['lastname'] );
        echo $formHelper->row( $profileFormView->children['email'] );
        echo $formHelper->row( $profileFormView->children['showMail'] );
        echo $formHelper->row( $profileFormView->children['number'] );
        echo $formHelper->row( $profileFormView->children['number2'] );
//        echo $formHelper->row( $profileFormView->children['image'] );

        echo $formHelper->row( $profileFormView->children['save'] );

//        echo $formHelper->rest( $profileFormView );

        echo $formHelper->end( $profileFormView );
        ?>
    </div>
<?php $slotsHelper->stop('content') ?>