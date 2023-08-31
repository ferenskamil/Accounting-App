<?php

class File {

        protected $db;

        protected array $user;

        protected array $fileinfo;

        /* CONSTRUCTOR
         *
         * As a $fileinfo parameter pass $_FILES['file']  (only $_FILES could not work) */
        public function __construct(array $user , array $fileinfo)
        {

                // Connect to database
                // Assign the returned $db object (PDO instance) to the $this->db variable).
                $this->db = require_once __DIR__ . '/../config/database/db_database.php';

                // Assign data to private variables
                $this->user = $user;
                $this->fileinfo = $fileinfo;
        }

        protected function get_file_extension(string $filename) : string
        {
                $file_extension = explode('.', $filename);
                return strtolower(end($file_extension));
        }

        public function get_file_name() : string {
                return $this->fileinfo['name'];
        }
}


