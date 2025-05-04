<?php
declare(strict_types=1);
namespace Src\container;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionIntersectionType;
use ReflectionParameter;
use ReflectionUnionType;
use Src\attributes\Provider;
use Src\exceptions\container\BindingExistsException;
use Src\exceptions\container\NotInstantiableException;
use Src\exceptions\container\NoTypeException;
use Src\exceptions\container\UnionIntersectionException;
use Src\exceptions\CustomException;

class Container implements ContainerInterface
{
    private array $bindings;
    private array $prototypes;

    public function __construct()
    {
        $this->bindings = [];
        $this->prototypes = [];
        $this->prototypes[Container::class] = $this;
    }


    /**
     * @throws CustomException
     */
    public function bind(string $id, callable|string $concrete): void
    {
        if($this->has($id)){
            throw BindingExistsException::get([$id]);
        }
        $this->bindings[$id] = $concrete;
    }

    /**
     * @throws ReflectionException
     * @throws CustomException
     */
    public function get(string $id)
    {
        if($this->isInitialized($id)){
            return $this->prototypes[$id];
        }
        if ($this->has($id)){
            $binding = $this->bindings[$id];
            if(is_callable($binding)){
                $instance = $binding($this);
                $this->prototypes[$id] = $instance;
                return $instance;
            }
            $id = $binding;
        }

        return $this->resolve($id);

    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    public function isInitialized(string $id): bool
    {
        return isset($this->prototypes[$id]);
    }

    /**
     * @throws ReflectionException
     * @throws CustomException
     */
    private function resolve(string $id)
    {
        $reflection = new ReflectionClass($id);
        if (! $reflection->isInstantiable()){
            throw NotInstantiableException::get([$id]);
        }

        $constructor = $reflection->getConstructor();
        if(! $constructor){
            return new $id();
        }

        $parameters = $constructor->getParameters();
        if(! $parameters){
            return new $id;
        }

        $providers = $this->getProviderAttributes($reflection);
        $dependencies = array_map(fn(ReflectionParameter $parameter) => $this->resolveDependencies($parameter, $id, $providers), $parameters);
        $cleanedDependencies = array_filter($dependencies);//removes null values

        $instance = $reflection->newInstanceArgs($cleanedDependencies);
        $this->prototypes[$id] = $instance;
        return $instance;

    }

    /**
     * @param ReflectionClass $reflection
     * @return array<string, string>
     */
    private function getProviderAttributes(ReflectionClass $reflection): array{
        $attributes = $reflection->getAttributes(Provider::class);
        $providerArr = [];
        if(empty($attributes)){
            return $providerArr;
        }
        foreach ($attributes as $attribute){
            $provider = $attribute->newInstance();
            if(! $provider instanceof Provider){
                continue;
            }
            $providerArr[$provider->providedClassName] = $provider->providerClassName;
        }
        return $providerArr;
    }

    /**
     * @throws ReflectionException
     * @throws CustomException
     */
    private function resolveDependencies(ReflectionParameter $parameter, string $id, array $providers)
    {
        $name = $parameter->getName();
        $type = $parameter->getType();

        if (! $type){
            throw NoTypeException::get([$id, $name]);
        }

        if ($type instanceof ReflectionUnionType || $type instanceof ReflectionIntersectionType){
            throw UnionIntersectionException::get([$id, $name]);
        }

        if ($type->isBuiltin()){
            return null;
        }

        if(isset($providers[$type->getName()])){
            $provider = $this->get($providers[$type->getName()]);
            if($provider instanceof \Src\config\Provider){
                return $provider->configure($this);
            }
            throw new ReflectionException("Provider is not of type config/Provider.");
        }

        return $this->get($type->getName());
    }

    public function getBindings(): array
    {
        return $this->bindings;
    }


}