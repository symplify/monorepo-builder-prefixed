<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperbe77f3b0e77d\Symfony\Component\HttpFoundation;

use _PhpScoperbe77f3b0e77d\Symfony\Component\ExpressionLanguage\ExpressionLanguage;
/**
 * ExpressionRequestMatcher uses an expression to match a Request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ExpressionRequestMatcher extends \_PhpScoperbe77f3b0e77d\Symfony\Component\HttpFoundation\RequestMatcher
{
    private $language;
    private $expression;
    public function setExpression(\_PhpScoperbe77f3b0e77d\Symfony\Component\ExpressionLanguage\ExpressionLanguage $language, $expression)
    {
        $this->language = $language;
        $this->expression = $expression;
    }
    public function matches(\_PhpScoperbe77f3b0e77d\Symfony\Component\HttpFoundation\Request $request)
    {
        if (!$this->language) {
            throw new \LogicException('Unable to match the request as the expression language is not available.');
        }
        return $this->language->evaluate($this->expression, ['request' => $request, 'method' => $request->getMethod(), 'path' => \rawurldecode($request->getPathInfo()), 'host' => $request->getHost(), 'ip' => $request->getClientIp(), 'attributes' => $request->attributes->all()]) && parent::matches($request);
    }
}
