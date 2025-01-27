<?php

namespace App\Controller\Mission;

use App\Entity\Audience;
use App\Form\AudienceType;
use App\Service\FormError;
use App\Service\ActionRender;
use Doctrine\ORM\QueryBuilder;
use App\Controller\BaseController;
use App\Entity\LigneMission;
use App\Entity\Mission;
use App\Form\JutificationAudienceType;
use App\Form\MissionType;
use App\Repository\AudienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Component\Workflow\Exception\LogicException;

#[Route('/ads/mission/mission')]
class MissionController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_config_mission_index';

    #[Route('/{etat}/liste', name: 'app_config_mission_index', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $etat, DataTableFactory $dataTableFactory): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        // if ($etat == 'en_cours') {
        //     $titre = "En attente de validation";
        // } elseif ($etat == 'valider') {
        //     $titre = "Validées";
        // } 
        $table = $dataTableFactory->create()
           ->add('objetMission', TextColumn::class, ['label' => 'Objet'])
            // ->add('numeroOM')
            // ->add('dateCreationMission')
            // ->add('dateDebutPrevue')
            // ->add('dateFinPrevue')
            // ->add('dateDebutEffective')
            // ->add('dateFinEffective')
            // ->add('montantParticipantMission')
            // ->add('pourcentageAvanceMission')
            // ->add('initiateurMission')
            // ->add('imputationBudgetaire')
            // ->add('options')
            // ->add('employe')
            // ->add('moyenTransport')
            // ->add('participants')
            // ->add('compteRendu')
            // ->add('fichier')
            // ->add('daterencontre', DateTimeColumn::class, [
            //     'label' => 'Date de la rencontre',
            //     "format" => 'd-m-Y'
            // ])
            // ->add('communaute', TextColumn::class, ['label' => 'Communauté', 'field' => 'co.libelle'])
            // ->add('nomchef', TextColumn::class, ['label' => 'Nom du chef'])
            // ->add('numero', TextColumn::class, ['label' => 'Numéro'])
            // ->add('motif', TextColumn::class, ['label' => 'Motif'])
            ->add('')
            ->createAdapter(ORMAdapter::class, [
                'entity' => Mission::class,
                'query' => function (QueryBuilder $req) use ($etat) {
                    $req->select('m')
                        ->from(Mission::class, 'm')
                        // ->leftJoin('a.communaute', 'co')
                        ;

                    if ($etat == 'en_cours') {
                        $req->andWhere("m.etat =:etat")
                            ->setParameter('etat', "en_cours");
                    } elseif ($etat == 'valider') {
                        $req->andWhere("m.etat =:etat")
                            ->setParameter('etat', "valider");
                    }
                }
            ])
            ->setName('dt_app_config_mission_' . $etat);

        if ($permission != null) {
            $renders = [
                'edit' => new ActionRender(function () use ($permission) {
                    if ($permission == 'R') {
                        return false;
                    } elseif ($permission == 'RD') {
                        return false;
                    } elseif ($permission == 'RU') {
                        return true;
                    } elseif ($permission == 'CRUD') {
                        return true;
                    } elseif ($permission == 'CRU') {
                        return true;
                    } elseif ($permission == 'CR') {
                        return false;
                    }
                }),
                'delete' => new ActionRender(function () use ($permission) {
                    if ($permission == 'R') {
                        return false;
                    } elseif ($permission == 'RD') {
                        return true;
                    } elseif ($permission == 'RU') {
                        return false;
                    } elseif ($permission == 'CRUD') {
                        return true;
                    } elseif ($permission == 'CRU') {
                        return false;
                    } elseif ($permission == 'CR') {
                        return false;
                    }
                }),
                'show' => new ActionRender(function () use ($permission) {
                    if ($permission == 'R') {
                        return true;
                    } elseif ($permission == 'RD') {
                        return true;
                    } elseif ($permission == 'RU') {
                        return true;
                    } elseif ($permission == 'CRUD') {
                        return true;
                    } elseif ($permission == 'CRU') {
                        return true;
                    } elseif ($permission == 'CR') {
                        return true;
                    }
                }),

            ];



            $hasActions = false;

            foreach ($renders as $_ => $cb) {
                if ($cb->execute()) {
                    $hasActions = true;
                    break;
                }
            }



            if ($hasActions) {
                $table->add('id', TextColumn::class, [
                    'label' => 'Actions',
                    'orderable' => false,
                    'globalSearchable' => false,
                    'className' => 'grid_row_actions',
                    'render' => function ($value, Mission $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'url' => $this->generateUrl('app_mission_mission_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_mission_mission_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_mission_mission_delete', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-trash',
                                    'attrs' => ['class' => 'btn-main'],
                                    'render' => $renders['delete']
                                ]
                            ]

                        ];
                        return $this->renderView('_includes/default_actions.html.twig', compact('options', 'context'));
                    }
                ]);
            }
        }





        $table->handleRequest($request);
        if ($table->isCallback() == true) {
            return $table->getResponse();
        }


        return $this->render('mission/mission/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission,
            'etat' => $etat,
            
        ]);
    }

    #[Route('/new', name: 'app_mission_mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $mission = new Mission();
           $ligneMissions = new LigneMission();
        $mission->addLigneMission($ligneMissions);
        $validationGroups = ['Default', 'FileRequired', 'oui'];
        $filePath = 'mission';
        $form = $this->createForm(MissionType::class, $mission, [
            'method' => 'POST',
            'doc_options' => [
                'uploadDir' => $this->getUploadDir(self::UPLOAD_PATH, true),
                'attrs' => ['class' => 'filestyle'],
            ],
            'validation_groups' => $validationGroups, 
            'action' => $this->generateUrl('app_mission_mission_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_missions_index');


            if ($form->isValid()) {

                $entityManager->persist($mission);
                $entityManager->flush();

                $data = true;
                $message = 'Opération effectuée avec succès';
                $statut = 1;
                $this->addFlash('success', $message);
            } else {
                $message = $formError->all($form);
                $statut = 0;
                $statutCode = 500;
                if (!$isAjax) {
                    $this->addFlash('warning', $message);
                }
            }


            if ($isAjax) {
                return $this->json(compact('statut', 'message', 'redirect', 'data'), $statutCode);
            } else {
                if ($statut == 1) {
                    return $this->redirect($redirect, Response::HTTP_OK);
                }
            }
        }

        return $this->renderForm('mission/mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_mission_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mission_mission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, EntityManagerInterface $entityManager, FormError $formError): Response
    {
       
        $validationGroups = ['Default', 'FileRequired', 'oui'];
        $filePath = 'mission';
        $form = $this->createForm(MissionType::class, $mission, [
            'method' => 'POST',
            'doc_options' => [
                'uploadDir' => $this->getUploadDir(self::UPLOAD_PATH, true),
                'attrs' => ['class' => 'filestyle'],
            ],
            'validation_groups' => $validationGroups,
            'action' => $this->generateUrl('app_mission_mission_edit', [
                'id' => $mission->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_missions_index');


            if ($form->isValid()) {

                $entityManager->persist($mission);
                $entityManager->flush();

                $data = true;
                $message = 'Opération effectuée avec succès';
                $statut = 1;
                $this->addFlash('success', $message);
            } else {
                $message = $formError->all($form);
                $statut = 0;
                $statutCode = 500;
                if (!$isAjax) {
                    $this->addFlash('warning', $message);
                }
            }

            if ($isAjax) {
                return $this->json(compact('statut', 'message', 'redirect', 'data'), $statutCode);
            } else {
                if ($statut == 1) {
                    return $this->redirect($redirect, Response::HTTP_OK);
                }
            }
        }

        return $this->renderForm('mission/mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_mission_mission_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Mission $mission, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_mission_mission_delete',
                    [
                        'id' => $mission->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($mission);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_config_missions_index');

            $message = 'Opération effectuée avec succès';

            $response = [
                'statut' => 1,
                'message' => $message,
                'redirect' => $redirect,
                'data' => $data
            ];

            $this->addFlash('success', $message);

            if (!$request->isXmlHttpRequest()) {
                return $this->redirect($redirect);
            } else {
                return $this->json($response);
            }
        }

        return $this->renderForm('mission/mission/delete.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }
}
