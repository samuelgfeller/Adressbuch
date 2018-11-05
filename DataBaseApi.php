<?php
	/**
	 * @class DataBaseApi
	 * @desc class for database operations
	 */
	class DataBaseApi
	{
		/**
		 * connection to database
		 */
		private $db_link;

		/**
		 * constructor
		 * @param $database database path
		 * @param $user user for login
		 * @param $pw pw for login
		 * @param $host host
		 */
		function __construct($database, $user, $pw, $host) 
		{
			$this->db_link = mysqli_connect ( $host, 
										$user, 
										$pw,
										$database );
		}

		/**
		 * destructor 
		 */
		function __destruct() 
		{
			if($this->db_link)
				mysqli_close($this->db_link);
		}
		/**
		 * @param $sql sql statment
		 * @return $db_result query result
		 */
		public function queryDatabase($sql)
		{
			$db_result = mysqli_query($this->db_link, $sql);
			if (!$db_result)
			{
				die('Ungütige Abfrage: ' . mysqli_error());
			}

			//mysqli_free_result( $db_result );
			return $db_result;
		}

		/**
		 * @return db_link database connection
		 */
		public function getDBLink()
		{
			return $this->db_link;
		}
	}
?>