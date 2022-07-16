<?php

namespace Phpactor\WorseReflection\Core\Reflector;

use Phpactor\WorseReflection\Bridge\TolerantParser\Reflection\ReflectionNavigation;
use Phpactor\WorseReflection\Core\Diagnostics;
use Phpactor\WorseReflection\Core\Reflection\ReflectionEnum;
use Phpactor\WorseReflection\Core\Reflection\ReflectionFunction;
use Phpactor\WorseReflection\Core\Reflection\ReflectionNode;
use Phpactor\WorseReflection\Core\SourceCode;
use Phpactor\WorseReflection\Reflector;
use Phpactor\WorseReflection\Core\Reflection\ReflectionClass;
use Phpactor\WorseReflection\Core\Reflection\ReflectionInterface;
use Phpactor\WorseReflection\Core\Reflection\ReflectionTrait;
use Phpactor\WorseReflection\Core\Reflection\ReflectionClassLike;
use Phpactor\WorseReflection\Core\Reflection\ReflectionOffset;
use Phpactor\WorseReflection\Core\Reflection\ReflectionMethodCall;
use Phpactor\WorseReflection\Core\Reflection\Collection\ReflectionClassLikeCollection;
use Phpactor\WorseReflection\Core\Reflection\Collection\ReflectionFunctionCollection;

class CompositeReflector implements Reflector
{
    private ClassReflector $classReflector;
    
    private SourceCodeReflector $sourceCodeReflector;
    
    private FunctionReflector $functionReflector;

    public function __construct(
        ClassReflector $classReflector,
        SourceCodeReflector $sourceCodeReflector,
        FunctionReflector $functionReflector
    ) {
        $this->classReflector = $classReflector;
        $this->sourceCodeReflector = $sourceCodeReflector;
        $this->functionReflector = $functionReflector;
    }
    
    public function reflectClass($className): ReflectionClass
    {
        return $this->classReflector->reflectClass($className);
    }
    
    public function reflectInterface($className): ReflectionInterface
    {
        return $this->classReflector->reflectInterface($className);
    }
    
    public function reflectTrait($className): ReflectionTrait
    {
        return $this->classReflector->reflectTrait($className);
    }
    
    public function reflectEnum($className): ReflectionEnum
    {
        return $this->classReflector->reflectEnum($className);
    }
    
    public function reflectClassLike($className): ReflectionClassLike
    {
        return $this->classReflector->reflectClassLike($className);
    }
    
    public function reflectClassesIn($sourceCode): ReflectionClassLikeCollection
    {
        return $this->sourceCodeReflector->reflectClassesIn($sourceCode);
    }
    
    public function reflectOffset($sourceCode, $offset): ReflectionOffset
    {
        return $this->sourceCodeReflector->reflectOffset($sourceCode, $offset);
    }
    
    public function reflectMethodCall($sourceCode, $offset): ReflectionMethodCall
    {
        return $this->sourceCodeReflector->reflectMethodCall($sourceCode, $offset);
    }
    
    public function reflectFunctionsIn($sourceCode): ReflectionFunctionCollection
    {
        return $this->sourceCodeReflector->reflectFunctionsIn($sourceCode);
    }

    public function navigate($sourceCode): ReflectionNavigation
    {
        return $this->sourceCodeReflector->navigate($sourceCode);
    }

    public function reflectFunction($name): ReflectionFunction
    {
        return $this->functionReflector->reflectFunction($name);
    }
    
    public function sourceCodeForClassLike($className): SourceCode
    {
        return $this->classReflector->sourceCodeForClassLike($className);
    }
    
    public function sourceCodeForFunction($name): SourceCode
    {
        return $this->functionReflector->sourceCodeForFunction($name);
    }

    public function diagnostics($sourceCode): Diagnostics
    {
        return $this->sourceCodeReflector->diagnostics($sourceCode);
    }

    public function reflectNode($sourceCode, $offset): ReflectionNode
    {
        return $this->sourceCodeReflector->reflectNode($sourceCode, $offset);
    }
}
