<?php

namespace Sylius\Bundle\CoreBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends ResourceController
{
    /**
     * Render user filter form.
     */
    public function filterFormAction(Request $request)
    {
        return $this->render('SyliusWebBundle:Backend/User:filterForm.html.twig', array(
            'form' => $this->get('form.factory')->createNamed('criteria', 'sylius_user_filter', $request->query->get('criteria'))->createView()
        ));
    }
}
