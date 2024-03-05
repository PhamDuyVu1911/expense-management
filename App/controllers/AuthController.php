<?php
class AuthController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function sayHi()
    {
       
        $this->view('auth-layout', ['page' => 'auth/login', 'pageName' => 'Đăng nhập']);
    }

    public function register()
    {
        $this->view('auth-layout', ['page' => 'auth/register', 'pageName' => 'Đăng ký']);
    }

    public function signIn()
    {
        $email = $_POST['username'];
        $pass = $_POST['password'];
        $result = $this->userModel->findEmail($email); //Tìm email
        if ($result) { // Nếu có email
            if ($pass == $result['password']) { //Kiểm tra password
                $_SESSION['login'] = $result; // Tạo session_login

                header('Location: ../');
            } else {
                $err = 'Mật khẩu không chính xác';
                echo $err;
            }
        } else {
            $err = 'Email không tồn tại';
            echo $err;
        }
    }

    public function checkEmail()
    {
        $email = $_POST['email'];
        $result = $this->userModel->findEmail($email); //Tìm email

        if ($result) {
            $response = array('status' => true, 'message' => 'Email đã tồn tại');
        } else {
            $response = array('status' => false, 'message' => 'Email không tồn tại');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function create()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_r = $_POST['pass_r'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];

        $customer = $this->userModel->findEmail($email); //Tìm email
        if ($customer) {
            echo "Email đã tồn tại";
        } else {
            if ($name && $email && $pass && $pass_r &&  $address && $phoneNumber) {
                $data = [
                    'full_name' => $name,
                    'email' => $email,
                    'password' => $pass,
                    'address' => $address,
                    'phone_number' => $phoneNumber
                ];

                if ($pass == $pass_r) {
                    $this->userModel->createAuth($data);
                    header("location:sayHi");
                } else {
                    header("location:register");
                }
            } else {
                header("location:register");
            }
        }
    }

    public function waningMoney()
    {
        $this->view('main-layout', ['page' => 'auth/warningMoney', 'pageName' => 'Giới hạn thu chi']);
    }

    public function logout()
    {
        if ($_SESSION['login']) {
            unset($_SESSION['login']);
            header('Location: ../auth/login');
        }
    }
}
