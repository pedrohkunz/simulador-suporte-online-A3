<?php

namespace src\factories;

use src\models\Attendant;

class AttendantFactory
{
    private static function createAttendant(int $id, $waitTime): Attendant
    {
        return new Attendant($id, $waitTime);
    }

    public static function createAttendants(int $numberOfAttendants): array
    {
        $attendants = [];
        for ($i = 1; $i <= $numberOfAttendants; $i++) {
            $attendants[] = self::createAttendant($i, 0);
        }

        return $attendants;
    }
}