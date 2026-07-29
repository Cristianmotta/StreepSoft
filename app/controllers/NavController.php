<?php
declare(strict_types=1);

/**
 *  NavController - sirve el fragmento de navegacion (sildebar)
 * usando por expor.js via fetch 
 */

class NavController extends Controller
{
    public function render(): void
    {
        // view(), ya genera csrftoken, isAuth, authUser, etc.
        $this->view('navegacion/navegacion');
    }
}



?>