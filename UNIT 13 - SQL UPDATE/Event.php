<?php
// event class 
// formatted by Eclipse IDE (using PHP 'compiler')
class Event{
    private $event_ID;
    private $event_name;
    private $event_description;
    private $event_presenter;
    private $event_date;
    private $event_time;
	private $event_error;
	    function __const(){
        
    }// end const
    /**
     * @return string
     */
    public function getEvent_ID()
    {
        return $this->event_ID;
    } // end event id

    /**
     * @return mixed
     */
    public function getEvent_name()
    {
        return $this->event_name;
    }// end event name

    /**
     * @return mixed
     */
    public function getEvent_description()
    {
        return $this->event_description;
    }// end event descr

    /**
     * @return mixed
     */
    public function getEvent_presenter()
    {
        return $this->event_presenter;
    }//// end event presenter

    /**
     * @return mixed
     */
    public function getEvent_date()
    {
        return $this->event_date;
    } // // end event date

    /**
     * @return mixed
     */
    public function getEvent_time()
    {
        return $this->event_time;
    } // // end event time
	 
	 /**
     * @return mixed
     */
	public function getEvent_error()
    {
        return $this->event_error;
    } // // end event errr
    /**
     * @param string $event_ID
     */
    public function setEvent_ID($event_ID)
    {
        $this->event_ID = $event_ID;
    }// end event id

    /**
     * @param mixed $event_name
     */
    public function setEvent_name($event_name)
    {
        $this->event_name = $event_name;
    }//// end event name

    /**
     * @param mixed $event_description
     */
    public function setEvent_description($event_description)
    {
        $this->event_description = $event_description;
    } // // end event descr

    /**
     * @param mixed $event_presenter
     */
    public function setEvent_presenter($event_presenter)
    {
        $this->event_presenter = $event_presenter;
    }// end event presenter

    /**
     * @param mixed $event_date
     */
    public function setEvent_date($event_date)
    {
        $this->event_date = $event_date;
    }// end event date

    /**
     * @param mixed $event_time
     */
    public function setEvent_time($event_time)
    {
        $this->event_time = $event_time;
    }// end event time
		 
	 /**
     * @return mixed
     */
	public function setEvent_error($event_error)
    {
        $this->event_error = $event_error;
    } // // end event errr

} // end class
?>