<?php
/**
 * ECalendarView.php
 *
 * @author Martin Ludvik <matolud@gmail.com>
 * @copyright Copyright &copy; 2014 by Martin Ludvik
 * @license http://opensource.org/licenses/MIT MIT license
 */

Yii::import('ecalendarview.ECalendarViewDataProvider');

/**
 * The calendar view renders days using customizable view.
 */
class ECalendarView extends CWidget {

  /**
   * @var ECalendarViewDataProvider The data provider.
   */
  private $_dataProvider;

  /**
   * @var string The custom view that is used to render each day cell.
   */
  private $_itemView;

  /**
   * @var string The custom view that is used to render month and year information on the top of calendar.
   */
  private $_titleView;

  /**
   * @var int The number of weeks that is be rendered in one row. Valid values are 1 - 3. Has effect only with page size set to @link{ECalendarViewPageSize::MONTH}.
   */
  private $_weeksInRow;

  /**
   * @var string The path to custom css file to style calendar.
   */
  private $_cssFile;

  /**
   * @var boolean True if page navigation should be performed using ajax calls if possible, otherwise false.
   */
  private $_ajaxUpdate;

  /**
   * Constructs the calendar and sets it's attributes to default values.
   * @param CBaseController $owner The owner of calendar.
   */
  public function __construct(CBaseController $owner) {
    parent::__construct($owner);
    $this->_dataProvider = new ECalendarViewDataProvider();
    $this->_itemView = null;
    $this->_titleView = null;
    $this->_weeksInRow = 1;
    $this->_cssFile = null;
    $this->_ajaxUpdate = true;
    $this->getDataProvider()->getPagination()->setPageIndexVar($this->getId(true) . '_page');
  }

  /**
   * Sets the data provider's attributes.
   * @param array $config The attributes as key=>value map.
   */
  public function setDataProvider(array $config) {
    foreach($config as $key => $value) {
      $this->getDataProvider()->$key = $value;
    }
  }

  /**
   * @see ECalendarView::$_weeksInRow
   */
  public function setWeeksInRow($weeksInRow) {
    $weeksInRow = (int) $weeksInRow;
    if($weeksInRow < 1 || $weeksInRow > 3) {
      throw new CException(Yii::t('ecalendarview', 'Weeks in Row is out of permitted values. See documentation for more information.'));
    }
    $this->_weeksInRow = $weeksInRow;
  }

  /**
   * @see ECalendarView::$_itemView
   */
  public function setItemView($itemView) {
    $this->_itemView = $itemView;
  }

  /**
   * @see ECalendarView::$_titleView
   */
  public function setTitleView($titleView) {
    $this->_titleView = $titleView;
  }

  /**
   * @see ECalendarView::$_cssFile
   */
  public function setCssFile($cssFile) {
    $this->_cssFile = $cssFile;
  }

  /**
   * @see ECalendarView::$_ajaxUpdate
   */
  public function setAjaxUpdate($ajaxUpdate) {
    $this->_ajaxUpdate = (boolean) $ajaxUpdate;
  }

  /**
   * @see ECalendarView::$_dataProvider
   */
  public function getDataProvider() {
    return $this->_dataProvider;
  }

  /**
   * @see ECalendarView::$_weeksInRow
   */
  public function getWeeksInRow() {
    return $this->_weeksInRow;
  }

  /**
   * @see ECalendarView::$_itemView
   */
  public function getItemView() {
    return $this->_itemView;
  }

  /**
   * @see ECalendarView::$_titleView
   */
  public function getTitleView() {
    return $this->_titleView;
  }

  /**
   * @see ECalendarView::$_cssFile
   */
  public function getCssFile() {
    return $this->_cssFile;
  }

  /**
   * @see ECalendarView::$_ajaxUpdate
   */
  public function getAjaxUpdatE() {
    return $this->_ajaxUpdate;
  }

  /**
   * Initializes the calendar.
   */
  public function init() {
    // register css
    $cssFilePath = $this->resolveCssFilePath($this->getCssFile(), 'styles.css');
    $publishedCssFilePath = Yii::app()->getAssetManager()->publish($cssFilePath);
    Yii::app()->clientScript->registerCssFile($publishedCssFilePath);

    // register js
    if($this->getAjaxUpdate()) {
      $jsFilePath = $this->resolveJsFilePath('ecalendarview.js');
      $publishedJsFilePath = Yii::app()->getAssetManager()->publish($jsFilePath);
      Yii::app()->clientScript->registerScriptFile($publishedJsFilePath, CClientScript::POS_END);
      Yii::app()->clientScript->registerScript('e-calendar-view', 'jQuery(\'.e-calendar-view\').ecalendarview();');
    }

    parent::init();
  }

  /**
   * Runs the calendar.
   */
  public function run() {
    $this->render('main', array(
      'id' => $this->getId(true),
      'data' => $this->getDataProvider()->getData(),
      'pagination' => $this->getDataProvider()->getPagination(),
      'daysInRow' => $this->resolveDaysInWeek(),
      'itemViewFile' => $this->resolveViewFile($this->getItemView(), '_view'),
      'titleViewFile' => $this->resolveViewFile($this->getTitleView(), '_title'),
      'previousUrl' => $this->getUrl($this->getDataProvider()->getPagination()->getPageIndex() - 1),
      'nextUrl' => $this->getUrl($this->getDataProvider()->getPagination()->getPageIndex() + 1),
    ));
  }

  /**
   * Generates url for page navigation.
   * @param int $pageIndex The index of page.
   * @return string The url.
   */
  private function getUrl($pageIndex) {
    $params = $_GET;
    $params[$this->getDataProvider()->getPagination()->getPageIndexVar()] = $pageIndex;
    return Yii::app()->getController()->createUrl('', $params);
  }

  /**
   * Resolves path to css file that should be used.
   * @param string $customCssFile The custom css file path.
   * @param string $defaultCssFile The default css file path.
   * @return string The css file path.
   */
  private function resolveCssFilePath($customCssFile, $defaultCssFile) {
    return $customCssFile ? $customCssFile : dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets/' . $defaultCssFile;
  }

  /**
   * Resolves path to js file.
   * @param string $jsFile The js file path.
   */
  private function resolveJsFilePath($jsFile) {
    return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets/' . $jsFile;
  }

  private function resolveDaysInWeek() {
    switch($this->getDataProvider()->getPagination()->getPageSize()) {
      case ECalendarViewPageSize::MONTH:
        return $this->_weeksInRow * 7;
      case ECalendarViewPageSize::WEEK:
        return 7;
      case ECalendarViewPageSize::DAY:
        return 1;
    }
  }

  /**
   * Resolves the view file that should be used.
   * @param string $customView The custom view.
   * @param string $defaultView The default view.
   * @return string The view.
   */
  private function resolveViewFile($customView, $defaultView) {
    return $customView ? $this->getOwner()->getViewFile($customView) : $this->getViewFile($defaultView);
  }

}
