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

$view->extend('::base.html.php');

?>

<?php $slotsHelper->start('content'); ?>
    <style>
        .date {
            transform:  rotate(-45deg);
            margin-top: 20px;
            width:      30px;
            height:     20px;
            margin-left:10px;
        }

        .inline {
            display:        inline-block;
            vertical-align: top;
        }

        .inline table thead {
            height:60px;
        }

        .inline table tbody td {
            height: 53px;
            vertical-align: middle;
        }

        .inline td label {
            margin: 0;
        }

        .no-wrap {
            white-space: nowrap;
        }

        th {
            position:relative;
        }

        .arrow {
            position:absolute;
            right: 0;
            bottom: -5px;
        }

        #table-students {
            position:absolute;
            background: white;
            z-index:2;
            left:15px;
        }

        #table-marks {
            z-index:1;
        }

        #table-students-holder {
            position:relative;
            width:150px;
            margin-left:-15px;
        }

        .marked {
            background-color: #eee !important;
        }

        .ajax {
            background-color: #5cb85c !important;
        }
    </style>

    <div class="container-fluid">
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
                                <?php $max = 80; for($i = 0; $i < $max; $i++): ?>
                                <th>
                                    <div class="date" data-id="<?php echo $i; ?>">00.00.00</div>
                                    <div class="arrow">
                                        <span class="glyphicon glyphicon-chevron-down"></span>
                                    </div>
                                </th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($k = 0; $k < 20; $k++): ?>
                            <tr>
                                <?php for($i = 0; $i < $max; $i++): ?>
                                    <td>
                                        <input data-id="" data-last-value="" onfocus="this.select();" type="text" class="form-control no-padding-horizontal text-center" autocomplete="off" />
                                    </td>
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
        tableStudents:  null,
        tableMarks:     null,
        inputs:         null,

        current: {
            date:    null,
            input:   null,
            student: null
        },

        log: function()
        {
            if(this.debug !== true || arguments.length <= 0) {
                return;
            }

            var index;
            for(index in arguments) {
                if(arguments.hasOwnProperty(index)) {
                    console.log(arguments[index]);
                }
            }
        },

        init: function()
        {
            var that = this;

            that.tableStudents = $(that.tableStudentsId);
            that.tableMarks =    $(that.tableMarksId);
            that.inputs =        that.tableMarks.find('input');

            that.inputs
                .on('focus focusout', {marks: that}, that.updateInput);

            $(document).on('mouseenter', that.tableMarksId + ' td', {marks: that}, this.setColors);

            $(window).on('scroll', function() {
                that.tableStudents.css({
                    'left': $(this).scrollLeft()
                });
            }).trigger('scroll');
        },

        updateInput: function(event)
        {
            var that    = event.data.marks,

                currVal = $(this).val(),
                lastVal = $(this).data('last-value');

            if(event.type === 'focus')
            {
                $(this).data('last-value', currVal);
            }
            else if(event.type === 'focusout')
            {
                that.log('currVal = ' + currVal + ', lastVal = ' + lastVal);

                if(currVal !== lastVal) {
                    that.updateCurrent($(this));
                    that.sendAjax();
                }

                that.resetCurrent();
            }
        },

        sendAjax: function()
        {
            var that = this;
        },

        resetCurrent: function()
        {
            this.current = {
                date:    null,
                input:   null,
                student: null
            };
        },

        updateCurrent: function($elm)
        {
            var that = this,

                position = that.getPosition($elm.parents('td').first()[0]);

            that.current.date    = that.tableMarks.find('.date').eq(position.x);
            that.current.input   = $elm;
            that.current.student = that.tableStudents.find('.student').eq(position.y);

            that.log(that.current);
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

                position  = that.getPosition(this, that),

                ySelector = 'tbody tr:nth-of-type('+ (position.y+1) +')',
                xSelector = 'td:nth-of-type('+ (position.x+1) +')';

            $('.marked').removeClass('marked');

            that.tableStudents.find(ySelector).addClass('marked');
            that.tableMarks.find(ySelector).addClass('marked');
            that.tableMarks.find(xSelector).addClass('marked');
        }
    };

    marks.init();
    window.marks = marks;
    <?php $slotsHelper->stop(); ?>
</script>
