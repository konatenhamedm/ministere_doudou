<?php

namespace App\Controller;

use App\Entity\Contratloc;
use App\Entity\FichierAdmin;
use App\Repository\FichierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('fichier')]
class FichierController extends AbstractController
{
    #[Route('/{id}/fichier', name: 'fichier_index', methods: ['GET'])]
    public function show(Request $request, FichierAdmin $fichier)
    {
        $fileName = $fichier->getFileName();
        $filePath = $fichier->getAlt();
        dd($filePath);
        $download = $request->query->get('download');

        $file = $this->getUploadDir($filePath . '/' . $fileName);


        /*try {
            $file = $this->getUploadDir($filePath . '/' . $fileName);
        } catch (FileNotFoundException $e) {
            $file = $this->getUploadDir($fileName);
        } catch (FileNotFoundException $e) {
            $file = null;
        }*/

        if (!file_exists($file)) {
            return new Response('FichierAdmin invalide');
        }

        if ($download) {
            return $this->file($file);
        }

        return new BinaryFileResponse($file);
    }



    /**
     * @return mixed
     */
    public function getUploadDir($path)
    {
        return $this->getParameter('upload_dir') . '/' . $path;
    }
}
