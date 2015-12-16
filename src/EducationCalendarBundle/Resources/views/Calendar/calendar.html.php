<?php
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    ToolboxBundle\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 *
 * @var $tableResponse  Symfony\Component\HttpFoundation\Response
 * @var $education_classes array
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::loggedIn.html.php');
?>

<?php $slotsHelper->start('title'); ?>Kalender<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->append('header-css'); ?>
<link href="/css/table-div.css" rel="stylesheet" />
<style>
    .date-holder .week {
        font-size: 20px;
        margin-top: 6px;
    }

    @media(max-width: 499px) {
        .date-holder .week {
            display: none;
        }

        .date-holder h2 {
            text-align: center;
            float: none !important;
        }

        #datepicker {
            border-radius: 4px;
        }

        #datepicker + label {
            display: none;
        }
    }

    .dropdown-menu {
        right: 0;
        left: auto;
    }

    .dropdown-menu > li > label {
        clear: both;
        color: #333;
        display: block;
        font-weight: 400;
        line-height: 2;
        padding: 10px;
        white-space: nowrap;
    }

    .dropdown-menu > li > label:hover {
        background-color: #f5f5f5;
        color: #262626;
    }

    #filter input:not(:checked) + span::before {
        display: none;
    }

    #filter input + span::before {
        font-size: 20px;
    }

    #filter input:not(:checked) + span + span {
        margin-left: 20px;
    }

    .datepicker {
        right: auto;
    }

    .datepicker .datepicker-days td, th {
        padding: 9px;
    }

    .filtered {
        color: green;
    }

    .date-holder h2:hover,
    .dropdown .glyphicon-filter:hover,
    .panel-title:hover {
        color: #337ab7;
    }

    .dropdown .glyphicon-filter {
        font-size: 25px;
        margin-top: 3px;
    }

    .panel-title .small {
        width:35px;
        margin-bottom:0;
        margin-top:4px;
    }
</style>
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<?php $days = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']; ?>

<div class="row date-holder">
    <div class="col-md-offset-1 col-md-3 col-sm-4 col-xs-3">
        <h2 id="prevWeek" class="no-margin pull-right pointer">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="pull-right week">KW --</span>
        </h2>
    </div>
    <div class="col-sm-3 col-xs-4 no-padding">
        <div class="input-group date full-width" id="calendarViewDatePicker">
            <input id="datepicker" type="text" class="form-control text-center" autocomplete="off" value="<?php echo date('d.m.Y'); ?>" />
            <label for="datepicker" class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </label>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-3">
        <h2 id="nextWeek" class="no-margin pull-left pointer">
            <span class="week pull-left">KW --</span>
            <span class="glyphicon glyphicon-chevron-right"></span>
        </h2>
    </div>
    <div class="col-md-2 col-sm-1 col-xs-2 no-padding text-center">
        <div class="dropdown">
            <label class="glyphicon glyphicon-filter pointer full-width" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></label>
            <ul class="dropdown-menu pointer" id="filter">
                <li>
                    <label class="pointer">
                        <input name="radio-education-class" value="" type="radio" class="hidden" autocomplete="off" checked="checked" />
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="text-holder"><b>&nbsp;nicht Filtern</b></span>
                    </label>
                </li>
                <?php foreach($education_classes as $id => $name) : ?>
                    <li>
                        <label class="pointer">
                            <input name="radio-education-class" value="<?php echo $id; ?>" type="radio" class="hidden" autocomplete="off" />
                            <span class="glyphicon glyphicon-ok"></span>
                            <span class="text-holder"><b>&nbsp;<?php echo $name; ?></b></span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="table table-div">
    <div class="row">
        <div id="accordion" class="panel-group accordion">
            <?php echo $tableResponse->getContent(); ?>
        </div>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<script type="text/javascript">
    <?php $slotsHelper->append('jQuery'); ?>

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
        mObj.isoWeekday(1);
        // initialize new moment objects with date of previews- and next week date
        var
            prevWeek = new moment(mObj).days(-7),
            nextWeek = new moment(mObj).days(7);

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

            time = mObj.unix(),

            proto_url = '<?php echo $routerHelper->generate('education_calendar_accordion_response', ['time' => '_time_']); ?>',
            route = proto_url.replace('_time_', time);

        $accordion.fadeOut();

        changeAccordionAjax = $.ajax({
            url: route,
            success: function(response) {
                $('#accordion').html(response);
                refreshChosen();
                $accordion.fadeIn();
                $('#filter').find('input:checked').trigger('click');
            }
        })
    }

    $picker
        .datepicker(datepickerOptions)
        .on('changeDate', function() {

            var mObj     = new moment($(this).val(), format.toUpperCase()),
                lastWeek    = $(this).data('week'),
                currentWeek = mObj.isoWeek();

            $(this).data('week', currentWeek);
            updateWeekData(mObj);

            if(pickerInitialized !== true) {
                pickerInitialized = true;
            } else if(lastWeek !== currentWeek) {
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
            success: function(/*response*/) {
                //console.log(response);
            },
            error: function(/*response*/) {
                //console.log(response);
            }
        });
    }

    function deleteEntity($that)
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
            success: function(/*response*/) { /*console.log(response)*/ }
        });
    }

    function sendFormAjax(event)
    {
        var $that   = $(this),
            $target = $(event.target),
            $subject= $that.find('[name="subject_class"]');

        // do not save TeachingUnit without Subject
        if(!$subject.val()) {
            deleteEntity($that);
        } else {
            saveEntity($that, $target, $subject);
        }
    }

    $(document).on('change', 'form', sendFormAjax);

    function filter(/*event*/)
    {
        var $that       = $(this),
            filterVal   = $that.val(),
            $headers    = $(document).find('.panel-heading'),
            filterClass = 'collapse-filtered',
            $accordion  = $('#accordion'),
            $filterIcon = $('#filter').prev();

        $(document)
            .find('.'+filterClass)
            .removeClass(filterClass);

        if(filterVal) {
            $accordion
                .find('.chosen-select > option:selected')
                .each(function() {

                    var optionVal   = $(this).data('education-class'),
                        $td         = $(this).parents('.td-div'),
                        $header     = $(this).parents('.panel-collapse').prev();

                    if(optionVal == filterVal) {
                        $td.css('display', 'block');

                        $header.addClass(filterClass);
                    } else {
                        $td.css('display', 'none');
                    }
                });

            $headers.each(function() {
                var $a = $(this).find('a');
                if($(this).hasClass(filterClass) && $a.attr('aria-expanded') === 'false') {
                    $a.trigger('click');
                }
            });

            $filterIcon.addClass('filtered');

        } else {
            $accordion
                .find('.td-div')
                .css('display', 'block');

            $filterIcon.removeClass('filtered');
        }
    }

    $('#filter').find('input').on('click', filter);

    <?php $slotsHelper->stop(); ?>
</script>
