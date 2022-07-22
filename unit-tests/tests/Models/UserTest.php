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
	 * @expectedException PHPUnit\Framework\Error
	 */

	/**
	 * @var \Faker\Generator
	 */
	protected $faker;

	/**
	 * @var \App\Models\User
	 */
	protected $user;

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

	// testar se o nome do usuário é válido
	public function testNomeEhValido(): void
	{
		$this->assertTrue($this->user->nomeEhValido('Lucas'), 'Nome do usuário é inválido!');
	}

	// testar se a idade do usuário é válida
	public function testIdadeEhValida(): void
	{
		$this->assertTrue($this->user->idadeEhValida(28), 'Idade inválida!');
	}

	// testar se o nome e a idade do usuário são válidos
	public function testNomeEIdadeSaoValidos(): void
	{
		$this->assertTrue($this->user->nomeEIdadeSaoValidos('Lucas Rodrigues', 28), 'Nome e idade inválidos!');
	}

	public function tearDown(): void
	{
		parent::tearDown();
	}
}
