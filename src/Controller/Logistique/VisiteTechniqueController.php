<?php

namespace App\Controller\Logistique;

use App\Entity\VisiteTechnique;
use App\Form\VisiteTechniqueType;
use App\Repository\VisiteTechniqueRepository;
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

#[Route('/ads/logistique/visite/technique')]
class VisiteTechniqueController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_logistique_visite_technique_index';

    #[Route('/', name: 'app_logistique_visite_technique_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {


        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        $table = $dataTableFactory->create()
              ->add('dateDerniereVisite', DateTimeColumn::class, [
                  'label' => 'Date dernière visite',
                  'format' => 'd/m/Y',
              ])
            ->add('dateProchaineVisite', DateTimeColumn::class, [
                'label' => 'Date prochaine visite',
                'format' => 'd/m/Y',
            ])
            // ->add('observation')
            // ->add('vehicule')
            ->createAdapter(ORMAdapter::class, [
                'entity' => VisiteTechnique::class,
            ])
            ->setName('dt_app_logistique_visite_technique');
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
                    'render' => function ($value, VisiteTechnique $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'target' => '#exampleModalSizeSm2',

                                    'url' => $this->generateUrl('app_logistique_visite_technique_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_logistique_visite_technique_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_logistique_visite_technique_delete', ['id' => $value]),
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


        return $this->render('logistique/visite_technique/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission
        ]);
    }

    #[Route('/new', name: 'app_logistique_visite_technique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $visiteTechnique = new VisiteTechnique();
        $form = $this->createForm(VisiteTechniqueType::class, $visiteTechnique, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_visite_technique_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_visite_technique_index');


            if ($form->isValid()) {

                $entityManager->persist($visiteTechnique);
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

        return $this->renderForm('logistique/visite_technique/new.html.twig', [
            'visite_technique' => $visiteTechnique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_logistique_visite_technique_show', methods: ['GET'])]
    public function show(VisiteTechnique $visiteTechnique): Response
    {
        return $this->render('logistique/visite_technique/show.html.twig', [
            'visite_technique' => $visiteTechnique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_logistique_visite_technique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VisiteTechnique $visiteTechnique, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(VisiteTechniqueType::class, $visiteTechnique, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_visite_technique_edit', [
                'id' => $visiteTechnique->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_visite_technique_index');


            if ($form->isValid()) {

                $entityManager->persist($visiteTechnique);
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

        return $this->renderForm('logistique/visite_technique/edit.html.twig', [
            'visite_technique' => $visiteTechnique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_logistique_visite_technique_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, VisiteTechnique $visiteTechnique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_logistique_visite_technique_delete',
                    [
                        'id' => $visiteTechnique->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($visiteTechnique);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_logistique_visite_technique_index');

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

        return $this->renderForm('logistique/visite_technique/delete.html.twig', [
            'visite_technique' => $visiteTechnique,
            'form' => $form,
        ]);
    }
}
