<?php
/*
 * This file is part of the BlacklistedEmailValidatorBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\BlacklistedEmailValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\Email;

/**
 * @Annotation
 */
class BlacklistedEmail extends Email
{
    public $message = 'L\'adresse email renseignées est incorrecte';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'blacklisted_email_validator';
    }
}
