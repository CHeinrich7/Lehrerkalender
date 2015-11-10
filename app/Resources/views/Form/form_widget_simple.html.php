<?php
/* @var $view       Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine  */
/* @var $formHelper Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper */
/* @var $form       Symfony\Component\Form\FormView */
/* @var $label      string */
/* @var $value      string */

$formHelper = $view['form'];

$widgetClass = 'form-control ';

if(isset($attr['class-widget'])) $widgetClass .= $attr['class-widget'];
$realType   = isset($type) ? $view->escape($type) : 'text';
$finalType  = (isset($attr['force_type'])) ? $attr['force_type'] : $realType;

?>
<input type="<?php echo $finalType; ?>" class="<?php echo $widgetClass; ?>" value="<?php echo $view->escape($value); ?>" <?php echo $formHelper->block($form, 'widget_attributes'); ?> />