<?php
/**
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 *
 * @var $data           array
 * @var $index          integer
 * @var $subjects       array
 */
$date = date('d', $data['time']);
?>
<div class="panel-content panel-content-<?php echo strtolower($data['day']); ?>">
    <div class="panel-heading" role="tab">
        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $index; ?>">
            <h4 class="panel-title"><p class="small pull-left">(<?php echo $date; ?>.)</p><?php echo $data['day']; ?></h4>
        </a>
    </div>
    <div id="collapse-<?php echo $index; ?>" class="panel-collapse collapse" role="tabpanel">
        <div class="panel-body">
            <?php foreach($data['blocks'] as $block => $teachingUnit): ?>
                <div class="col-xs-12 td-div td-div-<?php echo $block; ?>">
                    <?php echo $view->render('EducationCalendarBundle:Calendar:accordionPanelForm.html.php', [
                        'block'     => $block,
                        'time'      => $data['time'],
                        'subjects'  => $subjects,
                        'teachingUnit'  => $teachingUnit
                    ]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
