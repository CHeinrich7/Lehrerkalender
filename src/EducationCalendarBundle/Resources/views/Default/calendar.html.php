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

<?php $slotsHelper->start('title'); ?>
Kalender
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header'); ?>
<div class="col-xs-6">
    <a href="/in/calendar"><h1 class="text-center">Kalender</h1></a>
</div>
<div class="col-xs-6">
    <a href="/in/benotung"><h1 class="text-center">Benotung</h1></a>
</div>
<?php $slotsHelper->stop(); ?>


<?php $slotsHelper->start('content'); ?>
<style>
    h2, p, ol, ul, li {
        margin:0px;
        padding:0px;
        font-size:13px;
        font-family:Arial, Helvetica, sans-serif;
    }
    #container {
        width:300px;
        margin:auto;
        margin-top:100px;
    }
    .expandable-panel {
        width:100%;
        position:relative;
        min-height:50px;
        overflow:auto;
        margin-bottom: 20px;
        border:1px solid #999;
    }
    .expandable-panel-heading {
        width:100%;
        cursor:pointer;
        min-height:50px;
        clear:both;
        background-color:white;
        position:relative;
        border-bottom:1px solid black;
    }
    .expandable-panel-heading:hover {
        color:#666;
    }
    .expandable-panel-heading h2 {
        padding:14px 10px 9px 15px;
        font-size:18px;
        line-height:20px;
    }
    .expandable-panel-content {
        padding:0 15px 0 15px;
        margin-top:-999px;
    }
    .expandable-panel-content p {
        padding:4px 0 6px 0;
    }
    .expandable-panel-content p:first-child {
        padding-top:10px;
    }
    .expandable-panel-content p:last-child {
        padding-bottom:15px;
    }
    .icon-close-open {
        width:20px;
        height:20px;
        position:absolute;
        background-image:url(http://i.imgur.com/Ir4S1H7.png);
        right:15px;
    }
</style>

<div class="container">
    <div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Montag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Stunde</th>
                    <th>Raum</th>
                    <th>Klasse</th>
                    <th>Fach</th>
                    <th>Notiz</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Dienstag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div><div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Mittwoch<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div><div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Donnerstag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div><div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Freitag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div><div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Samstag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div><div class="expandable-panel" id="cp-1">
        <div class="expandable-panel-heading">
            <h2>Sonntag<span class="icon-close-open"></span></h2>
        </div>
        <div class="expandable-panel-content">
            <p>First Panel HTML...</p>
        </div>
    </div>
</div>

<?php $slotsHelper->stop(); ?>

<script type="text/javascript">
    <?php $slotsHelper->start('jQuery'); ?>
    $(function () {
        /*-------------------- EXPANDABLE PANELS ----------------------*/
        var panelspeed = 500; //panel animate speed in milliseconds
        var totalpanels = 3; //total number of collapsible panels
        var defaultopenpanel = 0; //leave 0 for no panel open
        var accordian = false; //set panels to behave like an accordian, with one panel only ever open at once

        var panelheight = new Array();
        var currentpanel = defaultopenpanel;
        var iconheight = parseInt($('.icon-close-open').css('height'));

        //Initialise collapsible panels
        function panelinit() {
            for (var i = 1; i <= totalpanels; i++) {
                panelheight[i] = parseInt($('#cp-' + i).find('.expandable-panel-content').css('height'));
                $('#cp-' + i).find('.expandable-panel-content').css('margin-top', -panelheight[i]);
                if (defaultopenpanel == i) {
                    $('#cp-' + i).find('.icon-close-open').css('background-position', '0px -' + iconheight + 'px');
                    $('#cp-' + i).find('.expandable-panel-content').css('margin-top', 0);
                }
            }
        }



        $('.expandable-panel-heading').click(function () {
            var obj = $(this).next();
            var objid = parseInt($(this).parent().attr('ID').substr(3, 2));
            currentpanel = objid;
            if (accordian == true) {
                resetpanels();
            }

            if (parseInt(obj.css('margin-top')) <= (panelheight[objid] * -1)) {
                obj.clearQueue();
                obj.stop();
                obj.prev().find('.icon-close-open').css('background-position', '0px -' + iconheight + 'px');
                obj.animate({
                    'margin-top': 0
                }, panelspeed);
            } else {
                obj.clearQueue();
                obj.stop();
                obj.prev().find('.icon-close-open').css('background-position', '0px 0px');
                obj.animate({
                    'margin-top': (panelheight[objid] * -1)
                }, panelspeed);
            }
        });

        function resetpanels() {
            for (var i = 1; i <= totalpanels; i++) {
                if (currentpanel != i) {
                    $('#cp-' + i).find('.icon-close-open').css('background-position', '0px 0px');
                    $('#cp-' + i).find('.expandable-panel-content').animate({
                        'margin-top': -panelheight[i]
                    }, panelspeed);
                }
            }
        }

        // run once window has loaded
        panelinit();

    });
    <?php $slotsHelper->stop(); ?>

</script>
