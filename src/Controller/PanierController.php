<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\User;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{
    #[Route('', name: 'app_panier_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $panier = $request->getSession()->get('_panier', []);
        return $this->render('panier/index.html.twig', [
            'panier' => $panier
        ]);
    }

    #[Route('/add/{id}', name: 'app_panier_add', methods: ['POST'])]
    public function add(Request $request, Produit $produit): Response
    {
        $panier = $request->getSession()->get('_panier', []);
        $panier[] = $produit;
        $request->getSession()->set('_panier', $panier);
        return $this->redirectToRoute('app_home');
    }

    #[Route('/remove/{id}', name: 'app_panier_remove', methods: ['POST'])]
    public function remove(Request $request, Produit $produit): Response
    {
        $panier = $request->getSession()->get('_panier', []);
        $panier = array_filter($panier, function (Produit $p) use ($produit) {
                return $p->getId() != $produit->getId();
        });
        $request->getSession()->set('_panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/validate', name: 'app_panier_validate', methods: ['POST'])]
    public function validate(
        Request $request,
        CommandeRepository $repository,
        ProduitRepository $produitRepository,
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $panier = $request->getSession()->get('_panier', []);
        $quantity = count($panier); // calcule de la quantité des produits

        if ($quantity > 0) {
            $commande = (new Commande())
                ->setMembre($user)
                ->setQuantite($quantity)
                ->setEtat('pending')
                ->setDateEnregistrement(new \DateTimeImmutable());

            $prixTotal = 0;
            /** @var Produit $produit */
            foreach($panier as $produit) {
                $prixTotal += $produit->getPrix(); // calcule du prix total de la commande
                $commande->addProduit($produitRepository->find($produit->getId()));
            }

            $commande->setMontant((int) $prixTotal);
            $repository->add($commande, true); // enregistrement dans la base de donnée
            $request->getSession()->set('_panier', []); // vider le panier
        }

        return $this->redirectToRoute('app_home');
    }
}
