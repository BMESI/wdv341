<?php 
//include "../../Final Project/models/BlogPostModel.php";

require "connection.php";
class Select   {
 public $Count = 0;

function __construct(){

	}// end constr
function GetBlogByID($UsernameARG){
	try{
		$inta = 0;
		$Results = ["n/a"];
		global $Connection;
		if ($UsernameARG == ""){
		$Results = ["n/a"];
			return $Results;
		}else{
			if ( $Connection ){
				$SQLSelectStatement = $Connection->prepare("SELECT title, author, post, date_created, date_edited, post_time, tags, post_id FROM app_users_posts WHERE author = :author");
				$SQLSelectStatement->bindParam(':author', $UsernameARG);
				$SQLSelectStatement->execute();
								foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
									$Blog = new BlogPostModel();

									$Blog->setPost_ID($row['post_id']);
									$Blog->setTitle($row['title']);
									$Blog->setPost($row['post']);
									$Blog->setAuthor($row['author']);
									$Blog->setDate_created($row['date_created']);
									$Blog->setDate_edited($row['date_edited']);
									$Blog->setTime($row['post_time']);
									$Blog->setTags($row['tags']);
									$Results[$inta] = $Blog;
											$inta ++;

								}// end loop	
							//	$Connection = null;
			} // end if connection
			else{
									$Blog->setPost_ID($row['n/a']);
									$Blog->setTitle($row['n/a']);
									$Blog->setPost($row['n/a']);
									$Blog->setAuthor($row['n/a']);
									$Blog->setDate_created($row['n/a']);
									$Blog->setDate_edited($row['n/a']);
									$Blog->setTime($row['n/a']);
									$Blog->setTags($row['n/a']);
									$Results[0] = $Blog;
									error_log("Error at Select GetBlogByID  - If connection else");
			} // end inner esle
		}// end outer else

			 return $Results;

		}// end try
	catch(PDOException $Error){				
			$Blog->setTitle('n/a');		
		    error_log("Error at Select GetBlogByID PDO");
			return $Results;
		}/// end catch
}// end get by id
function CheckBlogsCountByID($UsernameARG){
		try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
		if ($Connection){
		$Count = $inta;
			$SQLSelectStatement = $Connection->prepare("SELECT 'count(*)' FROM app_users_posts WHERE author = :author");
			$SQLSelectStatement->bindParam(':author', $UsernameARG);

			$SQLSelectStatement->execute();
				$Count = $SQLSelectStatement->fetchall(); 
			 return $Count;
		}// end if connectio
		else{
		error_log("Error at Select CheckBlogsCountByID - ELSE - failed");
					$Count = 0;
		} // end inner esle
	}// end try
	catch(PDOException $Error){
			$Count = 0;			 
			error_log("Error at Select CheckBlogsCountByID PDO");
	}/// end catch
}// end check by id count
function CheckBlogsCount(){ // get count of all blogs in databse
		try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
		if ($Connection){
		$Count = $inta;
			$SQLSelectStatement = $Connection->prepare("SELECT 'count(*)' FROM app_users_posts");
			$SQLSelectStatement->execute();
				$Count = $SQLSelectStatement->fetchall(); 
			 return $Count;
		}// end if connectio
		else{
					$Count = 0;
		} // end inner esle
	}// end try
	catch(PDOException $Error){
			$Count = 0;
			return $Count;
	}/// end catch
}// end check count
function CheckBlogsCountToday(){
	try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
		$Count = $inta;
		if ($Connection){
		$Count = $inta;
			$SQLSelectStatement = $Connection->prepare("SELECT 'count(*)' FROM app_users_posts WHERE date_created = CURDATE()");
			$SQLSelectStatement->execute();
				$Count = $SQLSelectStatement->fetchall(); 
			 return $Count;
		}// end if connectio
		else{
					$Count = 0;
			error_log("Error at Select CheckBlogsCountToday - ELSE  - FAILED QUERY");

		} // end inner esle
	}// end try
	catch(PDOException $Error){
					$Count = 0;
			error_log("Error at Select CheckBlogsCountToday - PDO");

			return $Count;
	}/// end catch
}// end Select today
function ViewBlogsGeneral(){
	try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
		if ($Connection){
		$Count = $inta;
			$SQLSelectStatement = $Connection->prepare("SELECT title, author, post, date_created, date_edited, post_time, tags, post_id FROM app_users_posts");
			$SQLSelectStatement->execute();
				foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
				$Blogs = new BlogPostModel();
				$Blogs->setPost_ID($row['post_id']);
				$Blogs->setTitle($row['title']);
				$Blogs->setAuthor($row['author']);
				$Blogs->setPost($row['post']);
				$Blogs->setDate_created($row['date_created']);
				$Blogs->setDate_edited($row['date_edited']);
				$Blogs->setTime($row['post_time']);
				$Blogs->setTags($row['tags']);

				$Results[$inta] = $Blogs;
	
						$inta++;

			 } // end for loop
			//$Connection = null;
			 return $Results;
		}// end if connectio
		else{
					$Results =  ['<span class="error">No database connection made...</span>'];
		} // end inner esle
	}// end try
	catch(PDOException $Error){
					$Results = ["<p>Nothing to view...Try some other time...</p>"];
							error_log("Error at Select ViewBlogsGeneral - PDO");
			return $Results;
	}/// end catch
}// end Select general
function ViewBlogsLimited($ShowCountArg){
	try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
				$Limit= 5;
		$Limit = 5;
		$Offset = $ShowCountArg;
		global $Connection;
		if ($Connection){
			$SQLSelectStatement = $Connection->prepare("SELECT title, author, post, date_created, date_edited, post_time, tags, post_id FROM app_users_posts LIMIT $Limit OFFSET $ShowCountArg");
			$SQLSelectStatement->execute();
				foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
				$Blogs = new BlogPostModel();
				$Blogs->setPost_ID($row['post_id']);
				$Blogs->setTitle($row['title']);
				$Blogs->setAuthor($row['author']);
				$Blogs->setPost($row['post']);
				$Blogs->setDate_created($row['date_created']);
				$Blogs->setDate_edited($row['date_edited']);
				$Blogs->setTime($row['post_time']);
				$Blogs->setTags($row['tags']);

				$Results[$inta] = $Blogs;
	
						$inta++;

			 } // end for loop
			//$Connection = null;
			 return $Results;
		}// end if connectio
		else{
					$Results =  ['<span class="error">No database connection made...</span>'];
		} // end inner esle
	}// end try
	catch(PDOException $Error){
					$Results = ["<p>Nothing to view...Try some other time...</p>"];
							error_log("Error at Select ViewBlogsLimited - PDO");

			return $Results;
	}/// end catch
}// end Select general
function ViewBlogsToday(){
	try{
		$Results =  ['<span class="error">No matching record(s)...</span>'];
		$inta = 0;
		global $Connection;
		if ($Connection){
		$Count = $inta;
			$SQLSelectStatement = $Connection->prepare("SELECT title, author, post, date_created, date_edited, post_time, tags, post_id FROM app_users_posts WHERE date_created = CURDATE()");
			$SQLSelectStatement->execute();
				foreach($SQLSelectStatement->fetchall(PDO::FETCH_ASSOC) as $row) {
				$Blogs = new BlogPostModel();
				$Blogs->setPost_ID($row['post_id']);
				$Blogs->setTitle($row['title']);
				$Blogs->setAuthor($row['author']);
				$Blogs->setPost($row['post']);
				$Blogs->setDate_created($row['date_created']);
				$Blogs->setDate_edited($row['date_edited']);
				$Blogs->setTime($row['post_time']);
				$Blogs->setTags($row['tags']);
				$Results[$inta] = $Blogs;
						$inta++;
			 } // end for loop
			//$Connection = null;
			 return $Results;
		}// end if connectio
		else{
					$Results =  ['<span class="error">No database connection made...</span>'];
		} // end inner esle
	}// end try
	catch(PDOException $Error){
			//echo "<br>  <h1>Select failed: " .$Error->getMessage()."</h1>";
					$Results = ["<p>Nothing to view...Try some other time...</p>"];
						error_log("Error at Select ViewBlogsToday - PDO");
			return $Results;
	}/// end catch
}// end Select today



}// end class


?>