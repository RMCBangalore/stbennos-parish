<?php
/**
 * ECalendarViewItem.php
 *
 * @author Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright &copy; 2014 by Martin Ludvik
 * @license http://opensource.org/licenses/MIT MIT license
 */

/**
 * The item is model for rendering day's cell content by {@link ECalendarView}.
 */
class ECalendarViewItem extends CComponent {

  /**
   * @var DateTime The date of day.
   */
  private $_date;

  /**
   * @var boolean True if day is the one selected in calendar, otherwise false.
   */
  private $_isCurrentDate;

  /**
   * @var boolean True if day directly belongs to currently rendered page of days, otherwise false (if day is used only as padding of empty space on month page).
   */
  private $_isRelevantDate;

  /**
   * Constructs the item and sets it's attributes to default values.
   * @param array $config The attributes as key=>value map.
   */
  public function __construct(array $config = array()) {
    $this->_date = null;
    $this->_isCurrentDate = null;
    $this->_isRelevantDate = null;

    foreach($config as $key => $value) {
      $this->$key = $value;
    }
  }

  /**
   * @see ECalendarViewItem::$_date
   */
  public function setDate(DateTime $date) {
    $this->_date = $date;
  }

  /**
   * @see ECalendarViewItem::$_isCurrentDate
   */
  public function setIsCurrentDate($isCurrentDate) {
    $this->_isCurrentDate = (boolean) $isCurrentDate;
  }

  /**
   * @see ECalendarViewItem::$_isRelevantDate
   */
  public function setIsRelevantDate($isRelevantDate) {
    $this->_isRelevantDate = (boolean) $isRelevantDate;
  }

  /**
   * @see ECalendarViewItem::$_date
   */
  public function getDate() {
    return $this->_date;
  }

  /**
   * @see ECalendarViewItem::$_isCurrentDate
   */
  public function getIsCurrentDate() {
    return $this->_isCurrentDate;
  }

  /**
   * @see ECalendarViewItem::$_isRelevantDate
   */
  public function getIsRelevantDate() {
    return $this->_isRelevantDate;
  }

}
