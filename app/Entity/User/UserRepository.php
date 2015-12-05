<?php

namespace NeoShop\Entity\User;

use NeoShop\Entity\Base\Repository;

class UserRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model() : string
    {
        return User::class;
    }
}