<?php

namespace App\Controllers;

use App\Core\BaseController;
//use App\Core\Debug;
use App\Core\Request;
use App\Models\ContactModel;

class ContactController extends BaseController
{
    public function contact(Request $request)
    {
        if ($request->isPost()) {
            $contact = new ContactModel();
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->contact()) {
                echo 'success';
            }
            //Debug::showArray($contact->errors);
            return $this->render('contact', [
                'model' => $contact
            ]);
        }
        return $this->render('contact');
    }
}
