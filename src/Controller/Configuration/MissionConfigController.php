<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/mission')]
class  MissionConfigController extends BaseController
{
    private const MODULE_NAME = 'Missions';
    const INDEX_ROOT_NAME = 'app_config_missions_index';

    #[Route(path: '/index', name: 'app_config_missions_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        //dd('drtgjtyrter');
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
            [
                'label' => ' Paramétrage',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_mission_ls', ['module' => 'config'])
            ],

            [
                'label' => 'Missions en cours',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_mission_ls', ['module' => 'mission'])
            ],

            [
                'label' => 'Missions finalisées',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_mission_ls', ['module' => 'finalise'])
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

        return $this->render('config/mission/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_mission_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [

            'config' => [

                [
                    'label' => 'Tarif',
                    'id' => 'param_tarif',
                    'href' => $this->generateUrl('app_mission_tarif_index')
                ],
              


                [
                    'label' => 'Moyens de transport',
                    'id' => 'param_moyens',
                    'href' => $this->generateUrl('app_mission_moyen_transport_index')
                ],  

                [
                    'label' => 'Source de financement',
                    'id' => 'param_source',
                    'href' => $this->generateUrl('app_mission_source_financement_index')
                ],
               

            


            ],

            'mission' => [

                [
                    'label' => 'En attente de validation',
                    'id' => 'param_attente',
                    'href' => $this->generateUrl('app_config_mission_index', ['etat' => 'en_cours'])
                ],



                [
                    'label' => 'Validées',
                    'id' => 'param_valide',
                    'href' => $this->generateUrl('app_config_mission_index', ['etat' => 'valide'])
                ],

             
            ],

            'finalise' => [

                

                [
                    'label' => 'Finalisées',
                    'id' => 'param_finalise',
                    'href' => $this->generateUrl('app_config_mission_index', ['etat' => 'finalise'])
              
                ],
            ]
        ];


        return $this->render('config/mission/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}