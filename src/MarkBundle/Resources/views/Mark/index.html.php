<?php
/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $error          Symfony\Component\Security\Core\Exception\AuthenticationServiceException
 *
 * @var $name           string
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::loggedIn.html.php');

?>

<?php $slotsHelper->start('title'); ?>Benotung<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<div id="mark-form-wrapper" style="width:250px;" class="well">
    <form action="" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3">Note</label>
            <div class="col-sm-9">
                <input class="form-control text-center" type="text" value="100%" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Typ</label>
            <div class="col-sm-9">
                <select name="" id="" class="form-control text-center">
                    <option value="">Mündlich</option>
                    <option value="">Sonderleistung</option>
                    <option value="">Schriftlich</option>
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

<div class="container marks">
    <div class="row">
        <div class="col-xs-12 no-wrap">
            <div id="table-students-holder" class="inline">
                <table id="table-students" class="table table-striped">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($k = 0; $k < 20; $k++): ?>
                        <tr>
                            <td>
                                <label data-id="<?php echo $k; ?>" class="control-label student">Schüler Name</label>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            <div class="inline">
                <table id="table-marks" class="table table-striped">
                    <thead>
                    <tr>
                        <?php $max = 20; for($i = 0; $i < $max; $i++): ?>
                            <th>
                                <div class="date" data-id="<?php echo $i; ?>">00.00.00</div>
                            </th>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($k = 0; $k < 20; $k++): ?>
                        <tr>
                            <?php for($i = 0; $i < $max; $i++): ?>
                                <td><span>100%</span></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $slotsHelper->stop(); ?>



<script type="text/javascript">
    <?php $slotsHelper->start('jQuery'); ?>

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