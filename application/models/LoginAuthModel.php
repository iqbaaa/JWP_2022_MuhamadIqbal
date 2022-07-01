<?php 


    class LoginAuthModel extends CI_Model
    {   
        private $_table = "tb_user";
        const SESSION_KEY = 'userID';

        // rules form
        public function formRules()
        {
            return [
                [
                    'field' => 'username',
                    'label' => 'Username atau Email',
                    'rules' => 'required'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|max_length[255]'
                ]
            ];
        }

        // membuat fungsi login
        public function login($username, $password)
        {
            $this->db->where('email', $username)->or_where('username', $username);
            $query = $this->db->get($this->_table);
            $user = $query->row();

            // cek jika user terdaftar
            if(!$user) {
                return FALSE;
            }

            // cek login password
            if(!password_verify($password, $user->password)){
                return FALSE;
            }

        // simpan data ke session
            $this->session->set_userdata([self::SESSION_KEY => $user->userID]);
            $this->_update_last_login($user->userID);

            return $this->session->has_userdata(self::SESSION_KEY);
        }

        public function user()
        {
            if (!$this->session->has_userdata(self::SESSION_KEY)) {
                return null;
            }

            $user_id = $this->session->userdata(self::SESSION_KEY);
            $query = $this->db->get_where($this->_table, ['userID' => $user_id]);
            return $query->row();
        }

        public function logout()
        {
            $this->session->unset_userdata(self::SESSION_KEY);
            return !$this->session->has_userdata(self::SESSION_KEY);
        }

        public function _update_last_login($id)
        {
        $data = [
            'lastLogin' => date("Y-m-d H:i:s"),
        ];

        return $this->db->update($this->_table, $data, ['userID' => $id]);
        }
    }
?>