<?php

use App\Infrastrucutre\Service\JwtManager;
use App\Core\Domain\Service\JwtManagerInterface;
use Illuminate\Contracts\Foundation\Application;
use App\Infrastrucutre\Repository\SqlUserRepository;
use App\Infrastrucutre\Repository\SqlGejalaRepository;
use App\Infrastrucutre\Repository\SqlPasienRepository;
use App\Core\Domain\Repository\UserRepositoryInterface;
use App\Infrastrucutre\Repository\SqlCheckInRepository;
use App\Core\Domain\Repository\GejalaRepositoryInterface;
use App\Core\Domain\Repository\PasienRepositoryInterface;
use App\Core\Domain\Repository\CheckInRepositoryInterface;
use App\Infrastrucutre\Repository\SqlPasienGejalaRepository;
use App\Core\Domain\Repository\PasienGejalaRepositoryInterface;

/** @var Application $app */

$app->singleton(UserRepositoryInterface::class, SqlUserRepository::class);
$app->singleton(GejalaRepositoryInterface::class, SqlGejalaRepository::class);
$app->singleton(PasienRepositoryInterface::class, SqlPasienRepository::class);
$app->singleton(PasienGejalaRepositoryInterface::class, SqlPasienGejalaRepository::class);
$app->singleton(CheckInRepositoryInterface::class, SqlCheckInRepository::class);
$app->singleton(JwtManagerInterface::class, JwtManager::class);
