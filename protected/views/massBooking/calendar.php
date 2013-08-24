<?php

$this->breadcrumbs=array(
	'Mass Bookings',
);

$this->menu=array(
	array('label'=>'Create MassBooking', 'url'=>array('create')),
	array('label'=>'Manage MassBooking', 'url'=>array('admin')),
);
?>

<h1>Mass Booking Calendar</h1>

<?php
 $this->widget('ecalendarview.ECalendarView', array(
  'id' => 'MyCalendar',
  'weeksInRow' => 1,
  'itemView' => '_cal_view',
  'cssFile' => 'css/calendar.css',
  'ajaxUpdate' => true,
  'dataProvider' => array(
    'pagination' => array(
      'currentDate' => new DateTime("now"),
      'pageSize' => 'month',
      'pageIndex' => 0,
      'pageIndexVar' => 'MyCalendar_page',
      'isMondayFirst' => false,
    )
  )
)); ?>
