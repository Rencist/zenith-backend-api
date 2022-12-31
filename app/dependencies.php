<?php

use App\Infrastrucutre\Service\JwtManager;
use App\Core\Domain\Service\JwtManagerInterface;
use Illuminate\Contracts\Foundation\Application;
use App\Infrastrucutre\Repository\SqlUserRepository;
use App\Infrastrucutre\Repository\SqlGejalaRepository;
use App\Infrastrucutre\Repository\SqlPasienRepository;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use App\Core\Domain\Repository\PasienRepositoryInterface;

/** @var Application $app */

$app->singleton(UserRepositoryInterface::class, SqlUserRepository::class);
$app->singleton(GejalaRepositoryInterface::class, SqlGejalaRepository::class);
$app->singleton(PasienRepositoryInterface::class, SqlPasienRepository::class);
$app->singleton(JwtManagerInterface::class, JwtManager::class);
