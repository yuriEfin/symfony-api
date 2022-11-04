<?php

namespace App\Context\Category\Interfaces;

use App\Context\Interfaces\Crud\CreateInterface;
use App\Context\Interfaces\Crud\DeleteInterface;
use App\Context\Interfaces\Crud\UpdateInterface;

interface CategoryServiceInterface extends CreateInterface, UpdateInterface, DeleteInterface
{
}