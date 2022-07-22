<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'age',
	];

	public function __construct(string $name, int $age)
	{
		$this->name = $name;
		$this->age = $age;
	}

	public function getUser(): array
	{
		return [
			'name' => $this->name,
			'age' => $this->age,
		];
	}

	// TESTES

	// nome do usuario é valido
	public function nomeEhValido(string $name): bool
	{
		return preg_match('/^[a-zA-Z ]+$/', $name) === 1;
	}

	// idade do usuario é valida
	public function idadeEhValida(int $age): bool
	{
		return $age >= 18;
	}

	// nome e idade do usuario são validos
	public function nomeEIdadeSaoValidos(string $name, int $age): bool
	{
		return $this->nomeEhValido($name) && $this->idadeEhValida($age);
	}
};
