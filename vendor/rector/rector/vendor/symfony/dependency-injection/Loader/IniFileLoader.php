<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace RectorPrefix20220609\Symfony\Component\DependencyInjection\Loader;

use RectorPrefix20220609\Symfony\Component\Config\Util\XmlUtils;
use RectorPrefix20220609\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
/**
 * IniFileLoader loads parameters from INI files.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class IniFileLoader extends FileLoader
{
    /**
     * {@inheritdoc}
     * @param mixed $resource
     * @return mixed
     */
    public function load($resource, string $type = null)
    {
        $path = $this->locator->locate($resource);
        $this->container->fileExists($path);
        // first pass to catch parsing errors
        $result = \parse_ini_file($path, \true);
        if (\false === $result || [] === $result) {
            throw new InvalidArgumentException(\sprintf('The "%s" file is not valid.', $resource));
        }
        // real raw parsing
        $result = \parse_ini_file($path, \true, \INI_SCANNER_RAW);
        if (isset($result['parameters']) && \is_array($result['parameters'])) {
            foreach ($result['parameters'] as $key => $value) {
                $this->container->setParameter($key, $this->phpize($value));
            }
        }
        if ($this->env && \is_array($result['parameters@' . $this->env] ?? null)) {
            foreach ($result['parameters@' . $this->env] as $key => $value) {
                $this->container->setParameter($key, $this->phpize($value));
            }
        }
        return null;
    }
    /**
     * {@inheritdoc}
     * @param mixed $resource
     */
    public function supports($resource, string $type = null) : bool
    {
        if (!\is_string($resource)) {
            return \false;
        }
        if (null === $type && 'ini' === \pathinfo($resource, \PATHINFO_EXTENSION)) {
            return \true;
        }
        return 'ini' === $type;
    }
    /**
     * Note that the following features are not supported:
     *  * strings with escaped quotes are not supported "foo\"bar";
     *  * string concatenation ("foo" "bar").
     * @return mixed
     */
    private function phpize(string $value)
    {
        // trim on the right as comments removal keep whitespaces
        if ($value !== ($v = \rtrim($value))) {
            $value = '""' === \substr_replace($v, '', 1, -1) ? \substr($v, 1, -1) : $v;
        }
        $lowercaseValue = \strtolower($value);
        switch (\true) {
            case \defined($value):
                return \constant($value);
            case 'yes' === $lowercaseValue:
            case 'on' === $lowercaseValue:
                return \true;
            case 'no' === $lowercaseValue:
            case 'off' === $lowercaseValue:
            case 'none' === $lowercaseValue:
                return \false;
            case isset($value[1]) && ("'" === $value[0] && "'" === $value[\strlen($value) - 1] || '"' === $value[0] && '"' === $value[\strlen($value) - 1]):
                return \substr($value, 1, -1);
            default:
                return XmlUtils::phpize($value);
        }
    }
}
