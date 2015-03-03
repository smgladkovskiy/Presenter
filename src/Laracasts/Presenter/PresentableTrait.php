<?php namespace Laracasts\Presenter;

use Laracasts\Presenter\Exceptions\PresenterException;

trait PresentableTrait {

	/**
	 * View presenter instance
	 *
	 * @var mixed
	 */
	protected $presenterInstance;

	/**
	 * Prepare a new or cached presenter instance
	 *
	 * @return mixed
	 * @throws PresenterException
	 */
	public function present()
	{

		if ( ! $this->presenterInstance)
		{
			$this->presenterInstance = \App::make($this->presenter);
			$this->presenterInstance->setEntity($this);
			$this->locale = $this->translations->where('lang',\App::getLocale())->first();
		}

		return $this->presenterInstance;
	}

} 
