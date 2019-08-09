<?php

namespace Galahad\AireCustomForms\Tests;

use Galahad\AireCustomForms\AireCustomFormsServiceProvider;

abstract class TestCase extends \Galahad\Aire\Tests\TestCase
{
	protected function getPackageProviders($app)
	{
		return array_merge(parent::getPackageProviders($app), [
			AireCustomFormsServiceProvider::class,
		]);
	}
}
