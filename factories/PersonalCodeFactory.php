<?php

namespace app\factories;

use app\dtos\PersonalCodeDTO;
use app\enums\PersonalCodeGenderEnum;
use app\exceptions\PersonalCodeException;
use DateTime;

class PersonalCodeFactory
{
    /**
     * Get the Personal Code provided and build the Data Transfer Object
     * @param $code String Personal Code 
     * @return PersonalCodeDTO 
     */
    public static function make($code): PersonalCodeDTO{
        
        $splitted = $this->splitCode($code);

        $dto = new PersonalCodeDTO();
        $dto->gender = $this->getGender($splitted[0]);
        $dto->century = $this->getCentury($splitted[0]);
        $dto->birthday = $this->getBirthday($splitted[1], $splitted[2], $splitted[3]);
        $dto->age = $this->getAge($dto->birthday);
        $dto->hash = $this->getHash($splitted[4]);
        $dto->checksum = $this->getChecksum($splitted[4]);
        
        return $dto;
    }

    /**
     * Get the personal code, validate and split into array
     * @return array
     * @param String Personal Code
     */
    protected function splitCode($code): array{
        $code = (string) $code;

        if(strlen($code) !== 11){
            throw new PersonalCodeException('Invalid Personal Code: '.$code);
        }
        return [
            substr($code,0,1),
            substr($code,1,2),
            substr($code,3,2),
            substr($code,5,2),
            substr($code,7,3),
            substr($code,10,1)
        ];
    }

    /**
     * Get date and return a DateTime object with birthday setted
     * @param $year int Year provided personal code
     * @param $month int Month provided personal code
     * @param $day int Day provided personal code
     * @return DateTime
     */
    protected function getBirthday($year, $month, $day): DateTime{
        try{
            return new DateTime($year . '-' . $month . '-' . $day);
        }catch(\Exception $e){
            throw new PersonalCodeException($e->getMessage(), $e->code, $e);
        }
    }

    /**
     * Get the gender number data and return the write Gender 
     * @param $gender String Gender number provided by Personal Code
     */
    protected function getGender($gender): int{
         $rest = $gender % 2;
         if($rest === 0){
             return PersonalCodeGenderEnum::FEMALE;
         }

         return PersonalCodeGenderEnum::MALE;
    }

    /**
     * Get the century provided by Personal Code
     * @param $gender String Gender provided by Personal Code
     * @return int
     * @throws PersonalCodeException If the value is not expected
     */
    protected function getCentury($gender): int{ 
        if($gender === 1 || $gender === 2){
            return 19;
        }

        if ($gender === 3 || $gender === 4) {
            return 20;
        }

        if ($gender === 5 || $gender === 6) {
            return 21;
        }

        throw new PersonalCodeException('Personal Code Invalid: Incorrect century provided');
        
    }

    /**
     * Get the birthday and return the age provided by Personal Code
     * @param $birthday DateTime The birthday provided by Personal Code
     * @return int The age in years
     */
    protected function getAge(DateTime $birthday): int{
        $now = new DateTime(date("Y-m-d"));
        return (int) $birthday->diff($now)->format('%y');
    }

    /**
     * Just return the value informed. But we can do something here in the future
     * @param $hash
     * @param String The hash informed
     */
    protected function getHash($hash): string{ 
        return $hash;
    }
    /**
     * Just return the value informed. But we can do something here in the future
     * @param $chacksum String
     * @return String The hash informed
     */
    protected function getChecksum($checksum): string{ 
        return $checksum;
    }
}
