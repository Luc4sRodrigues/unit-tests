<?php

namespace Tests;

use Faker\Factory;
use Termwind\Components\Dd;
use Tests\CreatesApplication;
use Tests\TestCase;

class UserTest extends TestCase
{
	use CreatesApplication;

	/**
	 * @var \Faker\Generator
	 */
	protected $faker;

	/**
	 * @var \App\Models\User
	 */
	protected $user;

	/**
	 * @var \App\Services\UserService
	 */
	protected $userService;

	public function setUp(): void
	{
		parent::setUp();

		$this->faker = Factory::create();
		$this->user = new \App\Models\User($this->faker->name(), $this->faker->numberBetween(18, 99));
	}

	public function testGetUser(): void
	{
		$this->assertEquals([
			'name' => $this->user->name,
			'age' => $this->user->age,
		], $this->user->getUser());
	}

	// testar se o nome do usuario é válido
	public function testNomeEhValido(): void
	{
		$this->assertTrue($this->user->nomeEhValido('Lucas Rodrigues'));
	}

	// testar se a idade do usuario é válida
	public function testIdadeEhValida(): void
	{
		$this->assertTrue($this->user->idadeEhValida(28));
	}

	// testar se o nome e a idade do usuario são válidos
	public function testNomeEIdadeSaoValidos(): void
	{
		$this->assertTrue($this->user->nomeEIdadeSaoValidos('Lucas Rodrigues', 28));
	}

	public function tearDown(): void
	{
		parent::tearDown();
	}
}
