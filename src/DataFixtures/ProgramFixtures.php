<?php


namespace App\DataFixtures;


use App\Entity\Program;

use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface

{

    public function load(ObjectManager $manager)

    {

        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $this->addReference('program_0', $program);
        $manager->persist($program);


        $program->setTitle('Film6');
        $program->setSynopsis('Des zombies envahissent Mars');
        $program->setCategory($this->getReference('category_Aventure'));
        $this->addReference('program_1', $program);
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Film2');
        $program->setSynopsis('Des zombies envahissent Jupiter');
        $program->setCategory($this->getReference('category_Animation'));
        $this->addReference('program_2', $program);
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Film3');
        $program->setSynopsis('Des zombies envahissent Venus');
        $program->setCategory($this->getReference('category_Fantastique'));
        $this->addReference('program_3', $program);
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Film4');
        $program->setSynopsis('Des zombies envahissent Saturne');
        $program->setCategory($this->getReference('category_Horreur'));
        $this->addReference('program_4', $program);
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Film7');
        $program->setSynopsis('Des zombies envahissent Mars');
        $program->setCategory($this->getReference('category_Horreur'));
        $this->addReference('program_5', $program);
        $manager->persist($program);



        $manager->flush();

    }


    public function getDependencies()

    {

        return [

            CategoryFixtures::class,

        ];

    }



}
