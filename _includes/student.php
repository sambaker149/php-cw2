<?php
    class Student
    {
        // Properties
        public $name;
        public $id;
        public $dob;
        public $address;

        // Methods
        function set_name($name) 
        {
            $this->name = $name;
        }
        function get_name() 
        {
            return $this->name;
        }
        function set_id($id) 
        {
            $this->id = $id;
        }
        function get_id() 
        {
            return $this->id;
        }
        function set_dob($dob) 
        {
            $this->dob = $dob;
        }
        function get_dob() 
        {
            return $this->dob;
        }
        function set_address($address) 
        {
            $this->address = $address;
        }
        function get_address() 
        {
            return $this->address;
        }
    }
?>