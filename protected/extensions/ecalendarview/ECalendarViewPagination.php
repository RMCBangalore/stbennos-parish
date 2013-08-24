<?php
/**
 * ECalendarViewPagination.php
 *
 * @author Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright &copy; 2013 by Martin Ludvik
 * @license http://opensource.org/licenses/MIT MIT license
 */

Yii::import('ecalendarview.ECalendarViewPageSize');

/**
 * The pagination controls which days are passed by {@link ECalendarViewDataProvider} to {@link ECalendarView}.
 */
class ECalendarViewPagination extends CComponent {

  /**
   * @var DateTime The current date represents the zero-index day for pagination. It is also understand by calendar as the currently selected date.
   */
  private $_currentDate;

  /**
   * @var ECalendarViewPageSize The size of calendar page.
   */
  private $_pageSize;

  /**
   * @var int The page index. Can be negative. Notice that url request parameter overrides this value.
   */
  private $_pageIndex;

  /**
   * @var boolean True if Monday is considered the first day of the week, otherwise false (then Sunday is considered).
   */
  private $_isMondayFirst;

  /**
   * @var string The request parameter that holds page index.
   */
  private $_pageIndexVar;

  /**
   * Constructs pagination and sets it's attributes to default values.
   * @param array $config The attributes as key=>value map.
   */
  public function __construct(array $config = array()) {
    $this->_currentDate = $this->createTodayDate();
    $this->_pageSize = ECalendarViewPageSize::MONTH;
    $this->_pageIndex = 0;
    $this->_isMondayFirst = false;
    $this->_pageIndexVar = 'page';

    foreach($config as $key => $value) {
      $this->$key = $value;
    }
  }

  /**
   * @see ECalendarViewPagination::$_currentDate
   */
  public function setCurrentDate(DateTime $currentDate) {
    $this->_currentDate = clone($currentDate);
  }

  /**
   * @see ECalendarViewPagination::$_pageSize
   */
  public function setPageSize($pageSize) {
    if( ! ECalendarViewPageSize::isValidValue($pageSize)) {
      throw new CException(Yii::t('ecalendarview', 'Page size is out of permitted values. See documentation for more information.'));
    }
    $this->_pageSize = $pageSize;
  }

  /**
   * @see ECalendarViewPagination::$_pageIndex
   */
  public function setPageIndex($pageIndex) {
    $this->_pageIndex = (int) $pageIndex;
  }

  /**
   * @see ECalendarViewPagination::$_isMondayFirst
   */
  public function setIsMondayFirst($isMondayFirst) {
    $this->_isMondayFirst = (boolean) $isMondayFirst;
  }

  /**
   * @see ECalendarViewPagination::$_pageIndexVar
   */
  public function setPageIndexVar($pageIndexVar) {
    $this->_pageIndexVar = $pageIndexVar;
  }

  /**
   * @see ECalendarViewPagination::$_currentDate
   */
  public function getCurrentDate() {
    return clone($this->_currentDate);
  }

  /**
   * @see ECalendarViewPagination::$_pageSize
   */
  public function getPageSize() {
    return $this->_pageSize;
  }

  /**
   * @see ECalendarViewPagination::$_pageIndex
   */
  public function getPageIndex() {
    if(isset($_GET[$this->getPageIndexVar()])) {
      return (int) $_GET[$this->getPageIndexVar()];
    } else {
      return (int) $this->_pageIndex;
    }
  }

  /**
   * @see ECalendarViewPagination::$_isMondayFirst
   */
  public function getIsMondayFirst() {
    return (boolean) $this->_isMondayFirst;
  }

  /**
   * @see ECalendarViewPagination::$_pageIndexVar
   */
  public function getPageIndexVar() {
    return $this->_pageIndexVar;
  }

  /**
   * Retrieves the first date on current page that is relevant.
   * @return DateTime The date.
   * @see ECalendarViewPagination::isRelevantDate
   */
  public function getFirstRelevantPageDate() {
    switch($this->getPageSize()) {

      case ECalendarViewPageSize::MONTH:
        $year = (int) $this->getCurrentDate()->format('Y');
        $month = (int) $this->getCurrentDate()->format('n') + $this->getPageIndex();
        $date = $this->createDate($year, $month, 1);
        return $date;

      case ECalendarViewPageSize::WEEK:
        $date = clone($this->getCurrentDate());
        if($this->getPageIndex() >= 0) {
          $date->add(new DateInterval('P' . 7 * $this->getPageIndex() . 'D'));
        } else {
          $date->sub(new DateInterval('P' . 7 * (-$this->getPageIndex()) . 'D'));
        }
        $dateIndex = $this->getWeekdayIndex($date);
        $date->sub(new DateInterval('P' . $dateIndex . 'D'));
        return $date;

      case ECalendarViewPageSize::DAY:
        $date = clone($this->getCurrentDate());
        if($this->getPageIndex() >= 0) {
          $date->add(new DateInterval('P' . $this->getPageIndex() . 'D'));
        } else {
          $date->sub(new DateInterval('P' . (-$this->getPageIndex()) . 'D'));
        }
        return $date;
    }
  }

  /**
   * Retrieves the last date on current page that is relevant.
   * @return DateTime The date.
   * @see ECalendarViewPagination::isRelevantDate
   */
  public function getLastRelevantPageDate() {
    switch($this->_pageSize) {

      case ECalendarViewPageSize::MONTH:
        $year = (int) $this->getCurrentDate()->format('Y');
        $month = (int) $this->getCurrentDate()->format('n') + $this->getPageIndex();
        $date = $this->createDate($year, $month, $this->getMonthSize($year, $month));
        return $date;

      case ECalendarViewPageSize::WEEK:
        $date = clone($this->getCurrentDate());
        if($this->getPageIndex() >= 0) {
          $date->add(new DateInterval('P' . 7 * $this->getPageIndex() . 'D'));
        } else {
          $date->sub(new DateInterval('P' . 7 * (-$this->getPageIndex()) . 'D'));
        }
        $dateIndex = $this->getWeekdayReverseIndex($date);
        $date->add(new DateInterval('P' . $dateIndex . 'D'));
        return $date;

      case ECalendarViewPageSize::DAY:
        $date = clone($this->getCurrentDate());
        if($this->getPageIndex() >= 0) {
          $date->add(new DateInterval('P' . $this->getPageIndex() . 'D'));
        } else {
          $date->sub(new DateInterval('P' . (-$this->getPageIndex()) . 'D'));
        }
        return $date;
    }
  }

  /**
   * Retrieves the middle date on current page that is relevant.
   * @return DateTime The date.
   * @see ECalendarViewPagination::isRelevantDate
   */
  public function getMiddleRelevantPageDate() {
    switch($this->getPageSize()) {

      case ECalendarViewPageSize::MONTH:
        $date = $this->getFirstRelevantPageDate();
        $offset = (int) ($this->getMonthSize2($date) / 2);
        $date->add(new DateInterval('P' . $offset . 'D'));
        return $date;

      case ECalendarViewPageSize::WEEK:
        $date = $this->getFirstRelevantPageDate();
        $date->add(new DateInterval('P3D'));
        return $date;

      case ECalendarViewPageSize::DAY:
        return $this->getFirstRelevantPageDate();
    }
  }

  /**
   * Retrieves the first date on current page including non-relevant days.
   * @return DateTime The date.
   * @see ECalendarViewPagination::isRelevantDate
   */
  public function getFirstPageDate() {
    switch($this->getPageSize()) {

      case ECalendarViewPageSize::MONTH:
        $date = $this->getFirstRelevantPageDate();
        $dateIndex = $this->getWeekdayIndex($date);
        $date->sub(new DateInterval('P' . $dateIndex . 'D'));
        return $date;

      case ECalendarViewPageSize::WEEK:
      case ECalendarViewPageSize::DAY:
        return $this->getFirstRelevantPageDate();
    }
  }

  /**
   * Retrieves the last date on current page including non-relevant days.
   * @return DateTime The date.
   * @see ECalendarViewPagination::isRelevantDate
   */
  public function getLastPageDate() {
    switch($this->_pageSize) {

      case ECalendarViewPageSize::MONTH:
        $date = $this->getFirstPageDate();
        $dateIndex = $this->getWeekdayIndex($date);
        $date->add(new DateInterval('P' . (41 - $dateIndex) . 'D'));
        return $date;

      case ECalendarViewPageSize::WEEK:
      case ECalendarViewPageSize::DAY:
        return $this->getLastRelevantPageDate();
    }
  }

  /**
   * Checks if given date is current.
   * @param DateTime $date The date.
   * @return boolean True if date is current, otherwise false.
   * @see ECalendarViewPagination::$_currentDate
   */
  public function isCurrentDate(DateTime $date) {
    return (boolean) ($date == $this->getCurrentDate());
  }

  /**
   * Checks if given date is relevant.
   * That means that date is not used only as padding on the beginning and end of the month page.
   * @param DateTime $date The date.
   * @return boolean True if date is relevant, otherwise false.
   */
  public function isRelevantDate(DateTime $date) {
    return (boolean)
      ($date >= $this->getFirstRelevantPageDate() &&
       $date <= $this->getLastRelevantPageDate());
  }

  /**
   * Creates date.
   * @param int $year The year.
   * @param int $month The month.
   * @param int $day The day.
   * @return DateTime The date.
   */
  private function createDate($year, $month, $day) {
    $date = new DateTime();
    $date->setDate($year, $month, $day);
    return $date;
  }

  /**
   * Creates today's date.
   * @return DateTime The date.
   */
  private function createTodayDate() {
    return $this->createDate(date('Y'), date('n'), date('j'));
  }

  /**
   * Retrieves number of days in month.
   * @param int $year The year.
   * @param int $month The month.
   * @return int The number of days.
   */
  private function getMonthSize($year, $month) {
    $date = $this->createDate($year, $month, 1);
    return (int) $this->getMonthSize2($date);
  }

  /**
   * Retrieves number of days in month.
   * @param DateTime $date The date that belongs to given month.
   * @return int The number of days.
   */
  private function getMonthSize2($date) {
    return (int) $date->format('t');
  }

  /**
   * Retrieves index of day from the beginning of week.
   * @param DateTime $date The date.
   * @return int The index.
   */
  private function getWeekdayIndex(DateTime $date) {
    $timestamp = $date->getTimestamp();
    if($this->_isMondayFirst) {
      return (int) ($date->format('N') - 1);
    } else {
      return (int) $date->format('w');
    }
  }

  /**
   * Retrieves index of day from the end of week.
   * @param DateTime $date The date.
   * @return int The index.
   */
  private function getWeekdayReverseIndex(DateTime $date) {
    return (int) (6 - $this->getWeekdayIndex($date));
  }

}
