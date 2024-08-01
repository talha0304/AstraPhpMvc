<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\User;

/**
 * Class SiteController
 * 
 *  @author Talha Saleem
 *  @package app\controllers
 *  
 */
class SiteController extends Controller
{
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }


        return $this->render('contact', [
            'model' => $contact
        ]);
    }

    public function home()
    {
        $params = [
            'name' => "AstraPHP"
        ];

        return $this->render('home', $params);
    }


    public function showUsers()
    {
        return $this->showTableData('users', 'profile');
    }

    public function deleteUser(Request $request, Response $response)
    {
        $id = $request->getBody()['id'] ?? null;
        if ($id) {
            $user = new User();
            $user->delete($id);
            Application::$app->session->setFlash('success', 'User deleted successfully.');
        }
        return $response->redirect('/profile');
    }
    
    public function updateUser(Request $request, Response $response)
    {
        $user = new User();
        $id = $request->getBody()['id'] ?? null;
        if ($id) {
            $user = $user->findOne(['id' => $id]);

            if (!$user) {

                Application::$app->session->setFlash('error', 'User not found.');
                return $response->redirect('/profile');
            }
        }
        if ($request->isPost()) {
            $data = $request->getBody();
            $user->loadData($data);


            if ( $user->update($id)) {
                Application::$app->session->setFlash('success', 'User updated successfully.');
                return $response->redirect('/profile');
            }
        }
        return $this->render('updateuser', ['model' => $user]);
    }


}


