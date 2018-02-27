<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 12/02/2018
 * Time: 09:31
 */

namespace share\SharePress\ServiceProviders;

use share\SharePress\Facades\Container;
use share\SharePress\WordPress\Security\Actions\AdvancedFingerprintingResponse;
use share\SharePress\WordPress\Security\Actions\FilterOutOffendingUserAgents;
use share\SharePress\WordPress\Security\Actions\PreventPluginEnumeration;
use share\SharePress\WordPress\Security\Actions\PreventUserEnumeration;
use share\SharePress\WordPress\Security\Actions\SpoofWPGlobalVersion;
use share\SharePress\WordPress\Security\Filters\DisableXMLRPC;
use share\SharePress\WordPress\Security\Filters\ModifyGenerator;
use share\SharePress\WordPress\Security\Filters\RemoveWPVersionFromResources;
use share\SharePress\WordPress\Security\Filters\RemoveXMLRPCHTTPHeader;

class WPSecurityServiceProvider implements IServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		Container::make(AdvancedFingerprintingResponse::class);
		Container::make(FilterOutOffendingUserAgents::class);
		Container::make(PreventPluginEnumeration::class);
		Container::make(PreventUserEnumeration::class);
		Container::make(SpoofWPGlobalVersion::class);
		Container::make(DisableXMLRPC::class);
		Container::make(ModifyGenerator::class);
		Container::make(RemoveWPVersionFromResources::class);
		Container::make(RemoveXMLRPCHTTPHeader::class);

		$this->defaultActionsRemoval();
	}

	private function defaultActionsRemoval () {
		// Remove feed links from the header
		remove_action('wp_head', 'feed_links_extra', 3 );
		remove_action('wp_head', 'feed_links', 2 );

		// REMOVE WP EMOJI
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_scripts', 'print_emoji_detection_script' );
		remove_action('admin_print_styles', 'print_emoji_styles' );

		// Remove the rest link
		remove_action('wp_head',      'rest_output_link_wp_head'              );
		remove_action('wp_head',      'wp_oembed_add_discovery_links'         );
		remove_action('template_redirect', 'rest_output_link_header', 11);

		// remove xmlrpc links
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');

		// remove visual composer meta tags
		if(function_exists('visual_composer')) {
			remove_action('wp_head', array(visual_composer(), 'addMetaData'));
		}
	}
}