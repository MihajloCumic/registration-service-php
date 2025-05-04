<?php

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use Src\container\Container;
use Src\controller\RegistrationController;
use Src\exceptions\executor\ControllerNotFoundException;
use Src\exceptions\executor\RequestTypeException;
use Src\exceptions\executor\WrongParamsArgsException;
use Src\executor\impl\ControllerExecutor;
use Src\request\Request;

class ExecutorTest extends TestCase
{
    private Container $container;
    private RegistrationController $controller;
    private Request $request;
    protected function setUp(): void
    {
        parent::setUp();
        $this->container = $this->createMock(Container::class);
        $this->controller = $this->createMock(RegistrationController::class);
        $this->request = $this->createMock(Request::class);
    }
    public function testCallsMethod(): void
    {
        $this->container->method('get')->willReturn($this->controller);
        $this->controller->expects($this->once())->method('registration');
        $executor = new ControllerExecutor($this->container);

        $executor->execute(RegistrationController::class, 'registration', [$this->request]);
    }

    public function testNonExistingClass(): void
    {
        $executor = new ControllerExecutor($this->container);

        $this->expectException(ControllerNotFoundException::class);

        $executor->execute('Non\existent', 'registration', [$this->request]);
    }

    public function testNonExistingMethod(): void
    {
        $executor = new ControllerExecutor($this->container);

        $this->expectException(ControllerNotFoundException::class);

        $executor->execute(RegistrationController::class, 'nonMethod', [$this->request]);
    }

    public function testWrongArgsNumber(): void
    {
        $this->container->method('get')->willReturn($this->controller);
        $executor = new ControllerExecutor($this->container);

        $this->expectException(WrongParamsArgsException::class);

        $executor->execute(RegistrationController::class, 'registration', []);
    }

    public function testWrongArgType(): void
    {
        $this->container->method('get')->willReturn($this->controller);
        $executor = new ControllerExecutor($this->container);

        $this->expectException(RequestTypeException::class);

        $executor->execute(RegistrationController::class, 'registration', [['arg']]);
    }
}