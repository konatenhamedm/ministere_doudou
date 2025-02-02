<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/dossier')]
class  DossierConfigController extends BaseController
{
    private const MODULE_NAME = 'DOSSIER';
    const INDEX_ROOT_NAME = 'app_config_dossiers_index';

    #[Route(path: '/index', name: 'app_config_dossiers_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        //dd('drtgjtyrter');
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
            


            [
                'label' => ' WORKFLOW',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_dossier_workflow_index')
            ],

            [
                'label' => 'GESTION DES DOSSIERS',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_dossier_ls', ['module' => 'dossier'])
            ],

            [
                'label' => 'MES DOSSIERS',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_dossier_ls', ['module' => 'mesdossiers'])
            ],



        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'GESTION DES DOSSIERS'
            ],
            [
                'label' => 'Paramètres'
            ]
        ]);

        return $this->render('config/dossier/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_dossier_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [


            'dossier' => [

                [
                    'label' => 'En attente de validation',
                    'id' => 'param_attente',
                    'href' => $this->generateUrl('app_config_dossier_index', ['etat' => 'en_cours'])
                ],


                [
     
 
          'label' => 'En cours',
                    'id' => 'param_en_cours',
                    'href' => $this->generateUrl('app_config_dossier_index', ['etat' => 'termine'])
                ],

                [
                    'label' => 'Finalisés ',
                    'id' => 'param_valide',
                    'href' => $this->generateUrl('app_config_dossier_index', ['etat' => 'termine'])
                ],

             
            ],

            'mesdossiers' => [




                [


                    'label' => 'En cours',
                    'id' => 'param_en_cours',
                    'href' => $this->generateUrl('app_config_dossier_index', ['etat' => 'valide'])
                ],

                [
                    'label' => 'Finalisés ',
                    'id' => 'param_valide',
                    'href' => $this->generateUrl('app_config_dossier_index', ['etat' => 'valide'])
                ],
            ]
        ];


        return $this->render('config/dossier/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}