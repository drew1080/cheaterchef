<?php 
/*
Plugin Name: WP Overview (lite) MS
Plugin URI: //slangji.wordpress.com/wp-overview-lite-ms/
Description: Show Dashboard Overview and footer memory usage with less consumption on Network Multi~Site Environment. Work under GPLv2 License. | <a href="//slangji.wordpress.com/donate/" title="Free Donation">Donate</a> | <a href="//wordpress.org/plugins/wp-overview-lite/" title="Show Dashboard Overview and Footer Memory Load Usage">WP Overview?</a> | <a href="//wordpress.org/plugins/wp-missed-schedule/" title="Fix Missed Scheduled Future Posts Cron Job">WP Missed Schedule?</a> | <a href="//wordpress.org/plugins/wp-admin-bar-removal/" title="Remove Admin Bar Frontend Backend User Profile and Code">Admin Bar Removal?</a> | <a href="//wordpress.org/plugins/wp-admin-bar-node-removal/" title="Remove Admin Bar Frontend and Backend Node">Admin Bar Node Removal?</a> | <a href="//wordpress.org/plugins/wp-toolbar-removal/" title="Remove ToolBar Frontend Backend User Profile and Code">ToolBar Removal?</a> | <a href="//wordpress.org/plugins/wp-toolbar-node-removal/" title="Remove ToolBar Frontend and Backend Node">ToolBar Node Removal?</a> | <a href="//wordpress.org/plugins/wp-login-deindexing/" title="Total DeIndexing WordPress LogIn from all Search Engines">LogIn DeIndexing?</a> | <a href="//wordpress.org/plugins/wp-total-deindexing/" title="Total DeIndexing WordPress from all Search Engines">WP DeIndexing?</a> | <a href="//wordpress.org/plugins/wp-ie-enhancer-and-modernizer/" title="Enhancer and Modernizer IE Surfing Expirience">Enhancer IE Surfing?</a>
Version: 2012.1122.2016
Author: slangjis
Author URI: //slangji.wordpress.com/
Requires at least: 3.0
Tested up to: 3.6
License: GPLv2 or later
License URI: //www.gnu.org/licenses/gpl-2.0.html
Indentation: GNU style coding standard
Indentation URI: //www.gnu.org/prep/standards/standards.html
Network: true
 *
 * LICENSING
 *
 * [WP Overview (lite) MS](//wordpress.org/plugins/wp-overview-lite-ms/) 
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the [GNU General Public License](//wordpress.org/about/gpl/)
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see [GNU General Public Licenses](//www.gnu.org/licenses/),
 * or write to the Free Software Foundation, Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * DISCLAIMER
 *
 * The license under which the WordPress software is released is the GPLv2 (or later) from the
 * Free Software Foundation. A copy of the license is included with every copy of WordPress.
 *
 * Part of this license outlines requirements for derivative works, such as plugins or themes.
 * Derivatives of WordPress code inherit the GPL license.
 *
 * There is some legal grey area regarding what is considered a derivative work, but we feel
 * strongly that plugins and themes are derivative work and thus inherit the GPL license.
 *
 * The license for this software can be found on [Free Software Foundation](//www.gnu.org/licenses/gpl-2.0.html) and as license.txt into this plugin package.
 *
 * The author of this plugin is available at any time, to make all changes, or corrections, to respect these specifications.
 *
 * THERMS
 *
 * This uses (or it parts) code derived from
 *
 * wp-header-footer-log.php by slangjis <slangjis [at] googlemail [dot] com>
 * Copyright (C) 2009-2013 [slangjis](//slangji.wordpress.com/) (email: <slangjis [at] googlemail [dot] com>)
 *
 * wp-overview-lite.php by slangjis <slangjis [at] googlemail [dot] com>
 * Copyright © 2010 [slangjis](//slangji.wordpress.com/) (email: <slangjis [at] googlemail [dot] com>)
 *
 * according to the terms of the GNU General Public License version 2 (or later)
 *
 * This wp-header-footer-log.php uses (or it parts) code derived from
 *
 * wp-footer-log.php by slangjis <slangjis [at] googlemail [dot] com>
 * Copyright (C) 2008-2013 [slangjis](//slangji.wordpress.com/) (email: <slangjis [at] googlemail [dot] com>)
 *
 * sLa2sLaNGjIs.php by slangjis <slangjis [at] googlemail [dot] com>
 * Copyright (C) 2009-2013 [slangjis](//slangji.wordpress.com/) (email: <slangjis [at] googlemail [dot] com>)
 *
 * according to the terms of the GNU General Public License version 2 (or later)
 *
 * According to the Terms of the GNU General Public License version 2 (or later) part of Copyright belongs to your own author and part belongs to their respective others authors:
 *
 * Copyright (C) 2008-2013 [slangjis](//slangji.wordpress.com/) (email: <slangjis [at] googlemail [dot] com>)
 *
 * VIOLATIONS
 *
 * [Violations of the GNU Licenses](//www.gnu.org/licenses/gpl-violation.en.html)
 * The author of this plugin is available at any time, to make all changes, or corrections, to respect these specifications.
 *
 * GUIDELINES
 *
 * This software meet [Detailed Plugin Guidelines](//wordpress.org/plugins/about/guidelines/) paragraphs 1,4,10,12,13,16,17 quality requirements.
 * The author of this plugin is available at any time, to make all changes, or corrections, to respect these specifications.
 *
 * CODING
 *
 * This software implement [GNU style](//www.gnu.org/prep/standards/standards.html) coding standard indentation.
 * The author of this plugin is available at any time, to make all changes, or corrections, to respect these specifications.
 *
 * VALIDATION
 *
 * This readme.txt rocks. Seriously. Flying colors. It meet the specifications according to WordPress [Readme Validator](//wordpress.org/plugins/about/validator/) directives.
 * The author of this plugin is available at any time, to make all changes, or corrections, to respect these specifications.
 */

	/**
	 * @package WP Overview (lite) MS
	 * @subpackage WordPress PlugIn
	 * @description 
	 * @since 3.0.0
	 * @tested 3.6.0
	 * @version 2012.1122.2016
	 * @1stversion 
	 * @status STABLE (trunk) release
	 * @development Code in Becoming!
	 * @install The configuration of this Plugin is Automattic!
	 * @author slangjis
	 * @license GPLv2 or later
	 * @indentation GNU style coding standard
	 * @keytag 74be16979710d4c4e7c6647856088456
	 */

	if ( !function_exists( 'add_action' ) )
		{
			header( 'HTTP/0.9 403 Forbidden' );
			header( 'HTTP/1.0 403 Forbidden' );
			header( 'HTTP/1.1 403 Forbidden' );
			header( 'Status: 403 Forbidden' );
			header( 'Connection: Close' );
				exit();
		}
?>
<?php
	function wpoms_nfo()
		{
			echo "\n<!--Plugin WP Overview (lite) MS 2010.0925.0254-MS Active-->";
		}
	add_action('wp_head', 'wpoms_nfo');
	add_action('wp_footer', 'wpoms_nfo');
?>
<?php
if ( is_admin() ) {
	class wp_overview_lite_ms { 
		var $memory = false;
			function wpo() {
				return$this->__construct();
				}
			function __construct() {
				add_action( 'init', array(&$this, 'wpo_limit' ) );
				add_action( 'wp_dashboard_setup', array(&$this, 'wpo_dashboard' ) );
				add_filter( 'admin_footer_text', array(&$this, 'wpo_footer' ) );
				$this->memory = array();
				}
			function wpo_limit() {
			$this->memory[ 'wpo-limit' ] = (int)ini_get( 'memory_limit' );
			}
			function wpo_load() {
			$this->memory[ 'wpo-load' ] = function_exists( 'memory_get_usage' )?round(memory_get_usage()/1024/1024,2):0;
			}
			function wpo_consumption() {
			$this->memory[ 'wpo-consumption' ] = round($this->memory[ 'wpo-load' ]/$this->memory[ 'wpo-limit' ]*100,0);
			}
			function wpo_output() {
			$this->wpo_load();
			$this->wpo_consumption();
			$this->memory[ 'wpo-load' ] = empty($this->memory[ 'wpo-load' ] )?__( '0' ):$this->memory[ 'wpo-load' ].__( 'M' )
?>
<?php
	global $wpdb, $wp_version, $wpmu_version;
	$mysql_status = array();
	$mysql_vars   = array();
	foreach ($wpdb->get_results('SHOW GLOBAL STATUS') as $result)
		{
			$mysql_status[$result->Variable_name] = $result->Value;
		}
	foreach ($wpdb->get_results('SHOW GLOBAL VARIABLES') as $result)
		{
			$mysql_vars[$result->Variable_name] = $result->Value;
		}
	$uptime_days    = $mysql_status['Uptime'] / 86400;
	$uptime_hours   = ($uptime_days - (int) $uptime_days) * 24;
	$uptime_minutes = ($uptime_hours - (int) $uptime_hours) * 60;
	$uptime_seconds = ($uptime_minutes - (int) $uptime_minutes) * 60;
	$uptime_string  = (int) $uptime_days . ' days, ' . (int) $uptime_hours . ' hours, ' . (int) $uptime_minutes . ' minutes, ' . (int) $uptime_seconds . ' seconds'
?>
<ul><li><strong>Mem</strong>:
<strong>WP </strong><span><?php echo WP_MEMORY_LIMIT?></span>
<strong>Usage </strong><span><?php echo$this->memory['wpo-consumption'].'%'.' '.$this->memory['wpo-load']?></span>
<strong>Limit </strong><span><?php echo$this->memory['wpo-limit'].'M *'?></span></li>
<li><br/><strong>Server</strong>:
<strong>OS </strong><span><?php echo PHP_OS?></span>
<strong>Software </strong><span><?php echo$_SERVER['SERVER_SOFTWARE']?></span>
<strong>Version </strong><span><?php echo(PHP_INT_SIZE*8).__('Bit')?></span></li>
<li><strong>Name </strong><span><?php echo$_SERVER['SERVER_NAME']?></span>
<strong>Address </strong><span><?php echo$_SERVER['SERVER_ADDR']?></span>
<strong>Port </strong><span><?php echo$_SERVER['SERVER_PORT']?></span></li>
<li><strong>Type </strong><span><?php echo php_uname()?></span></li>
<li><strong>System</strong>:
<strong>PHP </strong><span><?php echo PHP_VERSION?></span>
<strong>Active Plugins </strong><span><?php echo count(get_option('active_plugins'))?></span>
<strong>Zend </strong><span><?php echo zend_version()?></span></li>
<li><strong>Database</strong>:
<strong>SQL </strong><span><?php printf("%s\n",mysql_get_client_info())?></span>
<strong>Build </strong><span><?php echo$mysql_vars['version']?></span>
<strong>Charset </strong><span><?php echo DB_CHARSET?></span></li>
<li><strong>Name </strong><span><?php echo DB_NAME?></span>
<strong>Host </strong><span><?php echo DB_HOST?></span></li>
<li><strong>WordPress</strong>:
<strong>VER </strong><span><?php echo _e($wp_version)?></span><strong> Language </strong><span><?php echo _e(WPLANG)?></span><strong> Locale </strong><span><?php echo$cur_locale?></span></li>
<li><strong>Max</strong>:
<strong>Post </strong><span><?php echo _e(ini_get('post_max_size'))?></span>
<strong>Upload </strong><span><?php echo _e(ini_get('upload_max_filesize'))?></span>
<strong>Input </strong><span><?php echo ini_get('max_input_time')?>s</span>
<strong>Exec </strong><span><?php $et=ini_get('max_execution_time');if($et>1000)$et/=1000;echo$et?>s</span></li>
<li><strong>Debug</strong>:
<strong>State </strong><span><?php echo(int)WP_DEBUG?></span>
<strong>Display </strong><span><?php echo(int)WP_DEBUG_DISPLAY?></span>
<strong>Log </strong><span><?php echo(int)WP_DEBUG_LOG?></span>
<strong>Script </strong><span><?php echo(int)SCRIPT_DEBUG?></span>
<strong>Deprecated </strong><span><?php echo(int)E_DEPRECATED?></span><br/></li>
<li><br/><strong>SQL Uptime</strong>:<span> <?php echo$uptime_string?></span><br/></li>
<li><br/><strong>Default Theme</strong><span> <?php echo WP_DEFAULT_THEME?></span><em> (since wp-3.0)</em></li>
<li><strong>Allow DB Repair</strong><span> <?php echo(int)WP_ALLOW_REPAIR?></span><em> (since wp-2.9)</em></li>
<li><strong>Auto-Save</strong><span> <?php echo(int)AUTOSAVE_ON?></span><strong> Interval </strong><span><?php echo(int)AUTOSAVE_INTERVAL.' seconds'?></span><em> (since wp-2.5)</em></li>
<li><strong>WP (Hyper - Super - W3 Total) Cache </strong><span><?php echo(int)WP_CACHE?></span><em> (since wp-2.6)</em></li>
<li><strong>Magpie RSS Cache </strong><span><?php echo(int)MAGPIE_CACHE_ON?></span><strong> Age </strong><span><?php echo(int)MAGPIE_CACHE_AGE.' seconds'?></span><em> (since wp-1.5)</em></li>
<li><strong>Post Revisions </strong><span><?php echo(int)WP_POST_REVISIONS?></span><em> (since wp-2.6)</em></li>
<li><strong>Trash</strong> <span><?php echo(int)WP_TRASH?></span><strong> Empty </strong><span><?php echo(int)EMPTY_TRASH_DAYS.' days'?></span><em> (since wp-2.9)</em><br/></li>
<li><br/><strong><u>NETWORK - MU~LTI-SITE</u></strong></li>
<li><strong>404 </strong><span><?php echo _e(NOBLOGREDIRECT)?></span></li>
<li><strong>Network </strong><span><?php echo _e(WP_ALLOW_MULTISITE)?></span><em> (since wp-3.0)</em><strong> Multi-site </strong><span><?php echo _e(MULTISITE)?></span><em> (since wp-3.0.1)</em></li>
<li><strong>Sunrise </strong><span><?php echo _e(SUNRISE)?></span></li></ul><br/>
<em><strong>Legend</strong> 0=disabled 1=enabled * PHP or WP</em>
<?php }
function wpo_dashboard() {
	wp_add_dashboard_widget( 'wp_overview_lite_ms_dashboard_widget', 'Overview', array(&$this, 'wpo_output' ) );
	}
	function wpo_footer($content) {
		$this->wpo_load();
		$content.=' | Load '.$this->memory[ 'wpo-load' ].'M'.' of '.$this->memory[ 'wpo-limit' ].'M';
		return $content;
		}
	}
	add_action( 'plugins_loaded', create_function( '', '$memory = new wp_overview_lite_ms();' ) );
}
?>