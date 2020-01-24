<?php

namespace App\Traits;

use App\Helpers\DataHelper;

trait SuppliersTrait
{
    public function setFavoredCnpjAttribute($value)
    {
        return $this->attributes['favored_cnpj'] = DataHelper::getOnlyNumbers($value);
    }

    public function getFormattedFavoredCnpj()
    {
        return DataHelper::mask($this->attributes['favored_cnpj'], '##.###.###/####-##');
    }

    public function setFavoredCpfAttribute($value)
    {
        return $this->attributes['favored_cpf'] = DataHelper::getOnlyNumbers($value);
    }

    public function getFormattedFavoredCpf()
    {
	    return DataHelper::mask($this->attributes['favored_cpf'], '###.###.###-##');
    }

}