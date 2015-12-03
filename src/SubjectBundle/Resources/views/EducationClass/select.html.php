<?php

/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    ToolboxBundle\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 *
 * @var $classEntities  SubjectBundle\Entity\EducationClassEntity[]
 * @var $userSubjects   array
 * @var $allSubjects    array
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::loggedIn.html.php');

$isAdmin = $app->getSecurity()->isGranted(\UserBundle\Entity\Role::ROLE_ADMIN);

?>

<?php $slotsHelper->start('title'); ?>Klasse auswaehlen<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->append('header-css'); ?>
<style>
    .table .btn-holder {
        width: 70px;
    }

    .edit-link {
        position:absolute;
        left:0;
        top:0;
        width:100%;
        height:100%;
        display:block;
        padding:8px;
    }

    .table td {
        position:relative;
    }

    .table .btn-holder .btn-xs {
        position: absolute;
        left: 25px;
        top: 7px;
    }

    .table > thead > tr > th,
    .table > tbody > tr > td {
        padding: 8px 0;
    }

    .table tr:hover .btn-holder .btn-xs {
        left: 24px;
        top: 3px;
        font-size: 16px;
    }

    .table tr .btn-holder a {
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }

    @media(max-width: 767px) {
        .modal .modal-footer,
        .modal .modal-body,
        .table,
        button[data-toggle="modal"] {
            font-size: 20px;
        }


        .table .btn-holder .btn-xs {
            left: 25px;
            top: 10px;
        }

        .table tr:hover .btn-holder .btn-xs {
            left: 24px;
            top: 7px;
        }
    }
</style>
<?php $slotsHelper->stop(); ?>
<?php $slotsHelper->start('content'); ?>


<div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-xs-offset-2 col-xs-8 no-padding">
        <table id="subject-holder" class="table table-striped table-hover text-center">
            <thead>
            <tr>
                <th class="text-center">Klasse</th>
                <th class="text-center">Fach</th>
                <?php if($isAdmin): ?>
                    <th class="text-center">Option</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userSubjects as $subject): ?>
                <tr>
                    <td><?php echo $subject['class']; ?></td>
                    <td>
                        <a class="edit-link" href="<?php echo $routerHelper->generate('mark_overview', ['subject' => $subject['id']]); ?>">
                            <?php echo $subject['name']; ?>
                        </a>
                    </td>
                    <?php if($isAdmin): ?>
                        <td class="btn-holder">
                            <a href="#">
                                <span class="btn btn-danger btn-xs" data-subject-id="<?php echo $subject['id']; ?>">
                                    <span class="glyphicon glyphicon-remove remove"></span>
                                </span>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

            <?php if(!count($userSubjects)): ?>
                <tr>
                    <td colspan="<?php echo $isAdmin ? 3 : 2; ?>"><b>Bisher keine Einträge</b></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-offset-4 col-xs-offset-2 col-xs-8 no-padding">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
            Hinzufügen
        </button>
    </div>
</div>

<!-- Modal -->
<form id="newClassForm" action="#" class="form-horizontal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Fach-Klasse Kombination anlegen</h3>
                </div>
                <div class="modal-body">
                    <div class="row no-margin">
                        <div class="form-group">
                            <label for="educationClass" class="control-label col-sm-2">Klasse</label>
                            <div class="col-sm-10">
                                <select id="educationClass" name="education_class" class="form-control chosen-select" autocomplete="off">
                                    <?php
                                    foreach ($classEntities as $class) {
                                        echo sprintf('<option value="%s">%s</option>', $class->getId(), $class->getName());
                                    }
                                    ?>
                                    <?php if(!count($classEntities)): ?>
                                        <option value="keine Klasse" class="placeholder" selected></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="educationSubject" class="control-label col-sm-2">Fach</label>
                            <div class="col-sm-10">
                                <select id="educationSubject" name="education_subject" class="form-control chosen-select" autocomplete="off">
                                    <?php
                                    foreach ($allSubjects as $subject) {
                                        echo sprintf('<option value="%s">%s</option>', $subject['name'], $subject['name']);
                                    }
                                    ?>
                                    <?php if(!count($allSubjects)): ?>
                                        <option value="keine Klasse" class="placeholder" selected></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close-modal" type="button" data-abort class="btn btn-danger pull-left" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove"></i>
                        Abbrechen
                    </button>
                    <button type="submit" data-submit class="btn btn-primary pull-right">
                        Speichern
                        <i class="glyphicon glyphicon-ok"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $slotsHelper->stop(); ?>

<script type="text/javascript">
    <?php $slotsHelper->append('jQuery'); ?>
    $('#newClassForm').submit(function () {
        var $edClassOption = $('#educationClass').find('option:selected'),
            $subjectOption = $('#educationSubject').find('option:selected'),
            data;

        if($edClassOption.text() == '' || $subjectOption.text() == '') {
            alert('es gibt keinen Löffel!');
            return false;
        }

        data = {
            'education_class': {
                'key': $edClassOption.text(),
                'val': $edClassOption.val()
            },
            'education_subject': {
                'key': $subjectOption.text(),
                'val': $subjectOption.val()
            }
        };

        $.ajax({
            'url': '<?php echo $routerHelper->generate('subject_class_new'); ?>',
            'data': data,
            success: function (/*response*/) {
                /*console.log(response);*/
                location.reload();
            },
            error: function (/*response*/) {
                alert("Die Kombination Klasse - Fach ist bereits vorhanden oder eines der Felder [Klasse, Fach] wurde nicht ausgefüllt");
            }
        });

        return false;
    });

    $('#subject-holder').find('.remove').on('click', function() {

    });
    <?php $slotsHelper->stop(); ?>
</script>

