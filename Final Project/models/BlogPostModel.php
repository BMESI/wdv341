<?php
// event class 
class BlogPostModel{
    private $post_ID;
    private $author;
    private $title;
    private $post;
    private $date_created;
    private $date_edited;
    private $time;
    private $tags;
    function __const(){
        
    }// end const
    /**
     * @return string
     */
    public function getPost_ID()
    {
        return $this->post_ID;
    } // end id

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }// end title

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }// end post

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }//// end author

    /**
     * @return mixed
     */
    public function getDate_created()
    {
        return $this->date_created;
    } // // end date

    /**
     * @return mixed
     */
    public function getDate_edited()
    {
        return $this->date_edited;
    } // // end date 2
	 
	 /**
     * @return mixed
     */
	public function getTime()
    {
        return $this->time;
    } // 
	public function getTags()
    {
        return $this->tags;
    } // 
       /**
     * @return string
     */
    public function setPost_ID($idarg)
    {
		$this->post_ID = $idarg;
    } // end id

    /**
     * @return mixed
     */
    public function setTitle($titlearg)
    {
        $this->title = $titlearg;
    }// end title

    /**
     * @return mixed
     */
    public function setPost($postarg)
    {
        $this->post = $postarg;
    }// end post

    /**
     * @return mixed
     */
    public function setAuthor($authorarg)
    {
        $this->author = $authorarg;
    }//// end author

    /**
     * @return mixed
     */
    public function setDate_created($datearg)
    {
        $this->date_created = $datearg;
    } // // end date

    /**
     * @return mixed
     */
    public function setDate_edited($datearg)
    {
        $this->date_edited = $datearg;
    } // // end date
	 
	 /**
     * @return mixed
     */
	public function setTime($timearg)
    {
        $this->time = $timearg;
    } // // end event errr
	public function setTags($tagsarg)
    {
        $this->tags = $tagsarg;
    } // // end >tags 

} // end class
?>