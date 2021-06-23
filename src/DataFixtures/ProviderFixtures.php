<?php

namespace App\DataFixtures;

use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProviderFixtures extends Fixture
{
    const COUNT_PROVIDER = 4;
    public function load(ObjectManager $manager)
    {
        $arr_name = [
            'ООО «Мох у ели»',
            'ИП «Сосну за доллары»',
            'ЗАО «Ёлки-палки»',
            'OАО «Тыща пней»',
            'ООО ТД "ЭКОДЭК"',
            'ООО Кубометр',
            'ООО Леспромэкспресс',
            'ИП Липатов Алексей Васильевич',
            'ООО «Зеленый дом»',
            'ООО Вальдинвестгруп',
            'ООО «Кенза-Вуд»',
        ];

        for ($i = 0; $i < self::COUNT_PROVIDER; $i++) {
            $name = $arr_name[$i] ?? "Поставщик $i";
            $provder = new Provider($name);
            $manager->persist($provder);
        }

        $manager->flush();
    }
}
