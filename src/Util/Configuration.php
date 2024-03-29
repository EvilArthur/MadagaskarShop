<?php

namespace Up\Util;

class Configuration
{
	private static array $config = [];
	private static ?Configuration $instance = null;

	private function __construct()
	{
		if (!file_exists(ROOT . '/config/local.config.php'))
		{
			throw new \RuntimeException("local config not found");
		}
		if (!file_exists(ROOT . '/config/master.config.php'))
		{
			throw new \RuntimeException("master config not found");
		}
		$localConfig = require ROOT . '/config/local.config.php';
		$masterConfig = require ROOT . '/config/master.config.php';

		self::$config = array_merge($masterConfig, $localConfig);
	}

	public function option(string $name, $defaultValue = null)
	{
		if (array_key_exists($name, static::$config))
		{
			return static::$config[$name];
		}

		if ($defaultValue !== null)
		{
			return $defaultValue;
		}

		throw new \RuntimeException("Configuration option {$name} not found");
	}

	public static function getInstance(): Configuration
	{
		if (static::$instance)
		{
			return static::$instance;
		}

		static::$instance = new self();

		return static::$instance;
	}
}
