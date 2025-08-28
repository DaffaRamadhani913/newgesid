<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class EmailTest extends Controller
{
    public function send()
    {
        $email = \Config\Services::email();

        $email->setFrom('no-reply@gesid.id', 'GESID Admin');
        $email->setTo('hugeman55ramadhani@gmail.com');
        $email->setSubject('Tes Email GESID');
        $email->setMessage('<h1>Email berhasil dikirim!</h1><p>Halo, ini email dari GESID.</p>');

        if ($email->send()) {
            echo "Email terkirim!";
        } else {
            echo $email->printDebugger(['headers', 'subject', 'body']);
        }
    }
}
