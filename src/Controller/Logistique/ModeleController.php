<?php

namespace App\Controller\Logistique;

use App\Entity\Modele;
use App\Form\ModeleType;
use App\Repository\ModeleRepository;
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
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/ads/logistique/modele')]
class ModeleController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_logistique_modele_index';

    #[Route('/', name: 'app_logistique_modele_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {


        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        $table = $dataTableFactory->create()
            // ->add('id', TextColumn::class, ['label' => 'Identifiant'])
           
            ->add('marque', TextColumn::class, ['label' => 'Marque', 'field' => 'marque.libelle'])
            ->add('libelle', TextColumn::class, ['label' => 'Nom'])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Modele::class,
                'query' => function (QueryBuilder $qb) {
                    $qb->select(['modele', 'marque',]) // 't' a été retiré car non utilisé
                        ->from(Modele::class, 'modele')
                        ->join('modele.marque', 'marque')
                      
                        ->orderBy('modele.id', 'DESC'); // Suppression de l'espace superflu après 'id'
                }
            ])
            ->setName('dt_app_logistique_modele');
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
                    'render' => function ($value, Modele $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'url' => $this->generateUrl('app_logistique_modele_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_logistique_modele_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_logistique_modele_delete', ['id' => $value]),
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


        return $this->render('logistique/modele/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission
        ]);
    }

    #[Route('/new', name: 'app_logistique_modele_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_modele_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_modele_index');


            if ($form->isValid()) {

                $entityManager->persist($modele);
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

        return $this->renderForm('logistique/modele/new.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_logistique_modele_show', methods: ['GET'])]
    public function show(Modele $modele): Response
    {
        return $this->render('logistique/modele/show.html.twig', [
            'modele' => $modele,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_logistique_modele_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Modele $modele, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(ModeleType::class, $modele, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_logistique_modele_edit', [
                'id' => $modele->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_logistique_modele_index');


            if ($form->isValid()) {

                $entityManager->persist($modele);
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

        return $this->renderForm('logistique/modele/edit.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_logistique_modele_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Modele $modele, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_logistique_modele_delete',
                    [
                        'id' => $modele->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($modele);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_logistique_modele_index');

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

        return $this->renderForm('logistique/modele/delete.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }
}
