<?php
use Symfony\Component\Templating\Helper\SlotsHelper;
/* @var $view Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */
$slotsHelper = $view['slots']; /* @var $slotsHelper SlotsHelper */
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <?php $slotsHelper->output('header-js') ?>


    <title><?php $slotsHelper->output('title') ?> - Lehrerkalender</title>

    <link href="/css/bootstrap.css" rel="stylesheet">

    <?php $slotsHelper->output('header-css') ?>
    <link href="/css/helper.css" rel="stylesheet">
    <?php $slotsHelper->output('styles', ''); ?>

    <script type="text/javascript"></script>

    <style>
        #header a {
            text-decoration: none;
            color:           #337ab7;
            display:inline-block;
            width: 100%;
            height: 100%;
        }

        #header a:hover {
            background: #eee;
        }
    </style>
</head>
<body>
<div class="container" id="header">
    <div class="row" style="border-bottom: 1px solid #eee;margin-bottom:20px;">
        <?php $slotsHelper->output('header', ''); ?>
    </div>
</div>

<?php $slotsHelper->output('content', ''); ?>

<?php $slotsHelper->output('footer', ''); ?>


<script type="text/javascript">
    (function(document, $) {
        $( document ).ready(function() {
            <?php $slotsHelper->output('jQuery', ''); ?>
        });
    })(document, jQuery);
</script>
<script>
    (function(document, $) {

        function chosenOptionalValue()
        {
            var options = {
                    max_selected_options:       1,
                    disable_search_threshold:   0,
                    width:                      '100%'
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
        }

        $( document ).ready(function() {
            $('.chosen, .chosen-select').each(chosenOptionalValue);
        });
    })(document, jQuery);
</script>
</body>
</html>