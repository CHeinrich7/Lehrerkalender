<?php
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 *
 * @var $tableResponse  \Symfony\Component\HttpFoundation\Response
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

    .table-div .placeholder {
        color: #999 !important;
    }

    /*
        OVERRIDE SOME CHOSEN STYLES
        only for .table-div
    */
    .table-div select.form-control + .chosen-container.chosen-container-single .chosen-single > div {
        display: none;
    }

    .table-div select.form-control + .chosen-container.chosen-container-single .chosen-single > span {
        margin: 0;
    }

    .table-div select.form-control + .chosen-container.chosen-container-single .chosen-single,
    .table-div select.form-control + .chosen-container.chosen-container-single .active-result,
    .table-div select.form-control + .chosen-container.chosen-container-single .chosen-search input {
        padding: 6px 0;
        text-align: center;
        box-shadow: none;
        background: transparent;
    }

    .table-div select.form-control + .chosen-container.chosen-container-single .chosen-single,
    .table-div select.form-control + .chosen-container.chosen-container-single .active-result {
        border: 0;
    }

    .table-div select.form-control + .chosen-container.chosen-container-single .active-result.highlighted {
        color: black;
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
                <input id="datepicker" type="date" class="form-control text-center" autocomplete="off" value="<?php echo date('d.m.Y'); ?>" />
                <label for="datepicker" class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </label>
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
            <div id="accordion" class="panel-group accordion">
                <?php echo $tableResponse->getContent(); ?>
            </div>
        </div>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<script>
    <?php $slotsHelper->start('jQuery'); ?>

    var
        format  = 'dd.mm.yyyy',
        $picker = $('#datepicker'),
        pickerInitialized = false,
        datepickerOptions = {
            format          : format,
            calendarWeeks   : true,
            viewMode        : 'days',
            language        : 'de',
            allowInputToggle: true
        },

        changeAccordionAjax = null
        ;

    /**
     * @param mObj moment with date of #datepicker value
     */
    function updateWeekData(mObj)
    {
        // initialize new moment objects with date of previews- and next week date
        var
            prevWeek = new moment(mObj).days(-6),
            nextWeek = new moment(mObj).days(8);

        // '< KW 32'
        $("#prevWeek").data('week', prevWeek.isoWeek()).find('.week').html( "KW " + prevWeek.isoWeek());
        // 'KW 34 >'
        $("#nextWeek").data('week', nextWeek.isoWeek()).find('.week').html( "KW " + nextWeek.isoWeek());
    }

    /**
     * @param mObj moment with date of #datepicker value
     */
    function changeAccordionData(mObj)
    {

        var $accordion = $('#accordion'),

            time = mObj.valueOf(),

            proto_url = '<?php echo $routerHelper->generate('education_calendar_accordion_response', ['time' => '_time_']); ?>',
            route = proto_url.replace('_time_', time);

        $accordion.fadeOut();

        changeAccordionAjax = $.ajax({
            url: route,
            success: function(response) {
                $('#accordion').html(response);
                refreshChosen();
                $accordion.fadeIn();
            }
        })
    }

    $picker
        .datepicker(datepickerOptions)
        .on('changeDate', function() {
            updateWeekData(new moment($(this).val(), format.toUpperCase()));

            if(pickerInitialized !== true) {
                pickerInitialized = true;
            } else {
                changeAccordionData(new moment($(this).val(), format.toUpperCase()));
            }
        })
        .trigger('changeDate');

    // datepicker gets update when clicking on '< KW 32' or 'KW 34 >'
    $('#prevWeek, #nextWeek').on('click', function()
    {
        var mObj        = new moment($picker.val(), format.toUpperCase()),
            addToWeek   = ( $(this).attr('id') === 'prevWeek' )
                            ? (-1)
                            : 1
            ;

        if(changeAccordionAjax !== null) {
            changeAccordionAjax.abort();
        }

        // first day of week in moment.js is sunday, but we need monday
        mObj.isoWeekday(1)

            .isoWeek(mObj.isoWeek()+addToWeek);

        // udpate picker and trigger that it's updated
        $picker
            .datepicker('update', mObj._d)
            .trigger('changeDate');
    });

    // this is for that jumpy textareas in calendar
    $('textarea.height-34').each(function() {
        $(this)
            .on('focus', function() { $(this).removeClass('height-34'); })
            .on('focusout', function() { $(this).addClass('height-34'); })
    });

    function saveEntity($that, $target, $subject)
    {
        var block   = $that.data('block'),  // UnitBlock
            time    = $that.data('time'),   // time for \DateTime
            subject = $subject.val(),       // SubjectEntity::id

            data    = {
                key : $target.attr('name'),
                val : $target.val()
            },

            proto_route = '<?php
                echo $routerHelper->generate('teaching_unit_save', [
                    'block'     => '_block_',
                    'time'      => '_time_',
                    'subject'   => '_subject_'
                ]);
                ?>',

            route   = proto_route
                .replace('_block_'  , block)
                .replace('_time_'   , time)
                .replace('_subject_', subject)
            ;

        $.ajax({
            url: route,
            data: data,
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function deleteEntity($that, $target)
    {
        var block   = $that.data('block'),  // UnitBlock
            time    = $that.data('time'),   // time for \DateTime

            proto_route = '<?php
                echo $routerHelper->generate('teaching_unit_remove', [
                    'block'     => '_block_',
                    'time'      => '_time_'
                ]);
                ?>',

            route   = proto_route
                .replace('_block_', block)
                .replace('_time_', time)
            ;

        $.ajax({
            url: route,
            success: function(response) { console.log(response) }
        });
    }

    function sendFormAjax(event)
    {
        var $that   = $(this),
            $target = $(event.target),
            $subject= $that.find('[name="subject_class"]');

        // do not save TeachingUnit without Subject
        if(!$subject.val()) {
            deleteEntity($that, $target);
        } else {
            saveEntity($that, $target, $subject);
        }
    }

    $(document).on('change', 'form', sendFormAjax);

    <?php $slotsHelper->stop(); ?>
</script>
