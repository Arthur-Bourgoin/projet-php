<?php
namespace app\controllers;
use app\models\ {
    UserModel,
    DoctorModel
};

class StatsController {

    public function displayPage() {
        $tab = $this->getTabStats();
        $doctors = DoctorModel::getDoctors();
        require("../app/views/statistics.php");
    }

    private function getTabStats() {
        $users = UserModel::getUsers();
        $tabStats = ["M" => [0, 0, 0], "F" => [0, 0, 0]];
        foreach($users as $user) {
            $age = $user->getAge();
            switch($user->civility) {
                case "M":
                    if($age < 25)
                        $tabStats["M"][0]++;
                    elseif($age <= 50)
                        $tabStats["M"][1]++;
                    else
                        $tabStats["M"][2]++;
                    break;
                case "F":
                    if($age < 25)
                        $tabStats["F"][0]++;
                    elseif($age <= 50)
                        $tabStats["F"][1]++;
                    else
                        $tabStats["F"][2]++;
                    break;
            }
        }
        return $tabStats;
    }

    private function test() {
        $users = UserModel::getUsers();
        foreach($users as $user) {
            echo $user->birthDate . "  &&  " . $user->getAge() . "</br>";
        }
    }

}