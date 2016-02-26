<?php

/**
 * User naming service.
 *
 * @author Áureo Ares <aares.brenes@atsistemas.com>
 */

namespace AAres\UserNaming;

use Faker\Factory as FakerFactory;

/**
 * Class UserNaming.
 *
 * @package AAres\UserNaming
 */
class UserNamingService
{
    /**
     * @param int $nChars Number of characters.
     *
     * @return string The generated user name.
     */
    public function generate($nChars = 5)
    {
        $faker = FakerFactory::create();
        $string = '';

        while (strlen($string) < $nChars) {
            $string .= $faker->randomLetter;
        }

        return $string;
    }
}
