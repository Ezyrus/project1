<?php 

class main_helper {

    public function isUserLoggedIn($data, $redirect){
        if (empty($data)) {
            return $redirect;
        }
    }

}

?>