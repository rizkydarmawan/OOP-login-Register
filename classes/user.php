<?php
class User
{
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function register_user($field = array())
    {
        if ($this->_db->insert('user', $field)) {
            return true;
        }

        return false;
    }
	public function update_user($field = array(), $id)
	{
		if ($this->_db->update('user',$field,$id)) return true;
		else return false;
	}
    public function login_user($username, $password)
    {
        $data = $this->_db->get_info('user', 'username', $username);
        if (password_verify($password, $data['password'])) {
            return true;
        }
        else return false;
    }

    public function cek_username($username)
    {
        $data = $this->_db->get_info('user', 'username', $username);
        if (empty($data)) return false ;
        else return true;
    }

    public function get_data($username)
    {   
        if ( $this->cek_username($username) ){
            return $this->_db->get_info('user', 'username', $username);
        }
        return die('Username tidak Terdaftar');
    }
	
	public function get_all_data($table)
	{
		return $this->_db->get_info($table);
	}

    public function is_admin($username)
    {
        $data = $this->_db->get_info('user', 'username', $username);
        if ($data['level'] == 1) return true;
        else return false;
    }

    public function is_login($name)
    {
        if (Session::exists($name)) return true;
        else return false;
    }
}
