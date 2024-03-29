<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public $user;
	public $_id;
	public $username;
	public $college_id;
	
	
	public function authenticate()
	{
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		
        $user=AdminInfo::model()->find('admin_login_name=:admin_login_name and college_id=:college_id',array('admin_login_name'=>$this->username,'college_id'=>$this->college_id));
		
        if ($user)
        {
        	$encrypted_passwd=trim($user->admin_login_password);


        	$inputpassword = trim(md5($this->password));

			if($inputpassword===$encrypted_passwd)
			{
				$this->errorCode=self::ERROR_NONE;
            	$this->setUser($user);
				$this->_id=$user->admin_id;
				$this->username=$user->admin_name;
			}
			else
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;

			}
        }
        else
        {
        	$this->errorCode=self::ERROR_USERNAME_INVALID;
        }

        unset($user);
        return !$this->errorCode;
	}

	public function getUser()
    {
        return $this->user;
    }

    public function getId()
        {
                return $this->_id;
        }

    public function getUserName()
        {
                return $this->username;
        }
	public function  getCollegeId($college_id){
	
		return $this->college_id=$college_id;
	
	}
    public function setUser(CActiveRecord $user)
    {
        $this->user=$user->attributes;
    }
}