<?php

namespace Carboneum\ContextualException;

abstract class Exception extends \Exception
{
    const CODE = 0;
    const CODE_PACKAGE_PREFIX = 0;

    const PRE_MARKER = '{';
    const POST_MARKER = '}';

    const MESSAGE = 'Exception context: [{exception_context}]';

    private $context = [];

    /**
     *
     * @param \Exception|null $previous
     */
    public function __construct(\Exception $previous = null)
    {
        parent::__construct($this->formatMessage(), static::CODE_PACKAGE_PREFIX + static::CODE, $previous);
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function setContextValue($name, $value)
    {
        $this->context[$name] = $value;
    }

    /**
     * @param array $contextValues
     */
    protected function setContextValues(array $contextValues)
    {
        $this->context = array_merge($this->context, $contextValues);
    }

    /**
     * @return string
     */
    private function formatMessage()
    {
        return strtr(
            static::MESSAGE,
            array_merge($this->getContextSubstitutionPairs(), ['{exception_context}' => $this->getContextString()])
        );
    }

    /**
     * @return array
     */
    private function getContextSubstitutionPairs()
    {
        $substitutionPairs = [];
        foreach ($this->context as $key => $value) {
            $substitutionPairs[static::PRE_MARKER . $key . static::POST_MARKER] = $value;
        }

        return $substitutionPairs;
    }

    /**
     * @return string
     */
    private function getContextString()
    {
        $paramsProcessed = [];
        foreach ($this->context as $key => $value) {
            $paramsProcessed[] = $key . ': ' . json_encode($value);
        }

        return implode(', ', $paramsProcessed);
    }
}
