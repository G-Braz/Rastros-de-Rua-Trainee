<?php
    namespace App\Controllers;

    use App\Core\App;
    use Exception;

    class LoginController{
        public function exibirLogin(){
            return view('site/login');
        }

        public function exibirDashboard(){
            return view('admin/dashboard');
        }
        public function exibirLandingPage(){
            $posts = App::get('database')->selectAll('publicacoes', 0, 100); // ou outro método para buscar posts
            return view('site/paginaInicial', compact('posts'));
        }

        public function efetuarLogin(){
            $email=$_POST['email'];
            $senha=$_POST['senha'];

            $user=App::get('database')->verificarLogin($email, $senha);

            if($user){
                session_start();
                $_SESSION['id'] = $user->id;
                header('Location: /admin/dashboard');
            }else{
                session_start();
                $_SESSION['erro']="Email e/ou senha inválidos";
                header('Location: /login');
            }

        }
        
        public function logout(){
            session_start();
            session_unset();
            session_destroy();
            header('Location: /landingPage');
        }

    }


?>