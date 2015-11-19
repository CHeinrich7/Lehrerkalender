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

<style>
    .week {
        font-size: 20px;
        margin-top: 6px;
    }

    .cw {
        color: grey;
    }

    th.cw::before {
        content: 'KW';
    }

    .datepicker {
        min-width: 230px;
        cursor: pointer;
    }

    .table-div {
        margin-top: 40px;
    }

    @media(max-width: 499px) {
        .week {
            display: none;
        }

        .date-holder h2 {
            text-align: center;
            float: none !important;
        }
    }
</style>

<div class="container">
    <div class="row date-holder">
        <div class="col-sm-4 col-xs-3">
            <h2 id="prevWeek" class="no-margin pull-right pointer">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <div class="pull-right week">KW --</div>
            </h2>
        </div>
        <div class="col-sm-4 col-xs-6 pointer">
            <div class="input-group date" id="calendarViewDatePicker">
                <input type="date" class="form-control text-center" autocomplete="off" value="<?php echo date('d.m.Y'); ?>" id="wasd" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="col-sm-4 col-xs-3">
            <h2 id="nextWeek" class="no-margin pull-left pointer">
                <div class="week pull-left">KW --</div>
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


    var format  = 'dd.mm.yyyy',
        $picker = $('#calendarViewDatePicker'),
        $input  = $picker.find('input'),

        prevWeek,
        nextWeek;

    function updateWeekData(mObj)
    {
        prevWeek = new moment(mObj).days(-6);
        nextWeek = new moment(mObj).days(8);

        $("#prevWeek").data('week', prevWeek.isoWeek()).find('.week').html( "KW " + prevWeek.isoWeek());
        $("#nextWeek").data('week', nextWeek.isoWeek()).find('.week').html( "KW " + nextWeek.isoWeek());
    }

    $picker
        .datepicker({
            format          : format,
            calendarWeeks   : true,
            viewMode        : 'days',
            language        : 'de',
            allowInputToggle: true
        })
        .on('changeDate', function() {
            updateWeekData(moment($input.val(), format.toLocaleUpperCase()));
        })
        .trigger('changeDate');

    $('#prevWeek, #nextWeek').on('click', function()
    {
        console.log(this, $(this).data('week'));

        var mObj = new moment($input.val(), 'DD.MM.YYYY');

        mObj.isoWeekday(1);
        mObj.isoWeek(mObj.isoWeek()+1);

        var dateString = mObj.date() + '.' + ( mObj.month() + 1 ) + '.' + mObj.year();

        $picker.datepicker('update', mObj._d);

        $input.val(dateString).trigger('changeDate');
    });

    $('textarea.height-34').each(function() {
        $(this)
            .on('focus', function() { $(this).removeClass('height-34'); })
            .on('focusout', function() { $(this).addClass('height-34'); })
    });
    <?php $slotsHelper->stop(); ?>
</script>
