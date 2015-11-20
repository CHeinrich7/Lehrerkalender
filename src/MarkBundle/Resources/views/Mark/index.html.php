<?php
use \MarkBundle\Entity\MarkEntity;
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 *
 * @var $data           array
 * @var $teachingUnits  \EducationCalendarBundle\Entity\TeachingUnit[]
 * @var $teachingUnit   \EducationCalendarBundle\Entity\TeachingUnit
 * @var $subject        \SubjectBundle\Entity\SubjectEntity
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::loggedIn.html.php');
?>

<?php $slotsHelper->start('title'); ?>Benotung<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<div id="mark-form-wrapper" style="width:250px;" class="well">
    <form id="mark-form" action="#" class="form-horizontal">
        <div class="form-group">
            <label for="mark" class="control-label col-sm-3">Note</label>
            <div class="col-sm-9">
                <input id="mark" name="mark" class="form-control text-center" type="text" value="100%" />
            </div>
        </div>
        <div class="form-group">
            <label for="mark_type" class="control-label col-sm-3">Typ</label>
            <div class="col-sm-9">
                <select name="mark_type" id="mark_type" class="form-control text-center">
                    <option value="<?php echo MarkEntity::VERBAL;  ?>">Mündlich</option>
                    <option value="<?php echo MarkEntity::SPECIAL; ?>">Sonderleistung</option>
                    <option value="<?php echo MarkEntity::WRITTEN; ?>">Schriftlich</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="button" data-abort class="btn btn-danger pull-left">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <button type="button" data-submit class="btn btn-primary pull-right">
                    <span class="glyphicon glyphicon-ok"></span>
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    td:hover .control-label .form-control {
        border: 1px solid #888;
        padding: 0;
    }

    .control-label .form-control {
        display: inline;
        box-shadow: none;
        background: transparent;
        min-width:30px;
        border: 0;
        padding: 1px;
    }
    .control-label .form-control:focus {
        background: white;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
</style>

<div class="container marks">
    <div class="row">
        <div class="col-xs-12 no-wrap">
            <div id="table-students-holder" class="inline">
                <table id="table-students" class="table table-striped">
                    <thead>
                    <tr>
                        <th class="valign">
                            <h2 class="no-margin text-center"><?php echo $subject->getNameWithEducationClassName(); ?></h2>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $studentData): ?>
                        <tr>
                            <td class="no-padding">
                                <label data-id="<?php echo $studentData['id']; ?>" class="control-label student">
                                    <input name="firstname" type="text" class="form-control" value="<?php echo $studentData['firstname']; ?>" />
                                    <input name="lastname"  type="text" class="form-control" value="<?php echo $studentData['lastname']; ?>" min="3" />
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="no-padding">
                            <label data-id="new" class="control-label student" style="white-space: nowrap">
                                <input name="firstname" type="text" value="Peter Franz" class="form-control" style="min-width:30px;" autocomplete="off" />
                                <input name="lastname"  type="text" value="Detlef Wurst" class="form-control" style="min-width:30px;" min="3" autocomplete="off" />
                            </label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="inline">
                <table id="table-marks" class="table table-striped">
                    <thead>
                    <tr>
                        <?php foreach($teachingUnits as $teachingUnit): ?>
                            <th>
                                <div class="date" data-id="<?php echo $teachingUnit->getId(); ?>"><?php echo $teachingUnit->getDate()->format('d.m.Y'); ?></div>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $studentData): ?>
                        <tr data-id="<?php echo $studentData['id']; ?>">
                            <?php foreach($studentData['teachingUnits'] as $teachingUnitId => $mark): ?>
                                <td><span><?php echo $mark ? $mark : '&nbsp;'; ?></span></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $slotsHelper->stop(); ?>



<script type="text/javascript">
    <?php $slotsHelper->start('jQuery'); ?>

    $.fn.textWidth = function(){
        var $self = $(this),
            val = $self.val(),
            $calculator = $('<span style="display: inline-block;position:absolute;width:auto;left:-9999px;font-weight:bold" />'),
            width;

        $calculator.text(val);
        $('body').append($calculator);
        width = $calculator.width();
        $calculator.remove();
        $self.css('width', width+3);
    };

    $('.control-label .form-control')
        .on('keyup keydown', function() {
            $(this).textWidth();
        }).trigger('keyup');

    var marks =
    {
        debug: <?php echo in_array($app->getEnvironment(), array('dev', 'test')) ? 'true' : 'false'; ?>,

        tableStudentsId:'#table-students',
        tableMarksId:   '#table-marks',
        formWrapperId:  '#mark-form-wrapper',
        tableStudents:  null,
        tableMarks:     null,
        formWrapper:    null,
        values:         null,

        current: {
            date:    null,
            input:   null,
            student: null
        },

        log: function()
        {
            var that = this;
            if(that.debug !== true || arguments.length <= 0) {
                return;
            }

            var index;
            for(index in arguments) {
                if(arguments.hasOwnProperty(index)) {
                    console.log(arguments[index]);
                }
            }

            return that;
        },

        init: function()
        {
            var that = this;

            that.debug = false;

            that.tableStudents = $(that.tableStudentsId);
            that.tableMarks =    $(that.tableMarksId);
            that.values =         that.tableMarks.find('td');
            that.formWrapper =   $(that.formWrapperId);

            that.values
                .on('click', {marks: that}, that.loadMarkForm)
                .on('click', {marks: that, 'class': 'marked-form'}, that.setColors)
                .on('mouseenter', {marks: that, 'class': 'marked'}, this.setColors);

            that.setFormEvents();
        },

        hideForm: function(event)
        {
            var that    = event.data.marks,
                cssClass= 'marked-form';

            $('.'+cssClass).removeClass(cssClass);

            that.formWrapper.fadeOut();
        },

        setFormEvents: function()
        {
            var that = this;
            that.formWrapper.find('[data-abort]').on('click', {marks: that}, that.hideForm);
            that.formWrapper.on('click', function(event) { event.stopImmediatePropagation(); });

            that.tableStudents.find('tr').on('mouseenter', function() {
                var $td,
                    $tr     = $(this),
                    $tbody  = that.tableStudents.find('tbody'),

                    x = 0,
                    y = $tbody.find('tr').index($tr[0]);

                $td = that.tableMarks.find('tbody tr').eq(y).find('td').eq(x);

                $td.trigger('mouseenter');
            });
        },

        loadMarkForm: function(event)
        {
            var that    = event.data.marks;

            that
                .updateCurrent($(this))
                .prepareAndLoadForm($(this));
        },

        prepareAndLoadForm: function($elm)
        {
            var that = this,

                $form = that.formWrapper.find('form');

            $elm.append(that.formWrapper);
            that.formWrapper.fadeIn();

            return that;
        },

        sendAjax: function()
        {
            var that = this;

            return that;
        },

        resetCurrent: function()
        {
            var that = this;

            that.current = {
                date:    null,
                input:   null,
                student: null
            };

            return that;
        },

        updateCurrent: function($elm)
        {
            var that = this,

                position = that.getPosition($elm.parents('td').first()[0]);

            that.current.date    = that.tableMarks.find('.date').eq(position.x);
            that.current.input   = $elm;
            that.current.student = that.tableStudents.find('.student').eq(position.y);

            that.log(that.current);

            return that;
        },

        getPosition: function(elm)
        {
            var that    = this,

                $tr     = $(elm).parent(),
                $tbody  = that.tableMarks.find('tbody');

            var x = $tr.find('td').index(elm),
                y = $tbody.find('tr').index($tr[0]);

            return {x: x, y: y};
        },

        setColors: function(event)
        {
            var that = event.data.marks,

                cssClass  = event.data['class'],

                position  = that.getPosition(this, that),

                ySelector = 'tbody tr:nth-of-type('+ (position.y+1) +') td',
                xSelector = 'td:nth-of-type('+ (position.x+1) +')';

            that.log(this);

            $('.'+cssClass).removeClass(cssClass);

            that.tableStudents.find(ySelector).addClass(cssClass);
            that.tableMarks.find(ySelector).addClass(cssClass);
            that.tableMarks.find(xSelector).addClass(cssClass);
        }
    };

    marks.init();
    window.marks = marks;
    <?php $slotsHelper->stop(); ?>
</script>