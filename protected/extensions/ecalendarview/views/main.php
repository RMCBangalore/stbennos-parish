<?php
/**
 * main.php
 *
 * @author Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright &copy; 2014 by Martin Ludvik
 * @license http://opensource.org/licenses/MIT MIT license
 */
?>

<?php $view = $pagination->getPageSize(); ?>

<table id="<?php echo $id; ?>" class="e-calendar-view <?php echo $view; ?>">
  <?php $this->render($view, array(
    'id' => $id,
    'data' => $data,
    'pagination' => $pagination,
    'daysInRow' => $daysInRow,
    'itemViewFile' => $itemViewFile,
    'titleViewFile' => $titleViewFile,
    'previousUrl' => $previousUrl,
    'nextUrl' => $nextUrl,
  )); ?>
</table>
