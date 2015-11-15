<?php
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::base.html.php');

?>

<?php $slotsHelper->start('title'); ?>
    test
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapseOne">
                    Collapsible Group Item #1
                </a>
                <a data-toggle="collapse" href="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible Group Item #2
                </a>
                <a data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                    Collapsible Group Item #3
                </a>
                <div id="collapse1" class="panel-collapse collapse pull-left" role="tabpanel" aria-labelledby="headingOne">
                    inhalt1
                </div>
                <div id="collapse2" class="panel-collapse collapse pull-left" role="tabpanel" aria-labelledby="headingTwo">
                    inhalt2
                </div>
                <div id="collapse3" class="panel-collapse collapse pull-left" role="tabpanel" aria-labelledby="headingThree">
                    inhalt3
                </div>
            </div>
        </div>
    </div>
<?php $slotsHelper->stop(); ?>