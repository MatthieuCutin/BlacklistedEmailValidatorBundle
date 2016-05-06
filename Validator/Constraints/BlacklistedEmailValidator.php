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

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BlacklistedEmailValidator extends EmailValidator
{
    /**
     * @var ExecutionContextInterface
     */
    protected $context;

    /**
     * An array of blacklisted hostnames which aren't allowed.
     *
     * @var array
     */
    private $blacklist = [];

    /**
     * @param bool  $strict
     * @param array $hosts
     */
    public function __construct($strict = false, $hosts = [], $em = null)
    {
        parent::__construct($strict);
        $this->blacklist = $hosts;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        parent::validate($value, $constraint);

        $host = substr($value, strpos($value, '@') + 1);
        if (in_array($host, $this->blacklist)) {
            $this->context->addViolation($constraint->message, [
                '%host%' => $host,
            ]);
        }

        $invalidHost = $this->em->getRepository('CommonBundle:InvalidEmail')->findOneByDomain($host);
        if (null != $invalidHost) {
            $this->context->addViolation($constraint->message, [
                '%host%' => $invalidHost->getDomain(),
            ]);
        }
    }
}
