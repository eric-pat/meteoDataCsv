<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImportController extends AbstractController
{
    #[Route('/import', name: 'app_import')]
    public function index(): Response
    {
        $data = [];
        $file = fopen(__DIR__.'/../Data/Data_test.csv', 'r'); // Open the file
        fgetcsv($file, null, ";"); // Read the first line

        while (($line = fgetcsv($file, null, ";")) !== false) {
            $data[] = [
                'cityName' => $line[1],
                'date' => date('d-m-Y', strtotime($line[5])),
                'temperature' => $line[6],
            ];
        }

        return $this->render('import/index.html.twig', [
            'data' => $data,
        ]);
    }
}
