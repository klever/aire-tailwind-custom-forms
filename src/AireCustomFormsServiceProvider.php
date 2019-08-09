<?php

namespace Galahad\AireCustomForms;

use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Select;
use Galahad\Aire\Support\Facades\Aire;
use Illuminate\Support\ServiceProvider;

class AireCustomFormsServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Aire::setTheme('aire', null, array_replace_recursive(
			\Galahad\Aire\Aire::getDefaultThemeConfig(),
			[
				'default_classes' => [
					'input' => 'form-input block w-full',
					'radio_group' => 'form-radio',
					'select' => 'form-select block w-full',
					'checkbox' => 'form-checkbox',
					'checkbox_group' => 'form-checkbox',
					'textarea' => 'form-textarea block w-full',
				],
			]
		));
		
		// Multi-selects need a different class, so we'll register this as a mutator
		// that will check the "multiple" attribute before rendering
		Select::registerElementMutator(function(Select $select) {
			$select->attributes->registerMutator('class', function(ClassNames $class_names) use ($select) {
				if ($select->attributes->get('multiple', false)) {
					$class_names
						->remove('form-select')
						->add('form-multiselect');
				}
				
				return $class_names;
			});
		});
	}
}
