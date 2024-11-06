<?php 
    class departments{
        public function get_all_departments(){
            $_departments[] = array(
                "_id" => "_operation",
                "dep_id" => "operation",
            );
            $_departments[] = array(
                "_id" => "_it",
                "dep_id" => "it",
            );
            $_departments[] = array(
                "_id" => "_engineering",
                "dep_id" => "engineering",
            );
            $_departments[] = array(
                "_id" => "engineeringuser",
                "dep_id" => "engineeringuser",
            );
            //procurement
            $_departments[] = array(
                "_id" => "_procurement",
                "dep_id" => "procurement",
            ); 
            $_departments[] = array(
                "_id" => "_purchase",
                "dep_id" => "Purchase",
            );
            $_departments[] = array(
                "_id" => "_estimate",
                "dep_id" => "estimate",
            );
            $_departments[] = array(
                "_id" => "_sales",
                "dep_id" => "sales",
            );
            $_departments[] = array(
                "_id" => "_management",
                "dep_id" => "Management",
            );
            $_departments[] = array(
                "_id" => "accounts",
                "dep_id" => "accounts",
            );
            $_departments[] = array(
                "_id" => "contract and operations",
                "dep_id" => "contract and operations",
            );
            return json_encode($_departments);
        }
    }
