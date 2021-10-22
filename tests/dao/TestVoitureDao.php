<?php
namespace Test\dao;
require_once '../../vendor/autoload.php';

use App\models\VoitureDao;
use PHPUnit\Framework\TestCase;

class TestVoitureDao extends TestCase {

    private static $voitureDao;  
    
    public static function setUpBeforeClass() : void
    {
        TestVoitureDao::$voitureDao = new VoitureDao();
    }

    public static function tearDownAfterClass () : void
    {
        $voiture = TestVoitureDao::$voitureDao->findById (1);
        $voiture->setCouleur ("White");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        TestVoitureDao::$voitureDao->insertVoiture2(3, "ab-789-cd", "Blue", "VW", "Golf");
        TestVoitureDao::$voitureDao->deleteVoiture(4);
    }

    public function testFindAll () {
        $voitures = TestVoitureDao::$voitureDao->findAll();
        $this->assertEquals(count($voitures),3);
    }

    public function testfindById () {
        $voiture = TestVoitureDao::$voitureDao->findById (2);
        $this->assertNotNull($voiture);
    }

    public function testUpdateVoiture () {
        $voiture = TestVoitureDao::$voitureDao->findById (1);
        $voiture->setCouleur ("Red");
        TestVoitureDao::$voitureDao->updateVoiture($voiture);
        $voitureUpdated = TestVoitureDao::$voitureDao->findById (1);
        $this->assertEquals($voitureUpdated->getCouleur(),"Red");
    }

    public function testDeleteVoiture () {
        $isDeleted = TestVoitureDao::$voitureDao->deleteVoiture (3);
        $this->assertTrue ($isDeleted);
    }


    public function testInsertVoiture2(){
        $isInserted = TestVoitureDao::$voitureDao->insertVoiture2 ("4","xx-555-yy","Green","Volvo","A5");
        $this->assertNotNull ($isInserted);
    }
}