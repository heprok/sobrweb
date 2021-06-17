<?php

namespace App\DataFixtures;

use App\Entity\Duty;
use App\Entity\People;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PeopleFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT_PEOPLE = 10;

    public function load(ObjectManager $manager)
    {
        $arr_pat = ['Филимонович', 'Демьянович', 'Мечиславович', 'Климентович', 'Олегович', 'Левович', 'Филиппович', 'Чеславович', 'Ростиславович', 'Макарович'];
        $arr_fam = ['Яхаев', 'Радыгин', 'Погребной', 'Цыганков', 'Брагин', 'Рекунов', 'Толстобров', 'Носачёв', 'Шкловский', 'Васенин'];
        $arr_nam = ['Афанасий', 'Арсений', 'Еремей', 'Клавдий', 'Евстигней', 'Рубен', 'Варфоломей', 'Саввелий', 'Евгений', 'Агап'];

        $duties = $manager->getRepository(Duty::class)->findAll();

        for ($i = 0; $i < self::COUNT_PEOPLE; $i++) {
            $people = new People($arr_fam[array_rand($arr_fam)]);
            $people->setPat($arr_pat[array_rand($arr_pat)]);
            $people->setNam($arr_nam[array_rand($arr_nam)]);
            
            for ($j = 0; $j < rand(0, DutyFixtures::COUNT_DUTY); $j++) {
                $people->addDuty($duties[array_rand($duties)]);
            }
            $manager->persist($people);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DutyFixtures::class
        ];
    }
}
