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

<div class="row" style="margin-bottom: 20px;">
    <div class="col-sm-12"><?php echo 'Hello ' . $name; ?></div>
</div>
<div class="row">
    <div class="col-xs-6">
        <form class="form-horizontal">
            <div class="row">
                <div class="form-group">
                    <label for="MyFancyInput" class="control-label col-sm-3">MyFancyInput</label>
                    <div class="col-sm-9">
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
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 no-padding">
        <div class="panel-group accordion">
            <?php
                $datas = [
                    [
                        'title'     => 'My Title1',
                        'content'   => 'My Content1'
                    ], [
                        'title'     => 'My Title2',
                        'content'   => 'My Content2'
                    ], [
                        'title'     => 'My Title3',
                        'content'   => 'My Content3'
                    ],
                ]
            ?>
            <?php foreach($datas as $key => $data): ?>
                <div class="panel-heading" role="tab">
                    <a role="button" data-toggle="collapse" href="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse<?php echo $key; ?>">
                        <h4 class="panel-title"><?php echo $data['title']; ?></h4>
                    </a>
                </div>
                <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <?php echo $data['content']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $slotsHelper->stop(); ?>