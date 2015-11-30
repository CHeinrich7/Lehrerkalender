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

$view->extend('::base.html.php');
?>

<?php $slotsHelper->start('header-js'); ?>
    <script src="/js/moment.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <!-- locale 'de_DE' for datepicker -->
    <script src="/js/bootstrap-datepicker.de.js"></script>
    <script src="/js/chosen.js"></script>
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header-css'); ?>
    <link href="/css/chosen.css" rel="stylesheet">
    <!-- chosen theme for bootstrap 3 -->
    <link href="/css/chosen-bootstrap.css" rel="stylesheet">
    <link href="/css/datepicker.css" rel="stylesheet">
    <link href="/css/table-div.css" rel="stylesheet">
    <link href="/css/marks-div.css" rel="stylesheet">

    <!-- some styles should be overwritten for this system -->
    <link href="/css/override-bootstrap.css" rel="stylesheet">
    <link href="/css/override-datepicker.css" rel="stylesheet">

    <style>
        html, body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            height:100%;
        }

        body > .container {
            min-height:100%;
            position:relative;
            padding-bottom: 80px;
        }

        #footer {
            position:absolute;
            bottom: 0;
        }

        .glyphicon {
            top: 3px;
        }

        @media (max-width: 767px) {
            #header .glyphicon {
                font-size: 40px;
            }

            #header > div {
                padding: 0;
            }

            .date-holder {
                font-size: 20px;
            }
        }

        .chosen-container:not(.chosen-with-drop) .chosen-drop {
            display: none;
        }
    </style>
<?php $slotsHelper->stop(); ?>

<?php $slotsHelper->start('header'); ?>
    <div class="col-xs-6">
        <a href="<?php echo $routerHelper->generate('education_calendar_overview'); ?>">
            <h1 class="text-center"><i class="glyphicon glyphicon-calendar"></i><span class="hidden-xs">&nbsp;Kalender</span></h1>
        </a>
    </div>
    <div class="col-xs-6">
        <a href="<?php echo $routerHelper->generate('subject_select_class'); ?>">
            <h1 class="text-center"><i class="glyphicon glyphicon-music"></i><span class="hidden-xs">&nbsp;Benotung</span></h1>
        </a>
    </div>
<?php if (in_array($app->getEnvironment(), array('dev', 'test'))): ?>
    <div class="col-xs-12 text-center">
        <span class="visible-lg pull-left">lg&nbsp;</span>
        <span class="visible-md pull-left">md&nbsp;</span>
        <span class="visible-sm pull-left">sm&nbsp;</span>
        <span class="visible-xs pull-left">xs&nbsp;</span>
        <span id="screen-width" class="pull-left"></span>
        <script>
            $(document).on('ready', function() {
                $(window).resize(function() {
                    $('#screen-width').html(window.outerWidth);
                }).trigger('resize');
            })
        </script>
    </div>
<?php endif; ?>

    <script>
        (function(document, $) {

            function chosenOptionalValue()
            {
                var options = {
                        max_selected_options:       1,
                        disable_search_threshold:   0,
                        width:                      '100%',
                        no_results_text: "[Enter] für neuen Eintrag"
                    },

                    $input = $(this);

                $input.chosen(options)
                    .parent()
                    .on('keydown', function(event) {
                        if(event.keyCode === 13) {
                            var $defaultInput = $(this).find('input');

                            $input.find('.optional').remove();

                            $input.append('<option value="" class="optional" selected="selected">'+ $defaultInput.val() +'</option>');

                            $input.trigger('chosen:updated');
                        }
                    });

                $input
                    .on('change init', function() {
                        var $chosenSingle = $(this).parent().find('.chosen-single');

                        $chosenSingle.removeClass('placeholder');

                        if($(this).find('option:selected').hasClass('placeholder') === true) {
                            $chosenSingle.addClass('placeholder');
                        }
                    }).trigger('init');
            }

            window.refreshChosen = function() {
                $('.chosen, .chosen-select').each(chosenOptionalValue);
            };

            $( document ).ready(refreshChosen);
        })(document, jQuery);
    </script>
<?php $slotsHelper->stop(); ?>

<?php if($app->getSecurity()->isGranted(\UserBundle\Entity\Role::ROLE_ADMIN)): ?>
<?php $slotsHelper->start('footer'); ?>
    <div class="col-xs-4 col-xs-offset-2">
        <a href="<?php $routerHelper->generate('user_index'); ?>">
            <h3 class="no-margin-top text-center"><span class="glyphicon glyphicon-user"></span>&nbsp;User</h3>
        </a>
    </div>
    <div class="col-xs-4">
        <a href="<?php $routerHelper->generate('user_index'); ?>">
            <h3 class="no-margin text-center"><span class="glyphicon glyphicon-education"></span>&nbsp;User</h3>
        </a>
    </div>
<?php $slotsHelper->stop(); ?>
<?php endif; ?>