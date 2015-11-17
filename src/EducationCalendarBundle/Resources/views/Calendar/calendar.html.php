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

<?php $slotsHelper->start('title'); ?>
Kalender
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>
<div class="container">
    <div class="row">
        <div class='col-sm-6 col-sm-offset-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" style="text-align: center"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($datas as $key => $data): ?>
                    <div class="panel panel-default">
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
                                <table class="table-bordered table table-hover calendarViewCustomTable">
                                    <thead>
                                    <tr>
                                        <th width="5%">Stunde</th>
                                        <th width="5%">Raum</th>
                                        <th width="5%">Klasse</th>
                                        <th width="5%">Fach</th>
                                        <th width="40%">Inhalt</th>
                                        <th width="40%">Notiz</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data['content'] as $x => $contentdata): ?>
                                        <tr>
                                            <td><?php echo $contentdata['stunde']; ?></td>
                                            <td class="calendarViewSmallTD">
                                                <input type="text" class="calendarViewSmallInput"/>
                                            </td>
                                            <td class="calendarViewSmallTD">
                                                <input type="text" class="calendarViewSmallInput"/>
                                            </td>
                                            <td class="calendarViewSmallTD">
                                                <input type="text" class="calendarViewSmallInput"/>
                                            </td>
                                            <td class="calendarViewTableTextAreaTD">
                                                <textarea class="calendarViewTableTextArea" rows="1"></textarea>
                                            </td>
                                            <td class="calendarViewTableTextAreaTD">
                                                <textarea class="calendarViewTableTextArea" rows="1"></textarea>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('jQuery'); ?>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format          : 'DD.MM.YYYY',
            useCurrent      : true,
            calendarWeeks   : true,
            viewMode        : 'days'
        });
    });
<?php $slotsHelper->stop(); ?>
