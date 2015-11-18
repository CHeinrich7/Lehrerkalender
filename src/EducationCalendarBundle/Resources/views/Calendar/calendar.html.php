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

$view->extend('::loggedIn.html.php');

?>

<?php $slotsHelper->start('title'); ?>Kalender<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<?php $days = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-xs-2">
            <h2 class="no-margin pull-right pointer">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </h2>
        </div>
        <div class="col-sm-4 col-xs-8 pointer">
            <div id="calendarViewDatePicker" class="input-group">
                <input type="text" class="form-control text-center" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-4 col-xs-2">
            <h2 class="no-margin pull-left pointer">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </h2>
        </div>
    </div>

    <div class="table table-div">
        <div class="row">
            <div class="panel-group accordion">
                <?php foreach($days as $key => $day): ?>
                    <div class="panel-content panel-content-<?php echo strtolower($day); ?>">
                        <div class="panel-heading" role="tab">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse<?php echo $key; ?>">
                                <h4 class="panel-title"><?php echo $day; ?></h4>
                            </a>
                        </div>
                        <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <?php for($block = 0; $block < 5; $block++): ?>
                                    <div class="col-xs-12 td-div td-div-<?php echo $block; ?>">
                                        <form action="#" class="form-horizontal row">
                                            <div class="col-lg-3 col-xs-4">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-3 cell">
                                                        <label>
                                                            <input type="text" class="form-control" placeholder="<?php echo ($block+1); ?>" autocomplete="off" disabled />
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-3 cell">
                                                        <label>
                                                            <input type="text" class="form-control" placeholder="Raum" autocomplete="off" />
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 cell">
                                                        <label>
                                                            <input type="text" class="form-control" placeholder="Fach/Klasse" autocomplete="off" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-4 col-xs-8 cell">
                                                <label>
                                                    <textarea class="form-control height-34" placeholder="Inhalt" autocomplete="off"></textarea>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-sm-4 col-xs-8 cell">
                                                <label>
                                                    <textarea class="form-control height-34" placeholder="Notiz" autocomplete="off"></textarea>
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<script>
    <?php $slotsHelper->start('jQuery'); ?>
    $('#calendarViewDatePicker')
        .datetimepicker({
            format          : 'DD.MM.YYYY',
            useCurrent      : true,
            calendarWeeks   : true,
            viewMode        : 'days'
        })
        .on("dp.change",function(e){
            console.log(e.date._d);
        });

    $('textarea.height-34').each(function() {
        $(this)
            .on('focus', function() { $(this).removeClass('height-34'); })
            .on('focusout', function() { $(this).addClass('height-34'); })
    });
    <?php $slotsHelper->stop(); ?>
</script>
