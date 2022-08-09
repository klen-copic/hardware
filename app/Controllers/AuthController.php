<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{

    public function loginPage()
    {

        $data['title'] = "Login";
        echo view('templates/header', $data);
        echo view('auth/login');
        echo view('templates/footer');
    }

    public function registerPage()
    {

        $data['title'] = "Register";
        echo view('templates/header', $data);
        echo view('auth/register');
        echo view('templates/footer');
    }

    public function register()
    {
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|min_length[4]|max_length[50]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[4]|max_length[50]',
            'passwordConfirm' => 'required|min_length[4]|max_length[50]|matches[password]',
            'phoneNumber' => 'required|min_length[2]|max_length[50]',
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'firstName' => $this->request->getVar('firstName'),
                'lastName' => $this->request->getVar('lastName'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'phoneNumber' => $this->request->getVar('phoneNumber'),
                'role' => 'user',
            ];
            $userModel->save($data);
            return "ok";
        } else {
            $data['validation'] = $this->validator;
            return $data['validation']->listErrors();
        }
    }


    public function login()
    {
        $rules = [
            'password' => 'required',
            'email' => 'required',
        ];

        if ($this->validate($rules)) {

            $session = session();
            $userModel = new UserModel();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $data = $userModel->where('email', $email)->first();

            if ($data) {
                $pass = $data['password'];
                $authenticatePassword = password_verify($password, $pass);
                if ($authenticatePassword) {
                    $ses_data = [
                        'id' => $data['id'],
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'email' => $data['email'],
                        'phoneNumber' => $data['phoneNumber'],
                        'role' => $data['role'],
                        'isLoggedIn' => TRUE,
                    ];
                    $session->set($ses_data);
                    return "ok";
                } else {
                    $session->setFlashdata('msg', 'Password is incorrect.');
                    return "Password is incorrect.";
                }
            } else {
                $session->setFlashdata('msg', 'Email does not exist.');
                return "Email does not exist.";
            }
        } else {
            $data['validation'] = $this->validator;
            return $data['validation']->listErrors();
        }
    }

    public function logout()
    {
        $ses_data = [
            'id' => '',
            'name' => '',
            'surname' => '',
            'email' => '',
            'phoneNumber' => '',
            'isLoggedIn' => FALSE,
            'role' => '',
        ];
        session()->set($ses_data);
        return redirect()->to('/login');
    }
}