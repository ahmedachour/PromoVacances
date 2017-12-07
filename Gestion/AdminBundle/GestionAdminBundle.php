<?php

namespace Gestion\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GestionAdminBundle extends Bundle
{
      public function getParent()
    {
        return 'FOSUserBundle';
    }
}
