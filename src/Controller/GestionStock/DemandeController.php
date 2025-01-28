<?php

namespace App\Controller\GestionStock;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
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
use App\Entity\LigneDemande;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

#[Route('/ads/gestionstock/demande')]
class DemandeController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_config_stock_index';


 #[Route('/{etat}/liste', name: 'app_config_stock_index', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $etat, DataTableFactory $dataTableFactory): Response
    {
        
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        // if ($etat == 'en_cours') {
        //     $titre = "En attente de validation";
        // } elseif ($etat == 'valider') {
        //     $titre = "Validées";
        // } 
        $table = $dataTableFactory->create()
            ->add('reference', TextColumn::class, ['label' => 'Reference'])
            ->add('libelle', TextColumn::class, ['label' => 'Libellé'])
            ->add('dateDemande', DateTimeColumn::class, ['label' => 'Date de demande'])
            // ->add('dateValidation')
            // ->add('dateLivraison')
            ->createAdapter(ORMAdapter::class, [
                'entity' => Demande::class,
                'query' => function (QueryBuilder $req) use ($etat) {
                    $req->select('d')
                        ->from(Demande::class, 'd')
                        // ->leftJoin('a.communaute', 'co')
                        ;
      
                    if ($etat == 'en_cours') {
                       
                        $req->andWhere("d.etat =:etat")
                            ->setParameter('etat', "en_cours");
                    } elseif ($etat == 'valide') {
                        $req->andWhere("d.etat =:etat")
                            ->setParameter('etat', "valide");
                    } elseif ($etat == 'livree') {
                    $req->andWhere("d.etat =:etat")
                        ->setParameter('etat', "livre");
                }
                }
            ])
    
            ->setName('dt_app_gestionstock_demande_' . $etat);

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
                    'render' => function ($value, Demande $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'edit' => [
                                    'url' => $this->generateUrl('app_gestionstock_demande_edit', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-pen',
                                    'attrs' => ['class' => 'btn-default'],
                                    'render' => $renders['edit']
                                ],
                                'show' => [
                                    'url' => $this->generateUrl('app_gestionstock_demande_show', ['id' => $value]),
                                    'ajax' => true,
                                    'icon' => '%icon% bi bi-eye',
                                    'attrs' => ['class' => 'btn-primary'],
                                    'render' => $renders['show']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_gestionstock_demande_delete', ['id' => $value]),
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


        return $this->render('gestionstock/demande/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission,
            'etat' => $etat,
            
        ]);
    }
    #[Route('/new', name: 'app_gestionstock_demande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FormError $formError): Response
    {
        $demande = new Demande();
        // $ligneDemandes = new LigneDemande();
        // $demande->addLigneDemande($ligneDemandes);
        $form = $this->createForm(DemandeType::class, $demande, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_gestionstock_demande_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_stocks_index');


            if ($form->isValid()) {

                $entityManager->persist($demande);
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

        return $this->renderForm('gestionstock/demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_gestionstock_demande_show', methods: ['GET'])]
    public function show(Demande $demande): Response
    {
        return $this->render('gestionstock/demande/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestionstock_demande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demande $demande, EntityManagerInterface $entityManager, FormError $formError): Response
    {

        $form = $this->createForm(DemandeType::class, $demande, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_gestionstock_demande_edit', [
                'id' => $demande->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_stocks_index');


            if ($form->isValid()) {

                $entityManager->persist($demande);
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

        return $this->renderForm('gestionstock/demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_gestionstock_demande_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                    'app_gestionstock_demande_delete',
                    [
                        'id' => $demande->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $entityManager->remove($demande);
            $entityManager->flush();

            $redirect = $this->generateUrl('app_config_stocks_index');

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

        return $this->renderForm('gestionstock/demande/delete.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }
}
