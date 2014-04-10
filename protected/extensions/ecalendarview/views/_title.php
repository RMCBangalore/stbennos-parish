<?php
/**
 * _title.php
 *
 * @author Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright &copy; 2014 by Martin Ludvik
 * @license http://opensource.org/licenses/MIT MIT license
 */
?>

<?php echo Yii::t('ecalendarview', $pagination->getMiddleRelevantPageDate()->format('F')); ?>,
<?php echo $pagination->getMiddleRelevantPageDate()->format('Y'); ?>
