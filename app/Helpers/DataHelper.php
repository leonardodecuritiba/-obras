<?php

namespace App\Helpers;

use Jenssegers\Date\Date;

class DataHelper
{
    // ******************** FUNCTIONS ******************************
    static public function getTimestamp($value)
    {
        return strtotime($value);
    }
    static public function now()
    {
        return Date::now()->format('H:i - d/m/Y');
    }
    static public function getPercent2Float($value)
    {
        return floatval(str_replace(',', '.', $value));
    }

    static public function getReal2Float($value)
    {
        return (($value == '') || ($value == NULL)) ? 0 : floatval(str_replace(',', '.', str_replace('.', '', $value)));
    }

    static public function getFloat2Currency($value)
    {
        return 'R$ ' . self::getFloat2Real($value);
    }

    static public function getFloat2Real($value)
    {
        return number_format($value, 2, ',', '.');
    }

    static public function getFullPrettyDateTime($value)
    {
        return ($value != NULL) ? Date::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s') : $value;
    }

    static public function getPrettyDateTime($value)
    {
        return ($value != NULL) ? Date::createFromFormat('Y-m-d H:i:s', $value)->format('H:i - d/m/Y') : $value;
    }

    static public function getPrettyDateTimeToMonth($value)
    {
        Date::setLocale('pt_BR');
        return ($value != NULL) ? Date::createFromFormat('Y-m-d H:i:s', $value)->format('F/Y') : $value;
    }

    static public function getPrettyDate($value)
    {
        return ($value != NULL) ? Date::createFromFormat('Y-m-d', $value)->format('d/m/Y') : $value;
    }

    static public function getPrettyToCorrectDate($value)
    {
        return ($value != NULL) ? Date::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    static public function getPrettyToCorrectDateTime($value)
    {
        return ($value != NULL) ? Date::createFromFormat('d/m/Y', $value)->format('Y-m-d H:i:s') : $value;
    }

    static public function setDate($value)
    {
        return (($value != NULL) && ($value != '')) ? Date::createFromFormat('dmY', self::getOnlyNumbers($value))->format('Y-m-d') : NULL;
    }

	static public function getOnlyValues( $value ) {
		return ( $value != null ) ? preg_replace( "/[^0-9-.-,]/", "", $value ) : $value;
	}

    static public function getOnlyNumbers($value)
    {
        return ($value != NULL) ? preg_replace("/[^0-9]/", "", $value) : $value;
    }

    static public function getOnlyNumbersLetters($value)
    {
        return ($value != NULL) ? preg_replace("/[^a-zA-Z0-9-]/", "", $value) : $value;
    }

    static public function getShortName($value)
    {
        $value = explode(' ', $value);
        return (count($value) > 1) ? ($value[0] . " " . end($value)) : $value[0];
    }

    static public function mask($val, $mask)
    {
        if ($val != NULL || $val != "") {
            $maskared = '';
            $k = 0;
            for ($i = 0; $i <= strlen($mask) - 1; $i++) {
                if ($mask[$i] == '#') {
                    if (isset($val[$k])) $maskared .= $val[$k++];
                } else {
                    if (isset($mask[$i])) $maskared .= $mask[$i];
                }
            }
        } else {
            $maskared = NULL;
        }
        return $maskared;
    }


}
