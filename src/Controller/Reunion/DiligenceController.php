<?php

namespace App\Controller\Reunion;

use App\Entity\Diligence;
use App\Form\DiligenceType;
use App\Repository\DiligenceRepository;
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
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Workflow\Exception\LogicException;

#[Route('/ads/reunion/diligence')]
class DiligenceController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_config_diligence_index';


    #[Route('/{etat}/liste', name: 'app_config_diligence_index', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $etat, DataTableFactory $dataTableFactory): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
    
        $table = $dataTableFactory->create()
            ->add('ordreJour', TextColumn::class, ['label' => 'Ordre du jour', 'field' => 'p.numOrdreJour'])
            // ->add('ordreJour', TextColumn::class, ['label' => 'Action', 'field' => 'p.libOrdreJour'])

            ->add('dateTraitementDiligence', DateTimeColumn::class, [
                'label' => 'Date De Traitement',
                "format" => 'd-m-Y'
            ])
   
        
            ->add('commentaireDiligence', TextColumn::class, ['label' => 'Commentaire'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Diligence::class,
                'query' => function (QueryBuilder $req) use ($etat) {
                    $req->select('d','p')
                        ->from(Diligence::class, 'd')
                         ->Join('d.points', 'p')
                    ;

                    if ($etat == 'en_cours') {
                        $req->andWhere("d.etat =:etat")
                        ->setParameter('etat', "en_cours");
                    } elseif ($etat == 'termine') {
                        $req->andWhere("d.etat =:etat")
                        ->setParameter('etat', "termine");
                    }
                }
            ])
   ->setName('dt_app_reunion_diligence_' . $etat);
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
                    'render' => function ($value, Diligence $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'target' => '#exampleModalSizeSm2',

                                'workflow_validation' => [
                                    'url' => $this->generateUrl('app_reunion_diligence_workflow', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon%  bi bi-arrow-repeat',
                                    'attrs' => ['class' => 'btn-danger'],
                                    'render' => $renders['workflow_validation']
                                ],
                                'edit' => [
                                    'url' => $this->generateUrl('app_reunion_diligence_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_reunion_diligence_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_reunion_diligence_delete', ['id' => $value]),
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


        return $this->render('reunion/diligence/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission,
            'etat' => $etat,

        ]);
    }
    #[Route('/new', name: 'app_reunion_diligence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $diligence = new Diligence();
        $form = $this->createForm(DiligenceType::class, $diligence, [
            'method' => 'POST',
            'etat' => 'en_cours',
            'action' => $this->generateUrl('app_reunion_diligence_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_reunions_index');


            if ($form->isValid()) {

                $entityManager->persist($diligence);
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

        return $this->renderForm('reunion/diligence/new.html.twig', [
            'diligence' => $diligence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_reunion_diligence_show', methods: ['GET'])]
    public function show(Diligence $diligence): Response
    {
        return $this->render('reunion/diligence/show.html.twig', [
            'diligence' => $diligence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reunion_diligence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Diligence $diligence, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(DiligenceType::class, $diligence, [
            'method' => 'POST',
            'etat' => 'en_cours',
            'action' => $this->generateUrl('app_reunion_diligence_edit', [
                'id' => $diligence->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_reunions_index');


            if ($form->isValid()) {

                $entityManager->persist($diligence);
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

        return $this->renderForm('reunion/diligence/edit.html.twig', [
            'diligence' => $diligence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_reunion_diligence_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Diligence $diligence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_reunion_diligence_delete',
                    [
                        'id' => $diligence->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($diligence);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_config_reunions_index');

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

        return $this->renderForm('reunion/diligence/delete.html.twig', [
            'diligence' => $diligence,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/workflow/validation', name: 'app_reunion_diligence_workflow', methods: ['GET', 'POST'])]
    public function workflow(Request $request, Diligence $diligence, DiligenceRepository $diligenceRepository, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $etat =  $diligence->getEtat();
        // $mission = $missionRepository->find(1);
        // dd($mission); // Remplacez par un ID existant
        // $validationGroups = ['Default', 'FileRequired', 'oui'];
        // $filePath = 'mission';
        $form = $this->createForm(DiligenceType::class, $diligence, [
            'method' => 'GET',
            'etat' => $etat,
            // 'doc_options' => [
            //     'uploadDir' => $this->getUploadDir(self::UPLOAD_PATH, true),
            //     'attrs' => ['class' => 'filestyle'],
            // ],
            // 'validation_groups' => $validationGroups,
            'action' => $this->generateUrl('app_reunion_diligence_workflow', [
                'id' =>  $diligence->getId()
            ])
        ]);


        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_reunions_index');
            $workflow = $this->workflow->get($diligence, 'diligence');

            if ($form->isValid()) {
                if ($form->getClickedButton()->getName() === 'valider') {

                    try {
                        if ($workflow->can($diligence, 'valider')) {
                            $workflow->apply($diligence, 'valider');

                            $this->em->flush();
                        }
                    } catch (LogicException $e) {

                        $this->addFlash('danger', sprintf('No, that did not work: %s', $e->getMessage()));
                    }
                    $diligenceRepository->add($diligence, true);
                } else {
                    $diligenceRepository->add($diligence, true);
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

        return $this->renderForm('reunion/diligence/workflow.html.twig', [
            'diligence' => $diligence,
            'form' => $form,
            'id' => $diligence->getId(),
            // 'etat' => json_encode($etat)
        ]);
    }
}
