<?php

namespace App\Controller\Reunion;

use App\Entity\Reunion;
use App\Form\ReunionType;
use App\Repository\ReunionRepository;
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
use App\Entity\OrdreJour;

use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Column\NumberColumn;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

#[Route('/ads/reunion/reunion')]
class ReunionController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_reunion_reunion_index';

    #[Route('/', name: 'app_reunion_reunion_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {


        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        $table = $dataTableFactory->create()
            ->add('libReunion', TextColumn::class, ['label' => 'Tire Réunion'])

            ->add('heureDebut', DateTimeColumn::class, [
                'label' => 'Heure de début',
                'format' => 'H:i' // Set the time format (HH:mm)
            ])

            ->add('heureFin', DateTimeColumn::class, [
                'label' => 'Heure de fin',
                'format' => 'H:i' // Set the time format (HH:mm)
            ])
            ->add('totalPoints', NumberColumn::class, [
                'label' => 'Total des points',

                'render' => function ($value, Reunion $context) {
                    // Calculer la somme des points (par exemple, à partir d'une relation)
                    $totalPoints = 0;
                    foreach ($context->getPoints() as $point) {
                        $totalPoints += $point->getId(); // Remplacer `getValue` par la méthode qui retourne les points
                    }
                    return number_format($totalPoints); // Afficher la somme des points avec 2 décimales
                }
            ])
            // ->add('id', TextColumn::class, ['label' => 'Identifiant'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Reunion::class,
            ])
            ->setName('dt_app_reunion_reunion');
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
                    'render' => function ($value, Reunion $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'target' => '#exampleModalSizeSm2',
                                    'url' => $this->generateUrl('app_reunion_reunion_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'target' => '#exampleModalSizeSm2',
                                    'url' => $this->generateUrl('app_reunion_reunion_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_reunion_reunion_delete', ['id' => $value]),
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

        if ($table->isCallback()) {
            return $table->getResponse();
        }


        return $this->render('reunion/reunion/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission
        ]);
    }

    #[Route('/new', name: 'app_reunion_reunion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $reunion = new Reunion();
        $ordrejOur = new OrdreJour();
        $reunion->addPoint($ordrejOur);
        $form = $this->createForm(ReunionType::class, $reunion, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_reunion_reunion_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_reunion_reunion_index');


            if ($form->isValid()) {

                $entityManager->persist($reunion);
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

        return $this->renderForm('reunion/reunion/new.html.twig', [
            'reunion' => $reunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_reunion_reunion_show', methods: ['GET'])]
    public function show(Reunion $reunion): Response
    {
        return $this->render('reunion/reunion/show.html.twig', [
            'reunion' => $reunion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reunion_reunion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reunion $reunion, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(ReunionType::class, $reunion, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_reunion_reunion_edit', [
                'id' => $reunion->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_reunion_reunion_index');


            if ($form->isValid()) {

                $entityManager->persist($reunion);
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

        return $this->renderForm('reunion/reunion/edit.html.twig', [
            'reunion' => $reunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_reunion_reunion_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Reunion $reunion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_reunion_reunion_delete',
                    [
                        'id' => $reunion->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($reunion);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_reunion_reunion_index');

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

        return $this->renderForm('reunion/reunion/delete.html.twig', [
            'reunion' => $reunion,
            'form' => $form,
        ]);
    }
}
