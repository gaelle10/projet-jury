<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create(locale: 'fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $manager->persist(
                (new Produit())
                    ->setTitre($faker->name)
                    ->setDescription($faker->text(300))
                    ->setCollection($faker->randomKey(['M', 'F']))
                    ->setTaille($faker->randomKey(['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL']))
                    ->setPhoto('https://source.unsplash.com/random/400x200')
                    ->setPrix($faker->randomFloat(2, 100, 500))
                    ->setStock($faker->randomDigitNotNull)
                    ->setCouleur($faker->hexColor)
                    ->setDateEnregistrement(new \DateTimeImmutable())
            );
        }

        $manager->flush();
    }
}
