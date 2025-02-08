<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/reunion')]
class  ReunionConfigController extends BaseController
{
    private const MODULE_NAME = 'Reunion';
    const INDEX_ROOT_NAME = 'app_config_reunions_index';

    #[Route(path: '/index', name: 'app_config_reunions_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        //dd('drtgjtyrter');
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
            [
                'label' => ' SALLES',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_reunion_salle_index')
            ],

            [
                'label' => 'LISTE DES REUNIONS',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_reunion_reunion_index')
            ],

            [
                'label' => 'DILIGENCES',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_reunion_ls', ['module' => 'dellibartion'])
            ],



        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Audiances'
            ],
            [
                'label' => 'Paramètres'
            ]
        ]);

        return $this->render('config/reunion/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_reunion_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [

           
    

            'dellibartion' => [

                [
                    'label' => 'En attente de validation',
                    'id' => 'param_attente',
                    'href' => $this->generateUrl('app_config_diligence_index', ['etat' => 'en_cours'])
                ],



                [
                    'label' => 'Validées',
                    'id' => 'param_valide',
                    'href' => $this->generateUrl('app_config_diligence_index', ['etat' => 'termine'])
                ],

                
            ],

            
        ];


        return $this->render('config/reunion/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}