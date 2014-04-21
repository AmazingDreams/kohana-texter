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

	public static function get($key, $translate = TRUE)
	{
		$lang = '';

		if(is_string($translate))
		{
			$lang = $translate;
		}

		if($translate === TRUE)
		{
			$lang = I18n::lang();
		}

		$select = DB::select('text')
			->from('texter')
			->where('key', '=', $key);

		$select = ($lang)
			? $select->and_where('lang', '=', $lang)
			: $select;

		$select = $select->execute();

		if($select->count() == 0 AND $lang != 'en-US')
		{
			return self::get($key, 'en-US');
		}

		if($select->count() > 1)
		{
			return $select;
		}

		return $select->get('text');
	}

	public function set($key, $lang = NULL)
	{

	}

} // End Kohana Texter
