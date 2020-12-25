<?php

namespace _PhpScoperef96225926e2\Composer;

use _PhpScoperef96225926e2\Composer\Semver\VersionParser;
class InstalledVersions
{
    private static $installed = array('root' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '52d3b04f5caad16d5cffd5f6e37f33bd9d166f1b', 'name' => 'symplify/monorepo-builder'), 'versions' => array('composer/package-versions-deprecated' => array('pretty_version' => '1.8.0', 'version' => '1.8.0.0', 'aliases' => array(), 'reference' => '98df7f1b293c0550bd5b1ce6b60b59bdda23aa47'), 'jean85/pretty-package-versions' => array('pretty_version' => '1.5.0', 'version' => '1.5.0.0', 'aliases' => array(), 'reference' => 'e9f4324e88b8664be386d90cf60fbc202e1f7fc9'), 'nette/finder' => array('pretty_version' => 'v2.5.0', 'version' => '2.5.0.0', 'aliases' => array(), 'reference' => '6be1b83ea68ac558aff189d640abe242e0306fe2'), 'nette/neon' => array('pretty_version' => 'v3.2.0', 'version' => '3.2.0.0', 'aliases' => array(), 'reference' => '72dd80316595d4b5c5312ea4e9beb53f3ba823d7'), 'nette/utils' => array('pretty_version' => 'v3.0.0', 'version' => '3.0.0.0', 'aliases' => array(), 'reference' => 'ec1e4055c295d73bb9e8ce27be859f434a6f6806'), 'ocramius/package-versions' => array('replaced' => array(0 => '1.2 - 1.8.99')), 'paragonie/random_compat' => array('pretty_version' => 'v1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'a1d9f267eb8b8ad560e54e397a5ed1e3b78097d1'), 'phar-io/version' => array('pretty_version' => '3.0.3', 'version' => '3.0.3.0', 'aliases' => array(), 'reference' => '726c026815142e4f8677b7cb7f2249c9ffb7ecae'), 'psr/container' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f'), 'psr/container-implementation' => array('provided' => array(0 => '1.0')), 'psr/event-dispatcher-implementation' => array('provided' => array(0 => '1.0')), 'psr/log' => array('pretty_version' => '1.0.0', 'version' => '1.0.0.0', 'aliases' => array(), 'reference' => 'fe0936ee26643249e916849d48e3a51d5f5e278b'), 'psr/log-implementation' => array('provided' => array(0 => '1.0')), 'sebastian/diff' => array('pretty_version' => '4.0.3', 'version' => '4.0.3.0', 'aliases' => array(), 'reference' => 'ffc949a1a2aae270ea064453d7535b82e4c32092'), 'symfony/config' => array('pretty_version' => 'v5.1.0', 'version' => '5.1.0.0', 'aliases' => array(), 'reference' => 'b8623ef3d99fe62a34baf7a111b576216965f880'), 'symfony/console' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '35d9077f495c6d184d9930f7a7ecbd1ad13c7ab8'), 'symfony/debug' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'b24b791f817116b29e52a63e8544884cf9a40757'), 'symfony/dependency-injection' => array('pretty_version' => 'v5.1.0', 'version' => '5.1.0.0', 'aliases' => array(), 'reference' => '6a6791e9584273b32eeb01790da4c7446d87a621'), 'symfony/deprecation-contracts' => array('pretty_version' => 'v2.1.0', 'version' => '2.1.0.0', 'aliases' => array(), 'reference' => 'ede224dcbc36138943a296107db2b8b2a690ac1c'), 'symfony/error-handler' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'e1acb58dc6a8722617fe56565f742bcf7e8744bf'), 'symfony/event-dispatcher' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'ab1c43e17fff802bef0a898f3bc088ac33b8e0e1'), 'symfony/event-dispatcher-contracts' => array('pretty_version' => 'v1.1.1', 'version' => '1.1.1.0', 'aliases' => array(), 'reference' => '8fa2cf2177083dd59cf8e44ea4b6541764fbda69'), 'symfony/event-dispatcher-implementation' => array('provided' => array(0 => '1.1')), 'symfony/filesystem' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'd12b01cba60be77b583c9af660007211e3909854'), 'symfony/finder' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'ce8743441da64c41e2a667b8eb66070444ed911e'), 'symfony/http-foundation' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '502040dd2b0cf0a292defeb6145f4d7a4753c99c'), 'symfony/http-kernel' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '5a5e7237d928aa98ff8952050cbbf0135899b6b0'), 'symfony/mime' => array('pretty_version' => 'v4.3.0', 'version' => '4.3.0.0', 'aliases' => array(), 'reference' => '0b166aee243364cd9de05755d2e9651876090abb'), 'symfony/polyfill-ctype' => array('pretty_version' => 'v1.8.0', 'version' => '1.8.0.0', 'aliases' => array(), 'reference' => '7cc359f1b7b80fc25ed7796be7d96adc9b354bae'), 'symfony/polyfill-intl-idn' => array('pretty_version' => 'v1.18.0', 'version' => '1.18.0.0', 'aliases' => array(), 'reference' => 'bc6549d068d0160e0f10f7a5a23c7d1406b95ebe'), 'symfony/polyfill-intl-normalizer' => array('pretty_version' => 'v1.10.0', 'version' => '1.10.0.0', 'aliases' => array(), 'reference' => 'f8ed52909fc049b42a772c64ec1e6b31792abad6'), 'symfony/polyfill-mbstring' => array('pretty_version' => 'v1.1.0', 'version' => '1.1.0.0', 'aliases' => array(), 'reference' => '1289d16209491b584839022f29257ad859b8532d'), 'symfony/polyfill-php70' => array('pretty_version' => 'v1.10.0', 'version' => '1.10.0.0', 'aliases' => array(), 'reference' => '6b88000cdd431cd2e940caa2cb569201f3f84224'), 'symfony/polyfill-php72' => array('pretty_version' => 'v1.10.0', 'version' => '1.10.0.0', 'aliases' => array(), 'reference' => '9050816e2ca34a8e916c3a0ae8b9c2fccf68b631'), 'symfony/polyfill-php73' => array('pretty_version' => 'v1.9.0', 'version' => '1.9.0.0', 'aliases' => array(), 'reference' => '990ca8fa94736211d2b305178c3fb2527e1fbce1'), 'symfony/polyfill-php80' => array('pretty_version' => 'v1.15.0', 'version' => '1.15.0.0', 'aliases' => array(), 'reference' => '8854dc880784d2ae32908b75824754339b5c0555'), 'symfony/process' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '75ad33d9b6f25325ebc396d68ad86fd74bcfbb06'), 'symfony/service-contracts' => array('pretty_version' => 'v1.1.6', 'version' => '1.1.6.0', 'aliases' => array(), 'reference' => 'ea7263d6b6d5f798b56a45a5b8d686725f2719a3'), 'symfony/service-implementation' => array('provided' => array(0 => '1.0')), 'symfony/var-dumper' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => 'eade2890f8b0eeb279b6cf41b50a10007294490f'), 'symfony/yaml' => array('pretty_version' => 'v4.4.0', 'version' => '4.4.0.0', 'aliases' => array(), 'reference' => '76de473358fe802578a415d5bb43c296cf09d211'), 'symplify/autowire-array-parameter' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '5b94a52bbf62eb1ab84e99a845548e25ab39b12c'), 'symplify/composer-json-manipulator' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => 'f682db521aa0f7597023c1876995e4393681c0ae'), 'symplify/console-color-diff' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '4c0b38dbb383da58b2e4d4faf2fb9c3d7978bc47'), 'symplify/easy-testing' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => 'b46bd7638ffd84e1a6a72757b45c4e51c049ea35'), 'symplify/monorepo-builder' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '52d3b04f5caad16d5cffd5f6e37f33bd9d166f1b'), 'symplify/package-builder' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => 'f1ff447df233c2f739c2ddde560832d99c19fb28'), 'symplify/set-config-resolver' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '6b0d5aa187556389c80df92cb67a5f862156935f'), 'symplify/smart-file-system' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => 'a2a5b85c5eaacf31496f55efbc393e24cd59ff92'), 'symplify/symplify-kernel' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(0 => '9.1.x-dev'), 'reference' => '06eef0c69100cb1ea158f02fcf4211779c7886fe')));
    public static function getInstalledPackages()
    {
        return \array_keys(self::$installed['versions']);
    }
    public static function isInstalled($packageName)
    {
        return isset(self::$installed['versions'][$packageName]);
    }
    public static function satisfies(\_PhpScoperef96225926e2\Composer\Semver\VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));
        return $provided->matches($constraint);
    }
    public static function getVersionRanges($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        $ranges = array();
        if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            $ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
        }
        if (\array_key_exists('aliases', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
        }
        if (\array_key_exists('replaced', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
        }
        if (\array_key_exists('provided', self::$installed['versions'][$packageName])) {
            $ranges = \array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
        }
        return \implode(' || ', $ranges);
    }
    public static function getVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['version'];
    }
    public static function getPrettyVersion($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['pretty_version'];
    }
    public static function getReference($packageName)
    {
        if (!isset(self::$installed['versions'][$packageName])) {
            throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
        }
        if (!isset(self::$installed['versions'][$packageName]['reference'])) {
            return null;
        }
        return self::$installed['versions'][$packageName]['reference'];
    }
    public static function getRootPackage()
    {
        return self::$installed['root'];
    }
    public static function getRawData()
    {
        return self::$installed;
    }
    public static function reload($data)
    {
        self::$installed = $data;
    }
}
