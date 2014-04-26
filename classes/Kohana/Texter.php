<?php defined('SYSPATH') or die('No direct script access');

/**
 * Kohana Texter
 *
 * Easily get, set and translate texts with kohana
 *
 * @package   Kohana/Texter
 * @category  Helper
 * @author    Dennis Ruhe
 * @copyright 2014 Dennis Ruhe
 */
class Kohana_Texter {

	/**
	 * Get a text from the database with a certain language
	 *
	 * @param   key        Key of the text
	 * @param   translate  Grab the text with specified language,
	 *                     can be omitted and will return I18n::lang() or default language set in config
	 * @return  String     Text you asked for
	 */
	public static function get($key, $translate = TRUE)
	{
		// Set default lang
		$lang = Kohana::$config->load('texter.default');

		// Override default language
		if(is_string($translate))
		{
			$lang = $translate;
		}

		// Override default language with I18n language
		if($translate === TRUE)
		{
			$lang = I18n::lang();
		}

		$select = DB::select('text')
			->from('texter')
			->where('key', '=', $key)
			->and_where('lang', '=', $lang);

		$result = $select->execute();

		// If there are no results, return default language set in config
		if($result->count() == 0 AND $lang != Kohana::$config->load('texter.default'))
		{
			return self::get($key, Kohana::$config->load('texter.default'));
		}

		// Otherwise return text column
		return $result->get('text');
	}

	public function set($key, $lang, $text)
	{

	}

} // End Kohana Texter
