<?php

namespace App\Controller\Dossier;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use App\Service\ActionRender;
use App\Service\FormError;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;
use App\Entity\LigneEtape;
use App\Entity\LigneReponsableDossier;
use App\Repository\LigneEtapeRepository;
use App\Repository\LigneReponsableDossierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Workflow\Exception\LogicException;

#[Route('/ads/dossier/dossier')]
class DossierController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_config_dossier_index';

     #[Route('/{etat}/liste', name: 'app_config_dossier_index', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $etat, DataTableFactory $dataTableFactory): Response
    {

       // dd($etat);

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        // if ($etat == 'en_cours') {
        //     $titre = "En attente de validation";
        // } elseif ($etat == 'valider') {
        //     $titre = "Validées";
        // } 


        $table = $dataTableFactory->create()
           ->add('libelle', TextColumn::class, ['label' => 'Nom de dossier'])
            ->add('dateCreation', DateTimeColumn::class, ['label' => 'Date de creation'])
            ->add('description', TextColumn::class, ['label' => 'Description'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Dossier::class,
                'query' => function (QueryBuilder $req) use ($etat) {
                    $req->select('dossier')
                        ->from(Dossier::class, 'dossier')
                        // ->leftJoin('a.communaute', 'co')
                    ;

                    if ($etat == 'en_cours') {
                        $req->andWhere("dossier.etat =:etat")
                        ->setParameter('etat', "en_cours");
                    } elseif ($etat == 'termine') {
                        $req->andWhere("dossier.etat =:etat")
                        ->setParameter('etat', "termine");
                    }
                }
            ])
            ->setName('dt_app_config_dossier_' . $etat);

        if ($permission != null) {
            $renders = [
                'workflow_validation' =>  new ActionRender(function () use ($permission) {
                    if ($permission == 'R') {
                        return false;
                    } elseif ($permission == 'RD') {
                        return false;
                    } elseif ($permission == 'RU') {
                        return true;
                    } elseif ($permission == 'RUD') {
                        return true;
                    } elseif ($permission == 'CRU') {
                        return true;
                    } elseif ($permission == 'CR') {
                        return false;
                    } else {
                        return true;
                    }
                }),
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
                    'render' => function ($value, Dossier $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'target' => '#exampleModalSizeSm2',

                                'workflow_validation' => [
                                    'url' => $this->generateUrl('app_dossier_dossier_workflow', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon%  bi bi-arrow-repeat',
                                    'attrs' => ['class' => 'btn-danger'],
                                    'render' => $renders['workflow_validation']
                                ],
                                'edit' => [
                                    'target' => '#exampleModalSizeSm2',
                                    'url' => $this->generateUrl('app_dossier_dossier_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_dossier_dossier_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_dossier_dossier_delete', ['id' => $value]),
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


        return $this->render('dossier/dossier/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission,
            'etat' => $etat,

        ]);
    }

    #[Route('/new', name: 'app_dossier_dossier_new', methods: ['GET', 'POST'], options: ['expose' => true])]
    public function new(Request $request, EntityManagerInterface $entityManager,LigneReponsableDossierRepository $ligneReponsableDossiers, LigneEtapeRepository $ligneEtapeRepository, FormError $formError): Response
    {
        // $all = $request->query->all();
        // $workflow = isset($all['workflow']) ? $all['workflow'] : null;
        $all = $request->query->all();
        $workflow = isset($all['dossier']['workfow']) ? $all['dossier']['workfow'] : null;

        $ligneEtapes = $ligneEtapeRepository->findBy(['workflow' => $workflow]);

        $ligneEtapes = $ligneEtapeRepository->findBy(['workflow' => $workflow]);
     
       $dossier = new Dossier();
        foreach ($ligneEtapes as $key=>$value) {
            $ligneReponsableDossiers = new LigneReponsableDossier();
            $ligneReponsableDossiers->setLigneEtape($value);
            $dossier->addLigneReponsableDossier($ligneReponsableDossiers);
        }
      
        $form = $this->createForm(DossierType::class, $dossier, [
            'method' => 'GET',
            'etat' => 'en_cours',
            'action' => $this->generateUrl('app_dossier_dossier_new')
        ]);
        $form->handleRequest($request);
    
        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_dossiers_index');

            //dd($ligneEtapes);
            if ($form->isValid()) {

                $entityManager->persist($dossier);
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

        return $this->renderForm('dossier/dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
            'ligneEtape' => $ligneEtapes,
            'type' => 'new',
        ]);
    }


    #[Route('/new/load/{workfow}', name: 'app_dossier_dossier_new_load', methods: ['GET', 'POST'], options: ['expose' => true])]
    public function newLoad(Request $request,$workfow, EntityManagerInterface $entityManager, LigneReponsableDossierRepository $ligneReponsableDossiers, LigneEtapeRepository $ligneEtapeRepository, FormError $formError): Response
    {

       
        $all = $request->query->all();
        
        $ligneEtapes = $ligneEtapeRepository->findBy(['workflow' => $workfow]);
      //  dd($ligneEtapes);
        $dossier = new Dossier();
        foreach ($ligneEtapes as $key => $value) {
            $ligneReponsableDossiers = new LigneReponsableDossier();
            $ligneReponsableDossiers->setLigneEtape($value);
            $dossier->addLigneReponsableDossier($ligneReponsableDossiers);
        }
       
       // dd($validationGroups);
      $form = $this->createForm(DossierType::class, $dossier, [
            'method' => 'POST',
            'etat' => 'en_cours',
            'action' => $this->generateUrl('app_dossier_dossier_new')
        ]);
        // Add logic to fetch DocumentTypeClient based on selected TypeClient
     
      
         $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_dossiers_index');


            if ($form->isValid()) {

                $entityManager->persist($dossier);
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

        return $this->renderForm('dossier/dossier/new_load.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
            'workfow' => $workfow,
            'ligneEtape' => $ligneEtapes,
            'type'=>'new'
        ]);
    }




    #[Route('/{id}/show', name: 'app_dossier_dossier_show', methods: ['GET'])]
    public function show(Dossier $dossier): Response
    {
        return $this->render('dossier/dossier/show.html.twig', [
            'dossier' => $dossier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_dossier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dossier $dossier, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(DossierType::class, $dossier, [
            'method' => 'POST',
            'etat' => 'en_cours',
            'action' => $this->generateUrl('app_dossier_dossier_edit', [
                'id' => $dossier->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_dossiers_index');


            if ($form->isValid()) {

                $entityManager->persist($dossier);
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

        return $this->renderForm('dossier/dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_dossier_dossier_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Dossier $dossier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_dossier_dossier_delete',
                    [
                        'id' => $dossier->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($dossier);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_config_dossiers_index');

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

        return $this->renderForm('dossier/dossier/delete.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/workflow/validation', name: 'app_dossier_dossier_workflow', methods: ['GET', 'POST'])]
    public function workflow(Request $request, Dossier $dossier, DossierRepository $dossierRepository, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $etat =  $dossier->getEtat();
        $form = $this->createForm(DossierType::class, $dossier, [
            'method' => 'POST',
            'etat' => $etat,
            'action' => $this->generateUrl('app_dossier_dossier_workflow', [
                'id' =>  $dossier->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_dossier_index');
            $workflow = $this->workflow->get($dossier, 'dossier');

            if ($form->isValid()) {
                if ($form->getClickedButton()->getName() === 'Valider') {
                    try {
                        if ($workflow->can($dossier, 'valider')) {
                            $workflow->apply($dossier, 'valider');
                            $this->em->flush();
                        }
                    } catch (LogicException $e) {

                        $this->addFlash('danger', sprintf('No, that did not work: %s', $e->getMessage()));
                    }
                    $dossierRepository->save($dossier, true);
                } else {
                    $dossierRepository->save($dossier, true);
                }

                // if ($form->getClickedButton()->getName() === 'rejeter') {
                //     try {
                //         if ($workflow->can($audience, 'rejeter')) {
                //             $workflow->apply($audience, 'rejeter');
                //             $this->em->flush();
                //         }
                //     } catch (LogicException $e) {

                //         $this->addFlash('danger', sprintf('No, that did not work: %s', $e->getMessage()));
                //     }
                //     $audienceRepository->save($audience, true);
                // } else {
                //     $audienceRepository->save($audience, true);
                // }

                $data = true;
                $message       = 'Opération effectuée avec succès';
                $statut = 1;
                $this->addFlash('success', $message);
            } else {
                $message = $formError->all($form);
                $statut = 0;
                $statutCode = Response::HTTP_INTERNAL_SERVER_ERROR;
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

        return $this->renderForm('dossier/dossier/workflow.html.twig', [
            'audience' => $dossier,
            'form' => $form,
            'id' => $dossier->getId(),
            'etat' => json_encode($etat)
        ]);
    }
}
