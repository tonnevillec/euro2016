<?php

namespace CYTN\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CYTNUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}