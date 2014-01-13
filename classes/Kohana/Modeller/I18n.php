<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Modeller Controller
 * @author sg
 *
 */
class Kohana_Modeller_I18n {

    /**
     * @var array Available languages
     */
    protected static $_available_languages = array();

    /**
     * @var array Default language
     */
    protected static $_default_language = array();

    // -------------------------------------------------------------------------

    /**
     *
     */
    public static function available_languages($as_object = FALSE, $reset = FALSE)
    {
        if (empty(self::$_available_languages) OR $reset === TRUE)
        {
            self::$_available_languages = ($reset === TRUE) ? array() : Cache::instance()->get('available_languages', array());

            if (empty(self::$_available_languages))
            {
                self::$_available_languages = ORM::factory('I18n_Language')->find_all()->as_array();

                Cache::instance()->set('available_languages', self::$_available_languages, 1);
            }
        }

        if ($as_object)
        {
            $languages = self::$_available_languages;
        }
        else
        {
            $languages = array();

            foreach (self::$_available_languages as $language)
            {
                $languages[$language->id] = $language->iso;
            }
        }

        return $languages;
    }

    // -------------------------------------------------------------------------

    /**
     * Getter and Setter for current language
     *
     * @return int language id
     */
    public static function language($value = FALSE, $reset = FALSE)
    {
        if ($value === FALSE)
        {
            $value = I18n::lang();
        }

        // @TODO: add caching
        $lang = ($reset === TRUE) ? FALSE : Cache::instance()->get('language_'.$value, FALSE);

        if ($lang === FALSE)
        {
            $lang = ORM::factory('I18n_Language')->where(is_numeric($value) ? 'id' : 'iso', '=', $value)->find();

            if ( ! $lang->loaded())
            {
                throw new Kohana_Exception('The langugae :langugae does not exist in the database',
                    array(':langugae' => $value));
            }

            Cache::instance()->set('language_'.$value, $lang, 1);
        }

        return $lang;
    }

    // -------------------------------------------------------------------------

    /**
     *
     */
    public static function default_language()
    {
        foreach (self::available_languages(TRUE) as $language)
        {
            if ($language->default === '1')
            {
                return $language;
            }
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

}