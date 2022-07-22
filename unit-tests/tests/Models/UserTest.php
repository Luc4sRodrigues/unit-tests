<?php

namespace Tests;

use Faker\Factory;
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

	public function setUp(): void
	{
		parent::setUp();

		$this->faker = Factory::create();
		$this->user = new \App\Models\User($this->faker->name, $this->faker->numberBetween(18, 99));
	}

	public function testGetUser(): void
	{
		$this->assertEquals([
			'name' => $this->user->name,
			'age' => $this->user->age,
		], $this->user->getUser());
	}

	public function testGetUserWithInvalidName(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Name must be at least 3 characters long.');
		$this->user = new \App\Models\User($this->faker->name(2), $this->faker->numberBetween(18, 99));
	}

	public function testGetUserWithInvalidAge(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Age must be between 18 and 99.');
		$this->user = new \App\Models\User($this->faker->name, $this->faker->numberBetween(17, 100));
	}

	public function testGetUserWithInvalidNameAndAge(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Name must be at least 3 characters long. Age must be between 18 and 99.');
		$this->user = new \App\Models\User($this->faker->name(2), $this->faker->numberBetween(17, 100));
	}
}
