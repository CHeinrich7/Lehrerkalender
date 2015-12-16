<?php
use EducationCalendarBundle\Entity\TeachingUnitEntity;
/**
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 *
 * @var $block          integer
 * @var $day            string
 * @var $time           integer
 * @var $data           array
 * @var $teachingUnit   TeachingUnitEntity|null
 * @var $subjects       array
 */

$data = [
    'block'     => $block,
    'room'      => '',
    'subject_class' => [
        'selected' => '',
        'choices' => $subjects
    ],
    'content'   => '',
    'notice'    => ''
];

if($teachingUnit instanceof TeachingUnitEntity === true) {
    $data['room']    = $teachingUnit->getRoom();
    $data['content'] = $teachingUnit->getContent();
    $data['notice']  = $teachingUnit->getNotice();
    $data['subject_class']['selected'] = $teachingUnit->getSubject()->getId();
}

?>
<form action="#" class="form-horizontal row" data-block="<?php echo $data['block']; ?>" data-time="<?php echo $time; ?>" autocomplete="off">
    <div class="col-lg-3 col-xs-4">
        <div class="row">
            <div class="col-lg-4 col-sm-3 cell">
                <label>
                    <input type="text" class="form-control" name="block" placeholder="<?php echo $data['block']; ?>" autocomplete="off" disabled />
                </label>
            </div>
            <div class="col-lg-4 col-sm-3 cell">
                <label>
                    <input type="text" class="form-control" name="room" placeholder="Raum" value="<?php echo $data['room']; ?>" autocomplete="off" maxlength="5"/>
                </label>
            </div>
            <div class="col-lg-4 col-sm-6 cell">
                <label>
                    <select class="form-control placeholder chosen-select" name="subject_class" autocomplete="off">
                        <option value="" class="placeholder">Klasse - Fach</option>
                        <?php foreach($data['subject_class']['choices'] as $index => $subject): ?>
                            <option
                                data-education-class="<?php echo $subject['class']; ?>"
                                value="<?php echo $index; ?>"
                                <?php if($index == $data['subject_class']['selected']): ?>selected="selected"<?php endif; ?>>
                                <?php echo $subject['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-sm-4 col-xs-8 cell">
        <label>
            <textarea class="form-control height-34" name="content" placeholder="Inhalt" autocomplete="off"><?php echo $data['content']; ?></textarea>
        </label>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-4 col-xs-8 cell">
        <label>
            <textarea class="form-control height-34" name="notice" placeholder="Notiz" autocomplete="off"><?php echo $data['notice']; ?></textarea>
        </label>
    </div>
</form>
