<?php

namespace App\Controller\Logistique;

use App\Entity\Assurance;
use App\Form\AssuranceType;
use App\Repository\AssuranceRepository;
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

#[Route('/ads/logistique/assurance')]
class AssuranceController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_logistique_assurance_index';

    #[Route('/', name: 'app_logistique_assurance_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {


        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        $table = $dataTableFactory->create()
            // 
            // 
            // ->add('dateDebut')
            // ->add('dateFin')
            // ->add('montant')
            // ->add('vehicule', TextColumn::class, ['label' => 'Vehicule','field' => 'vehecule.immatriculation'])
            ->add('compagnie', TextColumn::class, ['label' => 'Compagnie'])
            ->add('numeroPolice', TextColumn::class, ['label' => 'N° Police'])
            ->add('dateDebut', DateTimeColumn::class, ['label' => 'Date Debut', 'format' => 'd/m/Y'])
            ->add('dateFin', DateTimeColumn::class, ['label' => 'Date Fin,', 'format' => 'd/m/Y'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Assurance::class,
                'query' => function (QueryBuilder $qb) {
                    $qb->select(['assurance',]) // 't' a été retiré car non utilisé
                        ->from(Assurance::class, 'assurance')
                        // ->join('assurance.vehecules', 'vehecule')
                        // ->join('affectation.employes', 'employe')

                        ->orderBy('assurance.id', 'DESC'); // Suppression de l'espace superflu après 'id'
                }
            ])
            ->setName('dt_app_logistique_assurance');
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
                    'render' => function ($value, Assurance $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'target' => '#exampleModalSizeSm2',

                                    'url' => $this->generateUrl('app_logistique_assurance_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_logistique_assurance_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_logistique_assurance_delete', ['id' => $value]),
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


        return $this->render('logistique/assurance/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission
        ]);
    }

    #[Route('/new', name: 'app_logistique_assurance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $assurance = new Assurance();
        $form = $this->createForm(AssuranceType::class, $assurance, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_assurance_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_assurance_index');


            if ($form->isValid()) {

                $entityManager->persist($assurance);
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

        return $this->renderForm('logistique/assurance/new.html.twig', [
            'assurance' => $assurance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_logistique_assurance_show', methods: ['GET'])]
    public function show(Assurance $assurance): Response
    {
        return $this->render('logistique/assurance/show.html.twig', [
            'assurance' => $assurance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_logistique_assurance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assurance $assurance, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(AssuranceType::class, $assurance, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_assurance_edit', [
                'id' => $assurance->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_assurance_index');


            if ($form->isValid()) {

                $entityManager->persist($assurance);
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

        return $this->renderForm('logistique/assurance/edit.html.twig', [
            'assurance' => $assurance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_logistique_assurance_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Assurance $assurance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_logistique_assurance_delete',
                    [
                        'id' => $assurance->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($assurance);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_logistique_assurance_index');

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

        return $this->renderForm('logistique/assurance/delete.html.twig', [
            'assurance' => $assurance,
            'form' => $form,
        ]);
    }
}
