<?php namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BaseController
{
	use ResponseTrait;
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        $posts = $this->model->where(['is_deleted' => 0])->findAll();
        return $this->respond($posts);
    }
    public function login()
    {
        $data = [];
        helper('form');
        if ($this->request->getMethod() != 'post')
            return $this->fail('Only post request is allowed');
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];
        $errors = [
            'password' => [
                'validateUser' => 'Email or Password don\'t match'
            ]
        ];
        if (!$this->validate($rules, $errors)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $model = new UserModel();
            $user = $model->where('email', $this->request->getVar('email'))
                ->first();
            unset($user['password']);
            return $this->respond($user);
        }
    }

    public function register(){
        helper('form');

        if ($this->request->getMethod() != 'post')
            return $this->fail('Only post request is allowed');

        $rules = [
            'fullname' => 'required|min_length[3]|max_length[20]',
             'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]', // Random 15 Key
            'password_confirm' => 'required|matches[password]',
            'role' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $model = new UserModel();
            $data = [
                'fullname' => $this->request->getVar('fullname'),
                 'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'role' => $this->request->getVar('role'),
            ];
            $user_id = $model->insert($data);
            $data['id'] = $user_id;
            return $this->respondCreated($data);
        }
    }

    public function newClient()
    {
        helper('form');
        $data = [];
        if ($this->request->getMethod() != 'post')
            return $this->fail('Only post request is allowed');
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[20]',
             'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $model = new UserModel();
            $data = [
                'fullname' => $this->request->getVar('firstname'),
                 'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),

            ];
            $user_id = $model->insert($data);
            $data['id'] = $user_id;
            return $this->respondCreated($data);
        }
    }

    public function generateAuthenticationsKey()
    {
        $oauth = new Oauth();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();
        return $this->respond(json_decode($body), $code);
    }

    public function renewAuthentications($key = null)
    {
        helper(['form']);
        $rules = [
            'expiry_date' => 'required|min_length[6]',
            'user_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {

            $authenticationModel = new AuthenticationModel();
            $client = $authenticationModel->find($key);
            if ($client && $client['user_id'] == $this->request->getVar('user_id')) {
                $data = [
                    'access_token' => $key,
                    'expires' => $this->request->getVar('expiry_date'),
                ];
                $response = $authenticationModel->save($data);
                return $this->respond($response);
            } else {
                return $this->failNotFound('Client doesnt has any authorization token..');
            }
        }
    }

    public function clientAuthentications($id = null)
    {
        $authenticationModel = new AuthenticationModel();
        $where_data = array(
            'user_id' => $id
        );
        $user = $authenticationModel->where($where_data)->findAll();
        return $this->respond($user);
    }

    public function suspendAuthentication($key = null)
    {

        $authenticationModel = new AuthenticationModel();
        $key = $authenticationModel->find($key);
        if ($key) {
            $authenticationModel->delete($key);
            return $this->respondDeleted($key);
        } else {
            return $this->failNotFound('Item not found');
        }
    }

}
