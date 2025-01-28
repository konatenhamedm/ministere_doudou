<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/logist')]
class  LogistiqueConfigController extends BaseController
{
    private const MODULE_NAME = 'GESTION DE LOGISTIQUE';
    const INDEX_ROOT_NAME = 'app_config_logistiques_index';

    #[Route(path: '/', name: 'app_config_logistiques_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        //dd('drtgjtyrter');
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
            [
                'label' => ' PARAMETRES',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_logistique_ls', ['module' => 'config'])
            ],

            [
                'label' => 'VEHICULE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_vehicule_index')
            ],

        [
                'label' => 'AFFECTATION',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_affectation_index')
            ],
            [
                'label' => 'ASSURANCE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_assurance_index')
            ],
            [
                'label' => 'VISITE TECHNIQUE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_visite_technique_index')
            ],
               [
                'label' => 'SINISTRE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_sinistre_index')
            ],
               [
                'label' => 'INTERVENTION',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_intervention_index')
            ],
              [
                'label' => 'CARBURANT',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_logistique_carburant_index')
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

        return $this->render('config/logist/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_logistique_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [

            'config' => [
                [
                    'label' => 'Marques',
                    'id' => 'param_marque',
                    'href' => $this->generateUrl('app_logistique_marque_index')
                ],
        
            
                [
                    'label' => 'Modeles',
                    'id' => 'param_models',
                    'href' => $this->generateUrl('app_logistique_modele_index')
                ],  

               

                [
                    'label' => 'Types',
                    'id' => 'param_sens',
                    'href' => $this->generateUrl('app_logistique_type_index')
                ],
              

            


            ],

            // 'demande' => [

            //     [
            //         'label' => 'En attente de validation',
            //         'id' => 'param_attente',
            //         'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'en_cours'])
            //     ],



            //     [
            //         'label' => 'Validées',
            //         'id' => 'param_valide',
            //         'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'valide'])
            //     ],

            //     [
            //         'label' => 'Livrées',
            //         'id' => 'param_livree',
            //         'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'livre'])
            //     ],

             
            // ],

            // 'finalise' => [

                

            //     [
            //         'label' => 'Finalisées',
            //         'id' => 'param_finalise',
            //         'href' => $this->generateUrl('app_config_mission_index', ['etat' => 'finalise'])
              
            //     ],
            // ]
        ];


        return $this->render('config/logist/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}