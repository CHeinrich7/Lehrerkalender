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

<?php $slotsHelper->start('title'); ?>
Kalender
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<style>
    .panel-content {
        position:relative;
        z-index: 2;
        overflow:hidden;
    }

    .panel {
        z-index: 2;
        position:relative;
    }


    .panel-content-montag::before,
    .panel-content-dienstag::before,
    .panel-content-mittwoch::before,
    .panel-content-donnerstag::before,
    .panel-content-freitag::before,
    .panel-content-samstag::before,
    .panel-content-sonntag::before {
        position:absolute;
        font-size: 250px;
        color: #f5f5f5;
        z-index:-1;
        right: 0;
    }

    .panel-content-montag::before {
        content: 'MO';
    }
    .panel-content-dienstag::before {
        content: 'DI'
    }
    .panel-content-mittwoch::before {
        content: 'MI';
    }
    .panel-content-donnerstag::before {
        content: 'DO';
    }
    .panel-content-freitag::before {
        content: 'FR';
    }
    .panel-content-samstag::before {
        content: 'SA';
    }
    .panel-content-sonntag::before {
        content: 'SO';
    }

    table input.form-control,
    table textarea.form-control {
        /*background: transparent;*/
        box-shadow: none;
    }

    table textarea.height-34 {
        height: 34px;
    }

    table tr:hover input,
    table tr:hover textarea {
        background: white;
    }

    .table-hover > tbody > tr:hover {
        background: rgba(245, 245, 245, 0.5);
    }

    table label {
        display: block;
        font-weight: normal;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2 class="no-margin pull-right pointer">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </h2>
        </div>
        <div class="col-sm-4 pointer">
            <div id="calendarViewDatePicker" class="input-group">
                <input type="text" class="form-control text-center" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-4">
            <h2 class="no-margin pull-left pointer">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </h2>
        </div>
    </div>
    <div class="row" style="margin-top: 40px">
        <div class="col-xs-12">
            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($datas as $key => $data): ?>
                    <div class="panel panel-default">
                        <div class="panel-content panel-content-<?php echo strtolower($data['title']); ?>">
                            <div class="panel-heading" role="tab" id="heading<?php echo $key; ?>">
                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse<?php echo $key; ?>" aria-expanded="false"
                                   aria-controls="collapse<?php echo $key; ?>">
                                    <h4 class="panel-title"><?php echo $data['title']; ?></h4>
                                </a>
                            </div>
                            <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="heading<?php echo $key; ?>">
                                <div class="panel-body">
                                    <?php echo $view->render('EducationCalendarBundle:Calendar:calendarDayTable.html.php', ['data' => $data]); ?>
                                </div>
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

    $('table textarea.height-34').each(function() {
        $(this)
            .on('focus', function() { $(this).removeClass('height-34'); })
            .on('focusout', function() { $(this).addClass('height-34'); })
    });
    <?php $slotsHelper->stop(); ?>
</script>
