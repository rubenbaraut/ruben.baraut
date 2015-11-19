<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Work;
use AppBundle\Entity\Post;


class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tagSymfony = new Tag('Symfony',false);
        $tagCakephp = new Tag('Cake PHP',false);
        $tagHtml = new Tag('Html5',false);
        $tagCake = new Tag('Cake PHP',false);
        $tagPrestashop = new Tag('Prestashop',false);
        $tagTxema = new Tag('Disseny: Txema Morales',true);
        $tagEsther = new Tag('Disseny: Esther Ferrutz',true);
        $tagFados = new Tag('Col·laboració: Fados Produccions',true);
        $tagWave = new Tag('Col·laboració: Wavecontrol',true);


        $manager->persist($tagSymfony,true);
        $manager->persist($tagCakephp,true);
        $manager->persist($tagCake,true);
        $manager->persist($tagPrestashop,true);
        $manager->persist($tagTxema,true);



        $work1 = new Work('Wavecontrol','http://www.wavecontrol.com','wavecontrol_web.jpg');
        $work1->addTags($tagSymfony);
        $work1->addTags($tagHtml);
        $work1->addTags($tagWave);
        $manager->persist($work1);

        $work2 = new Work('Dichaea','http://www.dichaea.com','dichaea.jpg');
        $work2->addTags($tagSymfony);
        $work2->addTags($tagHtml);
        $work2->addTags($tagTxema);
        $manager->persist($work2);


        $work3 = new Work('Fesadent','http://www.fesadent.com','fesadent.jpg');
        $work3->addTags($tagSymfony);
        $work3->addTags($tagHtml);
        $work3->addTags($tagTxema);
        $manager->persist($work3);

        $work4 = new Work('Nexe','http://www.nexe.com','nexe.jpg');
        $work4->addTags($tagSymfony);
        $work4->addTags($tagHtml);
        $work4->addTags($tagFados);
        $manager->persist($work4);

        $work5 = new Work('La Keka','http://www.lakeka.es','lakeka.jpg');
        $work5->addTags($tagSymfony);
        $work5->addTags($tagHtml);
        $work5->addTags($tagEsther);
        $manager->persist($work5);

        $work6 = new Work('Genoxage','http://www.genoxage.com','genoxage.jpg');
        $work6->addTags($tagSymfony);
        $work6->addTags($tagHtml);
        $work6->addTags($tagFados);
        $manager->persist($work6);

        $work7 = new Work('Challenge Barcelona','http://www.challenge-barcelona.com','challenge.jpg');
        $work7->addTags($tagSymfony);
        $work7->addTags($tagHtml);
        $work7->addTags($tagFados);
        $manager->persist($work7);

        $work8 = new Work('Fitohobby','http://www.fitohobby.com','fito.jpg');
        $work8->addTags($tagSymfony);
        $work8->addTags($tagHtml);
        $work8->addTags($tagFados);
        $manager->persist($work8);

        $work9 = new Work('2345 Arquitectes','http://www.2345.cat','2345.jpg');
        $work9->addTags($tagSymfony);
        $work9->addTags($tagHtml);
        $work9->addTags($tagEsther);
        $manager->persist($work9);



        $post1 = new Post();
        $post1->setTitle('Benvinguts al blog tecnològic de Baraut.cat!');
        $post1->setTeaser("<p>Hola a tothom! Aquesta entrada és només la primera de lo que espero que sigui una llarga
        llista d'entrades relacionades amb les coses que més m'agraden, és a dir, la tecnologia i la programació.</p>
        <p>Em passo el dia desenvolupant en entorns web i voldria compartir amb vosaltres totes aquelles coses que quan les soluciono penso ..
        'ruben que bo que ets'. Potser a molts lectors els hi semblen coses òbvies però en quan m'han passat us ben asseguro que les he passat canutes per a solucionar-ho</p>
        <p>Moltes de les coses estaran relacionades amb Symfony, per mi, dels millors Frameworks en PHP que existeixen.</p>
        <p>Intentaré explicar-ho de la forma més clara possible, si en algo vaig equivocat, acepto tot tipus de comentaris</p>" );
        $post1->setText(null);
        $post1->setDate(new \Datetime('15-11-2015'));
        $post1->setType(POST::TYPE_TECNOLOGIC);
        $post1->setImage('mac.jpg');
        $post1->setLinkSingle(false);
        $manager->persist($post1);



        $post1 = new Post();
        $post1->setTitle('Benvinguts al blog de cuina de Baraut.cat!');
        $post1->setTeaser("
        <p>Hola a tothom! Aquesta entrada és només la primera de lo que espero que sigui una llarga
        llista d'entrades relacionades amb una de les coses que més m'agraden: el menjar.</p>
        <p>He de dir que no en
        tinc ni idea de cuina, i és per això que faig aquest blog. Només intento ajudar a totes aquelles persones que els
        hi passa el mateix que a mi. És a dir, que es posen davant de la cuina i no saben ni com han de pelar un tomàquet.</p>
        <p>Com en tot a la vida, només és qüestió de practicar (espero) i per tant aquí aniré penjant les petites receptes que vagi provant de fer i espero que vosaltres valoreu si el progrés és bo.</p>
        <p>I Ja us aviso que tant si és bo com si és dolent, un servidor no deixarà ni una molla a ningún plat! </p>" );
        $post1->setText(null);
        $post1->setDate(new \Datetime('15-11-2015'));
        $post1->setType(POST::TYPE_CULINARI);
        $post1->setLinkSingle(false);
        $post1->setImage('tomaquets.jpg');
        $manager->persist($post1);


        $post1 = new Post();
        $post1->setTitle("Codi d'aquesta web");
        $post1->setTeaser("<p>Si algú té curiositat per veure com està feta aquesta web, us passo l'enllaç al github, qualsevol errada / millora serà benvinguda. <a href='https://github.com/sitobcn82/ruben.baraut'>https://github.com/sitobcn82/ruben.baraut</a></p>
        <p>El template utilitzat està extret de  <a target='_blank' href='http://pozhilov.com'> **Sergey Pozhilov**</a></p>
        <p>La web està encara en fase de desenvolupament i encara no disposa de Backend pel que la carrega de continguts la faig mitjançant fixtures.</p>
        <p>Ara mateix els bundles externs més significatius són <ul><li>friendsofsymfony/comment-bundle : Per habilitar els comentaris dels posts</li><li>knplabs/knp-paginator-bundle: Per paginar els resultats dels llistats de posts</li></ul></p>
        <p>Els següents passos que m'agradaria fer són:<ul><li>Posts amb Audio</li><li>Navegador de Tags</li><li>Cercador</li><li>Backend</li><li>Api per a la pujada de dades</li></ul></p>" );
        $post1->setText(null);
        $post1->setDate(new \Datetime('16-11-2015'));
        $post1->setType(POST::TYPE_TECNOLOGIC);
        $post1->setImage(null);
        $post1->setLinkSingle(false);
        $manager->persist($post1);

        $manager->flush();







    }
}