<?php
/**
 * User: Daniel
 * Date: 16.11.2015
 * Time: 11:18
 */

/**
 * @var $app            Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables
 * @var $view           Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine
 * @var $slotsHelper    Symfony\Component\Templating\Helper\SlotsHelper
 * @var $routerHelper   Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
 */

$slotsHelper = $view['slots'];
$routerHelper = $view['router'];
$formHelper = $view['form'];

$view->extend('::loggedIn.html.php');

?>

<?php $slotsHelper->start('title'); ?>
Klasse auswaehlen
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('content'); ?>

<style>
    h2, p, ol, ul, li {
        margin: 0px;
        padding: 0px;
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    #container {
        width: 300px;
        margin: auto;
        margin-top: 100px;
    }

    .expandable-panel {
        width: 100%;
        position: relative;
        min-height: 50px;
        overflow: auto;
        margin-bottom: 20px;
        border: 1px solid #999;
    }

    .expandable-panel-heading {
        width: 100%;
        cursor: pointer;
        min-height: 50px;
        clear: both;
        background-color: white;
        position: relative;
        border-bottom: 1px solid black;
    }

    .expandable-panel-heading:hover {
        color: #666;
    }

    .expandable-panel-heading h2 {
        padding: 14px 10px 9px 15px;
        font-size: 18px;
        line-height: 20px;
    }

    .expandable-panel-content {
        padding: 0 0px 0 0px;
        margin-top: -999px;
    }

    .expandable-panel-content p {
        padding: 4px 0 6px 0;
        margin-left: 10px;
    }

    .expandable-panel-content p:first-child {
        padding-top: 10px;
    }

    .expandable-panel-content p:last-child {
        padding-bottom: 15px;
    }

    .icon-close-open {
        width: 20px;
        height: 20px;
        position: absolute;
        background-image: url(http://i.imgur.com/Ir4S1H7.png);
        right: 15px;
    }
</style>

<div class="container">
    <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $allClasses = [
            'title' => 'Klasse anlegen',
            'content' => [
                'classes' => [
                    'FIA30',
                    'FIA31',
                    'FIA32',
                    'FIA33',
                    'FIA34',
                    'FIA35',
                    'FIA36'
                ],
                'subjects' => [
                    'ITK',
                    'ANW (WO)',
                    'ANW (NL)',
                    'Sport',
                    'Religion',
                    'Mathe',
                    'Deu',
                    'Eng'
                ]
            ],
        ];
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingNew>">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNew"
                   aria-expanded="false" aria-controls="collapseNew">
                    <h4 class="panel-title">Klasse anlegen</h4>
                </a>
            </div>
            <div id="collapseNew" class="panel-collapse collapse" role="tabpanel"
                 aria-labelledby="headingNew">
                <div class="panel-body">
                    <div class="container">
                        <div class="row">
                            <form id="newClassForm" action="#" class="form-horizontal">
                                <div class="col-xs-4">
                                    <select id="educationClass" name="education_class" class="form-control chosen"
                                            autocomplete="off">
                                        <?php
                                        foreach ($allClasses['content']['classes'] as $key => $class) {
                                            echo sprintf('<option value="%s">%s</option>', $key, $class);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <select id="educationSubject" name="education_subject" class="form-control chosen"
                                            autocomplete="off">
                                        <?php
                                        foreach ($allClasses['content']['subjects'] as $key => $subject) {
                                            echo sprintf('<option value="%s">%s</option>', $key, $subject);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-default">Anlegen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container margin-top-30">
    <div class="list-group">
        <?php
        $educationClasses = [
            [
                'class' => 'FIA32',
                'subject' => 'ITK'
            ],
            [
                'class' => 'FIS33',
                'subject' => 'ITK'
            ],
            [
                'class' => 'FIA32',
                'subject' => 'ANW'
            ],
        ]
        ?>
        <?php foreach ($educationClasses as $class): ?>
            <a href="<?php echo $routerHelper->generate('mark_overview', ['subject' => 1]); ?>"
               class="list-group-item">
                <?php echo sprintf('%s - %s', $class['class'], $class['subject']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<script>
    <?php $slotsHelper->start('jQuery'); ?>
        $('#newClassForm').submit(function()
        {
            var $edClassOption = $('#educationClass').find('option:selected'),
                $subjectOption = $('#educationSubject').find('option:selected'),
                data;

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
                success: function(response) {
                    if(response.success) {
                        console.log(response.data);
                    }
                },
                error: function(response) {
                    alert(response.error)
                }
            });

            return false;
        });
    <?php $slotsHelper->stop(); ?>
</script>

