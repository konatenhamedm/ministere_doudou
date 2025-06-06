<?php

namespace App\Controller\Configuration;

use App\Controller\BaseController;
use App\Repository\CiviliteRepository;
use App\Service\Breadcrumb;
use App\Service\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/admin/config/parametre')]
class ParametreController extends BaseController
{

    const INDEX_ROOT_NAME = 'app_config_parametre_index';


    /* private $menu;
     public function __construct(Menu $menu){
         $this->menu = $menu;
     }*/

    #[Route(path: '/', name: 'app_config_parametre_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        /* if($this->menu->getPermission()){
             $redirect = $this->generateUrl('app_default');
             return $this->redirect($redirect);
             //dd($this->menu->getPermission());
         }*/
        $modules = [
            [
                'label' => 'STRUCTURE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_parametre_entreprise_index', ['module' => 'config'])
            ],
            [
                'label' => 'LOCALITE',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'localite'])
            ],
            /*[
                'label' => 'Ressource humaine',
                'icon' => 'bi bi-truck',
                'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'rh'])
            ],*/
            
            // [
            //     'label' => 'Gestion utilisateur',
            //     'icon' => 'bi bi-users',
            //     'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'utilisateur'])
            // ],

            [
                'label' => 'LE PERSONNEL',
                'icon' => 'bi bi-users',
                'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'utilisateur'])
            ],

            [
                'label' => 'ATTRIBUTION DES ACCES',
                'icon' => 'bi bi-users',
                'href' => $this->generateUrl('app_utilisateur_groupe_index')
            ],


        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Tableau de bord'
            ],
            [
                'label' => 'Paramètres'
            ]
        ]);

        return $this->render('config/parametre/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'permition' => $permission,
            'titre' => 'Configuration parametrage',
            'type' => 'autre'
        ]);
    }




    #[Route(path: '/{module}', name: 'app_config_parametre_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametres = [

            'utilisateur' => [
                //new menu
                [
                    'label' => 'Liste de fonctions',
                    'id' => 'param_fonction',
                    'href' => $this->generateUrl('app_parametre_fonction_index')
                ],
                [
                    'label' => 'Liste des emplyés',
                    'id' => 'param_employe',
                    'href' => $this->generateUrl('app_utilisateur_employe_index')
                ],
          
                [
                    'label' => 'Permissions',
                    'id' => 'param_permission',
                    'href' => $this->generateUrl('app_utilisateur_permition_index')
                ],
                 [
                    'label' => 'Compte utilisateurs ',
                    'id' => 'param_utilisateur',
                    'href' => $this->generateUrl('app_utilisateur_utilisateur_index')
                ],
                [
                    'label' => 'Configuration application',
                    'id' => 'param_p',
                    'href' => $this->generateUrl('app_parametre_config_app_index')
                ],

                //encien menu le  nouveau

                // [
                //     'label' => 'Groupes modules',
                //     'id' => 'param_groupe_m',
                //     'href' => $this->generateUrl('app_utilisateur_groupe_module_index')
                // ],
                // [
                //     'label' => 'Module',
                //     'id' => 'param_module',
                //     'href' => $this->generateUrl('app_utilisateur_module_index')
                // ],
                // [
                //     'label' => 'Permissions',
                //     'id' => 'param_permission',
                //     'href' => $this->generateUrl('app_utilisateur_permition_index')
                // ],
                // [
                //     'label' => 'Les elements du menu',
                //     'id' => 'param_permission_groupe',
                //     'href' => $this->generateUrl('app_utilisateur_module_groupe_permition_index')
                // ]

            ],


            'config' => [

                // [
                //     'label' => 'Civilité',
                //     'id' => 'param_article',
                //     'href' => $this->generateUrl('app_parametre_civilite_index')
                // ],
                //new  menu

                
                // [
                //     'label' => 'Type de clients',
                //     'id' => 'param_client',
                //     'href' => $this->generateUrl('app_parametre_type_client_index')
                // ],  
               
                // [
                //     'label' => 'Type de dossiers ',
                //     'id' => 'param_acts',
                //     'href' => $this->generateUrl('app_parametre_type_index')
                // ],
                // [
                //     'label' => 'Le process de traitement des actes',
                //     'id' => 'param_soci',
                //     'href' => $this->generateUrl('app_parametre_workflow_index')
                // ],

                // [
                //     'label' => 'Type de société',
                //     'id' => 'param_soci',
                //     'href' => $this->generateUrl('app_parametre_type_societe_index')
                // ],

                // [
                //     'label' => 'Type de Dépense',
                //     'id' => 'param_depen',
                //     'href' => $this->generateUrl('app_parametre_typedepense_index')
                // ],
                
                //encien menu
                // [
                //     'label' => 'Icons',
                //     'id' => 'param_cm',
                //     'href' => $this->generateUrl('app_parametre_icon_index')
                // ],
                // [
                //     'label' => 'Configuration application',
                //     'id' => 'param_p',
                //     'href' => $this->generateUrl('app_parametre_config_app_index')
                // ],
                // [
                //     'label' => 'Entreprise',
                //     'id' => 'param_entreprise',
                //     'href' => $this->generateUrl('app_parametre_entreprise_index')
                // ] 


            ],

            'localite' => [

                [

                    'label' => 'District',
                    'id' => 'param_district',
                    'href' => $this->generateUrl('app_parametre_district_index')
                ],
                [

                    'label' => 'Regions',
                    'id' => 'param_region',
                    'href' => $this->generateUrl('app_parametre_region_index')
                ],

                [

                    'label' => 'Départements',
                    'id' => 'param_departement',
                    'href' => $this->generateUrl('app_parametre_departement_index')
                ],

                [

                    'label' => 'Sous-prefectures',
                    'id' => 'param_sp',
                    'href' => $this->generateUrl('app_parametre_sous_prefecture_index')
                ],
                
                [

                    'label' => 'Village',
                    'id' => 'param_village',
                    'href' => $this->generateUrl('app_parametre_village_index')
                ],
            ],


        ];


        return $this->render('config/parametre/liste.html.twig', ['links' => $parametres[$module] ?? []]);
    }
}
