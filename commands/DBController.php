<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use app\models\Loan;


/**
 * Class DbController
 * @package app\commands
 */
class DbController extends Controller
{

    /**
     * 
     * @throws \yii\db\Exception
     */
    public function actionSeed(){
        echo "\n=== Seeding database ===\n\n";
        $this->seedUsers();
        $this->seedLoans();
        echo "\nCheers!🍻🍻 \nDatabase has been successfully seeded\n\n";
    }

    /**
     * Seed the user table
     */
    protected function seedUsers(){
        echo "Cleaning user table...\n";
        User::deleteAll();
        echo "Seeding users... \n";
        $userModel = new User();
        $userData = json_decode(file_get_contents(__DIR__ . '/../users.json'), true);
        Yii::$app->db->createCommand()->batchInsert(User::tableName(), $userModel->attributes(), $userData)->execute();
        echo "Fixing id seq. \n";
        Yii::$app->db->createCommand("ALTER SEQUENCE user_id_seq RESTART 8000")->execute();
        echo "Table user seeded. \n";
    }

    /**
     * Seed the loan table
     */
    protected function seedLoans(){
        echo "Cleaning loan table...\n";
        Loan::deleteAll();
        echo "Seeding loans... \n";
        $loanModel = new Loan();
        $loanData = json_decode(file_get_contents(__DIR__ . '/../loans.json'), true);
        $loansNormalized = $this->normalizeLoanData($loanData);
        Yii::$app->db->createCommand()->batchInsert(Loan::tableName(), $loanModel->attributes(), $loansNormalized)->execute();
        echo "Fixing id seq. \n";
        Yii::$app->db->createCommand("ALTER SEQUENCE user_id_seq RESTART 38000")->execute();
        echo "Table loan seeded. \n";
    }

    /**
     * Normalize loan data to insert into database
     * @param $loan array Data provided from loans.json
     * @return array 
     */
    protected function normalizeLoanData(array $loans): array{
        $loansNormalized = [];

        foreach ($loans as $loan) {
            $loansNormalized[] = [
                'id' => $loan['id'],
                'user_id' => $loan['user_id'],
                'amount' => $loan['amount'],
                'interest' => $loan['interest'],
                'duration' => $loan['duration'],
                'start_date' => date('Y-m-d',$loan['start_date']),
                'end_date' => date('Y-m-d',$loan['end_date']),
                'campaign' => $loan['campaign'],
                'status' => $loan['status'],
            ];
        }
        return $loansNormalized;
    }
}
