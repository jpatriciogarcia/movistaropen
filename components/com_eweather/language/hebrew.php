<?php
/**
* @version $Id: weather.php,v 0.1 2005/05/05 10:00:00 stingrey Exp $
* @package Mambo
* @subpackage Contact
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* Translated By Benny Davidovich (www.otv.co.il)
*/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

define("_W_ACTUAL", "����� ������");
define("_W_FORECAST", "�����");
define("_W_LOC_DATA", "����� �����");
define("_W_WIND", "���");
define("_W_TEMP", "�����");
define("_W_WINDCHILL", "�����");
define("_W_WINDSPEED", "������");
define("_W_WINDDIR", "�����");
define("_W_WINDGUST", "������ ���..");
define("_W_SUNRISE", "�����");
define("_W_SUNSET", "�����");
define("_W_OBST", "���� �����");
define("_W_LAT", "�� ����");
define("_W_LON", "�� ����");
define("_W_DEWP", "����� ������");
define("_W_VISIBILITY", "����");
define("_W_HUMIDITY", "����");
define("_W_UV_INDEX", "��� UV");
define("_W_UV_LOW", "����");
define("_W_UV_MED", "������");
define("_W_UV_HIGH", "�����");
define("_W_UV_SHIGH", "������");
define("_W_PRESSURE", "���");
define("_W_UNKNOWN_ERROR", "������ ���� �� �����!");
define("_W_ERROR_TITLE", "����");
define("_W_ERROR_DESCR", "Folgender Fehler ist aufgetreten");
define("_W_ERROR_CODE", "��� �����");
define("_W_ERROR_NOPARTNERID", "��� ���� ����� �����!");
define("_W_ERROR_NOPASSWORD", "��� ���� ������!");
define("_W_FORECAST_SUNRISE", "�����");
define("_W_FORECAST_SUNSET", "�����");
define("_W_FORECAST_TEMP_MAX", "���");
define("_W_FORECAST_TEMP_MIN", "���");
define("_W_FORECAST_WINDSPEED", "������");
define("_W_FORECAST_DAY", "���");
define("_W_FORECAST_NIGHT"," ����");
define("_W_FORECAST_SUN", "���");
define("_W_FORECAST_TEMP", "��������");
define("_W_FORECAST_WIND", "���");
define("_W_FORECAST_HUMI", "����");
define("_W_FORECAST_DIRECTION", "�����.");
define("_W_FORECAST_RAIN", "������.");
define("_W_FORECAST_FTITLE", "��� ���� ����");
define("_W_FORECAST_BACK", "���� �����");
define("_W_FORECAST_FOR", "����");
define("_W_FORECAST_D_DAY", "���� ����");
define("_W_FORECAST_D_NIGHT", "�����");
define("_W_FORECAST_TEMP_D_MAX", "�������� ���.");
define("_W_FORECAST_TEMP_D_MIN", "�������� ���.");
define("_W_FORECAST_D_RAIN", "������");
define("_W_BAROMETER", "����.");
define("_W_PROVIDER", "���� ��");
define("_W_MOD_BUTTON", "��� ���� ����");
define("_W_SELECT_LOCATION", "��� �� ����....");

// Language tags for administration section
define("_WEATHER_TITLE", "������ ���� eWeather");
define("_WEATHER_PARAM_TITLE", "�����");
define("_WEATHER_VALUE_TITLE", "���");
define("_WEATHER_DESCRIB_TITLE", "�����");
define("_WEATHER_PARTNER_ID", "���� �����");
define("_WEAHTER_PARTNER_ID_D", "You need a Partner ID provided by <a href=\"http://www.weather.com/services/xmloap.html\" target=\"_blank\">http://www.weather.com</a>.");
define("_WEATHER_PARTNER_KEY", "���� �����");
define("_WEAHTER_PARTNER_KEY_D", "You need a Key provided by <a href=\"http://www.weather.com/services/xmloap.html\" target=\"_blank\">http://www.weather.com</a>.");
define("_WEATHER_DEFAULT_LOCATION", "�����");
define("_WEATHER_DEFAULT_LOCATION_D", "����� ���� ����");
define("_WEATHER_DEFAULT_LOC_CODE", "��� �����");
define("_WEATHER_DEFAULT_LOC_CODE_D", "��� ���� ���� ��� �����.");
define("_WEATHER_CACHE_TIME", "��� �������");
define("_WEATHER_CACHE_TIME_D", "��� ������� �����. ������� ���� 1800 ����� (30 ����)");
define("_WEATHER_UNITS", "�����");
define("_WEATHER_UNITS_D", "����� ����� ����� ������ (������ �����).");
define("_WEATHER_FORECAST_DAYS", "����");
define("_WEATHER_UNITS_ENG", "������");
define("_WEATHER_UNITS_INT", "�����");
define("_WEATHER_FORECAST_DAYS_D", "���� ���� ������");
define("_WEATHER_SHOW_FOOTER", "��� �����");
define("_WEATHER_SHOW_FOOTER_D", "��� �� ������ �����");
define("_WEATHER_SHOW_FORECAST", "��� �����");
define("_WEATHER_SHOW_FORECAST_D", "��� �� ������ �� �����");
define("_WEATHER_TIME_FORMAT", "����� ���");
define("_WEATHER_TIME_FORMAT_D", "����� ��� ������ ������. ������ ������ STRFTIME");
define("_WEATHER_DATE_FORMAT_LONG", "����� ����� (����)");
define("_WEATHER_DATE_FORMAT_LONG_D", "����� ��� ������ ������. ������ ������ STRFTIME");
define("_WEATHER_DATE_FORMAT_SHORT", "����� ����� (���)");
define("_WEATHER_DATE_FORMAT_SHORT_D", "Dateformat in short format for display in overviews. Look for parameters in strftime function");
define("_WEATHER_DATE_FORMAT_DETAIL", "����� ����� (����)");
define("_WEATHER_DATE_FORMAT_DETAIL_D", "Dateformat for detailed forecast. Look for parameters in strftime function");
define("_WEATHER_ICONSET", "����� �����");
define("_WEATHER_ICONSET_D", "��� ����� ����� ������.");

define("_WEATHER_REGION", "�����");
define("_WEATHER_COUNTRY", "�����");
define("_WEATHER_CITY", "���");
define("_WEATHER_CITY_CODE", "��� ���");
define("_WEATHER_PROFILE_UPDATE", "������ �����!");
define("_WEATHER_PROFILE_SAVED", "������ ����!");
define("_WEATHER_PROFILE_ERROR", "����� - ������ �� ����!");
define("_WEATHER_SAVE_BUTTON", "&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;");
define("_WEATHER_CANCEL_BUTTON", "&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;");
define("_WEATHER_SHOW_ALL", "��� �� �� ����� �������");
define("_WEATHER_GO_INST", "����� �������");

?>