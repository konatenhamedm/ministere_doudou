<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/stock')]
class  StockConfigController extends BaseController
{
    private const MODULE_NAME = 'GESTION DE STOCK';
    const INDEX_ROOT_NAME = 'app_config_stocks_index';

    #[Route(path: '/index', name: 'app_config_stocks_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        //dd('drtgjtyrter');
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
            [
                'label' => ' PARAMETRES',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_stock_ls', ['module' => 'config'])
            ],

            [
                'label' => 'DEMANDE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_stock_ls', ['module' => 'demande'])
            ],

        [
                'label' => 'ENTREES STOCK',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_gestionstock_entree_index')
            ],
            [
                'label' => 'SORTIES STOCK',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_gestionstock_sortie_index')
            ],
            [
                'label' => 'ETAT STOCK',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_gestionstock_etat_index')
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

        return $this->render('config/stock/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_stock_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [

            'config' => [
                [
                    'label' => 'Catégories',
                    'id' => 'param_categorie',
                    'href' => $this->generateUrl('app_gestionstock_categorie_index')
                ],
              


                [
                    'label' => 'Articles',
                    'id' => 'param_article',
                    'href' => $this->generateUrl('app_gestionstock_article_index')
                ],  

               

                [
                    'label' => 'Sens',
                    'id' => 'param_sens',
                    'href' => $this->generateUrl('app_gestionstock_sens_index')
                ],
                [
                    'label' => 'Etat',
                    'id' => 'param_etat',
                    'href' => $this->generateUrl('app_gestionstock_etat_index')
                ],

            


            ],

            'demande' => [

                [
                    'label' => 'En attente de validation',
                    'id' => 'param_attente',
                    'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'en_cours'])
                ],



                [
                    'label' => 'Validées',
                    'id' => 'param_valide',
                    'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'valider'])
                ],

                [
                    'label' => 'Livrées',
                    'id' => 'param_livree',
                    'href' => $this->generateUrl('app_config_stock_index', ['etat' => 'livre'])
                ],

             
            ],

            // 'finalise' => [

                

            //     [
            //         'label' => 'Finalisées',
            //         'id' => 'param_finalise',
            //         'href' => $this->generateUrl('app_config_mission_index', ['etat' => 'finalise'])
              
            //     ],
            // ]
        ];


        return $this->render('config/stock/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}