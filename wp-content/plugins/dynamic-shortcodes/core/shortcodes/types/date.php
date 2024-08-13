<?php

// SPDX-FileCopyrightText: 2022-2024 Ovation S.r.l. <help@dynamic.ooo>
// SPDX-License-Identifier: LicenseRef-GPL-3.0-with-dynamicooo-additional-terms

namespace DynamicShortcodes\Core\Shortcodes\Types;

use DynamicShortcodes\Core\Shortcodes\EvaluationError;
use DynamicShortcodes\Core\Shortcodes\BaseShortcode;

class Date extends BaseShortcode {
	public static function get_shortcode_types( $context ) {
		return [
			'date',
			'timedelta',
		];
	}

	public function timedelta() {
		$this->arity_check( 0, 0 );
		$this->init_keyargs(
			[
				'days' => [ 'd' ],
				'seconds' => [ 's' ],
				'minutes' => [ 'm' ],
				'hours' => [ 'h' ],
				'weeks' => [ 'w' ],
			]
		);
		$return_value  = 0;
		$return_value += $this->get_keyarg_default( 'weeks', 0, 'numeric' ) * 604800;
		$return_value += $this->get_keyarg_default( 'days', 0, 'numeric' ) * 86400;
		$return_value += $this->get_keyarg_default( 'hours', 0, 'numeric' ) * 3600;
		$return_value += $this->get_keyarg_default( 'minutes', 0, 'numeric' ) * 60;
		$return_value += $this->get_keyarg_default( 'seconds', 0, 'numeric' );
		return $return_value;
	}

	public function evaluate() {
		if ( $this->type === 'timedelta' ) {
			return $this->timedelta();
		}
		$this->arity_check( 1, 2 );
		$this->init_keyargs(
			[
				'format' => [ 'fmt' ], // how to format date, as accepted by wp_date.
				'sub' => [],
				'add' => [], // pass seconds to add subtract from timestamp.
				'year' => [],
				'month' => [],
				'month-name' => [],
				'day' => [],
				'day-of-week' => [],
				'hour' => [],
				'minutes' => [],
				'seconds' => [],
			]
		);
		$timestamp = strtotime( $this->get_arg( 0 ) );
		if ( $timestamp === false ) {
			return false;
		}
		if ( $this->get_args_count() >= 2 ) {
			$timestamp = strtotime( $this->get_arg( 1, 'string' ), $timestamp );
		}
		if ( $timestamp === false ) {
			return false;
		}
		$timestamp += $this->get_keyarg_default( 'add', 0, 'int' );
		$timestamp -= $this->get_keyarg_default( 'sub', 0, 'int' );
		$format     = get_option( 'date_format' );
		if ( $this->has_keyarg( 'format' ) ) {
			$format = $this->get_keyarg( 'format', 'string' );
		}

		switch ( true ) {
			case $this->has_keyarg( 'year' ):
				return wp_date( 'Y', $timestamp );
			case $this->has_keyarg( 'month' ):
				return wp_date( 'm', $timestamp );
			case $this->has_keyarg( 'month-name' ):
				return wp_date( 'F', $timestamp );
			case $this->has_keyarg( 'day' ):
				return wp_date( 'j', $timestamp );
			case $this->has_keyarg( 'day-of-week' ):
				return wp_date( 'l', $timestamp );
			case $this->has_keyarg( 'hour' ):
				return wp_date( 'H', $timestamp );
			case $this->has_keyarg( 'minutes' ):
				return wp_date( 'i', $timestamp );
			case $this->has_keyarg( 'seconds' ):
				return wp_date( 's', $timestamp );
			default:
				return wp_date( $format, $timestamp );
		}
	}
}
