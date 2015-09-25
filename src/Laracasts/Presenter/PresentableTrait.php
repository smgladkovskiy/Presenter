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
        	if ( ! $this->presenter ) 
        	{
            		$this->presenter = get_class($this).'Presenter';
		}

		if ( ! class_exists($this->presenter) )
		{
			throw new PresenterException('Presenter Not Found : '.$this->presenter);
		}

		if ( ! $this->presenterInstance)
		{
			$this->presenterInstance = \App::make($this->presenter);
			$this->presenterInstance->setEntity($this);
			if(isset($this->translations))
				$this->locale = $this->translations->where('lang',\App::getLocale())->first();
		}

		return $this->presenterInstance;
	}

} 
