<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer;

use zaporylie\Cargonizer\Data\User;

class Profile extends Client
{
    protected string $resource = '/profile.xml';

    protected string $method = 'GET';

    public function getProfile(): User
    {
        $xml = $this->request();

        return User::fromXML($xml);
    }
}
