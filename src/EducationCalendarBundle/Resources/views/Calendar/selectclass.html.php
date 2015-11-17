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
        $datas = [
            [
                'title' => 'Klasse anlegen',
                'content' => '

<p><div class="container">
    <div class="row">
        <div class="col-xs-4">
            <select name="MyFancyInput" id="MyFancyInput" class="form-control chosen" autocomplete="off">
                <option value="1">Köln</option>
                <option value="2">Kiel</option>
                <option value="3">Düsseldorf</option>
                <option value="4">Berlin</option>
                <option value="5">München</option>
                <option value="6">Stuttgart</option>
                <option value="7">Hamburg</option>
                <option value="8">Bremen</option>
                <option value="9">Hürth</option>
                <option value="10">Öskirschen</option>
                <option value="11">Öskirschen</option>
            </select>
        </div>
        <div class="col-xs-4">
            <select name="MyFancyInput2" id="MyFancyInput2" class="form-control chosen" autocomplete="off">
                <option value="1">Köln</option>
                <option value="2">Kiel</option>
                <option value="3">Düsseldorf</option>
                <option value="4">Berlin</option>
                <option value="5">München</option>
                <option value="6">Stuttgart</option>
                <option value="7">Hamburg</option>
                <option value="8">Bremen</option>
                <option value="9">Hürth</option>
                <option value="10">Öskirschen</option>
                <option value="11">Öskirschen</option>
            </select>
        </div>
        <div class="col-xs-4"><button type="button" class="btn btn-default">Anlegen</button></div>
    </div></p>'
            ],

        ];
        ?>
        <?php foreach ($datas as $key => $data): ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $key; ?>">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key; ?>"
                       aria-expanded="false" aria-controls="collapse<?php echo $key; ?>">
                        <h4 class="panel-title"><?php echo $data['title']; ?></h4>
                    </a>
                </div>
                <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel"
                     aria-labelledby="heading<?php echo $key; ?>">
                    <div class="panel-body">
                        <?php echo $data['content']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>

<div class="container margin-top-30" style="margin-left: -15px">
    <div class="list-group">
        <a href="#" class="list-group-item">FIA32 - ANW</a>
        <a href="#" class="list-group-item">FIA32 - ITK</a>
    </div>
</div>


<?php $slotsHelper->stop(); ?>

