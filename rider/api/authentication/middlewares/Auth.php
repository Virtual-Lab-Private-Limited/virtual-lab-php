<?php
require __DIR__.'/../classes/JwtHandler.php';
class Auth extends JwtHandler{

    protected $db;
    protected $headers;
    protected $user_id;
    protected $token;
        
    public function __construct($db,$headers) {
        parent::__construct();
        $this->db = $db;
        $this->headers = $headers;

    }

    public function isAuth(){
        if(array_key_exists('token',$this->headers) && !empty(trim($this->headers['token']))):
            $this->token =  explode(" ", trim($this->headers['token']));
          
            if(isset($this->token[1]) && !empty(trim($this->token[1]))):
              
                $data = $this->_jwt_decode_data($this->token[1]);
                
                if(isset($data['auth']) && isset($data['data']->rider_id) && $data['auth']):
                
                    $user_id = $data['data']->rider_id;
                    return $user_id;
                else:
              
                    return null;

                endif; // End of isset($this->token[1]) && !empty(trim($this->token[1]))
                
            else:
                return null;

            endif;// End of isset($this->token[1]) && !empty(trim($this->token[1]))

        else:
            return null;

        endif;
    }


}