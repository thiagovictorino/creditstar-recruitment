<?php
namespace tests\factories;

use app\enums\PersonalCodeGenderEnum;
use app\exceptions\PersonalCodeException;
use app\factories\PersonalCodeFactory;
use DateTime;

class PersonalFactoryTest extends \Codeception\Test\Unit {
    

    public function testValidPersonalCode(){
        $code = '18611236669';
        $personal = PersonalCodeFactory::make($code);
        
        /**
         * I have to make the math every test again because
         * every year the age change. Otherwise, this test will broke if I set
         * the age on hard code
         */
        $now = new DateTime(date("Y-m-d"));
        $birthday = new DateTime(date("1886-11-23"));
        $age =  (int) $birthday->diff($now)->format('%y');
        

        expect($personal->gender)->equals(PersonalCodeGenderEnum::MALE);
        expect($personal->age)->equals($age);
        expect($personal->hash)->equals(666);
        expect($personal->is_allowed)->equals(true);
        expect($personal->century)->equals(19);
        expect($personal->checksum)->equals(9);
        expect($personal->birthday->format('Y'))->equals(1886);
        expect($personal->birthday->format('m'))->equals(11);
        expect($personal->birthday->format('d'))->equals(23);
    }

    public function testValidFemalePersonalCode(){
        $code = '28611236669';
        $personal = PersonalCodeFactory::make($code);
        expect($personal->gender)->equals(PersonalCodeGenderEnum::FEMALE);
    }
    /**
     * @expectedException app\exceptions\PersonalCodeException
     */
    public function testInvalidCenturyPersonalCode(){
        $code = '98611236669';
        PersonalCodeFactory::make($code);
    }

    /**
     * @expectedException app\exceptions\PersonalCodeException
     */
    public function testInvalidPersonalCode(){
        $code = '986112366';
        PersonalCodeFactory::make($code);
    }

    public function testValidCentury20PersonalCode(){
        $code = '38611236669';
        $personal = PersonalCodeFactory::make($code);
        expect($personal->century)->equals(20);
        expect($personal->birthday->format('Y'))->equals(1986);
    }

    public function testValidCentury21PersonalCode(){
        $code = '58611236669';
        $personal = PersonalCodeFactory::make($code);
        expect($personal->century)->equals(21);
        expect($personal->birthday->format('Y'))->equals(2086);
    }

    public function testValidUnderagePersonalCode()
    {
        $code = '50511236669';
        $personal = PersonalCodeFactory::make($code);
        expect($personal->is_allowed)->equals(false);
    }
}